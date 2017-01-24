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
            if ($_SESSION["op"] == "1"){
            	$_SESSION["jurnal_code"] = getKodeJurnalKas($hostDB, $userDB, $passDB, $nameDB); 
            	updateKodeJurnalKas($hostDB, $userDB, $passDB, $nameDB);  
            }
            //$_SESSION["jurnal_code"] = $_POST["txtjurnal_code"];
			$_SESSION["jurnal_date"] = $_POST["txtjurnal_date"];
			$_SESSION["perkiraan_header_code"] = $_POST["txtperkiraan_header_code"];
			$_SESSION["status_debet_kredit"] = $_POST["txtstatus_debet_kredit"];
			$_SESSION["jumlah"] = $_POST["txtSubAmount"]; 
			$_SESSION["keterangan"] = $_POST["txtketerangan"];
			$_SESSION["kode_divisi"] = $_POST["txtkode_divisi"];
			$_SESSION["tipe_jurnal"] = $_POST["txttipe_jurnal"];

 
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
			 $_SESSION["jurnal_code"] = getKodeJurnalKas($hostDB, $userDB, $passDB, $nameDB);
					
			$_SESSION["jurnal_date"] = date("Y-m-d");			
            $_SESSION["btnLabel"] = "Save Data Jurnal Kas";
            $_SESSION["lblTitle"] = "New Data Jurnal Kas";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT * FROM trx_jurnal a WHERE a.jurnal_code ='" .$_SESSION["ID"] . "'";
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	 
				$_SESSION["jurnal_code"] = $data["jurnal_code"];
				$_SESSION["jurnal_date"] = $data["jurnal_date"];
				$_SESSION["perkiraan_header_code"] = $data["perkiraan_header_code"];
				$_SESSION["status_debet_kredit"] = $data["status_debet_kredit"];
				$_SESSION["jumlah"] = $data["jumlah"];
				$_SESSION["keterangan"] = $data["keterangan"];
				$_SESSION["kode_divisi"] = $data["kode_divisi"];
				$_SESSION["tipe_jurnal"] = $data["tipe_jurnal"];  
			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data Jurnal Kas";
                $_SESSION["lblTitle"]  = "Edit Data Jurnal Kas";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data Jurnal Kas";
                    $_SESSION["lblTitle"]  = "Delete Data Jurnal Kas";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data Jurnal Kas";
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
	   
		$array2d[] = array("jurnal_code", $_SESSION["jurnal_code"], 1);
		$array2d[] = array("jurnal_date", $_SESSION["jurnal_date"], 1);
		$array2d[] = array("perkiraan_header_code", $_SESSION["perkiraan_header_code"], 1);
		$array2d[] = array("status_debet_kredit", $_SESSION["status_debet_kredit"], 0);
		$array2d[] = array("jumlah", $_SESSION["jumlah"], 0);
		$array2d[] = array("jumlah_debet", $_SESSION["jumlah_debet"], 0);
		$array2d[] = array("jumlah_kredit", $_SESSION["jumlah_kredit"], 0);
		$array2d[] = array("keterangan", $_SESSION["keterangan"], 1); 
		$array2d[] = array("kode_divisi", $_SESSION["kode_divisi"], 1);
		$array2d[] = array("tipe_jurnal", $_SESSION["tipe_jurnal"], 0);
        
        if ($_SESSION["op"] == "1")
        {
        	$_SESSION["ID"] = $_SESSION["jurnal_code"];
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlInsert("trx_jurnal", $array2d);
            $strTemp = "Data has been successfully inserted"; 
        }            
        else
        {           
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("trx_jurnal", $array2d, "where jurnal_code='" .$_SESSION["ID"] . "'");	
            $strTemp = "Data has been successfully updated";
        }
        $oDB->ExecuteNonQuery($sqlCmd);	
        
        $sqlCmd = "delete from trx_jurnal_detail where jurnal_code='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);	
        
        $sqlCmd = "delete from trx_besar where no_transaksi='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);
        
		$jmlItem = $_POST["txtJmlItem"];
		//eror($jmlItem);

		for($i=1; $i<=$jmlItem; $i++){
			unset($array2d);
			$array2d[] = array("jurnal_code", $_SESSION["ID"], 1); 
			$array2d[] = array("perkiraan_code", $_POST["txtDetailPerkiraanCode$i"], 1);
			$array2d[] = array("perkiraan_name", $_POST["txtDetailPerkiraan$i"], 1);
			$array2d[] = array("jumlah", $_POST["txtDetailJumlah$i"], 0);
			$array2d[] = array("ket_dok", $_POST["txtDetailKetDok$i"], 1);
			$array2d[] = array("tgl_dok",$_POST["txtDetailTglDok$i"], 1);
			$array2d[] = array("no_dok", $_POST["txtDetailNoDok$i"], 1); 
			
			$sqlCmd = sqlInsert("trx_jurnal_detail", $array2d); 
			//echo $sqlCmd . "<br />";
			$oDB->ExecuteNonQuery($sqlCmd);	
			
			//******* posting besar
			if ($_SESSION["status_debet_kredit"] == 1){
				$debet = $_POST["txtDetailJumlah$i"];
				$kredit = "0"; 
			}
			else{
				$debet = "0";  
				$kredit = $_POST["txtDetailJumlah$i"];	 
			}					
			unset($array2d);
			$array2d[] = array("no_transaksi", $_SESSION["jurnal_code"], 1); 
			$array2d[] = array("jenis_transaksi", $_SESSION["tipe_jurnal"], 0); 
			$array2d[] = array("tgl_transaksi", $_SESSION["jurnal_date"], 1);
			$array2d[] = array("kodeac", $_SESSION["perkiraan_header_code"], 1);
			$array2d[] = array("kodedc", $_POST["txtDetailPerkiraanCode$i"], 1);
			$array2d[] = array("stdk", $_SESSION["status_debet_kredit"], 0);
			$array2d[] = array("debet",$debet, 0);
			$array2d[] = array("kredit", $kredit, 0);
			$array2d[] = array("ket", $_POST["txtDetailKetDok$i"], 1);
			$sqlCmd = sqlInsert("trx_besar", $array2d); 
			$oDB->ExecuteNonQuery($sqlCmd);	 
			
			if ($_SESSION["status_debet_kredit"] == 1){
				$debet = "0";  
				$kredit = $_POST["txtDetailJumlah$i"];			
			}
			else{
				$debet = $_POST["txtDetailJumlah$i"];
				$kredit = "0";  
			}		
						
			unset($array2d);
			$array2d[] = array("no_transaksi", $_SESSION["jurnal_code"], 1); 
			$array2d[] = array("jenis_transaksi", $_SESSION["tipe_jurnal"], 0); 
			$array2d[] = array("tgl_transaksi", $_SESSION["jurnal_date"], 1);
			$array2d[] = array("kodeac", $_POST["txtDetailPerkiraanCode$i"], 1);
			$array2d[] = array("kodedc", $_SESSION["perkiraan_header_code"], 1);
			$array2d[] = array("stdk", $_SESSION["status_debet_kredit"], 0);
			$array2d[] = array("debet",$debet, 0);
			$array2d[] = array("kredit", $kredit, 0);
			$array2d[] = array("ket", $_POST["txtDetailKetDok$i"], 1);
			$sqlCmd = sqlInsert("trx_besar", $array2d); 
			$oDB->ExecuteNonQuery($sqlCmd);	
			//******* end posting besar

		}
		//eror($jmlItem . "stop");

    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from trx_jurnal where jurnal_code='" . $_SESSION["ID"] . "'"; 
        $oDB->ExecuteNonQuery($sqlCmd);	
        
        $sqlCmd = "delete from trx_besar where no_transaksi='" .$_SESSION["ID"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);
        
        $strTemp = "Data has been successfully deleted";

    }
    else
        eror("invalid op"); 
	
	header('location:global_notification.php?strMsg=' . htmlspecialchars($strTemp));

}

