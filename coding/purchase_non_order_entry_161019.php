<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();
	$dataValue = array();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	$_SESSION["transaksi_tipe"] ="3";
	
	$tableGen = "trx_beli_non_order";
	$tableName = "trx_master";
	$tableGenDetail = "trx_beli_non_order_detail";
	$tableNameDetail = "trx_detail";	
	$pageTitle = "Pembelian non Order";
	$pagePrefix = "purchase_non_order";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);		
	$sql = "select * from form_generator where tableName='$tableGen' order by sortNo"; 
	$rsGen = $oDB->ExecuteReader($sql); 
	if (mysql_num_rows($rsGen) == 0){
		eror("Generator $tableName belum disetting");	
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
       	FormProcess(); 
	}
	
	//******* form load
	else
	{
		$_SESSION["op"] = retrieveS($_GET["op"]);
		
		if ($_SESSION["op"] == "1")
		{
            $_SESSION["modeView"] = "1"; 
            $_SESSION["btnLabel"] = "Save Data";
            $_SESSION["lblTitle"] = "New Data $pageTitle";
			
			include "gen_ClearData.php";
			$whereKondisi = "where 1 <> 1";
			
			$_SESSION["ID"] = getKodeTransaksi($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB); 	
			$dataValue[0] = $_SESSION["ID"];
			$dataValue[1] = date("Y-m-d"); 
			
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
        
        if ($_SESSION["op"] == "1")
        { 
			$array2d[] = array("transaksi_tipe", $_SESSION["transaksi_tipe"], 0);
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1); 
            $sqlCmd = sqlInsert($tableName, $array2d);
            $strTemp = "Data has been successfully inserted";
			updateKodeTransaksi($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB);  
        }            
        else
        {                  
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
    	$sqlCmd = "delete from $tableNameDetail $whereKondisi ; delete from $tableName $whereKondisi";
		$oDB->ExecuteNonQuery($sqlCmd);	
        $strTemp = "Data has been successfully deleted";		
    }
    else
        eror("invalid op");
		
	//eror($sqlCmd);    
	//include "persediaan_in.php";
	include "purchase_posting_hutang.php";
	header('location:global_notification.php?from=" .$pagePrefix. "&strMsg=' . htmlspecialchars($strTemp));
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
    
    $sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe =5"; 
    $rsGudang = $oDB->ExecuteReader($sqlCmd); 
    
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe = 4"; 
    $rsPetugas = $oDB->ExecuteReader($sqlCmd); 
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe = 2"; 
    $rsSupplier = $oDB->ExecuteReader($sqlCmd); 
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=14 order by reff";
    $rsWarna = $oDB->ExecuteReader($sqlCmd);	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=15 order by reff";
    $rsSize = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=21 order by reff";
    $rsKelBeli = $oDB->ExecuteReader($sqlCmd);	
	
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
 
var jmlItem = <?php echo $jmlItem ?>;
var nSize = 8;
function AddItem()
{
	if(document.getElementById("txtdetailproduct_name_0").value == ""){
		alert('Silahkan isi/pilih barang');
		return false;
	} 
	//alert(cekIsiSize());
	if (cekIsiSize() == false){
		alert('Silahkan isi qty per size');
		return false;
	}
	sumSubDetail();
	
	jmlItem = jmlItem + 1;
	i = jmlItem ; 
	
    var table = document.getElementById("tblDetail");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount  -1); 	
    row.bgColor = "white"  
    
    el = "";
    el = el + "<img src='images/up.gif' onClick='moveUp(" +jmlItem+ ");'>";
    el = el + "<img src='images/down.gif' onClick='moveDown(" +jmlItem+ ");'>";
    el = el + "<img src='images/delmini.gif' onClick='delRow(" +jmlItem+ ");'>";
	
	var cell0 = row.insertCell(0); 
    cell0.innerHTML = "<div class='font10black' align='center'>" +(jmlItem)+ "</div >"
	
	<?php 
	$i = 1;
	mysql_data_seek($rsGenDetail, 0);						
	while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
	{ 	
		 ?>
		 nilai = document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_0").value;
		 //alert(nilai);
		 <?php
		 $elName = "txtdetail" .$dataGenDetail["FieldName"] . "_";
		 $name="\" + '$elName' +i + \"";
		 ?>
		 var cell<?php echo $i?> = row.insertCell(<?php echo $i?>);
		 elHtml = "<div class='font10black' align='center'><?php include "gen_SettingInputanDetail2.php";?></div>";
		 //alert(elHtml);
		 cell<?php echo $i?>.innerHTML = elHtml;
		 
		 document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_" + i).value = nilai;
		 document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_0").value = "";
		 <?php
		 $i++; 
	}
	?>
	
	var cell<?php echo $i?> = row.insertCell(<?php echo $i?>); 
    cell<?php echo $i?>.innerHTML = "<div class='font10black' align='center'>" + el + "</div>"
	
	el = "<div class='font10black' align='center'><table width='100%'  cellspacing='1' bgcolor='silver' id='tblJurnalDetailItem' >";
	el = el + "<tr bgcolor='white' class='font10black'>";
	
	for(iLoop=1; iLoop <= nSize; iLoop++){
		el = el + "<td width='10%' nowrap >";
		//el = el + "<?php $name="\" + 'txtdetailsize' +iLoop+ '_' +i + \""; echo getComboBox5("1", $name, "", $rsSize, ""); ?>/";
		el = el + "<?php $name="\" + 'txtdetailsize' +iLoop+ '_' +i + \""; echo getTextBox("1", $name, "", 10, 3, " readonly"); ?> x ";
		el = el + "<?php $name="\" + 'txtdetailqtysize' +iLoop+ '_' +i + \""; echo getTextBox("1", $name, "", 10, 5, " readonly"); ?>";
		el = el + "</td>";
	}
	el = el + "</tr>"
	el = el + "</table></div>"
	
	
	//alert(el);
	var row = table.insertRow(rowCount); 	
    row.bgColor = "white"  	
	var cell0 = row.insertCell(0); 
	cell0.colSpan = "2";
	cell0.innerHTML = "<div class='font10black' align='center'>size x qty</div>";
	
	var cell1 = row.insertCell(1); 
    cell1.colSpan = "8";
	cell1.innerHTML = el;
	var cell2 = row.insertCell(2);
	
	for(iLoop=1; iLoop <= nSize; iLoop++){		
		nilai = document.getElementById("txtdetailsize" + iLoop + "_0").value;
		nilai2 = document.getElementById("txtdetailqtysize" + iLoop + "_0").value;
		
		document.getElementById("txtdetailsize" + iLoop + "_" + i).value = nilai;
		document.getElementById("txtdetailqtysize" + iLoop + "_" + i).value= nilai2;	
		
		document.getElementById("txtdetailsize" + iLoop + "_0").value = "";
		document.getElementById("txtdetailqtysize" + iLoop + "_0").value = "";
	}	
	sumJumlah();
	
} 

