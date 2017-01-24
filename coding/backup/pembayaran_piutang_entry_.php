<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= ""; 
	$_SESSION["transaksi_tipe"] = "18";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	//$sql = "select * from tGroupUser order by GroupUserName";							
	//$rsGroupUser = $oDB->ExecuteReader($sql);
	ClearSession();
	
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
			$_SESSION["bayar"] = $_POST["txtbayar"];
			$_SESSION["total"] = $_POST["txttotal"];
			$_SESSION["biaya_lain"] = $_POST["txtbiaya_lain"];
			$_SESSION["potongan_lain"] = $_POST["txtpotongan_lain"];
			$_SESSION["keterangan"] = $_POST["txtketerangan"]; 		
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
		
		if ($_SESSION["op"] == "1")
		{
            $_SESSION["modeView"] = "1"; 
			ClearSession(); 
			$_SESSION["transaksi_kode"] = getKodeTransaksi($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB); 
			$_SESSION["transaksi_tgl"] = date("Y-m-d");		
			$_SESSION["contact_code"] = $customer;
            $_SESSION["btnLabel"] = "Save Data";
            $_SESSION["lblTitle"] = "New Data Pembayaran Piutang";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT transaksi_kode, transaksi_tipe, transaksi_tgl, contact_code, bayar, keterangan, JmlCaraBayar FROM trx_master a WHERE a.transaksi_kode ='" .$_SESSION["ID"] . "'";
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["transaksi_kode"] = $data["transaksi_kode"]; 
				$_SESSION["transaksi_tgl"] = $data["transaksi_tgl"];
				$_SESSION["contact_code"] = $data["contact_code"];
				$_SESSION["bayar"] = $data["bayar"];
				$_SESSION["keterangan"] = $data["keterangan"]; 			
			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data";
                $_SESSION["lblTitle"]  = "Edit Data Pembayaran Piutang";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data";
                    $_SESSION["lblTitle"]  = "Delete Data Pembayaran Piutang";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data Pembayaran piutang";
			}
        }
        else    
            eror("invalid op");
    	
		FormLoad();
	}

