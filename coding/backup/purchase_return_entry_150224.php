<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	//$sql = "select * from tGroupUser order by GroupUserName";							
	//$rsGroupUser = $oDB->ExecuteReader($sql);
	
	if (isset($_POST["txtOp"]))
	{
		$_SESSION["op"] = $_POST["txtOp"];
        $_SESSION["ID"] = $_POST["txtID"];

        if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
        {
            $_SESSION["transaksi_tipe"] = 3;
            if ($_SESSION["op"] == "1"){
            	$_SESSION["transaksi_kode"] = getKodeTransaksi($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB); 
            	updateKodeTransaksi($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB);  
            }            
			$_SESSION["transaksi_tgl"] = $_POST["txttransaksi_tgl"];
			$_SESSION["contact_code"] = $_POST["txtcontact_code"];
			$_SESSION["sales_code"] = $_POST["txtsales_code"];
			$_SESSION["sub_total"] = $_POST["txtsub_total"];
			$_SESSION["sub_qty"] = $_POST["txtsub_qty"];
			$_SESSION["disc_persen"] = $_POST["txtdisc_persen"];
			$_SESSION["disc_amount"] = $_POST["txtdisc_amount"];
			$_SESSION["ppn_persen"] = $_POST["txtppn_persen"];
			$_SESSION["ppn_amount"] = $_POST["txtppn_amount"];
			$_SESSION["total"] = $_POST["txttotal"];
			$_SESSION["bayar"] = $_POST["txtbayar"];
			$_SESSION["sisa"] = $_POST["txtsisa"]; 
			$_SESSION["keterangan"] = $_POST["txtketerangan"]; 
			$_SESSION["no_reff"] = $_POST["txtno_reff"];
			$_SESSION["tgl_reff"] = $_POST["txttgl_reff"];
        }
       	FormProcess(); 
	}
	else
	{
		$_SESSION["op"] = $_GET["op"];		
		
		if ($_SESSION["op"] == "1")
		{
            $_SESSION["modeView"] = "1"; 
			ClearSession();
			$_SESSION["transaksi_tipe"] = "3";
			$_SESSION["transaksi_kode"] = getKodeTransaksi($_SESSION["transaksi_tipe"], $hostDB, $userDB, $passDB, $nameDB); 
			$_SESSION["transaksi_tgl"] = date("Y-m-d");			
            $_SESSION["btnLabel"] = "Save Data Retur Pembelian";
            $_SESSION["lblTitle"] = "New Data Retur Pembelian";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT transaksi_kode, transaksi_tipe, transaksi_tgl, contact_code, sales_code, sub_total, sub_qty, disc_persen, disc_amount, ppn_persen, ppn_amount, total, bayar, sisa, keterangan, no_reff, tgl_reff FROM trx_master a WHERE a.transaksi_kode ='" .$_SESSION["ID"] . "'";
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["transaksi_kode"] = $data[0];
				$_SESSION["transaksi_tipe"] = $data[1];
				$_SESSION["transaksi_tgl"] = $data[2];
				$_SESSION["contact_code"] = $data[3];
				$_SESSION["sales_code"] = $data[4];
				$_SESSION["sub_total"] = $data[5];
				$_SESSION["sub_qty"] = $data[6];
				$_SESSION["disc_persen"] = $data[7];
				$_SESSION["disc_amount"] = $data[8];
				$_SESSION["ppn_persen"] = $data[9];
				$_SESSION["ppn_amount"] = $data[10];
				$_SESSION["total"] = $data[11];
				$_SESSION["bayar"] = $data[12];
				$_SESSION["sisa"] = $data[13]; 
				$_SESSION["keterangan"] = $data[14]; 
				$_SESSION["no_reff"] = $data["no_reff"];
				$_SESSION["tgl_reff"] = $data["tgl_reff"];

			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data Retur Pembelian";
                $_SESSION["lblTitle"]  = "Edit Data Retur Pembelian";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data Retur Pembelian";
                    $_SESSION["lblTitle"]  = "Delete Data Retur Pembelian";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data Retur Pembelian";
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
		$array2d[] = array("sales_code", $_SESSION["sales_code"], 1);
		$array2d[] = array("sub_total", $_SESSION["sub_total"], 0);
		$array2d[] = array("sub_qty", $_SESSION["sub_qty"], 0);
		$array2d[] = array("disc_persen", $_SESSION["disc_persen"], 0);
		$array2d[] = array("disc_amount", $_SESSION["disc_amount"], 0);
		$array2d[] = array("ppn_persen", $_SESSION["ppn_persen"], 0);
		$array2d[] = array("ppn_amount", $_SESSION["ppn_amount"], 0);
		$array2d[] = array("total", $_SESSION["total"], 0);
		$array2d[] = array("bayar", $_SESSION["bayar"], 0);
		$array2d[] = array("sisa", $_SESSION["sisa"], 0);
		$array2d[] = array("keterangan", $_SESSION["keterangan"], 1);
		$array2d[] = array("no_reff", $_SESSION["no_reff"], 1);
		$array2d[] = array("tgl_reff", $_SESSION["tgl_reff"], 1);

        
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
        
        $sqlCmd = "delete from trx_detail where transaksi_kode='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);	
        
        $sqlCmd = "delete from trx_besar where no_transaksi='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);
        
        $sqlCmd = "delete from trx_persediaan where no_transaksi='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);

        
		$jmlItem = $_POST["txtJmlItem"];
		//eror($jmlItem);

		for($i=1; $i<=$jmlItem; $i++){
			unset($array2d);
			$array2d[] = array("transaksi_kode", $_SESSION["ID"], 1); 
			$array2d[] = array("product_code", $_POST["txtDetailproduct_code$i"], 1);
			$array2d[] = array("product_name", $_POST["txtDetailproduct_name$i"], 1);
			$array2d[] = array("qty", $_POST["txtDetailqty$i"], 0);
			$array2d[] = array("harga_beli",$_POST["txtDetailharga_beli$i"], 0);
			$array2d[] = array("sub_total", $_POST["txtDetailsub_total$i"], 0); 
			$array2d[] = array("disc_persen", $_POST["txtDetaildisc_persen$i"], 0);
			$array2d[] = array("disc_amount", $_POST["txtDetaildisc_amount$i"], 0);
			$array2d[] = array("total", $_POST["txtDetailtotal$i"], 0); 
			$array2d[] = array("ket_detail", $_POST["txtDetailket_detail$i"], 1); 
			
			$sqlCmd = sqlInsert("trx_detail", $array2d); 
			//echo $sqlCmd . "<br />";
			$oDB->ExecuteNonQuery($sqlCmd);	
			
			//********* posting persediaan
			unset($array2d);
			$array2d[] = array("no_transaksi", $_SESSION["transaksi_kode"], 1); 
			$array2d[] = array("jenis_transaksi", $_SESSION["transaksi_tipe"], 0); 
			$array2d[] = array("tgl_transaksi", $_SESSION["transaksi_tgl"], 1);
			$array2d[] = array("product_code", $_POST["txtDetailproduct_code$i"], 1);
			$array2d[] = array("product_name", $_POST["txtDetailproduct_name$i"], 1);
			$array2d[] = array("qty_in", "0", 0);
			$array2d[] = array("qty_out", $_POST["txtDetailqty$i"], 0);
			$sqlCmd = sqlInsert("trx_persediaan", $array2d); 
			$oDB->ExecuteNonQuery($sqlCmd);
			
			//update stok
			$sqlCmd = "update mst_product, (select sum(qty_in) - sum(qty_out) as stok from trx_persediaan where product_code='" .$_POST["txtDetailproduct_code$i"]. "')src set mst_product.stok_jualbeli = src.stok where product_code='" .$_POST["txtDetailproduct_code$i"]. "'";
			$oDB->ExecuteNonQuery($sqlCmd);

			//******* posting besar
			/*if ($_SESSION["status_debet_kredit"] == 1){
				$debet = $_POST["txtDetailharga_beli$i"];
				$kredit = "0"; 
			}
			else{
				$debet = "0";  
				$kredit = $_POST["txtDetailharga_beli$i"];	 
			}					
			unset($array2d);
			$array2d[] = array("no_transaksi", $_SESSION["transaksi_kode"], 1); 
			$array2d[] = array("jenis_transaksi", $_SESSION["tipe_jurnal"], 0); 
			$array2d[] = array("tgl_transaksi", $_SESSION["jurnal_date"], 1);
			$array2d[] = array("kodeac", $_SESSION["product_name_header_code"], 1);
			$array2d[] = array("kodedc", $_POST["txtDetailproduct_code$i"], 1);
			$array2d[] = array("stdk", $_SESSION["status_debet_kredit"], 0);
			$array2d[] = array("debet",$debet, 0);
			$array2d[] = array("kredit", $kredit, 0);
			$array2d[] = array("ket", $_POST["txtDetailket_detail$i"], 1);
			$sqlCmd = sqlInsert("trx_besar", $array2d); 
			$oDB->ExecuteNonQuery($sqlCmd);	 
			
			if ($_SESSION["status_debet_kredit"] == 1){
				$debet = "0";  
				$kredit = $_POST["txtDetailharga_beli$i"];			
			}
			else{
				$debet = $_POST["txtDetailharga_beli$i"];
				$kredit = "0";  
			}		
						
			unset($array2d);
			$array2d[] = array("no_transaksi", $_SESSION["transaksi_kode"], 1); 
			$array2d[] = array("jenis_transaksi", $_SESSION["tipe_jurnal"], 0); 
			$array2d[] = array("tgl_transaksi", $_SESSION["jurnal_date"], 1);
			$array2d[] = array("kodeac", $_POST["txtDetailproduct_code$i"], 1);
			$array2d[] = array("kodedc", $_SESSION["product_name_header_code"], 1);
			$array2d[] = array("stdk", $_SESSION["status_debet_kredit"], 0);
			$array2d[] = array("debet",$debet, 0);
			$array2d[] = array("kredit", $kredit, 0);
			$array2d[] = array("ket", $_POST["txtDetailket_detail$i"], 1);
			$sqlCmd = sqlInsert("trx_besar", $array2d); 
			$oDB->ExecuteNonQuery($sqlCmd);	*/
			//******* end posting besar

		}
		//eror($jmlItem . "stop");
		
		//********* posting invoice
		unset($array2d);
		$array2d[] = array("no_transaksi", $_SESSION["transaksi_kode"], 1);
		$array2d[] = array("no_invoice", $_SESSION["transaksi_kode"], 1); 
		$array2d[] = array("jenis_transaksi", $_SESSION["transaksi_tipe"], 0); 
		$array2d[] = array("tgl_transaksi", $_SESSION["transaksi_tgl"], 1);
		$array2d[] = array("tgl_invoice", $_SESSION["transaksi_tgl"], 1);
		$array2d[] = array("contact_code", $_SESSION["contact_code"], 1);
		$array2d[] = array("no_reff", $_SESSION["no_reff"], 1);
		$array2d[] = array("jml_in", "0", 0);
		$array2d[] = array("jml_out", $_SESSION["total"], 0);
		$sqlCmd = sqlInsert("trx_invoice", $array2d); 
		$oDB->ExecuteNonQuery($sqlCmd);
		
		if ($_SESSION["bayar"] != "0" && $_SESSION["bayar"] != "0.00" && $_SESSION["bayar"] != ""){
			unset($array2d);
			$array2d[] = array("no_transaksi", $_SESSION["transaksi_kode"], 1);
			$array2d[] = array("no_invoice", $_SESSION["transaksi_kode"], 1); 
			$array2d[] = array("jenis_transaksi", "2", 0); 
			$array2d[] = array("tgl_transaksi", $_SESSION["transaksi_tgl"], 1);
			$array2d[] = array("tgl_invoice", $_SESSION["transaksi_tgl"], 1);
			$array2d[] = array("contact_code", $_SESSION["contact_code"], 1);
			$array2d[] = array("jml_in", $_SESSION["bayar"], 0);
			$array2d[] = array("jml_out", "0", 0);
			$sqlCmd = sqlInsert("trx_invoice", $array2d); 
			$oDB->ExecuteNonQuery($sqlCmd);
		} 
		//update saldo
		$sqlCmd = "update mst_contact, (select sum(jml_in) - sum(jml_out) as saldo from trx_invoice where contact_code='" .$_SESSION["contact_code"]. "')src set mst_contact.saldo = src.saldo where contact_code='" .$_SESSION["contact_code"]. "'";
		$oDB->ExecuteNonQuery($sqlCmd);  
		
		$tambahanUrl = "&kode=" .$_SESSION["ID"];
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from trx_master where transaksi_kode='" . $_SESSION["ID"] . "'"; 
        $oDB->ExecuteNonQuery($sqlCmd);	
        
        $sqlCmd = "delete from trx_besar where no_transaksi='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);
        
        $strTemp = "Data has been successfully deleted";
		$tambahanUrl = "";
    }
    else
        eror("invalid op"); 
	
	header("location:global_notification.php?from=purchase_return" .$tambahanUrl. "&strMsg=" . htmlspecialchars($strTemp));

}