function removeItem()
{
    if(jmlItem != 0)
    {
        var table = document.getElementById('tblDetail');		
		var rowCount = table.rows.length;
        table.deleteRow(rowCount-2)
		table.deleteRow(rowCount-3)		
        jmlItem = jmlItem-1; 
    }
}

function moveUp(index){
    if (index > 1){
		<?php 
		$i = 1;
		mysql_data_seek($rsGenDetail, 0);						
		while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
		{ 	
			 ?>
			temp = document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_" + (index-1)).value;
			document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_" + (index-1)).value =  document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_" + (index)).value;
        	document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_" + (index)).value =  temp 
			 <?php
			 $i++; 
		}
		?> 
		
		for(iLoop=1; iLoop <= nSize; iLoop++){		
			temp = document.getElementById("txtdetailsize" + iLoop + "_" + (index-1)).value;
			temp2 = document.getElementById("txtdetailqtysize" + iLoop + "_" + (index-1)).value;
			
			document.getElementById("txtdetailsize" + iLoop + "_" + (index-1)).value = document.getElementById("txtdetailsize" + iLoop + "_" + (index)).value;
			document.getElementById("txtdetailqtysize" + iLoop + "_" + (index-1)).value= document.getElementById("txtdetailqtysize" + iLoop + "_" + (index)).value;
			
			document.getElementById("txtdetailsize" + iLoop + "_" + (index)).value = temp;
			document.getElementById("txtdetailqtysize" + iLoop + "_" + (index)).value= temp2;
		}
    }
}

