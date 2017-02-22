<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();
	$dataValue = array();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	$_SESSION["transaksi_tipe"] ="6";
	
	$tableGen = "trx_jual_by_order";
	$tableName = "trx_master";
	$tableGenDetail = "trx_jual_by_order_detail";
	$tableNameDetail = "trx_detail";	
	$pageTitle = "Faktur Penjualan";
	$pagePrefix = "sales_by_order";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);		
	$sql = "select * from form_generator where tableName='$tableGen' order by sortNo"; 
	$rsGen = $oDB->ExecuteReader($sql); 
	if (mysql_num_rows($rsGen) == 0){
		eror("Generator $tableGen belum disetting");	
	} 
	
	$sql = "select * from form_generator where tableName='$tableGenDetail' order by sortNo"; 
	//eror($sql);
	$rsGenDetail = $oDB->ExecuteReader($sql); 
	if (mysql_num_rows($rsGenDetail) == 0){
		eror("Generator $tableGenDetail belum disetting");	
	}
		
	if (isset($_POST["txtOp"]))
	{
		$_SESSION["op"] = $_POST["txtOp"];
        $_SESSION["ID"] = $_POST["txtID"];

        if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
        {            
			include "gen_RetrieveForm.php";			
        }
		
		if ($_SESSION["op"] == "1")
        {
			$dataValue[0] = getKodeTransaksi2($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB, trim($_POST["txtkode_divisi"]));
			updateKodeTransaksi2($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB, trim($_POST["txtkode_divisi"]));
			//eror($dataValue[0]);
        }
		
       	FormProcess(); 
	}
	
	//******* form load
	else
	{
		$_SESSION["op"] = retrieveS($_GET["op"]);
		
		if (isset($_GET["divisi"]))
			$divisi = retrieveS($_GET["divisi"]);
		else
			$divisi = "";
			
		if (isset($_GET["customer"]))
			$customer = retrieveS($_GET["customer"]);
		else
			$customer = "";
		
		if (isset($_GET["no_order"]))
			$no_order = retrieveS($_GET["no_order"]);
		else
			$no_order = "";			
		
		
		if ($_SESSION["op"] == "1")
		{
            $_SESSION["modeView"] = "1"; 
            $_SESSION["btnLabel"] = "Save Data";
            $_SESSION["lblTitle"] = "New Data $pageTitle";

            $sql = "select transaksi_tgl from trx_master where transaksi_kode='$no_order'";
			$tgl_order = getSingleValue($hostDB, $userDB, $passDB, $nameDB, $sql); 	

			$sql = "select sales_code from trx_master where transaksi_kode='$no_order'";
			$sales_code = getSingleValue($hostDB, $userDB, $passDB, $nameDB, $sql); 	

			$sql = "select kode_wilayah from trx_master where transaksi_kode='$no_order'";
			$kode_wilayah = getSingleValue($hostDB, $userDB, $passDB, $nameDB, $sql); 	
			
			include "gen_ClearData.php";
			$whereKondisi = "where 1 <> 1";
			
			$_SESSION["ID"] = getKodeTransaksi2($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB, $divisi); 	
			//$_SESSION["ID"] = str_replace("X",$divisi, $_SESSION["ID"]);
			$dataValue[0] = $_SESSION["ID"];
			$dataValue[1] = date("Y-m-d"); 
			$dataValue[4] = $sales_code;
			$dataValue[7] = $kode_wilayah;			
			
			//updateKodeTransaksi2($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB, $divisi);
			
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }		
			
			$whereKondisi = "where transaksi_kode ='" .$_SESSION["ID"]. "'";
			include "gen_RetrieveData.php"; 
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data";
                $_SESSION["lblTitle"]  = "Edit Data $pageTitle";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data";
                    $_SESSION["lblTitle"]  = "Delete Data $pageTitle";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data $pageTitle";
			}
        }
        else    
            eror("invalid op");
			
		FormLoad();
	}