function FormLoad()
{	
	
	global $oDB;  
	global $clsformatInteger;
	global $ajaxgetproduct_name; 
	
	
	$sqlCmd = "SELECT transaksi_kode, product_code, product_name, satuan, qty, harga_beli, harga_jual, sub_total, disc_persen, disc_amount, total, ket_detail from trx_detail a WHERE a.transaksi_kode ='" .$_SESSION["ID"] . "'";
	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows; 
    
    $sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe =2"; 
    $rsSupplier = $oDB->ExecuteReader($sqlCmd); 
    
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe = 4"; 
    $rsKaryawan = $oDB->ExecuteReader($sqlCmd); 

	
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
function AddItem(){
	
	if((document.getElementById("txtDetailproduct_name0").value== "") || (document.getElementById("txtDetailproduct_name0").value== "<not found>"))
	{
		alert("Silahkan pilih product_name yang akan dijurnal");
		document.getElementById("txtDetailproduct_code0").focus();
		return false;	
	}
	
	sumSubDetail();
		
    jmlItem = jmlItem + 1;
	i = jmlItem ; 
	
    var table = document.getElementById("tblJurnalDetail");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount  -1); 	
    row.bgColor = "white"  
    
    el = "";
    el = el + "<img src='images/up.gif' onClick='moveUp(" +jmlItem+ ");'>";
    el = el + "<img src='images/down.gif' onClick='moveDown(" +jmlItem+ ");'>";
    el = el + "<img src='images/delmini.gif' onClick='delRow(" +jmlItem+ ");'>"; 
	
	
    var cell0 = row.insertCell(0); 
    cell0.innerHTML = "<div class='font10black' align='center'>" +(jmlItem)+ "</div >" 
    
    nilai = document.getElementById("txtDetailproduct_code0").value;
    nilai2 = document.getElementById("txtDetailproduct_name0").value; 
    var cell1 = row.insertCell(1);
    cell1.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailproduct_code' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 10, " readonly");  echo "-"; $name="\" + 'txtDetailproduct_name' +i + \""; echo getTextBox("1", $name, "\" +nilai2+ \"", 255, 25, " readonly");?></div>"
	//alert(document.getElementById("txtFieldName" + jmlItem ).value);
	
	nilai = document.getElementById("txtDetailharga_beli0").value;
	var cell2 = row.insertCell(2);
    cell2.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailharga_beli' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 15, $clsformatInteger . " readonly" ); ?></div>"
    
    nilai = document.getElementById("txtDetailqty0").value;
    var cell3 = row.insertCell(3);
    cell3.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailqty' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 20, 5, $clsformatInteger . " readonly"); ?></div>" 
    
    nilai = document.getElementById("txtDetailsub_total0").value;
	var cell4 = row.insertCell(4);
    cell4.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailsub_total' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 15, $clsformatInteger . " readonly"); ?></div>"
    
    nilai = document.getElementById("txtDetaildisc_persen0").value;
	nilai2 = document.getElementById("txtDetaildisc_amount0").value;
	var cell5 = row.insertCell(5);
    cell5.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetaildisc_persen' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 5, $clsformatInteger . " readonly"); echo "% "; $name="\" + 'txtDetaildisc_amount' +i + \""; echo getTextBox("1", $name, "\" +nilai2+ \"", 50, 15, $clsformatInteger . " readonly"); ?></div>"
    
    nilai = document.getElementById("txtDetailtotal0").value;
    var cell6 = row.insertCell(6);
    cell6.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailtotal' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 15, $clsformatInteger . " readonly"); ?></div>" 
    
    nilai = document.getElementById("txtDetailket_detail0").value;
    var cell7 = row.insertCell(7);
    cell7.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailket_detail' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 20, " readonly"); ?></div>"  
    
    var cell8 = row.insertCell(8); 
    cell8.innerHTML = "<div class='font10black' align='center'>" + el + "</div>"
    
    document.getElementById("txtDetailproduct_code0").value = "";
    document.getElementById("txtDetailproduct_name0").value = "";
    document.getElementById("txtDetailharga_beli0").value = "";
    document.getElementById("txtDetailqty0").value = "";
    document.getElementById("txtDetailsub_total0").value = "";
    document.getElementById("txtDetaildisc_persen0").value = ""; 
    document.getElementById("txtDetaildisc_amount0").value = "";
    document.getElementById("txtDetailtotal0").value = "";
    document.getElementById("txtDetailket_detail0").value = ""; 
    
    document.getElementById("txtDetailproduct_code0").focus();
    
    sumJumlah();
}    
 