function FormProcess()
{	
	global $oDB;  
	
    if($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
    { 
		$array2d[] = array("transaksi_tipe", $_SESSION["transaksi_tipe"], 0);
		$array2d[] = array("transaksi_tgl", $_SESSION["transaksi_tgl"], 1);
		$array2d[] = array("contact_code", $_SESSION["contact_code"], 1); 
		$array2d[] = array("bayar", $_SESSION["bayar"], 0);
		$array2d[] = array("total", $_SESSION["total"], 0);
		$array2d[] = array("potongan_lain", $_SESSION["potongan_lain"], 0);
		$array2d[] = array("biaya_lain", $_SESSION["biaya_lain"], 0);
		$array2d[] = array("keterangan", $_SESSION["keterangan"], 1); 		
        
        if ($_SESSION["op"] == "1")
        {
			$_SESSION["ID"] = $_SESSION["transaksi_kode"];
			
        	$array2d[] = array("transaksi_kode", $_SESSION["transaksi_kode"], 1);         	
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
        
		
		// ********** detail item
        $sqlCmd = "delete from trx_bayar where transaksi_kode='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);	
        
		$jmlItem = $_POST["txtJmlItem"]; 

		for($i=1; $i<=$jmlItem; $i++){
			unset($array2d);
			$array2d[] = array("transaksi_kode", $_SESSION["ID"], 1); 
			$array2d[] = array("no_invoice", $_POST["txtDetailno_invoice$i"], 1);
			$array2d[] = array("tgl_invoice", $_POST["txtDetailtgl_invoice$i"], 1);
			$array2d[] = array("jml_invoice", $_POST["txtDetailjml_invoice$i"], 0);
			$array2d[] = array("telah_bayar",$_POST["txtDetailtelah_bayar$i"], 0);
			$array2d[] = array("jml_hutang", $_POST["txtDetailjml_hutang$i"], 0); 
			$array2d[] = array("jml_bayar", $_POST["txtDetailjml_bayar$i"], 0);
			$array2d[] = array("ket_bayar", $_POST["txtDetailket_bayar$i"], 1);
			
			$sqlCmd = sqlInsert("trx_bayar", $array2d); 
			//echo $sqlCmd . "<br />";
			$oDB->ExecuteNonQuery($sqlCmd);	
		} 
		
		$tambahanUrl = "&kode=" .$_SESSION["ID"];
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from trx_master where transaksi_kode='" . $_SESSION["ID"] . "'"; 
        $oDB->ExecuteNonQuery($sqlCmd);	
		
		$sqlCmd = "delete from trx_bayar where transaksi_kode='" . $_SESSION["ID"] . "'"; 
        $oDB->ExecuteNonQuery($sqlCmd);	 		
        
        $sqlCmd = "delete from trx_cara_bayar where transaksi_kode='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);
		
		$sqlCmd = "delete from trx_invoice where no_transaksi='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);		
        
        $strTemp = "Data has been successfully deleted";
		$tambahanUrl = "";
    }
    else
        eror("invalid op"); 
	
	//include "posting_piutang_out.php";
	//header("location:global_notification.php?from=pembayaran_piutang" .$tambahanUrl. "&strMsg=" . htmlspecialchars($strTemp));
	
	if ($_SESSION["op"] != "3")
		header("location:pembayaran_piutang_cara_bayar_entry.php?op=" .$_SESSION["op"]. "&kode=" . $_SESSION["ID"]);
	else
		header("location:global_notification.php?from=pembayaran_piutang" .$tambahanUrl. "&strMsg=" . htmlspecialchars($strTemp));

}

function FormLoad()
{	
	
	global $oDB;  
	global $clsformatInteger;
	global $clsformatIntegerReadOnly;
	global $clsReadOnly;
	global $ajaxgettgl_invoice; 
	global $customer;
	
	if ($_SESSION["op"] == "1"){
		$sqlCmd = "select no_invoice, tgl_invoice, sum(jml_in) as jml_invoice, sum(jml_out) as telah_bayar, sum(jml_in) - sum(jml_out) as jml_hutang, sum(jml_in) - sum(jml_out) as jml_bayar, '' as ket_bayar from trx_invoice ";
		$sqlCmd = $sqlCmd . "where contact_code='$customer' ";
		$sqlCmd = $sqlCmd . "group by no_invoice, tgl_invoice ";	
		$sqlCmd = $sqlCmd . "having (sum(jml_in) - sum(jml_out) > 0) ";
		
		$sqlCmd = "
		select a.transaksi_kode as no_invoice, a.transaksi_tgl as tgl_invoice, ifnull(total,0) as jml_invoice, (ifnull(bayar,0) + ifnull(b.paid,0)) as telah_bayar
,(ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) as jml_hutang
,(ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) as jml_bayar
, '' ket_bayar
from trx_master a
left join 
(
	select a.contact_code, b.no_invoice, sum(ifnull(jml_bayar,0)) as paid
	from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode	
	where a.transaksi_tipe in (18) and a.contact_code ='$customer'
	group by a.contact_code, b.no_invoice
)b on a.contact_code = b.contact_code and a.transaksi_kode = b.no_invoice
where a.transaksi_tipe in (6, 7) and a.contact_code ='$customer' and (ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) > 0";
	}
	
	else{
		$sqlCmd = "SELECT no_invoice, tgl_invoice, jml_invoice, telah_bayar, jml_hutang, jml_bayar, ket_bayar FROM trx_bayar a WHERE a.transaksi_kode ='" .$_SESSION["ID"] . "'";
	}
	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows; 
    
    $sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe in (2, 3, 4)"; 
    $rsCustomer = $oDB->ExecuteReader($sqlCmd);  

	
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
				document.getElementById('txtDetailjml_bayar' + (i)).value =  document.getElementById('txtDetailjml_bayar' + (i+1)).value;
				document.getElementById('txtDetailket_bayar' + (i)).value =  document.getElementById('txtDetailket_bayar' + (i+1)).value;
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
    var sumTotal = 0; 
	var sumHutang = 0; 
    var nilai = 0; 
	
	jmlItem = parseInt(document.getElementById('txtJmlItem').value);
    for(i=1;i<=jmlItem;i++){
    	if (document.getElementById('txtDetailjml_bayar' + (i)).value == "") { document.getElementById('txtDetailjml_bayar' + (i)).value = "0";}
    	nilai = eval(formatBilangan(document.getElementById('txtDetailjml_bayar' + (i)).value));
    	sumTotal = sumTotal + nilai; 
		
		if (document.getElementById('txtDetailjml_hutang' + (i)).value == "") { document.getElementById('txtDetailjml_hutang' + (i)).value = "0";}
    	nilai = eval(formatBilangan(document.getElementById('txtDetailjml_hutang' + (i)).value));
    	sumHutang = sumHutang + nilai; 
    }         
    document.getElementById('txttotal').value = formatCurrency3(sumTotal);
	document.getElementById('txthutang').value = formatCurrency3(sumHutang);
	
	if (document.getElementById('txtbiaya_lain').value == "") document.getElementById('txtbiaya_lain').value = "0";
	if (document.getElementById('txtpotongan_lain').value == "") document.getElementById('txtpotongan_lain').value = "0";
	
	biaya_lain = eval(formatBilangan(document.getElementById('txtbiaya_lain').value));
	potongan_lain = eval(formatBilangan(document.getElementById('txtpotongan_lain').value));
	bayar = sumTotal + biaya_lain + potongan_lain
	
	document.getElementById('txtbayar').value = formatCurrency3(bayar);
}

function setNormal(){
    var i = 0; 
  	jmlItem = parseInt(document.getElementById('txtJmlItem').value);

    for(i=1;i<=jmlItem;i++)
    { 
    	document.getElementById('txtDetailjml_invoice' + (i)).value = formatBilangan(document.getElementById('txtDetailjml_invoice' + (i)).value); 
    	document.getElementById('txtDetailtelah_bayar' + (i)).value = formatBilangan(document.getElementById('txtDetailtelah_bayar' + (i)).value);
    	document.getElementById('txtDetailjml_hutang' + (i)).value = formatBilangan(document.getElementById('txtDetailjml_hutang' + (i)).value);
    	document.getElementById('txtDetailjml_bayar' + (i)).value = formatBilangan(document.getElementById('txtDetailjml_bayar' + (i)).value); 	
    } 
    
    document.getElementById('txtbayar').value = formatBilangan(document.getElementById('txtbayar').value);
	document.getElementById('txttotal').value = formatBilangan(document.getElementById('txttotal').value);
	document.getElementById('txtpotongan_lain').value = formatBilangan(document.getElementById('txtpotongan_lain').value);
	document.getElementById('txtbiaya_lain').value = formatBilangan(document.getElementById('txtbiaya_lain').value);
    
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
	window.open("pembayaran_piutang_cetak.php?kode="+kode, "cetak_jurnal_" + kode ,  "height=360, width=640, location=0,menubar=0,scrollbars=1,resizable=0, modal=yes");

}

function frmDaftarpiutang(){
}


function frmSubmit(){ 
    op = document.input.txtOp.value;

    if (op == "1" || op == "2")
    {  
    	 
    }

    if (op == "1")
        msg = 'Confirm add data ?';
    else if (op == "2")
        msg = 'Confirm edit data ?';
    else if (op == "3")
        msg = 'Confirm delete data ?';
    else
    {
        msg = 'invalid op';
        return false;
    } 
	 
	if(confirm(msg)){ 
		if (op == "1" || op == "2"){
			//document.input.txtJmlItem.value = jmlItem;  
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
						  <td width="30%" style="height: 23px">  Kode Transaksi</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txttransaksi_kode", $_SESSION["transaksi_kode"], 20, 20, $clsReadOnly . " readonly"); ?> </td>
						</tr >
						<tr class="font10black">
						  <td style="height: 23px" ></td>
						  <td style="height: 23px">  Tgl Transaksi</td>
						  <td style="height: 23px">:</td>
						  <td style="height: 23px"> <?php  echo getDatePicMand($_SESSION["modeView"], "txttransaksi_tgl", $_SESSION["transaksi_tgl"], ""); ?> </td>
						</tr >  
					</table>
				</td>
				
				<td  valign="top"> <!-- kanan-->
					<table width="100%">
						<tr class="font10black">
						  <td style="width: 3%"></td>
						  <td width="30%">Pembayaran Dari</td>
						  <td width="1%">:</td> 
						  <td> <?php  
						  echo getComboBox(2, "txtcontact_code", $_SESSION["contact_code"], $rsCustomer, ""); 
						  echo getHiddenBox(1, "txtcontact_code", $_SESSION["contact_code"]); 						  
						  ?> 
                          </td>
						  
						</tr >


					</table>
				</td> 
			</tr>
			
			<!-- detail invoice-->	
			
			<tr >
				<td colspan=2 valign="top">  
					<table width="100%"  cellspacing="1" bgcolor="silver" id="tblDetail" >  
					
						<tr class="contentTitleTable" align="center"> 
	                        <td style="height: 22px">&nbsp;</td>   
							<td style="height: 22px">No</td>
							<td style="height: 22px">No Faktur</td> 
							<td style="height: 22px">Tgl Faktur</td>
							<td style="height: 22px">Jumlah</td>
							<td style="height: 22px">Sudah Bayar</td> 
							<td style="height: 22px">Piutang</td>
							<td style="height: 22px">Bayar</td> 
							<td style="height: 22px">Ket</td>                            
						</tr> 
						
						<?php
							$i = 0;
							$sumTotal = 0;
							$sumJmlHutang = 0;
							while ($datadetail = mysql_fetch_array($rsdetail)) 
							{
								$i++;
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
								echo getTextBox($_SESSION["modeView"], "txtDetailjml_invoice$i", setNumber($datadetail["jml_invoice"]), 50, 15, $clsformatIntegerReadOnly . " readonly");
								echo "</td>";
								
								echo "<td align='right'>";
								//echo setNumber($datadetail["telah_bayar"]);
								//echo getHiddenBox(1, "txtDetailtelah_bayar$i", $datadetail["telah_bayar"]); 
								echo getTextBox($_SESSION["modeView"], "txtDetailtelah_bayar$i", setNumber($datadetail["telah_bayar"]), 50, 15, $clsformatIntegerReadOnly . " readonly");
								echo "</td>";
								
								echo "<td align='right'>";
								//echo setNumber($datadetail["jml_hutang"]);
								//echo getHiddenBox(1, "txtDetailjml_hutang$i", $datadetail["jml_hutang"]); 
								echo getTextBox($_SESSION["modeView"], "txtDetailjml_hutang$i", setNumber($datadetail["jml_hutang"]), 50, 15, $clsformatIntegerReadOnly . " readonly");
								echo "</td>";
								
								echo "<td align='right'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailjml_bayar$i", setNumber($datadetail["jml_bayar"]), 50, 15, $clsformatInteger . "");
								 
								echo "</td>";
								
								echo "<td align='left'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailket_bayar$i", $datadetail["ket_bayar"], 50, 25, ""); 
								echo "</td>";  
								
								echo "</tr>";
								
								$sumJmlHutang = $sumJmlHutang + $datadetail["jml_hutang"];
								$sumTotal = $sumTotal + $datadetail["jml_bayar"];								
							}
							
							echo "<tr bgcolor='white' class='font10black'>";
							echo "<td colspan='6' >&nbsp;</td>";
							echo "<td align='right'>";
							echo getTextBox($_SESSION["modeView"], "txthutang", setNumber($sumJmlHutang), 50, 15, $clsformatIntegerReadOnly . " readonly"); 
							echo "</td>";
							echo "<td align='right'>";
							echo getTextBox($_SESSION["modeView"], "txttotal", setNumber($sumTotal), 50, 15, $clsformatIntegerReadOnly . " readonly"); 
							echo getHiddenBox($_SESSION["modeView"], "txtJmlItem", $jmlItem);
							echo "</td>";
							echo "<td>";
							echo "<input class='button' type='button' name='btnCalc' value='&Sigma;' onClick='sumJumlah()' />";
							echo "</td>";
							echo "</tr>";
						?>						
					</table>
				</td> 
			</tr> 
			
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%">   
					<tr class="font10black">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">  Biaya Lain-lain</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtbiaya_lain", setNumber($_SESSION["biaya_lain"]), 50, 30, $clsformatInteger); ?> </td>
						</tr >
                        <tr class="font10black">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">  Potongan Lain-lain</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtpotongan_lain", setNumber($_SESSION["potongan_lain"]), 50, 30, $clsformatInteger); ?> </td>
						</tr >	 
					
	

					</table>
				</td>
				
				<td > <!-- kanan-->
					<table width="100%"> 
                    <tr class="font10black">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">  Total</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > 
						  <?php  
						  echo getTextBox($_SESSION["modeView"], "txtbayar", setNumber($_SESSION["bayar"]), 50, 30, $clsformatIntegerReadOnly);
                          if($_SESSION["modeView"] == "1")
	                          echo "%&nbsp;<input class=\"button\" type=\"button\" name=\"btnCalcTotal\" value=\" &Sigma; \" onClick=\"sumJumlah()\" />";
                          ?>
                          </td>
						</tr >
					<tr class="font10black">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">  Keterangan</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtketerangan", $_SESSION["keterangan"], 50, 30, ""); ?> </td>
						</tr >	
						
					</table>
				</td> 
			</tr> 
			
			<tr height="10">
				<td colspan=2 align='center'>
				</td>				
			</tr>
			
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
$_SESSION["sales_code"] = "";
$_SESSION["jml_hutang"] = "";
$_SESSION["sub_jml_invoice"] = "";
$_SESSION["jml_bayar"] = "";
$_SESSION["ket_bayar"] = "";
$_SESSION["ppn_persen"] = "";
$_SESSION["ppn_amount"] = "";
$_SESSION["total"] = "";
$_SESSION["bayar"] = "";
$_SESSION["sisa"] = ""; 
$_SESSION["keterangan"] = ""; 
$_SESSION["no_reff"] = ""; 
$_SESSION["JmlCaraBayar"] = "";

$_SESSION["biaya_lain"] = "";
$_SESSION["potongan_lain"] = "";
}
?>