function FormProcess()
{	
	global $rsGen;
	global $dataValue;
	global $oDB; 
	global $tableName;
	global $tableNameDetail;
	global $hostDB; 
	global $userDB; 
	global $passDB; 
	global $nameDB;
	
	global $rsGenDetail;
	
	$whereKondisi = "where transaksi_kode ='" .$_SESSION["ID"]. "'";
	
    if($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
    {
	   
		include "gen_PutToArray.php";
		
		eror($array2d[0]);
        
        if ($_SESSION["op"] == "1")
        { 
			$array2d[] = array("sub_total", retrieveS($_POST["txtdetailtotal_sum"]), 0);
			$array2d[] = array("transaksi_tipe", $_SESSION["transaksi_tipe"], 0);
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1); 
            $sqlCmd = sqlInsert($tableName, $array2d);
            $strTemp = "Data has been successfully inserted";
			//updateKodeTransaksi($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB);  
        }            
        else
        {                  
			$array2d[] = array("sub_total", retrieveS($_POST["txtdetailtotal_sum"]), 0);
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate($tableName, $array2d, $whereKondisi );	
            $strTemp = "Data has been successfully updated";
        }
		//eror($sqlCmd);
		$oDB->ExecuteNonQuery($sqlCmd);			
		include "gen_SaveDetail.php";	
		
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from $tableNameDetail $whereKondisi";
		$oDB->ExecuteNonQuery($sqlCmd);	
		
		$sqlCmd = "delete from $tableName $whereKondisi";
		$oDB->ExecuteNonQuery($sqlCmd);	
		
        $strTemp = "Data has been successfully deleted";		
    }
    else
        eror("invalid op");
		
	//eror($sqlCmd);    
	
	//include "persediaan_out.php";
	include "sales_posting_piutang.php";
	if ($_SESSION["op"] == "3")
		header('location:global_notification.php?from=" .$pagePrefix. "&strMsg=' . htmlspecialchars($strTemp));
	else
		header("location:sales_by_order_cetak.php?kode=" .$_SESSION["ID"]);
	//header('location:global_notification.php?from=" .$pagePrefix. "&strMsg=' . htmlspecialchars($strTemp));
}

function FormLoad()
{	
	
	global $oDB;  	
	global $clsformatInteger;
	
	global $ajaxgetProduct; 
	
	global $rsGen;
	global $rsGenDetail;
	
	global $dataValue;
	global $dataValueSum;
	
	global $tableName;
	global $tableNameDetail; 
	global $whereKondisi;
	global $customer;
	global $no_order;
	global $tgl_order;
	
	if (mysql_num_rows($rsGenDetail) == 0){
		eror("Retrieve Form Eror : Generator $tableNameDetail belum disetting");	
	}	
	
	mysql_data_seek($rsGenDetail, 0);
	$i = 0;	
	$fieldNames = "";
	while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
	{
		if ($i == 0)
			$koma = "";
		else
			$koma = ", ";
		
		$fieldNames = $fieldNames . $koma . $dataGenDetail["FieldName"];
		$i++;
	} 
	
	$fielsSize = "kode_size1, qty_size1, ";
	$fielsSize .= "kode_size2, qty_size2, ";
	$fielsSize .= "kode_size3, qty_size3, ";
	$fielsSize .= "kode_size4, qty_size4, ";
	$fielsSize .= "kode_size5, qty_size5, ";
	$fielsSize .= "kode_size6, qty_size6, ";
	$fielsSize .= "kode_size7, qty_size7, ";
	$fielsSize .= "kode_size8, qty_size8, ";
	$fielsSize .= "kode_size9, qty_size9, ";
	$fielsSize .= "kode_size10, qty_size10 ";
	
	$sql = "select $fieldNames, $fielsSize from $tableNameDetail $whereKondisi";
	//eror($sql);
	$rsRetrieveDetail = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rsRetrieveDetail);	 
	$jmlItem = $numRows;
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=14 order by reff";
    $rsWarna = $oDB->ExecuteReader($sqlCmd);	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=15 order by reff";
    $rsSize = $oDB->ExecuteReader($sqlCmd);	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $_SESSION["lblTitle"]; ?></title>
</head>

<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

var nSize = 8;

function removeItem()
{
    jmlItem = parseInt(document.getElementById("txtJmlItem").value);
	if(jmlItem != 0)
    {
        var table = document.getElementById('tblDetail');		
		var rowCount = table.rows.length;
        table.deleteRow(rowCount-2)
		table.deleteRow(rowCount-3)		
        jmlItem = jmlItem-1; 
		document.getElementById("txtJmlItem").value = jmlItem;
    }
}

