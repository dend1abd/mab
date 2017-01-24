<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	$_SESSION["transaksi_tipe"] = "16";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	//$sql = "select * from tGroupUser order by GroupUserName";							
	//$rsGroupUser = $oDB->ExecuteReader($sql);
	
	if (isset($_POST["txtOp"]))
	{
		$_SESSION["op"] = $_POST["txtOp"];
        $_SESSION["ID"] = $_POST["txtID"];

        if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
        {
            
            if ($_SESSION["op"] == "1"){
            	$_SESSION["transaksi_kode"] = getKodeTransaksi($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB); 
            	updateKodeTransaksi($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB);  
            }            
			$_SESSION["transaksi_tgl"] = $_POST["txttransaksi_tgl"];
			$_SESSION["contact_code"] = $_POST["txtcontact_code"]; 
			$_SESSION["piutang"] = $_POST["txtpiutang"];
			$_SESSION["keterangan"] = $_POST["txtketerangan"];  	
			$_SESSION["divisi"] = $_POST["txtdivisi"];
        }
       	FormProcess(); 
	}
	else
	{
		$_SESSION["op"] = $_GET["op"];		
		if (isset($_GET["customer"]))
			$customer = retrieveS($_GET["customer"]);
		else
			$customer = "";
			
		if (isset($_GET["divisi"]))
			$divisi = retrieveS($_GET["divisi"]);
		else
			$divisi = "";
			
		if ($_SESSION["op"] == "1")
		{
            $_SESSION["modeView"] = "1"; 
			ClearSession(); 
			$_SESSION["transaksi_kode"] = getKodeTransaksi($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB); 
			$_SESSION["transaksi_kode"] = str_replace("X",$divisi, $_SESSION["transaksi_kode"]);
			$_SESSION["transaksi_tgl"] = date("Y-m-d");
			$_SESSION["contact_code"] = $customer;
			$_SESSION["divisi"] = $divisi;
            $_SESSION["btnLabel"] = "Save Data";
            $_SESSION["lblTitle"] = "New Data Kontrabon Piutang";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT * FROM trx_master a WHERE a.transaksi_kode ='" .$_SESSION["ID"] . "'";
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["transaksi_kode"] = $data["transaksi_kode"];
				$_SESSION["transaksi_tipe"] = $data["transaksi_tipe"];
				$_SESSION["transaksi_tgl"] = $data["transaksi_tgl"];
				$_SESSION["contact_code"] = $data["contact_code"];
				$_SESSION["piutang"] = $data["total"];
				$_SESSION["keterangan"] = $data["keterangan"]; 			
				$_SESSION["divisi"] = $data["kode_divisi"];
			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data";
                $_SESSION["lblTitle"]  = "Edit Data Kontrabon Piutang";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data";
                    $_SESSION["lblTitle"]  = "Delete Data Kontrabon Piutang";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data Kontrabon piutang";
			}
        }
        else    
            eror("invalid op");
    	
		FormLoad();
	}