function moveDown(index){
    if (index < jmlItem){
		<?php 
		$i = 1;
		mysql_data_seek($rsGenDetail, 0);						
		while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
		{ 	
			 ?>
			temp = document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_" + (index+1)).value;
			document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_" + (index+1)).value =  document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_" + (index)).value;
        	document.getElementById("txtdetail<?php echo $dataGenDetail["FieldName"]; ?>_" + (index)).value =  temp 
			 <?php
			 $i++; 
		}
		?>
		
		for(iLoop=1; iLoop <= nSize; iLoop++){		
			temp = document.getElementById("txtdetailsize" + iLoop + "_" + (index+1)).value;
			temp2 = document.getElementById("txtdetailqtysize" + iLoop + "_" + (index+1)).value;
			
			document.getElementById("txtdetailsize" + iLoop + "_" + (index+1)).value = document.getElementById("txtdetailsize" + iLoop + "_" + (index)).value;
			document.getElementById("txtdetailqtysize" + iLoop + "_" + (index+1)).value= document.getElementById("txtdetailqtysize" + iLoop + "_" + (index)).value;
			
			document.getElementById("txtdetailsize" + iLoop + "_" + (index)).value = temp;
			document.getElementById("txtdetailqtysize" + iLoop + "_" + (index)).value= temp2;
		}
    } 
}

function delRow(index){
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
    sumJumlah();
} 

function sumJumlah(){
    sumDetailQty = 0;
	sumDetailDisc = 0;
	sumDetailSubTotal = 0;
	sumDetailTotal = 0;
	
	for(i=1;i<=jmlItem;i++)
    {
		if (document.getElementById('txtdetailqty_' + (i)).value == "") { document.getElementById('txtdetailqty_' + (i)).value = "0";}
		sumDetailQty = sumDetailQty + eval(formatBilangan(document.getElementById('txtdetailqty_' + (i)).value));
		
		if (document.getElementById('txtdetaildisc_amount_' + (i)).value == "") { document.getElementById('txtdetaildisc_amount_' + (i)).value = "0";}
		sumDetailDisc = sumDetailDisc + eval(formatBilangan(document.getElementById('txtdetaildisc_amount_' + (i)).value));
		
		if (document.getElementById('txtdetailsub_total_' + (i)).value == "") { document.getElementById('txtdetailsub_total_' + (i)).value = "0";}
		sumDetailSubTotal = sumDetailSubTotal + eval(formatBilangan(document.getElementById('txtdetailsub_total_' + (i)).value));
		
		if (document.getElementById('txtdetailtotal_' + (i)).value == "") { document.getElementById('txtdetailtotal_' + (i)).value = "0";}
		sumDetailTotal = sumDetailTotal + eval(formatBilangan(document.getElementById('txtdetailtotal_' + (i)).value));
	} 
	
	document.getElementById('txtdetailqty_sum').value = formatCurrency3(sumDetailQty); 
	document.getElementById('txtdetaildisc_amount_sum').value = formatCurrency3(sumDetailDisc); 
	document.getElementById('txtdetailsub_total_sum').value = formatCurrency3(sumDetailSubTotal); 
	document.getElementById('txtdetailtotal_sum').value = formatCurrency3(sumDetailTotal); 
	
	var ppn = 0;
	var disc = 0;
	var total = 0;
	var bayar = 0;
	var sisa = 0;
	
	if (document.getElementById('txtdisc_amount').value == "") { document.getElementById('txtdisc_amount').value = "0";}
	disc = eval(formatBilangan(document.getElementById('txtdisc_amount').value));
	
	if (document.getElementById('txtppn_amount').value == "") { document.getElementById('txtppn_amount').value = "0";} 
	ppn = eval(formatBilangan(document.getElementById('txtppn_amount').value));

	if (document.getElementById('txtbayar').value == "") { document.getElementById('txtbayar').value = "0";}
	bayar = eval(formatBilangan(document.getElementById('txtbayar').value));
	
	total = sumDetailTotal + ppn - disc;
	sisa = total - bayar;
	
	document.getElementById('txttotal').value = formatCurrency3(total);
	document.getElementById('txtsisa').value = formatCurrency3(sisa);
}