function removeItem()
{
    if(jmlItem != 0)
    {
        var table = document.getElementById('tblJurnalDetail');
        var rowCount = table.rows.length;
        table.deleteRow(rowCount-2)	
		
        jmlItem = jmlItem-1; 
    }
}

function moveUp(index){
    if (index > 1){
    	tempDetailproduct_code = document.getElementById('txtDetailproduct_code' + (index-1)).value;
        document.getElementById('txtDetailproduct_code' + (index-1)).value =  document.getElementById('txtDetailproduct_code' + index).value;
        document.getElementById('txtDetailproduct_code' + index).value =  tempDetailproduct_code ; 

		tempDetailproduct_name = document.getElementById('txtDetailproduct_name' + (index-1)).value;
        document.getElementById('txtDetailproduct_name' + (index-1)).value =  document.getElementById('txtDetailproduct_name' + index).value;
        document.getElementById('txtDetailproduct_name' + index).value =  tempDetailproduct_name;

        tempDetailharga_beli = document.getElementById('txtDetailharga_beli' + (index-1)).value;
        document.getElementById('txtDetailharga_beli' + (index-1)).value =  document.getElementById('txtDetailharga_beli' + index).value;
        document.getElementById('txtDetailharga_beli' + index).value =  tempDetailharga_beli;

        tempDetailqty = document.getElementById('txtDetailqty' + (index-1)).value;
        document.getElementById('txtDetailqty' + (index-1)).value =  document.getElementById('txtDetailqty' + index).value;
        document.getElementById('txtDetailqty' + index).value =  tempDetailqty;

        tempDetailsub_total = document.getElementById('txtDetailsub_total' + (index-1)).value;
        document.getElementById('txtDetailsub_total' + (index-1)).value =  document.getElementById('txtDetailsub_total' + index).value;
        document.getElementById('txtDetailsub_total' + index).value =  tempDetailsub_total;
        
        tempDetaildisc_persen = document.getElementById('txtDetaildisc_persen' + (index-1)).value;
        document.getElementById('txtDetaildisc_persen' + (index-1)).value =  document.getElementById('txtDetaildisc_persen' + index).value;
        document.getElementById('txtDetaildisc_persen' + index).value =  tempDetaildisc_persen;

        tempDetaildisc_amount = document.getElementById('txtDetaildisc_amount' + (index-1)).value;
        document.getElementById('txtDetaildisc_amount' + (index-1)).value =  document.getElementById('txtDetaildisc_amount' + index).value;
        document.getElementById('txtDetaildisc_amount' + index).value =  tempDetaildisc_amount;

        tempDetailtotal = document.getElementById('txtDetailtotal' + (index-1)).value;
        document.getElementById('txtDetailtotal' + (index-1)).value =  document.getElementById('txtDetailtotal' + index).value;
        document.getElementById('txtDetailtotal' + index).value =  tempDetailtotal; 

        tempDetailket_detail = document.getElementById('txtDetailket_detail' + (index-1)).value;
        document.getElementById('txtDetailket_detail' + (index-1)).value =  document.getElementById('txtDetailket_detail' + index).value;
        document.getElementById('txtDetailket_detail' + index).value =  tempDetailket_detail;
    }
}