function delRow(index){
	if (confirm('Delete item ?')){
		jmlItem = parseInt(document.getElementById("txtJmlItem").value);
		var i = 0;
		if (index < jmlItem){
			for(i=index;i<jmlItem;i++)
			{
				<?php 
				$i = 1;
				mysql_data_seek($rsGenDetail, 0);						
				while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
				{ 	
					?> 
					document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_" + (i)).value =  document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_" + (i+1)).value; 
					 <?php
					 $i++; 
				}
				?>
				
				for(iLoop=1; iLoop <= nSize; iLoop++){						
					document.getElementById("txtdetailsize" + iLoop + "_" + (i)).value = document.getElementById("txtdetailsize" + iLoop + "_" + (i+1)).value;
					document.getElementById("txtdetailqtysize" + iLoop + "_" + (i)).value= document.getElementById("txtdetailqtysize" + iLoop + "_" + (i+1)).value;
				}
				 
			}
		}
		removeItem();
		sumTotal();
    	//sumJumlah();
	}
}
 
function sumSubDetail(){
	sumDetailQty = 0;
	sumDetailDisc = 0;
	sumDetailSubTotal = 0;
	sumDetailTotal = 0;
	
	jml = parseInt(document.getElementById("txtJmlItem").value);
	for(i=1; i<=jml; i++){		
		qty_n = 0;
		/* for(j=1; j<=8; j++){
			qty = 0;
			if (document.getElementById('txtdetailqtysize' +j+ '_' + i).value != "") { 
				qty = parseInt(document.getElementById('txtdetailqtysize' +j+ '_' + i ).value);
				//alert(qty);
			}
			qty_n = qty_n + qty;			
		} */
		
		//document.getElementById("txtdetailqty_" + i).value = qty_n;		
		
		if (document.getElementById('txtdetailharga_' + i).value == "") { document.getElementById('txtdetailharga_' + i).value = "0";}
		if (document.getElementById('txtdetailqty_' + i).value == "") { document.getElementById('txtdetailqty_' + i).value = "0";}
		if (document.getElementById('txtdetaildisc_persen_' + i).value == "") { document.getElementById('txtdetaildisc_persen_' + i).value = "0";}
		if (document.getElementById('txtdetaildisc_amount_' + i).value == "") { document.getElementById('txtdetaildisc_amount_' + i).value = "0";} 
		
		harga = eval(formatBilangan(document.getElementById('txtdetailharga_' + i).value));
		qty = eval(formatBilangan(document.getElementById('txtdetailqty_' + i).value));
		discPersen = eval(formatBilangan(document.getElementById('txtdetaildisc_persen_' + i).value));
		disc = eval(formatBilangan(document.getElementById('txtdetaildisc_amount_' + i).value));
		
		subtotal = harga * qty;
		if (discPersen !=0 ){
			disc = subtotal  * discPersen  / 100 ;
			document.getElementById('txtdetaildisc_amount_' + i).value = formatCurrency3(disc);
		}
		
		total = subtotal - disc;
		document.getElementById('txtdetailsub_total_' + i).value = formatCurrency3(subtotal);
		document.getElementById('txtdetailtotal_' + i).value = formatCurrency3(total);		
		
		sumDetailQty = sumDetailQty + qty;
		sumDetailDisc = sumDetailDisc + disc ;
		sumDetailSubTotal = sumDetailSubTotal + subtotal;
		sumDetailTotal = sumDetailTotal + total;
	}
	
	document.getElementById('txtdetailqty_sum').value = formatCurrency3(sumDetailQty); 
	document.getElementById('txtdetaildisc_amount_sum').value = formatCurrency3(sumDetailDisc); 
	document.getElementById('txtdetailsub_total_sum').value = formatCurrency3(sumDetailSubTotal); 
	document.getElementById('txtdetailtotal_sum').value = formatCurrency3(sumDetailTotal); 
}

