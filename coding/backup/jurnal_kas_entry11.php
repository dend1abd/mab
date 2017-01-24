<?php
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
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
            $_SESSION["jurnal_code"] = $_POST["txtjurnal_code"];
			$_SESSION["jurnal_date"] = $_POST["txtjurnal_date"];
			$_SESSION["perkiraan_header_code"] = $_POST["txtperkiraan_header_code"];
			$_SESSION["status_debet_kredit"] = $_POST["txtstatus_debet_kredit"];
			$_SESSION["jumlah"] = $_POST["txtSubAmount"]; 
			$_SESSION["keterangan"] = $_POST["txtketerangan"];
 
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
			
            $_SESSION["btnLabel"] = "Save Data Jurnal Kas";
            $_SESSION["lblTitle"] = "New Data Jurnal Kas";
            $_SESSION["jurnal_id"] = "0";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT jurnal_id, jurnal_code, jurnal_date, perkiraan_header_id, perkiraan_header_code, status_debet_kredit, jumlah, jumlah_debet, jumlah_kredit, keterangan FROM trx_jurnal a WHERE a.jurnal_id =" .$_SESSION["ID"];
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["jurnal_id"] = $data[0]; 
				$_SESSION["jurnal_code"] = $data[1];
				$_SESSION["jurnal_date"] = $data[2];
				$_SESSION["perkiraan_header_code"] = $data[4];
				$_SESSION["status_debet_kredit"] = $data[5];
				$_SESSION["jumlah"] = $data[6];
				$_SESSION["jumlah_debet"] = $data[7];
				$_SESSION["jumlah_kredit"] = $data[8];
				$_SESSION["keterangan"] = $data[9];
 
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
        
        if ($_SESSION["op"] == "1")
        {
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlInsert("trx_jurnal", $array2d);
            $strTemp = "Data has been successfully inserted"; 
        }            
        else
        {           
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("trx_jurnal", $array2d, "where jurnal_id=" .$_SESSION["ID"] );	
            $strTemp = "Data has been successfully updated";
        }
        $oDB->ExecuteNonQuery($sqlCmd);	
        
        if ($_SESSION["op"] == "1"){
        	$sqlCmd= "select max(jurnal_id) from trx_jurnal where jurnal_code='" .$_SESSION["jurnal_code"]. "'";
        	
        	$rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["ID"] = $data[0];
			}	
			
			//eror ($sqlCmd . $_SESSION["ID"]);        
		}
        
        $sqlCmd = "delete from trx_jurnal_detail where jurnal_id=" .$_SESSION["ID"];	
        $oDB->ExecuteNonQuery($sqlCmd);	
        
		$jmlItem = $_POST["txtJmlItem"];
		//eror($jmlItem);

		for($i=1; $i<=$jmlItem; $i++){
			unset($array2d);
			$array2d[] = array("jurnal_id", $_SESSION["ID"], 0); 
			$array2d[] = array("perkiraan_code", $_POST["txtDetailPerkiraanCode$i"], 1);
			$array2d[] = array("perkiraan_name", $_POST["txtDetailPerkiraan$i"], 1);
			$array2d[] = array("jumlah", $_POST["txtDetailJumlah$i"], 0);
			$array2d[] = array("ket_dok", $_POST["txtDetailKetDok$i"], 1);
			$array2d[] = array("tgl_dok",$_POST["txtDetailTglDok$i"], 1);
			$array2d[] = array("no_dok", $_POST["txtDetailNoDok$i"], 1); 
			
			$sqlCmd = sqlInsert("trx_jurnal_detail", $array2d); 
			//echo $sqlCmd . "<br />";
			$oDB->ExecuteNonQuery($sqlCmd);	

		}
		//eror($jmlItem . "stop");

    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from trx_jurnal where jurnal_id=" . $_SESSION["ID"];
        $strTemp = "Data has been successfully deleted";
        
        $oDB->ExecuteNonQuery($sqlCmd);	
    }
    else
        eror("invalid op"); 
	
	header('location:global_notification.php?strMsg=' . htmlspecialchars($strTemp));

}