function moveDown(index){
    if (index < jmlItem){
    	tempDetailproduct_code = document.getElementById('txtDetailproduct_code' + (index+1)).value;
        document.getElementById('txtDetailproduct_code' + (index+1)).value =  document.getElementById('txtDetailproduct_code' + index).value;
        document.getElementById('txtDetailproduct_code' + index).value =  tempDetailproduct_code ; 

		tempDetailproduct_name = document.getElementById('txtDetailproduct_name' + (index+1)).value;
        document.getElementById('txtDetailproduct_name' + (index+1)).value =  document.getElementById('txtDetailproduct_name' + index).value;
        document.getElementById('txtDetailproduct_name' + index).value =  tempDetailproduct_name;

        tempDetailharga_beli = document.getElementById('txtDetailharga_beli' + (index+1)).value;
        document.getElementById('txtDetailharga_beli' + (index+1)).value =  document.getElementById('txtDetailharga_beli' + index).value;
        document.getElementById('txtDetailharga_beli' + index).value =  tempDetailharga_beli;

        tempDetailqty = document.getElementById('txtDetailqty' + (index+1)).value;
        document.getElementById('txtDetailqty' + (index+1)).value =  document.getElementById('txtDetailqty' + index).value;
        document.getElementById('txtDetailqty' + index).value =  tempDetailqty;

        tempDetailsub_total = document.getElementById('txtDetailsub_total' + (index+1)).value;
        document.getElementById('txtDetailsub_total' + (index+1)).value =  document.getElementById('txtDetailsub_total' + index).value;
        document.getElementById('txtDetailsub_total' + index).value =  tempDetailsub_total;
        
        tempDetaildisc_persen = document.getElementById('txtDetaildisc_persen' + (index+1)).value;
        document.getElementById('txtDetaildisc_persen' + (index+1)).value =  document.getElementById('txtDetaildisc_persen' + index).value;
        document.getElementById('txtDetaildisc_persen' + index).value =  tempDetaildisc_persen;

        tempDetaildisc_amount = document.getElementById('txtDetaildisc_amount' + (index+1)).value;
        document.getElementById('txtDetaildisc_amount' + (index+1)).value =  document.getElementById('txtDetaildisc_amount' + index).value;
        document.getElementById('txtDetaildisc_amount' + index).value =  tempDetaildisc_amount;

        tempDetailtotal = document.getElementById('txtDetailtotal' + (index+1)).value;
        document.getElementById('txtDetailtotal' + (index+1)).value =  document.getElementById('txtDetailtotal' + index).value;
        document.getElementById('txtDetailtotal' + index).value =  tempDetailtotal; 

        tempDetailket_detail = document.getElementById('txtDetailket_detail' + (index+1)).value;
        document.getElementById('txtDetailket_detail' + (index+1)).value =  document.getElementById('txtDetailket_detail' + index).value;
        document.getElementById('txtDetailket_detail' + index).value =  tempDetailket_detail;
    } 
}