function hitungDisc(){
	var nilai = 0; 
	var discPersen = 0;
	var disc = 0; 
	
	if ((document.getElementById('txtdisc_persen').value != "") && (document.getElementById('txtdisc_persen').value != "0")) {
		
		if (document.getElementById('txtdetailtotal_sum').value == "") { document.getElementById('txtdetailtotal_sum').value = "0";}
		nilai = eval(formatBilangan(document.getElementById('txtdetailtotal_sum').value));
		discPersen = eval(formatBilangan(document.getElementById('txtdisc_persen').value));
		
		disc = discPersen * nilai / 100; 		
		document.getElementById('txtdisc_amount').value = formatCurrency3(disc);
		sumJumlah();
	}
	
}

function hitungPPN(){
	var nilai = 0; 
	var ppnPersen = 0;
	var ppn = 0; 
	
	if ((document.getElementById('txtppn_persen').value != "") && (document.getElementById('txtppn_persen').value != "0")) {
		
		if (document.getElementById('txtdetailtotal_sum').value == "") { document.getElementById('txtdetailtotal_sum').value = "0";}		
		nilai = eval(formatBilangan(document.getElementById('txtdetailtotal_sum').value));
		ppnPersen = eval(formatBilangan(document.getElementById('txtppn_persen').value)); 
		ppn = ppnPersen * nilai / 100;
		
		document.getElementById('txtppn_amount').value = formatCurrency3(ppn);
		sumJumlah();
	}
	
}

function cekIsiSize(){
	result = false;
	if (
		(document.getElementById('txtdetailsize1_0').value == "") &&
		(document.getElementById('txtdetailsize2_0').value == "") &&
		(document.getElementById('txtdetailsize3_0').value == "") &&
		(document.getElementById('txtdetailsize4_0').value == "") &&
		(document.getElementById('txtdetailsize5_0').value == "") &&
		(document.getElementById('txtdetailsize6_0').value == "") &&
		(document.getElementById('txtdetailsize7_0').value == "") &&
		(document.getElementById('txtdetailsize8_0').value == "")
	)
	{
		result = true;
	}
	else
	{
		if (
			(document.getElementById('txtdetailqtysize1_0').value == "") &&
			(document.getElementById('txtdetailqtysize2_0').value == "") &&
			(document.getElementById('txtdetailqtysize3_0').value == "") &&
			(document.getElementById('txtdetailqtysize4_0').value == "") &&
			(document.getElementById('txtdetailqtysize5_0').value == "") &&
			(document.getElementById('txtdetailqtysize6_0').value == "") &&
			(document.getElementById('txtdetailqtysize7_0').value == "") &&
			(document.getElementById('txtdetailqtysize8_0').value == "")
			)
		{				
			result = false;
		}
		else
		{
			result = true;
		}		
	}
	
	return result;
}