function FormLoad()
{	
	
	global $oDB;  
	global $clsformatInteger;
	global $ajaxgetPerkiraan; 
	
	
	$sqlCmd = "SELECT perkiraan_code, perkiraan_name, jumlah, no_dok, tgl_dok, ket_dok FROM trx_jurnal_detail a WHERE a.jurnal_code ='" .$_SESSION["ID"] . "'";
	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows;
	
	$sqlCmd = "SELECT KodeReff, Reff FROM mst_reff where tipeReff =1"; 
    $rsDebetKredit = $oDB->ExecuteReader($sqlCmd); 
    
    $sqlCmd = "SELECT KodeReff, Reff FROM mst_reff where tipeReff =4"; 
    $rsTipeJurnalKas= $oDB->ExecuteReader($sqlCmd); 
    
    $sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd); 
    
    $sqlCmd = "SELECT perkiraan_code, perkiraan_name FROM mst_perkiraan where stac=1 and stkas=1"; 
    $rsPerkiraanHeader = $oDB->ExecuteReader($sqlCmd); 

	
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

$(function(){
    /*
     * this swallows backspace keys on any non-input element.
     * stops backspace -> back
     */
    var rx = /INPUT|SELECT|TEXTAREA/i;

    $(document).bind("keydown keypress", function(e){
        if( e.which == 8 ){ // 8 == backspace
            if(!rx.test(e.target.tagName) || e.target.disabled || e.target.readOnly ){
                e.preventDefault();
            }
        }
    });
});