function FormLoad()
{	
	
	global $oDB;  
	global $clsformatInteger;
	$sqlCmd = "SELECT perkiraan_code, perkiraan_name, jumlah, no_dok, tgl_dok, ket_dok FROM trx_jurnal_detail a WHERE a.jurnal_id =" .$_SESSION["jurnal_id"];
	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows;
	
	$sqlCmd = "SELECT id, ket FROM mst_debet_kredit"; 
    $rsDebetKredit = $oDB->ExecuteReader($sqlCmd); 
    
    $sqlCmd = "SELECT perkiraan_code, perkiraan_name FROM mst_perkiraan"; 
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

var jmlItem = <?php echo $jmlItem ?>;
function AddItem(){
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
    cell1.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailPerkiraanCode' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 20, 20, ""); $name="\" + 'txtDetailPerkiraan' +i + \""; echo getTextBox("1", $name, "\" +nilai2+ \"", 20, 20, "");?></div>"
	//alert(document.getElementById("txtFieldName" + jmlItem ).value);
	
	nilai = document.getElementById("txtDetailJumlah0").value;
	var cell2 = row.insertCell(2);
    cell2.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailJumlah' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 20, 20, $clsformatInteger ); ?></div>"
    
    nilai = document.getElementById("txtDetailTglDok0").value;
    var cell3 = row.insertCell(3);
    cell3.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailTglDok' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 20, 20, ""); ?></div>" 
    
    nilai = document.getElementById("txtDetailNoDok0").value;
	var cell4 = row.insertCell(4);
    cell4.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailNoDok' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 20, 20, ""); ?></div>"
    
    nilai = document.getElementById("txtDetailKetDok0").value;
    var cell5 = row.insertCell(5);
    cell5.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailKetDok' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 20, 20, ""); ?></div>"  
    
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

function frmSubmit(){ 
    op = document.input.txtOp.value;

    if (op == "1" || op == "2")
    { 
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

<table width="100%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
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
						  <td style="height: 23px" > <?php  echo getTextBox($_SESSION["modeView"], "txtjurnal_code", $_SESSION["jurnal_code"], 20, 20, ""); ?> </td>
						</tr >
						<tr class="font10black">
						  <td></td>
						  <td>  Tgl Jurnal</td>
						  <td>:</td>
						  <td> <?php  echo getDatePic($_SESSION["modeView"], "txtjurnal_date", $_SESSION["jurnal_date"], ""); ?> </td>
						</tr > 
					</table>
				</td>
				
				<td > <!-- kanan-->
					<table width="100%">
						<tr class="font10black">
						  <td style="width: 3%"></td>
						  <td width="30%">Kode Perkiraan Header</td>
						  <td width="1%">:</td> 
						  <td> <?php  echo getComboBox($_SESSION["modeView"], "txtperkiraan_header_code", $_SESSION["perkiraan_header_code"], $rsPerkiraanHeader , ""); ?> </td>
						  
						</tr >
						<tr class="font10black">
						  <td style="width: 3%"></td>
						  <td>  Status D/K</td>
						  <td>:</td>
						  <td> <?php  //echo getTextBox($_SESSION["modeView"], "txtstatus_debet_kredit", $_SESSION["status_debet_kredit"], 20, 20, ""); ?> 
						   <?php  echo getComboBox($_SESSION["modeView"], "txtstatus_debet_kredit", $_SESSION["status_debet_kredit"],  $rsDebetKredit, ""); ?> 

						  
						  </td>
						</tr >

					</table>
				</td> 
			</tr>
			
			<!-- detail-->
			
			<tr height="200">
				<td colspan=2 valign="top">  
					<table width="100%"  cellspacing="1" bgcolor="silver" id="tblJurnalDetail" >  
						<tr bgcolor="white"  align='center'>
							<td align="right"><input class="button" type="button" name="btnLookUp" value="..." onClick="lookupWindow('perkiraan_lookup.php?elid1=txtDetailPerkiraanCode0&elid2=txtDetailPerkiraan0', 'perkiraanlist')" /></td>
							<td><?php echo getTextBox(1, "txtDetailPerkiraanCode0", "", 50, 15, ""); echo getTextBox(1, "txtDetailPerkiraan0", "", 50, 30, ""); ?></td> 
							<td><?php echo getTextBox(1, "txtDetailJumlah0", "", 20, 20, $clsformatInteger); ?></td> 
							<td><?php echo getDatePic(1, "txtDetailTglDok0", "", ""); ?></td>
							<td><?php echo getTextBox(1, "txtDetailNoDok0", "", 50, 20, ""); ?></td>
							<td><?php echo getTextBox(1, "txtDetailKetDok0", "", 50, 20, ""); ?></td> 
							<td><input class="button" type="button" name="btnAddItem" value="Add Item" onClick="AddItem();" /></td>    
						</tr>
						
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
								
								echo "<td align='center'>";
								echo getTextBox(1, "txtDetailPerkiraanCode$i", $datadetail[0], 20, 20, " readonly"); echo getTextBox(1, "txtDetailPerkiraan$i", $datadetail[1], 20, 20, " readonly");
								echo "</td>";
								
								echo "<td align='center'>";
								echo getTextBox(1, "txtDetailJumlah$i", $datadetail[2], 20, 20, $clsformatInteger . " readonly");
								echo "</td>";
								
								echo "<td align='center'>";
								echo getTextBox(1, "txtDetailTglDok$i", $datadetail[4], 20, 10, " readonly");
								echo "</td>";
								
								echo "<td align='center'>";
								echo getTextBox(1, "txtDetailNoDok$i", $datadetail[3], 20, 20, " readonly");
								echo "</td>";
								
								echo "<td align='center'>";
								echo getTextBox(1, "txtDetailKetDok$i", $datadetail[5], 20, 20, " readonly");
								echo "</td>";
								
								echo "<td align='center'>";
								echo "<img src='images/up.gif' onClick='moveUp($i);'>";
							    echo "<img src='images/down.gif' onClick='moveDown($i);'>";
							    echo "<img src='images/delmini.gif' onClick='delRow($i);'>";  
								echo "</td>";

			
								
								
								echo "</tr>";
							}
						?>
						
						<tr bgcolor="white">
							<td colspan="2" align="right">Jumlah</td>  
							<td align="center">
							<?php  echo getTextBox($_SESSION["modeView"], "txtSubAmount", $_SESSION["jumlah"], 20, 20, $clsformatInteger); ?> 
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
				  <input class="button" type="button" name="cmdSubmit" value="<?php echo $_SESSION["btnLabel"] ?>" onClick="frmSubmit();" />&nbsp;&nbsp;&nbsp;
				<?php
				}
				?>
				  <input class='button' type='button' name='cmdBack' value='Back To List' onclick='window.history.back()' />
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
	$_SESSION["jurnal_id"] = "";
$_SESSION["jurnal_code"] = "";
$_SESSION["jurnal_date"] = "";
$_SESSION["perkiraan_header_id"] = "";
$_SESSION["perkiraan_header_code"] = "";
$_SESSION["status_debet_kredit"] = "";
$_SESSION["jumlah"] = "";
$_SESSION["jumlah_debet"] = "";
$_SESSION["jumlah_kredit"] = "";
$_SESSION["keterangan"] = "";

}
?>