function delRow(index){
    var i = 0;
    if (index < jmlItem){
        for(i=index;i<jmlItem;i++)
        {
        	document.getElementById('txtDetailproduct_code' + (i)).value =  document.getElementById('txtDetailproduct_code' + (i+1)).value; 
            document.getElementById('txtDetailproduct_name' + (i)).value =  document.getElementById('txtDetailproduct_name' + (i+1)).value;
            document.getElementById('txtDetailharga_beli' + (i)).value =  document.getElementById('txtDetailharga_beli' + (i+1)).value;
            document.getElementById('txtDetailqty' + (i)).value =  document.getElementById('txtDetailqty' + (i+1)).value;
            document.getElementById('txtDetailsub_total' + (i)).value =  document.getElementById('txtDetailsub_total' + (i+1)).value;
            document.getElementById('txtDetaildisc_persen' + (i)).value =  document.getElementById('txtDetaildisc_persen' + (i+1)).value;
            document.getElementById('txtDetaildisc_amount' + (i)).value =  document.getElementById('txtDetaildisc_amount' + (i+1)).value;
            document.getElementById('txtDetailtotal' + (i)).value =  document.getElementById('txtDetailtotal' + (i+1)).value;
            document.getElementById('txtDetailket_detail' + (i)).value =  document.getElementById('txtDetailket_detail' + (i+1)).value; 
        }
    }
    removeItem();
    sumJumlah();
} 

function sumJumlah(){
    var i = 0; 
    var sum = 0; 
    var nilai = 0; 
    
    var sum2 = 0; 
    var nilai2 = 0;

    for(i=1;i<=jmlItem;i++)
    {
    	if (document.getElementById('txtDetailtotal' + (i)).value == "") { document.getElementById('txtDetailtotal' + (i)).value = "0";}
    	nilai = eval(formatBilangan(document.getElementById('txtDetailtotal' + (i)).value));
    	sum = sum + nilai; 
    	
    	if (document.getElementById('txtDetailqty' + (i)).value == "") { document.getElementById('txtDetailqty' + (i)).value = "0";}
    	nilai2 = eval(formatBilangan(document.getElementById('txtDetailqty' + (i)).value));
    	sum2 = sum2 + nilai2;
    }     
    
    document.getElementById('txtsub_total').value = formatCurrency3(sum); 
	document.getElementById('txtsub_qty').value = formatCurrency3(sum2);
	
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
	
	total = sum + ppn - disc;
	sisa = total - bayar;
	
	document.getElementById('txttotal').value = formatCurrency3(total);
	document.getElementById('txtsisa').value = formatCurrency3(sisa); 
}