var jmlItem = <?php echo $jmlItem ?>;
function AddItem(){
	
	if((document.getElementById("txtDetailPerkiraan0").value== "") || (document.getElementById("txtDetailPerkiraan0").value== "<not found>"))
	{
		alert("Silahkan pilih perkiraan yang akan dijurnal");
		document.getElementById("txtDetailPerkiraanCode0").focus();
		return false;	
	}
	
	if(document.getElementById("txtDetailJumlah0").value== "") 
	{
		alert("Silahkan isi jumlah");
		document.getElementById("txtDetailJumlah0").focus();
		return false;	
	}

	
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
    
    nilai = document.getElementById("txtDetailPerkiraanCode0").value;
    nilai2 = document.getElementById("txtDetailPerkiraan0").value; 
    var cell1 = row.insertCell(1);
    cell1.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailPerkiraanCode' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 15, " readonly"); $name="\" + 'txtDetailPerkiraan' +i + \""; echo getTextBox("1", $name, "\" +nilai2+ \"", 50, 35, " readonly");?></div>"
	//alert(document.getElementById("txtFieldName" + jmlItem ).value);
	
	nilai = document.getElementById("txtDetailJumlah0").value;
	var cell2 = row.insertCell(2);
    cell2.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailJumlah' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 20, $clsformatInteger . " readonly" ); ?></div>"
    
    nilai = document.getElementById("txtDetailTglDok0").value;
    var cell3 = row.insertCell(3);
    cell3.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailTglDok' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 20, 10, " readonly"); ?></div>" 
    
    nilai = document.getElementById("txtDetailNoDok0").value;
	var cell4 = row.insertCell(4);
    cell4.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailNoDok' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 20, " readonly"); ?></div>"
    
    nilai = document.getElementById("txtDetailKetDok0").value;
    var cell5 = row.insertCell(5);
    cell5.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailKetDok' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 20, " readonly"); ?></div>"  
    
    var cell6 = row.insertCell(6); 
    cell6.innerHTML = "<div class='font10black' align='center'>" + el + "</div>"
    
    document.getElementById("txtDetailPerkiraanCode0").value = "";
    document.getElementById("txtDetailPerkiraan0").value = "";
    document.getElementById("txtDetailJumlah0").value = "";
    document.getElementById("txtDetailTglDok0").value = "";
    document.getElementById("txtDetailNoDok0").value = "";
    document.getElementById("txtDetailKetDok0").value = ""; 
    document.getElementById("txtDetailPerkiraanCode0").focus();
    
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
    	tempDetailPerkiraanCode = document.getElementById('txtDetailPerkiraanCode' + (index-1)).value;
        document.getElementById('txtDetailPerkiraanCode' + (index-1)).value =  document.getElementById('txtDetailPerkiraanCode' + index).value;
        document.getElementById('txtDetailPerkiraanCode' + index).value =  tempDetailPerkiraanCode ; 

		tempDetailPerkiraan = document.getElementById('txtDetailPerkiraan' + (index-1)).value;
        document.getElementById('txtDetailPerkiraan' + (index-1)).value =  document.getElementById('txtDetailPerkiraan' + index).value;
        document.getElementById('txtDetailPerkiraan' + index).value =  tempDetailPerkiraan;

        tempDetailJumlah = document.getElementById('txtDetailJumlah' + (index-1)).value;
        document.getElementById('txtDetailJumlah' + (index-1)).value =  document.getElementById('txtDetailJumlah' + index).value;
        document.getElementById('txtDetailJumlah' + index).value =  tempDetailJumlah;

        tempDetailTglDok = document.getElementById('txtDetailTglDok' + (index-1)).value;
        document.getElementById('txtDetailTglDok' + (index-1)).value =  document.getElementById('txtDetailTglDok' + index).value;
        document.getElementById('txtDetailTglDok' + index).value =  tempDetailTglDok;

        tempDetailNoDok = document.getElementById('txtDetailNoDok' + (index-1)).value;
        document.getElementById('txtDetailNoDok' + (index-1)).value =  document.getElementById('txtDetailNoDok' + index).value;
        document.getElementById('txtDetailNoDok' + index).value =  tempDetailNoDok;

        tempDetailKetDok = document.getElementById('txtDetailKetDok' + (index-1)).value;
        document.getElementById('txtDetailKetDok' + (index-1)).value =  document.getElementById('txtDetailKetDok' + index).value;
        document.getElementById('txtDetailKetDok' + index).value =  tempDetailKetDok;
    }
}