function hitungDisc(){
	sumSubDetail();
	
	var nilai = 0; 
	var discPersen = 0;
	var disc = 0; 
	
	if ((document.getElementById('txtdisc_persen').value != "") && (document.getElementById('txtdisc_persen').value != "0")) {
		
		if (document.getElementById('txtdetailtotal_sum').value == "") { document.getElementById('txtdetailtotal_sum').value = "0";}
		nilai = eval(formatBilangan(document.getElementById('txtdetailtotal_sum').value));
		discPersen = eval(formatBilangan(document.getElementById('txtdisc_persen').value));
		
		disc = discPersen * nilai / 100; 		
		document.getElementById('txtdisc_amount').value = formatCurrency3(disc);
	}
}

function hitungPPN(){
	hitungDisc();
	
	var nilai = 0; 
	var ppnPersen = 0;
	var ppn = 0; 
	
	if ((document.getElementById('txtppn_persen').value != "") && (document.getElementById('txtppn_persen').value != "0")) {
		
		if (document.getElementById('txtdetailtotal_sum').value == "") { document.getElementById('txtdetailtotal_sum').value = "0";}		
		nilai = eval(formatBilangan(document.getElementById('txtdetailtotal_sum').value));
		ppnPersen = eval(formatBilangan(document.getElementById('txtppn_persen').value)); 
		ppn = ppnPersen * nilai / 100;
		
		document.getElementById('txtppn_amount').value = formatCurrency3(ppn);
	}	
}

function sumTotal(){
	hitungPPN();
	
	var ppn = 0;
	var disc = 0;
	var total = 0;
	var bayar = 0;
	var sisa = 0;
	
	if (document.getElementById('txtdisc_amount').value == "") { document.getElementById('txtdisc_amount').value = "0";}
	disc = eval(formatBilangan(document.getElementById('txtdisc_amount').value));
	
	if (document.getElementById('txtppn_amount').value == "") { document.getElementById('txtppn_amount').value = "0";} 
	ppn = eval(formatBilangan(document.getElementById('txtppn_amount').value));
	
	if (document.getElementById('txtbiaya_kirim').value == "") { document.getElementById('txtbiaya_kirim').value = "0";} 
	biaya_kirim = eval(formatBilangan(document.getElementById('txtbiaya_kirim').value));

	if (document.getElementById('txtbayar').value == "") { document.getElementById('txtbayar').value = "0";}
	bayar = eval(formatBilangan(document.getElementById('txtbayar').value));
	
	total = sumDetailTotal + biaya_kirim + ppn - disc;
	sisa = total - bayar;
	
	document.getElementById('txttotal').value = formatCurrency3(total);
	document.getElementById('txtsisa').value = formatCurrency3(sisa);
}

function setNormal(){
	<?php
	include "gen_JSSetNormal.php";
	?> 
	
	var i = 0; 
	jml = parseInt(document.getElementById("txtJmlItem").value);
    for(i=1; i<=jml; i++)
    { 
    	<?php
		include "gen_JSSetNormalDetail.php";
		?>    	
    }
	
	<?php
	include "gen_JSSetNormalDetailSum.php";
	?> 
}


function errMsg() {
	<?php 
	if( $_SESSION["errAlert"] ==true){	
		echo "alert('" . $_SESSION["errAlert"] . "')";
	}
	?>
} 

function frmCetak(kode){
	//kode = document.input.txttransaksi_kode.value;
	//alert(kode );
	window.open("sales_by_order_cetak.php?kode="+kode, "faktur_" + kode,  "height=360, width=640, location=0,menubar=0,scrollbars=1,resizable=0, modal=yes");
}

function frmCetakSJ(){
	kode = document.input.txttransaksi_kode.value;
	//alert(kode );
	window.open("sales_surat_jalan.php?kode="+kode, "suratjalan_" + kode,   "height=360, width=640, location=0,menubar=0,scrollbars=1,resizable=0, modal=yes");
}

function frmSubmity(){ 
    
	alert('test');
}
	