function hitungDisc(){
	var nilai = 0; 
	var discPersen = 0;
	var disc = 0; 
	
	if ((document.getElementById('txtdisc_persen').value != "") && (document.getElementById('txtdisc_persen').value != "0")) {
		
		if (document.getElementById('txtsub_total').value == "") { document.getElementById('txtsub_total').value = "0";}
		
		nilai = eval(formatBilangan(document.getElementById('txtsub_total').value));
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
		
		if (document.getElementById('txtsub_total').value == "") { document.getElementById('txtsub_total').value = "0";}
		
		nilai = eval(formatBilangan(document.getElementById('txtsub_total').value));
		ppnPersen = eval(formatBilangan(document.getElementById('txtppn_persen').value)); 
		ppn = ppnPersen * nilai / 100;
		
		document.getElementById('txtppn_amount').value = formatCurrency3(ppn);
		sumJumlah();
	}
	
}

function sumSubDetail(){
	var harga = 0;
	var qty = 0;
	var subtotal = 0;
	var discPersen = 0;
	var disc = 0;
	var total = 0;
	
	if (document.getElementById('txtDetailharga_beli0').value == "") { document.getElementById('txtDetailharga_beli0').value = "0";}
	if (document.getElementById('txtDetailqty0').value == "") { document.getElementById('txtDetailqty0').value = "0";}
	if (document.getElementById('txtDetaildisc_persen0').value == "") { document.getElementById('txtDetaildisc_persen0').value = "0";}
	if (document.getElementById('txtDetaildisc_amount0').value == "") { document.getElementById('txtDetaildisc_amount0').value = "0";}
	if (document.getElementById('txtDetailtotal0').value == "") { document.getElementById('txtDetailtotal0').value = "0";}
	
	harga = eval(formatBilangan(document.getElementById('txtDetailharga_beli0').value));
	qty = eval(formatBilangan(document.getElementById('txtDetailqty0').value));
	discPersen = eval(formatBilangan(document.getElementById('txtDetaildisc_persen0').value));
	disc = eval(formatBilangan(document.getElementById('txtDetaildisc_amount0').value));
	
	subtotal = harga * qty;
	if (discPersen !=0 ){
		disc = subtotal  * discPersen  / 100 ;
		document.getElementById('txtDetaildisc_amount0').value = formatCurrency3(disc);
	}
	
	total = subtotal - disc;
	document.getElementById('txtDetailsub_total0').value = formatCurrency3(subtotal);
	document.getElementById('txtDetailtotal0').value = formatCurrency3(total ); 
}

function setNormal(){
    var i = 0; 
  

    for(i=1;i<=jmlItem;i++)
    { 
    	document.getElementById('txtDetailqty' + (i)).value = formatBilangan(document.getElementById('txtDetailqty' + (i)).value); 
    	document.getElementById('txtDetailharga_beli' + (i)).value = formatBilangan(document.getElementById('txtDetailharga_beli' + (i)).value);
    	document.getElementById('txtDetailsub_total' + (i)).value = formatBilangan(document.getElementById('txtDetailsub_total' + (i)).value);
    	document.getElementById('txtDetaildisc_persen' + (i)).value = formatBilangan(document.getElementById('txtDetaildisc_persen' + (i)).value);
    	document.getElementById('txtDetaildisc_amount' + (i)).value = formatBilangan(document.getElementById('txtDetaildisc_amount' + (i)).value);
    	document.getElementById('txtDetailtotal' + (i)).value = formatBilangan(document.getElementById('txtDetailtotal' + (i)).value);    	
    } 
    
    document.getElementById('txtsub_total').value = formatBilangan(document.getElementById('txtsub_total').value);
    document.getElementById('txtsub_qty').value = formatBilangan(document.getElementById('txtsub_qty').value);
    document.getElementById('txtdisc_persen').value = formatBilangan(document.getElementById('txtdisc_persen').value);
    document.getElementById('txtdisc_amount').value = formatBilangan(document.getElementById('txtdisc_amount').value);
    document.getElementById('txtppn_persen').value = formatBilangan(document.getElementById('txtppn_persen').value);
    document.getElementById('txtppn_amount').value = formatBilangan(document.getElementById('txtppn_amount').value);
    document.getElementById('txttotal').value = formatBilangan(document.getElementById('txttotal').value);
    document.getElementById('txtbayar').value = formatBilangan(document.getElementById('txtbayar').value);
    document.getElementById('txtsisa').value = formatBilangan(document.getElementById('txtsisa').value);
    
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
	window.open("purchase_return_cetak.php?kode="+kode, "cetak_jurnal_" + kode ,  "height=360, width=640, location=0,menubar=0,scrollbars=1,resizable=0, modal=yes");

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
    		alert("kode jurnal masih kosong");	
    		return false; 
    	}
    	
    	if(document.input.txttransaksi_tgl.value == "")
    	{
    		alert("tgl beli masih kosong");	
    		return false; 
    	}  
      	
      	//alert(document.input.txtJmlItem.value);
      	//return false;
    }

    if (op == "1")
        msg = 'Confirm add Data Retur Pembelian ?';
    else if (op == "2")
        msg = 'Confirm edit Data Retur Pembelian ?';
    else if (op == "3")
        msg = 'Confirm delete Data Retur Pembelian ?';
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
			
			document.getElementById("btSubmit").disabled = true; 
			document.getElementById("btCetak").disabled = true;
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