function moveDown(index){
    if (index < jmlItem){
    	tempDetailPerkiraanCode = document.getElementById('txtDetailPerkiraanCode' + (index+1)).value;
        document.getElementById('txtDetailPerkiraanCode' + (index+1)).value =  document.getElementById('txtDetailPerkiraanCode' + index).value;
        document.getElementById('txtDetailPerkiraanCode' + index).value =  tempDetailPerkiraanCode ;  

    	tempDetailPerkiraan = document.getElementById('txtDetailPerkiraan' + (index+1)).value;
        document.getElementById('txtDetailPerkiraan' + (index+1)).value =  document.getElementById('txtDetailPerkiraan' + index).value;
        document.getElementById('txtDetailPerkiraan' + index).value =  tempDetailPerkiraan;

        tempDetailJumlah = document.getElementById('txtDetailJumlah' + (index+1)).value;
        document.getElementById('txtDetailJumlah' + (index+1)).value =  document.getElementById('txtDetailJumlah' + index).value;
        document.getElementById('txtDetailJumlah' + index).value =  tempDetailJumlah;

        tempDetailTglDok = document.getElementById('txtDetailTglDok' + (index+1)).value;
        document.getElementById('txtDetailTglDok' + (index+1)).value =  document.getElementById('txtDetailTglDok' + index).value;
        document.getElementById('txtDetailTglDok' + index).value =  tempDetailTglDok;

        tempDetailNoDok = document.getElementById('txtDetailNoDok' + (index+1)).value;
        document.getElementById('txtDetailNoDok' + (index+1)).value =  document.getElementById('txtDetailNoDok' + index).value;
        document.getElementById('txtDetailNoDok' + index).value =  tempDetailNoDok;

        tempDetailKetDok = document.getElementById('txtDetailKetDok' + (index+1)).value;
        document.getElementById('txtDetailKetDok' + (index+1)).value =  document.getElementById('txtDetailKetDok' + index).value;
        document.getElementById('txtDetailKetDok' + index).value =  tempDetailKetDok;
    } 
}

function delRow(index){
    var i = 0;
    if (index < jmlItem){
        for(i=index;i<jmlItem;i++)
        {
        	document.getElementById('txtDetailPerkiraanCode' + (i)).value =  document.getElementById('txtDetailPerkiraanCode' + (i+1)).value; 
            document.getElementById('txtDetailPerkiraan' + (i)).value =  document.getElementById('txtDetailPerkiraan' + (i+1)).value;
            document.getElementById('txtDetailJumlah' + (i)).value =  document.getElementById('txtDetailJumlah' + (i+1)).value;
            document.getElementById('txtDetailTglDok' + (i)).value =  document.getElementById('txtDetailTglDok' + (i+1)).value;
            document.getElementById('txtDetailNoDok' + (i)).value =  document.getElementById('txtDetailNoDok' + (i+1)).value;
            document.getElementById('txtDetailKetDok' + (i)).value =  document.getElementById('txtDetailKetDok' + (i+1)).value; 
        }
    }
    removeItem();
    sumJumlah();
} 

function sumJumlah(){
    var i = 0; 
    var sum = 0; 
    var nilai = 0; 

    for(i=1;i<=jmlItem;i++)
    {
    	if (document.getElementById('txtDetailJumlah' + (i)).value == "") { document.getElementById('txtDetailJumlah' + (i)).value = "0";}
    	nilai = eval(formatBilangan(document.getElementById('txtDetailJumlah' + (i)).value));
    	sum = sum + nilai; 
    } 
    
    document.getElementById('txtSubAmount').value = formatCurrency3(sum);
}

function setNormal(){
    var i = 0; 
  

    for(i=1;i<=jmlItem;i++)
    { 
    	document.getElementById('txtDetailJumlah' + (i)).value = formatBilangan(document.getElementById('txtDetailJumlah' + (i)).value); 
    } 
    
    document.getElementById('txtSubAmount').value = formatBilangan(document.getElementById('txtSubAmount').value);
}