function sumQtySize(){
	//alert('sumQtySize');
	if (
		(document.getElementById('txtdetailsize1_0').value == "") &&
		(document.getElementById('txtdetailsize2_0').value == "") &&
		(document.getElementById('txtdetailsize3_0').value == "") &&
		(document.getElementById('txtdetailsize4_0').value == "") &&
		(document.getElementById('txtdetailsize5_0').value == "") &&
		(document.getElementById('txtdetailsize6_0').value == "") &&
		(document.getElementById('txtdetailsize7_0').value == "") &&
		(document.getElementById('txtdetailsize8_0').value == "")
	){
	
	}
	else{
		sumSize = 0;
		for(i=1; i<=8; i++){
			qty = 0;			
			if (document.getElementById('txtdetailqtysize' +i+ '_0').value != "") { 
				qty = parseInt(document.getElementById('txtdetailqtysize' +i+ '_0').value);
				//alert(qty);
			}
			sumSize = sumSize + qty;
		}
		document.getElementById('txtdetailqty_0').value = sumSize;	
	}	
}

function sumSubDetail(){
	var harga = 0;
	var qty = 0;
	var subtotal = 0;
	var discPersen = 0;
	var disc = 0;
	var total = 0;
	
	
	sumQtySize();
	if (document.getElementById('txtdetailharga_0').value == "") { document.getElementById('txtdetailharga_0').value = "0";}
	if (document.getElementById('txtdetailqty_0').value == "") { document.getElementById('txtdetailqty_0').value = "0";}
	if (document.getElementById('txtdetaildisc_persen_0').value == "") { document.getElementById('txtdetaildisc_persen_0').value = "0";}
	if (document.getElementById('txtdetaildisc_amount_0').value == "") { document.getElementById('txtdetaildisc_amount_0').value = "0";} 
	
	harga = eval(formatBilangan(document.getElementById('txtdetailharga_0').value));
	qty = eval(formatBilangan(document.getElementById('txtdetailqty_0').value));
	discPersen = eval(formatBilangan(document.getElementById('txtdetaildisc_persen_0').value));
	disc = eval(formatBilangan(document.getElementById('txtdetaildisc_amount_0').value));
	
	subtotal = harga * qty;
	if (discPersen !=0 ){
		disc = subtotal  * discPersen  / 100 ;
		document.getElementById('txtdetaildisc_amount_0').value = formatCurrency3(disc);
	}
	
	total = subtotal - disc;
	document.getElementById('txtdetailsub_total_0').value = formatCurrency3(subtotal);
	document.getElementById('txtdetailtotal_0').value = formatCurrency3(total );	
}