<table width="80%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
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
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txttransaksi_kode", $_SESSION["transaksi_kode"], 20, 20, " readonly"); ?> </td>
						</tr >
						
						<tr class="font10black">
						  <td style="height: 23px"></td>
						  <td style="height: 23px">  Tgl Transaksi</td>
						  <td style="height: 23px">:</td>
						  <td style="height: 23px"> <?php  echo getDatePic($_SESSION["modeView"], "txttransaksi_tgl", $_SESSION["transaksi_tgl"], ""); ?> </td>
						</tr >  
					</table>
				</td>
				
				<td  valign="top"> <!-- kanan-->
					<table width="100%">
						<tr class="font10black">
						  <td style="width: 3%"></td>
						  <td width="30%">Supplier</td>
						  <td width="1%">:</td> 
						  <td> <?php  echo getComboBox($_SESSION["modeView"], "txtcontact_code", $_SESSION["contact_code"], $rsSupplier, ""); ?> </td>
						  
						</tr >
						<tr class="font10black">
						  <td style="width: 3%; height: 23px;"></td>
						  <td style="height: 23px">  Petugas</td>
						  <td style="height: 23px">:</td>
						  <td style="height: 23px"> 
						   <?php  echo getComboBox($_SESSION["modeView"], "txtsales_code", $_SESSION["sales_code"], $rsKaryawan, ""); ?>  
						  </td>
						</tr > 
						<tr class="font10black">
						  <td style="height: 23px"></td>
						  <td style="height: 23px" nowrap>  No Invoice 
						  (yang di retur)</td>
						  <td style="height: 23px">:</td>
						  <td style="height: 23px"> <?php  echo getTextBox($_SESSION["modeView"], "txtno_reff", $_SESSION["no_reff"], 50, 20, ""); ?> </td>
						</tr >
						<tr class="font10black">
						  <td style="height: 23px"></td>
						  <td style="height: 23px" nowrap>  Tgl Invoice  
						  (yang di retur)</td>
						  <td style="height: 23px">:</td>
						  <td style="height: 23px"> <?php echo getDatePic($_SESSION["modeView"], "txttgl_reff", $_SESSION["tgl_reff"], ""); ?> </td>
						</tr >
					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr >
				<td colspan=2 valign="top">  
					<table width="100%"  cellspacing="1" bgcolor="silver" id="tblJurnalDetail" >  
					<?php
					if($_SESSION["modeView"] == "1"){  
					?>
						<tr bgcolor="white"  align='center'>
							<td align="right">
							<input class="button" type="button" name="btnLookUp" value="..." onClick="lookupWindow('product_lookup.php?tipe=1&elid1=txtDetailproduct_code0&elid2=txtDetailproduct_name0&elid3=txtDetailharga_beli0', 'product_list')" />
							</td>
							<td nowrap><?php 
								echo getTextBox(1, "txtDetailproduct_code0", "", 50, 10, $ajaxgetproduct_name); 
								echo "-";
								echo getTextBox(1, "txtDetailproduct_name0", "", 255, 25, " readonly"); 
								?>
							</td> 
							<td><?php echo getTextBox(1, "txtDetailharga_beli0", "", 50, 15, $clsformatInteger); ?></td> 
							<td><?php echo getTextBox(1, "txtDetailqty0", "", 50, 5, $clsformatInteger); ?></td>  
							<td><?php echo getTextBox(1, "txtDetailsub_total0", "", 50, 15, $clsformatInteger); ?></td>
							<td nowrap><?php echo getTextBox(1, "txtDetaildisc_persen0", "", 50, 5, $clsformatInteger); echo "% "; echo getTextBox(1, "txtDetaildisc_amount0", "", 50, 15, $clsformatInteger); ?></td>
							<td nowrap><?php echo getTextBox(1, "txtDetailtotal0", "", 50, 15, $clsformatInteger); ?>
							
							</td>
							<td><?php echo getTextBox(1, "txtDetailket_detail0", "", 50, 20, ""); ?></td> 
							<td nowrap>
							<input class="button" type="button" name="btnCalSubDetail" value=" &Sigma; " onClick="sumSubDetail()" />
							<input class="button" type="button" name="btnAddItem" value="Add Item" onClick="AddItem();" /></td>    
						</tr>
					<?php 
					}
					?>
						<tr class="contentTitleTable" align="center"> 
							<td style="height: 22px">No</td>
							<td style="height: 22px">Produk / Barang</td> 
							<td style="height: 22px">Harga</td>
							<td style="height: 22px">Banyak</td>
							<td style="height: 22px">Sub Total</td> 
							<td style="height: 22px">Disc</td>
							<td style="height: 22px">Total</td> 
							<td style="height: 22px">Ket</td>  
							<td style="height: 22px"></td> 
						</tr> 
						
						<?php
							$i = 0;
							while ($datadetail = mysql_fetch_array($rsdetail)) 
							{
								$i++;
								echo "<tr bgcolor='#ffffff' class='font10black'>";
								
								echo "<td align='center'>$i";
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailproduct_code$i", $datadetail["product_code"], 50, 10, " readonly"); 
								echo "-"; 
								echo getTextBox($_SESSION["modeView"], "txtDetailproduct_name$i", $datadetail["product_name"], 255, 25, " readonly");
								echo "</td>";
								
								echo "<td align='right'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailharga_beli$i", setNumber($datadetail["harga_beli"]), 50, 15, $clsformatInteger . " readonly");
								echo "</td>";
								
								echo "<td align='center'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailqty$i", setNumber($datadetail["qty"]), 20, 5, $clsformatInteger . " readonly");
								echo "</td>";
								
								echo "<td align='left'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailsub_total$i", setNumber($datadetail["sub_total"]), 50, 15, $clsformatInteger . " readonly");
								echo "</td>";
								
								echo "<td align='right'>";
								echo getTextBox($_SESSION["modeView"], "txtDetaildisc_persen$i", setNumber($datadetail["disc_persen"]), 50, 5, $clsformatInteger . " readonly");
								echo "% ";
								echo getTextBox($_SESSION["modeView"], "txtDetaildisc_amount$i", setNumber($datadetail["disc_amount"]), 50, 15, $clsformatInteger . " readonly"); 
								echo "</td>";
								
								echo "<td align='right'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailtotal$i", setNumber($datadetail["total"]), 50, 15, $clsformatInteger . " readonly"); 
								echo "</td>"; 
								
								echo "<td align='left'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailket_detail$i", $datadetail["ket_detail"], 50, 20, " readonly");
								echo "</td>";
								
								echo "<td align='center'>";
								if($_SESSION["modeView"] == "1"){   
									echo "<img src='images/up.gif' onClick='moveUp($i);'>";
								    echo "<img src='images/down.gif' onClick='moveDown($i);'>";
								    echo "<img src='images/delmini.gif' onClick='delRow($i);'>";  
								}
								echo "</td>"; 
								echo "</tr>";
							}
						?>
						
						<tr bgcolor="white" class='font10black'>
							<td colspan="3" align="right">Jumlah</td>  
							<td align="center">
							<?php  echo getTextBox($_SESSION["modeView"], "txtsub_qty", setNumber($_SESSION["sub_qty"]), 20, 5, $clsformatInteger); ?>  
							</td>
							<td colspan="2" align="right"></td>
							<td align="right">
							<?php  echo getTextBox($_SESSION["modeView"], "txtsub_total", setNumber($_SESSION["sub_total"]), 20, 15, $clsformatInteger); ?> 
							<?php  echo getHiddenBox($_SESSION["modeView"], "txtJmlItem","<?php echo $jmlItem;?>"); ?>

							</td> 
							<td colspan="2" align="right">&nbsp;</td> 
						</tr>
						
					</table>
				</td> 
			</tr>
			
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%">   
						<tr class="font10black"> 
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">Discount</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtdisc_persen", $_SESSION["disc_persen"], 50, 3, $clsformatInteger) . "% "; echo getTextBox($_SESSION["modeView"], "txtdisc_amount", setNumber($_SESSION["disc_amount"]), 50, 20, $clsformatInteger); ?> 
						  <input class="button" type="button" name="btnCalcDisc" value=" &Sigma; " onClick="hitungDisc()" />
						  </td>
						</tr >
						<tr class="font10black"> 
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">PPN</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtppn_persen", $_SESSION["ppn_persen"], 50, 3, $clsformatInteger) . "% "; echo getTextBox($_SESSION["modeView"], "txtppn_amount", setNumber($_SESSION["ppn_amount"]), 50, 20, $clsformatInteger); ?> 
						  <input class="button" type="button" name="btnCalcPPN" value=" &Sigma; " onClick="hitungPPN()" /> 
						  </td>
						</tr > 
						<tr class="font10black"> 
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">Total</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txttotal", setNumber($_SESSION["total"]), 50, 30, $clsformatInteger . " readonly"); ?> </td>
						</tr >
						

					</table>
				</td>
				
				<td > <!-- kanan-->
					<table width="100%"> 
						
						<tr class="font10black"> 
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">Pembayaran</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtbayar", setNumber($_SESSION["bayar"]), 50, 30, $clsformatInteger); ?>
						<input class="button" type="button" name="btnCalTotal" value=" &Sigma; " onClick="sumJumlah()" /> 
 </td>
						</tr >
						<tr class="font10black"> 
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">Piutang</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtsisa", setNumber($_SESSION["sisa"]), 50, 30, $clsformatInteger . " readonly"); ?> </td>
						</tr >
						<tr class="font10black"> 
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">Keterangan</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtketerangan", $_SESSION["keterangan"], 255, 40, ""); ?> </td>
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

function ClearSession()
{
//$_SESSION["op"] = ""
$_SESSION["btnLabel"] = "";
$_SESSION["lblTitle"] = "";
$_SESSION["errAlert"] 	= false;
$_SESSION["errMsg"] 	= "";
$_SESSION["ID"] = "";
$_SESSION["transaksi_kode"] = "";
$_SESSION["transaksi_tipe"] = "";
$_SESSION["transaksi_tgl"] = "";
$_SESSION["contact_code"] = "";
$_SESSION["sales_code"] = "";
$_SESSION["sub_total"] = "";
$_SESSION["sub_qty"] = "";
$_SESSION["disc_persen"] = "";
$_SESSION["disc_amount"] = "";
$_SESSION["ppn_persen"] = "";
$_SESSION["ppn_amount"] = "";
$_SESSION["total"] = "";
$_SESSION["bayar"] = "";
$_SESSION["sisa"] = ""; 
$_SESSION["keterangan"] = ""; 
$_SESSION["no_reff"] = ""; 
$_SESSION["tgl_reff"] = ""; 
}
?>