function frmSubmit(){ 
    op = document.input.txtOp.value;

    if (op == "1" || op == "2")
    {   
		<?php
include "gen_ValidasiMandatory.php";
		?>
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
	
	//alert(msg);
	 
	if(confirm(msg)){ 
		if (op == "1" || op == "2"){
			
 			sumTotal();
			setNormal();
			//return false;
			
			document.getElementById("btSubmit").disabled = true; 
			if (op != "1"){
				document.getElementById("btCetak").disabled = true;
			}
			document.getElementById("btBack").disabled = true
    	}
		document.input.submit();
	}
	
}

function getOrderData() {
	if (document.getElementById("txtcontact_code").value == ""){
		document.getElementById("txtcontact_code").focus();
		alert("Silahkan pilih customer terlebih dahulu");
		return false;	
	}
	
	param_data = {customer : document.getElementById("txtcontact_code").value};
	
	$.ajax(
	{
		url: 'getOrderData.php',
		data: param_data,
		type: 'GET',	
		success: function (result) {
			//console.debug(result);
			//closeModal();	
			document.getElementById("divDetail").innerHTML = result;
			
		},
		error: function (xhr, status, p3, p4) {		
			var err = "Error " + xhr.responseText + " " + status + " " + p3;
			//closeModal();
			alert(err);
		}
	});
	
	//document.getElementById("divDetail").innerHTML = "test";
}

-->
</Script>

<body onLoad="errMsg()">
<form name="input" method="post" >
<input type ="hidden" name="txtOp" value="<?php echo $_SESSION["op"]; ?>" />
<input type ="hidden" name="txtID" value="<?php echo $_SESSION["ID"]; ?>" /> 

<table width="60%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
	<tr bgcolor="white" >
	<td class="contentTitleTable" align="center">
	<?php echo $_SESSION["lblTitle"] ?>	</td>
	</tr>
	<tr bgcolor="white">
	<td height="250" valign="top" align="left">
		
		<table width="100%">
		
			<tr>
				<td width=50% valign="top"> <!-- top kiri-->
					<table width="100%"> 
						<?php
						$i = 0;
						mysql_data_seek($rsGen, 0);
						while ($dataGen = mysql_fetch_array($rsGen)) 
						{ 
							if (($dataGen["section"] == 1) && ($dataGen["kolom"] == 1))
							{
								echo "<tr class=\"font10black\">";
								echo "<td width=3%></td>";
								echo "<td width=30%>" .$dataGen["TitleName"]. "</td>";
								echo "<td width=1%>:</td>";
								echo "<td nowrap>";
								include "gen_SettingInputan.php";
								
								$fieldName = $dataGen["FieldName"];
								
								if ($_SESSION["modeView"] == "1"){
									if ($fieldName == "contact_code"){
										
										//echo "&nbsp;<input class='button' type='button' value='get Order Data' onclick='getOrderData()' />";
									}
								}								
								echo "</td>";							
								
							}
							$i++;
						}
						?>	  
					</table>
				</td>
				
				<td  valign="top"> <!-- top kanan-->
					<table width="100%"> 
                    	<?php
						$i = 0;
						mysql_data_seek($rsGen, 0);
						while ($dataGen = mysql_fetch_array($rsGen)) 
						{ 
							if (($dataGen["section"] == 1) && ($dataGen["kolom"] == 2))
							{
								echo "<tr class=\"font10black\">";
								echo "<td width=3%></td>";
								echo "<td width=30%>" .$dataGen["TitleName"]. "</td>";
								echo "<td width=1%>:</td>";
								echo "<td>";
								include "gen_SettingInputan.php";
								echo "</td>";							 
							}
							$i++;
						}
						?>
					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr >
				<td colspan=2 valign="top">  
                <div id='divDetail'>
                <?php
                if ($_SESSION["op"] == "1")
					include "get_item_sales_by_order.php";
				else
				{
				?>
					<table width="100%"  cellspacing="1" bgcolor="silver" id="tblDetail" >                      
                    <?php
                        echo "<tr class=\"contentTitleTable\" align=\"center\" >";
						echo "<td >&nbsp</td>";
						echo "<td width=3% >No</td>";							
						$i = 0;
						$iSum = 0;
						mysql_data_seek($rsGenDetail, 0);						
						while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
						{ 	
							echo "<td>";
							echo $dataGenDetail["TitleName"];
							echo "</td>"; 
							$i++; 
							
							if ($dataGenDetail["haveSum"] == 1){ 
								$dataValueSum[$iSum] = 0;
								$iSum++;
							}
						}
						echo "</tr>"; 
						
						//******* tampilkan detail						
							include "gen_RetrieveDataDetail_2.php";
						
						//******* subtotal detail
						echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
						echo "<td ></td>";
						echo "<td width=3% ></td>";							
						$i = 0;
						$iSum = 0;
						mysql_data_seek($rsGenDetail, 0);						
						while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
						{ 	
							echo "<td>";
							if ($dataGenDetail["haveSum"] == 1){
								$fieldLen = $dataGenDetail["FieldLen"];
								$fieldName = $dataGenDetail["FieldName"];								
								echo getTextBox($_SESSION["modeView"], "txtdetail" .$fieldName. "_sum", setNumber($dataValueSum[$iSum]), $fieldLen, $fieldLen, $clsformatInteger . " readonly");
								$iSum++;
							}
							else
								echo "&nbsp;";
								
							echo "</td>"; 
							$i++; 
						} 
						echo getHiddenBox($_SESSION["modeView"], "txtJmlItem","$jmlItem"); 
						echo "</tr>";
						
						?> 
						
					</table>
                    </div>
                    <?php
					}
					?>
				</td> 
			</tr>
			
			<tr>
				<td width=50% valign="top"> <!-- bottom kiri-->
					<table width="100%"> 
                    	<?php
						$i = 0;
						mysql_data_seek($rsGen, 0);
						while ($dataGen = mysql_fetch_array($rsGen)) 
						{ 
							if (($dataGen["section"] == 2) && ($dataGen["kolom"] == 1))
							{
								echo "<tr class=\"font10black\">";
								echo "<td width=3%></td>";
								echo "<td width=30% valign='top'>" .$dataGen["TitleName"]. "</td>";
								echo "<td width=1% valign='top'>:</td>";
								echo "<td valign='top'>";
								include "gen_SettingInputan.php";
								
								if ($dataGen["FieldName"] == "disc_persen")
									echo "%&nbsp;<input class=\"button\" type=\"button\" name=\"btnCalcDisc\" value=\" &Sigma; \" onClick=\"hitungDisc()\" />";
								if ($dataGen["FieldName"] == "disc_persen2")
									echo "%&nbsp;<input class=\"button\" type=\"button\" name=\"btnCalcDisc\" value=\" &Sigma; \" onClick=\"hitungDisc2()\" />";
								if ($dataGen["FieldName"] == "disc_persen3")
									echo "%&nbsp;<input class=\"button\" type=\"button\" name=\"btnCalcDisc\" value=\" &Sigma; \" onClick=\"hitungDisc3()\" />";
								if ($dataGen["FieldName"] == "ppn_persen")
									echo "%&nbsp;<input class=\"button\" type=\"button\" name=\"btnCalcPpn\" value=\" &Sigma; \" onClick=\"hitungPPN()\" />"; 
								echo "</td>";							
							}
							$i++;
						}
						?>
					</table>
				</td>
				
				<td  valign="top"> <!-- bottom kanan-->
					<table width="100%"> 
						<?php
						$i = 0;
						mysql_data_seek($rsGen, 0);
						while ($dataGen = mysql_fetch_array($rsGen)) 
						{ 
							if (($dataGen["section"] == 2) && ($dataGen["kolom"] == 2))
							{
								echo "<tr class=\"font10black\">";
								echo "<td width=3%></td>";
								echo "<td width=30% valign='top'>" .$dataGen["TitleName"]. "</td>";
								echo "<td width=1% valign='top'>:</td>";
								echo "<td valign='top'>";
								include "gen_SettingInputan.php";
								
								if ($dataGen["FieldName"] == "bayar")
									echo "&nbsp;<input class=\"button\" type=\"button\" name=\"btnCalcBayar\" value=\" &Sigma; \" onClick=\"sumTotal()\" />";
								echo "</td>";							 
							}
							$i++;
						}
						?> 
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
				  <input class="button" type="button" name="btSubmit" id="btSubmit" value="<?php echo $_SESSION["btnLabel"] ?>" onClick="frmSubmit();" />                  
				<?php
				}
				
				if ($_SESSION["op"] == "2" || $_SESSION["op"] == "4"){
					echo "<input class='button' type='button' name='btCetak' id='btCetak' value='Cetak' onClick=\"frmCetak('" .$_SESSION["ID"]. "')\" />&nbsp;&nbsp;&nbsp;";
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
?>