function setNormal(){
	<?php
	include "gen_JSSetNormal.php";
	?> 
	
	var i = 0;  
    for(i=1;i<=jmlItem;i++)
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

function frmCetak(){
	kode = document.input.txttransaksi_kode.value;
	//alert(kode );
	window.open("purchase_cetak.php?kode="+kode, "gudang_in_" + kode ,  "height=360, width=640, location=0,menubar=0,scrollbars=1,resizable=0, modal=yes");

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
	 
	if(confirm(msg)){ 
		if (op == "1" || op == "2"){
			document.input.txtJmlItem.value = jmlItem;  
      		hitungDisc();
      		hitungPPN();
			sumJumlah();
			setNormal();
 			
			//return false;
			
			document.getElementById("btSubmit").disabled = true; 
			document.getElementById("btCetak").disabled = true;
			document.getElementById("btBack").disabled = true
    	}
		document.input.submit();
	}
	
}

function lookupBarang(){
	lookupWindow('product_lookup.php?tipe=<?php echo $_SESSION["transaksi_tipe"]; ?>&kode=' + document.getElementById('txtdetailproduct_code_0').value, 'product_list');	
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
				<td width=50%> <!-- top kiri-->
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
								echo "<td>";
								include "gen_SettingInputan.php";
								echo "</td>";							
								
							}
							$i++;
						}
						?>	  
					</table>
				</td>
				
				<td > <!-- top kanan-->
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
					<table width="100%"  cellspacing="1" bgcolor="silver" id="tblDetail" >  
                    
                    <?php
						if ($_SESSION["modeView"] == "1")
						{
							echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
							echo "<td width=3%><input class=\"button\" type=\"button\" name=\"btnLookUp\" value=\"...\" onClick=\"lookupBarang()\" /></td>";							
							$i = 0;
							mysql_data_seek($rsGenDetail, 0);						
							while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
							{ 	
								echo "<td>";
								include "gen_SettingInputanDetail.php"; 
								echo "</td>";							
								$i++; 
							}
							echo "<td nowrap><input class=\"button\" type=\"button\" name=\"btnAddItem\" value=\"Add Item\" onClick=\"AddItem();\" /></td>";							
							echo "</tr>"; 
							
							echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
							echo "<td colspan=2>size x qty</td>";
							echo "<td colspan=8>";
							
							echo "<table width=\"100%\"  cellspacing=\"1\" bgcolor=\"silver\" id=\"tblJurnalDetailItem\" >";
							echo "<tr bgcolor=\"white\" class=\"font10black\">";
							$nSize = 8;
							for ($i=1;$i <= $nSize;$i++){
								echo "<td nowrap>";
								echo getTextBox($_SESSION["modeView"], "txtdetailsize" .$i. "_0", "", 10, 3, " readonly"); 
								echo "x";
								echo getTextBox($_SESSION["modeView"], "txtdetailqtysize" .$i. "_0", "", 10, 5, $clsformatInteger); 
								echo "</td>";	
							}
							
							echo "</tr>";
							echo "</table>";
							
							echo "</td>";
							echo "<td><input class=\"button\" type=\"button\" name=\"btnCalSubDetail\" value=\" &Sigma; \" onClick=\"sumSubDetail()\" /></td>";
							echo "</tr>";
						}				
						 
						
                        echo "<tr class=\"contentTitleTable\" align=\"center\" >";
						echo "<td width=3% ></td>";							
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
						echo "<td>&nbsp;</td>";
						echo "</tr>"; 
						
						//******* tampilkan detail
						include "gen_RetrieveDataDetail.php";
						
						//******* subtotal detail
						echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
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
						echo "<td>";
						echo getHiddenBox($_SESSION["modeView"], "txtJmlItem","<?php echo $jmlItem;?>");
						echo "</td>";
						echo "</tr>";
						
						?> 
						
					</table>
				</td> 
			</tr>
			
			<tr>
				<td width=50%> <!-- bottom kiri-->
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
									echo "&nbsp;<input class=\"button\" type=\"button\" name=\"btnCalcDisc\" value=\" &Sigma; \" onClick=\"hitungDisc()\" />";
								if ($dataGen["FieldName"] == "ppn_persen")
									echo "&nbsp;<input class=\"button\" type=\"button\" name=\"btnCalcPpn\" value=\" &Sigma; \" onClick=\"hitungPPN()\" />"; 
								echo "</td>";							
							}
							$i++;
						}
						?>
					</table>
				</td>
				
				<td > <!-- bottom kanan-->
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
									echo "&nbsp;<input class=\"button\" type=\"button\" name=\"btnCalcBayar\" value=\" &Sigma; \" onClick=\"sumJumlah()\" />";
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
				  <input class="button" type="button" name="btSubmit" id="btSubmit" value="<?php echo $_SESSION["btnLabel"] ?>" onClick="frmSubmit();" />&nbsp;&nbsp;&nbsp;
				  <input class="button" type="button" name="btCetak" id="btCetak" value="Cetak" onClick="frmCetak()" />&nbsp;&nbsp;&nbsp; 
				<?php
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