function errMsg() {
	<?php 
	if( $_SESSION["errAlert"] ==true){	
		echo "alert('" . $_SESSION["errAlert"] . "')";
	}
	?>
} 

function frmCetak(){
	kode = document.input.txtjurnal_code.value;
	//alert(kode );
	window.open("cetak_bukti_jurnal.php?kode="+kode, "cetak_jurnal_" + kode ,  "height=360, width=640, location=0,menubar=0,scrollbars=1,resizable=0, modal=yes");

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
    	
    	if(document.input.txtjurnal_code.value == "")
    	{
    		alert("kode jurnal masih kosong");	
    		return false; 
    	}
    	
    	if(document.input.txtjurnal_date.value == "")
    	{
    		alert("tgl jurnal masih kosong");	
    		return false; 
    	}
    	
    	if(document.input.txtperkiraan_header_code.value == "")
    	{
    		alert("kas masih kosong");	
    		return false; 
    	}
    	
    	if(document.input.txtstatus_debet_kredit.value == "")
    	{
    		alert("status debet/kredit mash kosong");	
    		return false; 
    	} 
    	
      	document.input.txtJmlItem.value = jmlItem;   
      	setNormal();
      	//alert(document.input.txtJmlItem.value);
      	//return false;
    }

    if (op == "1")
        msg = 'Confirm add Data Jurnal Kas ?';
    else if (op == "2")
        msg = 'Confirm edit Data Jurnal Kas ?';
    else if (op == "3")
        msg = 'Confirm delete Data Jurnal Kas ?';
    else
    {
        msg = 'invalid op';
        return false;
    } 
	 
	if(confirm(msg)){
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
				<td width=50%> <!-- kiri-->
					<table width="100%"> 
						<tr class="font10black">
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">  Kode Jurnal</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtjurnal_code", $_SESSION["jurnal_code"], 20, 20, " readonly"); ?> </td>
						</tr >
						<tr class="font10black">
						  <td style="height: 23px"></td>
						  <td style="height: 23px">  Tgl Jurnal</td>
						  <td style="height: 23px">:</td>
						  <td style="height: 23px"> <?php  echo getDatePic($_SESSION["modeView"], "txtjurnal_date", $_SESSION["jurnal_date"], ""); ?> </td>
						</tr > 
						<tr class="font10black">
						  <td></td>
						  <td>  Tipe  Jurnal </td>
						  <td>:</td>
						  <td> 
						  <?php  echo getComboBox3($_SESSION["modeView"], "txttipe_jurnal", $_SESSION["tipe_jurnal"],  $rsTipeJurnalKas, ""); ?> 
						  </td>
						</tr > 
					</table>
				</td>
				
				<td > <!-- kanan-->
					<table width="100%">
						<tr class="font10black">
						  <td style="width: 3%"></td>
						  <td width="30%">Kas</td>
						  <td width="1%">:</td> 
						  <td> <?php  echo getComboBox4($_SESSION["modeView"], "txtperkiraan_header_code", $_SESSION["perkiraan_header_code"], $rsPerkiraanHeader , ""); ?> </td>
						  
						</tr >
						<tr class="font10black">
						  <td style="width: 3%; height: 23px;"></td>
						  <td style="height: 23px">  Status D/K</td>
						  <td style="height: 23px">:</td>
						  <td style="height: 23px"> <?php  //echo getTextBox($_SESSION["modeView"], "txtstatus_debet_kredit", $_SESSION["status_debet_kredit"], 20, 20, ""); ?> 
						   <?php  echo getComboBox($_SESSION["modeView"], "txtstatus_debet_kredit", $_SESSION["status_debet_kredit"],  $rsDebetKredit, ""); ?>  
						  </td>
						</tr >
						<tr class="font10black">
						  <td style="width: 3%; height: 23px;"></td>
						  <td style="height: 23px">  Divisi</td>
						  <td style="height: 23px">:</td>
						  <td style="height: 23px"> <?php  //echo getTextBox($_SESSION["modeView"], "txtstatus_debet_kredit", $_SESSION["status_debet_kredit"], 20, 20, ""); ?> 
						   <?php  
						   echo getComboBox(2, "txtkode_divisi", $_SESSION["kode_divisi"], $rsArtikel, ""); 
						  echo getHiddenBox(1, "txtkode_divisi", $_SESSION["kode_divisi"]); 
						  ?>
						  <td>
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
							<td align="right"><input class="button" type="button" name="btnLookUp" value="..." onClick="lookupWindow('perkiraan_lookup.php?elid1=txtDetailPerkiraanCode0&elid2=txtDetailPerkiraan0', 'perkiraanlist')" /></td>
							<td><?php echo getTextBox(1, "txtDetailPerkiraanCode0", "", 50, 15, $ajaxgetPerkiraan); echo getTextBox(1, "txtDetailPerkiraan0", "", 50, 35, " readonly"); ?></td> 
							<td><?php echo getTextBox(1, "txtDetailJumlah0", "", 50, 20, $clsformatInteger); ?></td> 
							<td><?php echo getDatePic(1, "txtDetailTglDok0", "", ""); ?></td>
							<td><?php echo getTextBox(1, "txtDetailNoDok0", "", 50, 20, ""); ?></td>
							<td><?php echo getTextBox(1, "txtDetailKetDok0", "", 50, 20, ""); ?></td> 
							<td><input class="button" type="button" name="btnAddItem" value="Add Item" onClick="AddItem();" /></td>    
						</tr>
					<?php 
					}
					?>
						<tr class="contentTitleTable" align="center"> 
							<td>No</td>
							<td>Perkiraan</td> 
							<td>Jumlah</td> 
							<td>Tgl Dok</td>
							<td>No Dok</td>
							<td>Ket Dok</td> 
							<td>&nbsp;</td> 
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
								echo getTextBox($_SESSION["modeView"], "txtDetailPerkiraanCode$i", $datadetail[0], 50, 15, " readonly"); 
								echo " - "; 
								echo getTextBox($_SESSION["modeView"], "txtDetailPerkiraan$i", $datadetail[1], 255, 35, " readonly");
								echo "</td>";
								
								echo "<td align='right'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailJumlah$i", setNumber($datadetail[2]), 20, 20, $clsformatInteger . " readonly");
								echo "</td>";
								
								echo "<td align='center'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailTglDok$i", $datadetail[4], 20, 10, " readonly");
								echo "</td>";
								
								echo "<td align='left'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailNoDok$i", $datadetail[3], 20, 20, " readonly");
								echo "</td>";
								
								echo "<td align='left'>";
								echo getTextBox($_SESSION["modeView"], "txtDetailKetDok$i", $datadetail[5], 20, 20, " readonly");
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
							<td colspan="2" align="right">Jumlah</td>  
							<td align="right">
							<?php  echo getTextBox($_SESSION["modeView"], "txtSubAmount", setNumber($_SESSION["jumlah"]), 20, 20, $clsformatInteger); ?> 
							<?php  echo getHiddenBox($_SESSION["modeView"], "txtJmlItem","<?php echo $jmlItem;?>"); ?>

							</td> 
							<td colspan="4" align="right">&nbsp;</td> 
						</tr>
						
					</table>
				</td> 
			</tr>
			
			<tr>
				<td width=50%> <!-- kiri-->
					<table width="100%">  
						<tr class="font10black"> 
						  <td width="3%" style="height: 23px"></td>
						  <td width="30%" style="height: 23px">Keterangan</td>
						  <td width="1%" style="height: 23px">:</td>
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtketerangan", $_SESSION["keterangan"], 50, 40, ""); ?> </td>
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
			
			<tr>
				<td colspan=2 align='center'> 
					 <?php 
				if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2" || $_SESSION["op"] == "3")
				{ 
				?>
				  <input class="button" type="button" name="btSubmit" value="<?php echo $_SESSION["btnLabel"] ?>" onClick="frmSubmit();" />&nbsp;&nbsp;&nbsp;
				  <input class="button" type="button" name="btCetak" value="Cetak" onClick="frmCetak()" />&nbsp;&nbsp;&nbsp; 
				<?php
				}
				?>
				  <input class='button' type='button' name='btBack' value='Back To List' onclick='window.history.back()' />
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
$_SESSION["jurnal_code"] = "";
$_SESSION["jurnal_date"] = "";
$_SESSION["perkiraan_header_id"] = "";
$_SESSION["perkiraan_header_code"] = "";
$_SESSION["status_debet_kredit"] = "";
$_SESSION["jumlah"] = "";
$_SESSION["jumlah_debet"] = "";
$_SESSION["jumlah_kredit"] = "";
$_SESSION["keterangan"] = "";
$_SESSION["kode_divisi"] = "";
$_SESSION["tipe_jurnal"] = "";
$_SESSION["kode_divisi"] = "";
}
?>