function FormProcess()
{	
	global $oDB; 
	
	//$jmlItem = $_POST["txtJmlItem"];
		//eror($jmlItem);

	
    if($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
    { 
		$array2d[] = array("transaksi_tipe", $_SESSION["transaksi_tipe"], 0);
		$array2d[] = array("transaksi_tgl", $_SESSION["transaksi_tgl"], 1);
		$array2d[] = array("contact_code", $_SESSION["contact_code"], 1);
		$array2d[] = array("keterangan", $_SESSION["keterangan"], 1); 	
		$array2d[] = array("kode_divisi", $_SESSION["divisi"], 1);
		$array2d[] = array("total", $_SESSION["piutang"], 0); 	
        
        if ($_SESSION["op"] == "1")
        {
        	$array2d[] = array("transaksi_kode", $_SESSION["transaksi_kode"], 1); 
        	$_SESSION["ID"] = $_SESSION["transaksi_kode"];
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlInsert("trx_master", $array2d);
            $strTemp = "Data has been successfully inserted"; 
        }            
        else
        {           
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("trx_master", $array2d, "where transaksi_kode='" .$_SESSION["ID"] . "'");	
            $strTemp = "Data has been successfully updated";
        }
        $oDB->ExecuteNonQuery($sqlCmd);	

        
		$jmlItem = $_POST["txtJmlItem"];
		//eror($jmlItem);
		
		$sqlCmd = "delete from trx_kontrabon where transaksi_kode='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);
		
		for($i=1; $i<=$jmlItem; $i++){
			unset($array2d);
			$array2d[] = array("transaksi_kode", $_SESSION["ID"], 1); 
			$array2d[] = array("no_invoice", $_POST["txtDetailno_invoice$i"], 1);
			$array2d[] = array("tgl_invoice", $_POST["txtDetailtgl_invoice$i"], 1);
			$array2d[] = array("jml_invoice", $_POST["txtDetailjml_invoice$i"], 0);
			$array2d[] = array("telah_bayar", $_POST["txtDetailtelah_bayar$i"], 0);
			$array2d[] = array("jml_hutang", $_POST["txtDetailjml_hutang$i"], 0);
			
			$sqlCmd = sqlInsert("trx_kontrabon", $array2d);  
			$oDB->ExecuteNonQuery($sqlCmd);	
		}
		
		$tambahanUrl = "&kode=" .$_SESSION["ID"];
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from trx_master where transaksi_kode='" . $_SESSION["ID"] . "'"; 
        $oDB->ExecuteNonQuery($sqlCmd);	
        
        $sqlCmd = "delete from trx_kontrabon where transaksi_kode='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);
        
        $strTemp = "Data has been successfully deleted";
		$tambahanUrl = "";
    }
    else
        eror("invalid op"); 
	
	if ($_SESSION["op"] != "3")
		header("location:kontrabon_piutang_cetak.php?kode=" .$_SESSION["ID"]);
	else
		header("location:global_notification.php?from=kontrabon_piutang" .$tambahanUrl. "&strMsg=" . htmlspecialchars($strTemp));

}

function FormLoad()
{	
		
	global $oDB;  
	global $clsformatInteger;
	global $clsformatIntegerReadOnly;
	global $clsReadOnly;
	global $ajaxgettgl_invoice; 
	global $customer;
	global $divisi;
	
	if ($_SESSION["op"] == "1"){
		$sql = "select no_invoice, tgl_invoice, sum(jml_in) as jml_invoice, sum(jml_out) as telah_bayar, sum(jml_in) - sum(jml_out) as piutang from trx_invoice ";
		$sql = $sql . "where contact_code='$customer' ";
		$sql = $sql . "group by no_invoice, tgl_invoice HAVING sum(jml_in) - sum(jml_out) <> 0 ";
		
		$sql = "
		select a.transaksi_kode as no_invoice, a.transaksi_tgl as tgl_invoice, ifnull(total,0) as jml_invoice, (ifnull(bayar,0) + ifnull(b.paid,0)) as telah_bayar
,(ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) as piutang
,(ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) as jml_bayar
, '' ket_bayar, transaksi_tipe
from trx_master a
left join 
(
	select a.contact_code, b.no_invoice, sum(ifnull(jml_bayar,0)) as paid
	from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode	
	where a.transaksi_tipe in (18) 
	group by a.contact_code, b.no_invoice
)b on a.contact_code = b.contact_code and a.transaksi_kode = b.no_invoice
where a.transaksi_tipe in (6, 7, 8) and a.contact_code ='$customer' and a.kode_divisi ='$divisi' and (ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) <> 0 order by transaksi_tgl, transaksi_kode";
	
	}
	else{
		$sql = "SELECT no_invoice, tgl_invoice, jml_invoice, telah_bayar, jml_hutang as piutang FROM trx_kontrabon a WHERE a.transaksi_kode ='" .$_SESSION["ID"] . "'";
	}
	
	//eror($sql); 
    $rsdetail = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows; 
    
    $sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe in (3)"; 
    $rsCustomer = $oDB->ExecuteReader($sqlCmd);  
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List Jurnal</title>
</head>

<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--  

var jmlItem = <?php echo $jmlItem ?>;

function delRow(index){
	jmlItem = parseInt(document.getElementById('txtJmlItem').value);
    var i = 0;
	if (confirm('Delete no invoice ' + document.getElementById('txtDetailno_invoice' + (index)).value + ' ?')){
		if (index < jmlItem){		
			for(i=index;i<jmlItem;i++)
			{
				document.getElementById('txtDetailno_invoice' + (i)).value =  document.getElementById('txtDetailno_invoice' + (i+1)).value; 
				document.getElementById('txtDetailtgl_invoice' + (i)).value =  document.getElementById('txtDetailtgl_invoice' + (i+1)).value;
				document.getElementById('txtDetailjml_invoice' + (i)).value =  document.getElementById('txtDetailjml_invoice' + (i+1)).value;
				document.getElementById('txtDetailtelah_bayar' + (i)).value =  document.getElementById('txtDetailtelah_bayar' + (i+1)).value;
				document.getElementById('txtDetailjml_hutang' + (i)).value =  document.getElementById('txtDetailjml_hutang' + (i+1)).value; 
			}
		}
		removeItem();
		sumJumlah();
	}
}

function removeItem(){
	jmlItem = parseInt(document.getElementById('txtJmlItem').value);	
	if(jmlItem != 0)
	{		
		var table = document.getElementById('tblDetail');		
		var rowCount = table.rows.length;
		table.deleteRow(rowCount-2)
		jmlItem = jmlItem-1; 
		
		document.getElementById('txtJmlItem').value = jmlItem;
    }
}

function sumJumlah(){
    var i = 0; 
    var sumBayar = 0; 
	var sumHutang = 0; 
    var nilai = 0; 
	
	jmlItem = parseInt(document.getElementById('txtJmlItem').value);
    for(i=1;i<=jmlItem;i++){ 
		
		if (document.getElementById('txtDetailjml_hutang' + (i)).value == "") { document.getElementById('txtDetailjml_hutang' + (i)).value = "0";}
    	nilai = eval(formatBilangan(document.getElementById('txtDetailjml_hutang' + (i)).value));
    	sumHutang = sumHutang + nilai; 
    }     
     
	document.getElementById('txtsumhutang').value = formatCurrency3(sumHutang);
}

function setNormal(){
    var i = 0; 
  	jmlItem = parseInt(document.getElementById('txtJmlItem').value);

    for(i=1;i<=jmlItem;i++)
    { 
    	document.getElementById('txtDetailjml_invoice' + (i)).value = formatBilangan(document.getElementById('txtDetailjml_invoice' + (i)).value); 
    	document.getElementById('txtDetailtelah_bayar' + (i)).value = formatBilangan(document.getElementById('txtDetailtelah_bayar' + (i)).value);
    	document.getElementById('txtDetailjml_hutang' + (i)).value = formatBilangan(document.getElementById('txtDetailjml_hutang' + (i)).value); 
    } 
    
    document.getElementById('txtsumhutang').value = formatBilangan(document.getElementById('txtsumhutang').value);
    
}
 



function errMsg() {
	<?php 
	if( $_SESSION["errAlert"] ==true){	
		echo "alert('" . $_SESSION["errAlert"] . "')";
	}
	?>
} 

function frmCetak(){
	kode = document.input.txttransaksi_kode.value;
	//alert(kode );
	window.open("kontrabon_piutang_cetak.php?kode="+kode, "cetak_jurnal_" + kode ,  "height=360, width=640, location=0,menubar=0,scrollbars=1,resizable=0, modal=yes");

}

function frmDaftarpiutang(){
}


function frmSubmit(){ 
    op = document.input.txtOp.value;

    if (op == "1" || op == "2")
    { 
    	
    	/*
    	if(document.input.txtJmlItem.value == "")
    	{
    		alert("");	
    		return false; 
    	}
    	*/
    	
    	if(document.input.txttransaksi_kode.value == "")
    	{
    		alert("kode transaksi masih kosong");	
    		return false; 
    	}
    	
    	if(document.input.txttransaksi_tgl.value == "")
    	{
    		alert("tgl transaksi masih  kosong");	
    		return false; 
    	}  
      	
      	//alert(document.input.txtJmlItem.value);
      	//return false;
    }

    if (op == "1")
        msg = 'Confirm add Data?';
    else if (op == "2")
        msg = 'Confirm edit Data?';
    else if (op == "3")
        msg = 'Confirm delete Data?';
    else
    {
        msg = 'invalid op';
        return false;
    } 
	 
	if(confirm(msg)){ 
		if (op == "1" || op == "2"){
			document.input.txtJmlItem.value = jmlItem;  
			sumJumlah();
			setNormal(); 
			
			document.getElementById("btSubmit").disabled = true; 
			if (op != "1"){
				document.getElementById("btCetak").disabled = true;
			}
			document.getElementById("btBack").disabled = true
    	}
		document.input.submit();
	}
	
}
-->
</Script>

<body onLoad="errMsg()">
<form name="input" method="post" >
<input type ="hidden" name="txtOp" value="<?php echo $_SESSION["op"]; ?>" />
<input type ="hidden" name="txtID" value="<?php echo $_SESSION["ID"]; ?>" /> 

<table width="90%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
	<tr bgcolor="white" >
	<td class="contentTitleTable" align="center">
	<?php echo $_SESSION["lblTitle"] ?>	</td>
	</tr>
	<tr bgcolor="white">
	<td height="250" valign="top" align="left">
		
		<table width="100%">
		
			<tr>
				<td width=50% valign="top"> <!-- kiri-->
					<table width="100%"> 
						<tr class="font10black">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">  Kode Kontrabon</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txttransaksi_kode", $_SESSION["transaksi_kode"], 20, 20, " readonly"); ?> </td>
						</tr >
						<tr class="font10black">
						  <td style="height: 23px"></td>
						  <td style="height: 23px">  Tgl Kontrabon</td>
						  <td style="height: 23px">:</td>
						  <td style="height: 23px"> <?php  echo getDatePicMand($_SESSION["modeView"], "txttransaksi_tgl", $_SESSION["transaksi_tgl"], ""); ?> </td>
						</tr >  
					</table>
				</td>
				
				<td  valign="top"> <!-- kanan-->
					<table width="100%">
						<tr class="font10black">
						  <td style="width: 3%"></td>
						  <td width="30%">Customer</td>
						  <td width="1%">:</td> 
						  <td> <?php  
						  echo getComboBox(2, "txtcontact_code", $_SESSION["contact_code"], $rsCustomer, ""); 
						  echo getHiddenBox(1, "txtcontact_code", $_SESSION["contact_code"]); 
						  ?> </td>
						  
						</tr >
						
						<tr class="font10black">
						  <td style="width: 3%"></td>
						  <td width="30%">Divisi</td>
						  <td width="1%">:</td> 
						  <td> <?php  
						  echo getComboBox(2, "txtdivisi", $_SESSION["divisi"], $rsArtikel, ""); 
						  echo getHiddenBox(1, "txtdivisi", $_SESSION["divisi"]); 
						  ?> </td>
						  
						</tr >

					</table>
				</td> 
			</tr>
			
			<!-- detail invoice-->
			
			<tr  class="font10black">
				<td colspan=2 valign="top">
					<b>List Faktur / Invoice</b>
				</td>
			</tr>
			
			<tr >
				<td colspan=2 valign="top">  
					<table width="100%"  cellspacing="1" bgcolor="silver" id="tblDetail" >  
					
						<tr class="contentTitleTable" align="center"> 
	                        <td style="height: 22px">&nbsp;</td>   
							<td style="height: 22px">No</td>
							<td style="height: 22px">No Faktur</td> 
							<td style="height: 22px">Tgl Faktur</td>
							<td style="height: 22px">Jumlah</td>
							<td style="height: 22px">Telah Bayar</td> 
							<td style="height: 22px">Piutang</td>
						</tr> 
						
						<?php
							$i = 0;
							if ($jmlItem == 0){
								echo "<tr bgcolor='#ffffff' class='font10black'><td align='center' colspan=6>Data tidak ada</td></tr>";								
							}
							else
							{
								$sumPiutang = 0;
								while ($datadetail = mysql_fetch_array($rsdetail)) 
								{
									$i++;

									$jml_invoice = $datadetail["jml_invoice"];
									$telah_bayar = $datadetail["telah_bayar"];
									$jml_hutang = $datadetail["piutang"];
									//$jml_bayar = $datadetail["jml_bayar"];
									
									if (($_SESSION["op"] == "1") && ($datadetail["transaksi_tipe"] == 8)){
										$jml_invoice = $jml_invoice * -1;
										$telah_bayar = $telah_bayar * -1;
										$jml_hutang = $jml_hutang * -1;
										//$jml_bayar = $jml_bayar * -1 ; 								
									}

									echo "<tr bgcolor='#ffffff' class='font10black'>";
									
									echo "<td align='left'>";
									echo "<img src='images/delmini.gif' onClick='delRow($i);'>";  
									echo "</td>";  
								
									echo "<td align='center'>$i";
									echo "</td>"; 
									
									echo "<td align='left'>";
									//echo $datadetail["no_invoice"];
									//echo getHiddenBox(1, "txtDetailno_invoice$i", $datadetail["no_invoice"]);
									echo getTextBox($_SESSION["modeView"], "txtDetailno_invoice$i", $datadetail["no_invoice"], 50, 15, $clsReadOnly . " readonly");
									echo "</td>";
									
									echo "<td align='left'>";
									//echo $datadetail["tgl_invoice"];
									//echo getHiddenBox(1, "txtDetailtgl_invoice$i", $datadetail["tgl_invoice"]);
									echo getTextBox($_SESSION["modeView"], "txtDetailtgl_invoice$i", $datadetail["tgl_invoice"], 50, 15, $clsReadOnly . " readonly");
									echo "</td>";
	
									echo "<td align='right'>";
									//echo setNumber($datadetail["jml_invoice"]);
									//echo getHiddenBox(1, "txtDetailjml_invoice$i", $datadetail["jml_invoice"]);
									echo getTextBox($_SESSION["modeView"], "txtDetailjml_invoice$i", setNumber($jml_invoice), 50, 15, $clsformatIntegerReadOnly . " readonly");
									echo "</td>";
									
									echo "<td align='right'>";
									//echo setNumber($datadetail["telah_bayar"]);
									//echo getHiddenBox(1, "txtDetailtelah_bayar$i", $datadetail["telah_bayar"]);
									echo getTextBox($_SESSION["modeView"], "txtDetailtelah_bayar$i", setNumber($telah_bayar), 50, 15, $clsformatIntegerReadOnly . " readonly");
									echo "</td>";
									
									echo "<td align='right'>";
									//echo setNumber($datadetail["piutang"]);
									//echo getHiddenBox(1, "txtDetailjml_hutang$i", $datadetail["piutang"]);
									echo getTextBox($_SESSION["modeView"], "txtDetailjml_hutang$i", setNumber($jml_hutang), 50, 15, $clsformatIntegerReadOnly . " readonly");
									echo "</td>";
									
									echo "</tr>";
									
									$sumPiutang = $sumPiutang + $jml_hutang;
								}
								
								echo "<tr bgcolor='white' class='font10black'>";
								echo "<td colspan='6' align='right' style='height: 22px'>Total</td>";
								echo "<td align='right' style='height: 22px'><b>";
								//echo "" . setNumber($sumPiutang) . "";
								echo getTextBox($_SESSION["modeView"], "txtsumhutang", setNumber($sumPiutang), 50, 15, $clsformatIntegerReadOnly . " readonly"); 
								echo getHiddenBox(1, 'txtJmlItem', $jmlItem);
								echo getHiddenBox(1, 'txtpiutang', $sumPiutang);
								echo "</b></td>";
								echo "</tr>";						
							}
						?>						
					</table>
				</td> 
			</tr>
			
			 
			
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%">   
						 
					<tr class="font10black">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">  Keterangan</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtketerangan", $_SESSION["keterangan"], 50, 30, ""); ?> </td>
						</tr >
	

					</table>
				</td>
				
				<td > <!-- kanan-->
					<table width="100%"> 
						
						
					</table>
				</td> 
			</tr> 
			
			<tr height="10">
				<td colspan=2 align='center'>
				</td>				
			</tr>
			<?php
            if ($jmlItem > 0){
			?>
			<tr>
				<td colspan=2 align='center'> 
					 <?php 
				if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2" || $_SESSION["op"] == "3")
				{ 
				?>
				  <input class="button" type="button" name="btSubmit" id="btSubmit" value="<?php echo $_SESSION["btnLabel"] ?>" onClick="frmSubmit();" />&nbsp;&nbsp;&nbsp;
                  <?php
                  if ($_SESSION["op"] != "1")
				  {
				  ?>
				  <input class="button" type="button" name="btCetak" id="btCetak" value="Cetak" onClick="frmCetak()" />&nbsp;&nbsp;&nbsp; 
				<?php
				  }
				}
				?>
				  <input class='button' type='button' name='btBack' id='btBack' value='Back To List' onclick='window.history.back()' />
				</td> 
			</tr>
           
           <tr height="10">
				<td colspan=2 align='center'>
				</td>				
			</tr>
            <?php
			}
			?>

		</table>
	</td>
	</tr> 
</table> 
</form> 
 
</BODY>
</HTML>

<?php
}

function ClearSession()
{
//$_SESSION["op"] = ""
$_SESSION["btnLabel"] = "";
$_SESSION["lblTitle"] = "";
$_SESSION["errAlert"] 	= false;
$_SESSION["errMsg"] 	= "";
$_SESSION["ID"] = "";
$_SESSION["transaksi_kode"] = "";
$_SESSION["transaksi_tgl"] = "";
$_SESSION["contact_code"] = ""; 
$_SESSION["piutang"] = ""; 
$_SESSION["keterangan"] = "";  
$_SESSION["divisi"] = "";
}
?>

