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
            $_SESSION["contact_code"] = $_POST["txtcontact_code"];
			$_SESSION["contact_name"] = $_POST["txtcontact_name"];
 			$_SESSION["contact_tipe"] = $_POST["txtcontact_tipe"]; 
 			$_SESSION["contact_init"] = $_POST["txtcontact_init"]; 
 			
 			$_SESSION["alamat"] = $_POST["txtalamat"];
			$_SESSION["alamat2"] = $_POST["txtalamat2"];
			$_SESSION["kota"] = $_POST["txtkota"];
			$_SESSION["kodepos"] = $_POST["txtkodepos"];
			$_SESSION["negara"] = $_POST["txtnegara"];
			$_SESSION["telp"] = $_POST["txttelp"];
			$_SESSION["fax"] = $_POST["txtfax"];
			$_SESSION["email"] = $_POST["txtemail"];
			$_SESSION["website"] = $_POST["txtwebsite"];
			$_SESSION["npwp"] = $_POST["txtnpwp"];

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
			
            $_SESSION["btnLabel"] = "Save Data contact";
            $_SESSION["lblTitle"] = "New Data contact";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT contact_code, contact_tipe, contact_init, contact_name, alamat, alamat2, kota, kodepos, negara, telp, fax, email, website, npwp FROM mst_contact a WHERE a.contact_code ='" .$_SESSION["ID"] . "'";
	        //eror($sqlCmd );
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["contact_code"] = $data[0];
				$_SESSION["contact_tipe"] = $data["contact_tipe"];
				$_SESSION["contact_init"] = $data["contact_init"];
				$_SESSION["contact_name"] = $data["contact_name"];
				$_SESSION["alamat"] = $data["alamat"];
				$_SESSION["alamat2"] = $data["alamat2"];
				$_SESSION["kota"] = $data["kota"];
				$_SESSION["kodepos"] = $data["kodepos"];
				$_SESSION["negara"] = $data["negara"];
				$_SESSION["telp"] = $data["telp"];
				$_SESSION["fax"] = $data["fax"];
				$_SESSION["email"] = $data["email"];
				$_SESSION["website"] = $data["website"];
				$_SESSION["npwp"] = $data["npwp"];

			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data contact";
                $_SESSION["lblTitle"]  = "Edit Data contact";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data contact";
                    $_SESSION["lblTitle"]  = "Delete Data contact";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data contact";
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
	   
		$array2d[] = array("contact_code", $_SESSION["contact_code"], 1);
		$array2d[] = array("contact_name", $_SESSION["contact_name"], 1);
		$array2d[] = array("contact_tipe", $_SESSION["contact_tipe"], 0); 
		$array2d[] = array("contact_init", $_SESSION["contact_init"], 1);
		$array2d[] = array("alamat", $_SESSION["alamat"], 1);
		$array2d[] = array("alamat2", $_SESSION["alamat2"], 1);
		$array2d[] = array("kota", $_SESSION["kota"], 1);
		$array2d[] = array("kodepos", $_SESSION["kodepos"], 1);
		$array2d[] = array("negara", $_SESSION["negara"], 1);
		$array2d[] = array("telp", $_SESSION["telp"], 1);
		$array2d[] = array("fax", $_SESSION["fax"], 1);
		$array2d[] = array("email", $_SESSION["email"], 1);
		$array2d[] = array("website", $_SESSION["website"], 1);
		$array2d[] = array("npwp", $_SESSION["npwp"], 1);

        
        if ($_SESSION["op"] == "1")
        {
        	$_SESSION["ID"] = $_SESSION["contact_code"];
        	
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlInsert("mst_contact", $array2d);
            $strTemp = "Data has been successfully inserted";
        }            
        else
        {          
            
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("mst_contact", $array2d, "where contact_code='" .$_SESSION["ID"]. "'" );	
            $strTemp = "Data has been successfully updated";
        }
        
        $oDB->ExecuteNonQuery($sqlCmd);
        
        $sqlCmd = "delete from mst_contact_person where contact_code='" .$_SESSION["contact_code"]. "'";	
        $oDB->ExecuteNonQuery($sqlCmd);
        
        $jmlItem = $_POST["txtJmlItem"];
		//eror($jmlItem);

		for($i=1; $i<=$jmlItem; $i++){
			unset($array2d);
			$array2d[] = array("contact_code", $_SESSION["contact_code"], 1); 
			$array2d[] = array("nama", $_POST["txtDetailnama$i"], 1);
			$array2d[] = array("jabatan", $_POST["txtDetailjabatan$i"], 1);
			$array2d[] = array("telp", $_POST["txtDetailtelp$i"], 1);
			$array2d[] = array("email", $_POST["txtDetailemail$i"], 1);
			
			$sqlCmd = sqlInsert("mst_contact_person", $array2d); 
			//echo $sqlCmd . "<br />";
			$oDB->ExecuteNonQuery($sqlCmd);
		}
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from mst_contact where contact_code='" .$_SESSION["ID"]. "'";
        $strTemp = "Data has been successfully deleted"; 
        $oDB->ExecuteNonQuery($sqlCmd);
    }
    else
        eror("invalid op"); 
		
	header('location:global_notification.php?from=contact&strMsg=' . htmlspecialchars($strTemp)); 
}

function FormLoad()
{	
	global $oDB;
	
	$sqlCmd = "SELECT KodeReff, Reff FROM mst_reff where tipeReff =2";  
    $rsContactType= $oDB->ExecuteReader($sqlCmd);
    
    //$jmlItem = 0;
    
    $sqlCmd = "SELECT Reff , Reff FROM mst_reff where tipeReff =11"; 
    $rsKota = $oDB->ExecuteReader($sqlCmd);
    
    $sqlCmd = "SELECT Reff , Reff FROM mst_reff where tipeReff =12"; 
    $rsNegara = $oDB->ExecuteReader($sqlCmd);
    
    $sqlCmd = "SELECT nama, jabatan, telp, email from mst_contact_person a WHERE a.contact_code ='" .$_SESSION["ID"] . "'";
	//eror($sqlCmd); 
    $rsdetail = $oDB->ExecuteReader($sqlCmd);
	$numRows = mysql_num_rows($rsdetail);	 
	$jmlItem = $numRows;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List contact</title>
</head>

<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!-- 

var jmlItem = <?php echo $jmlItem ?>;
function AddItem(){

	if (document.getElementById("txtDetailnama0").value == ""){
		alert("Sialhkan input nama kontak person");
		document.getElementById("txtDetailnama0").focus();
		return;
	}
		
    jmlItem = jmlItem + 1;
	i = jmlItem ; 
	
    var table = document.getElementById("tblContactPerson");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount); 	
    row.bgColor = "white"   
    
    el = "";
    el = el + "<img src='images/up.gif' onClick='moveUp(" +jmlItem+ ");'>";
    el = el + "<img src='images/down.gif' onClick='moveDown(" +jmlItem+ ");'>";
    el = el + "<img src='images/delmini.gif' onClick='delRow(" +jmlItem+ ");'>"; 
	
	
    var cell0 = row.insertCell(0); 
    cell0.innerHTML = "<div class='font10black' align='center'>" +(jmlItem)+ "</div >" 
    
    nilai = document.getElementById("txtDetailnama0").value; 
    var cell1 = row.insertCell(1);
    cell1.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailnama' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 30, " readonly"); ?></div>";
	
	nilai = document.getElementById("txtDetailjabatan0").value;
	var cell2 = row.insertCell(2);
    cell2.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailjabatan' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 30, " readonly" ); ?></div>"
    
    nilai = document.getElementById("txtDetailtelp0").value;
    var cell3 = row.insertCell(3);
    cell3.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailtelp' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 30, " readonly"); ?></div>" 
    
    nilai = document.getElementById("txtDetailemail0").value;
	var cell4 = row.insertCell(4);
    cell4.innerHTML = "<div class='font10black' align='center'><?php $name="\" + 'txtDetailemail' +i + \""; echo getTextBox("1", $name, "\" +nilai+ \"", 50, 30, " readonly"); ?></div>"
 
    
    var cell5 = row.insertCell(5); 
    cell5.innerHTML = "<div class='font10black' align='center'>" + el + "</div>"
    
    document.getElementById("txtDetailnama0").value = "";
    document.getElementById("txtDetailjabatan0").value = "";
    document.getElementById("txtDetailtelp0").value = "";
    document.getElementById("txtDetailemail0").value = "";    
    document.getElementById("txtDetailnama0").focus();
}    
 

function removeItem()
{
	//alert(jmlItem);
    if(jmlItem != 0)
    {
        var table = document.getElementById('tblContactPerson');
        var rowCount = table.rows.length;
        table.deleteRow(rowCount-1)	
		
        jmlItem = jmlItem-1; 
    }
}

function moveUp(index){
    if (index > 1){
    	tempDetailnama = document.getElementById('txtDetailnama' + (index-1)).value;
        document.getElementById('txtDetailnama' + (index-1)).value =  document.getElementById('txtDetailnama' + index).value;
        document.getElementById('txtDetailnama' + index).value =  tempDetailnama ; 

        tempDetailjabatan = document.getElementById('txtDetailjabatan' + (index-1)).value;
        document.getElementById('txtDetailjabatan' + (index-1)).value =  document.getElementById('txtDetailjabatan' + index).value;
        document.getElementById('txtDetailjabatan' + index).value =  tempDetailjabatan;

        tempDetailtelp = document.getElementById('txtDetailtelp' + (index-1)).value;
        document.getElementById('txtDetailtelp' + (index-1)).value =  document.getElementById('txtDetailtelp' + index).value;
        document.getElementById('txtDetailtelp' + index).value =  tempDetailtelp;

        tempDetailemail = document.getElementById('txtDetailemail' + (index-1)).value;
        document.getElementById('txtDetailemail' + (index-1)).value =  document.getElementById('txtDetailemail' + index).value;
        document.getElementById('txtDetailemail' + index).value =  tempDetailemail;
    }
}

function moveDown(index){
    if (index < jmlItem){
    	tempDetailnama = document.getElementById('txtDetailnama' + (index+1)).value;
        document.getElementById('txtDetailnama' + (index+1)).value =  document.getElementById('txtDetailnama' + index).value;
        document.getElementById('txtDetailnama' + index).value =  tempDetailnama ; 

        tempDetailjabatan = document.getElementById('txtDetailjabatan' + (index+1)).value;
        document.getElementById('txtDetailjabatan' + (index+1)).value =  document.getElementById('txtDetailjabatan' + index).value;
        document.getElementById('txtDetailjabatan' + index).value =  tempDetailjabatan;

        tempDetailtelp = document.getElementById('txtDetailtelp' + (index+1)).value;
        document.getElementById('txtDetailtelp' + (index+1)).value =  document.getElementById('txtDetailtelp' + index).value;
        document.getElementById('txtDetailtelp' + index).value =  tempDetailtelp;

        tempDetailemail = document.getElementById('txtDetailemail' + (index+1)).value;
        document.getElementById('txtDetailemail' + (index+1)).value =  document.getElementById('txtDetailemail' + index).value;
        document.getElementById('txtDetailemail' + index).value =  tempDetailemail;
    } 
}

function delRow(index){
//alert(jmlItem);

    var i = 0;
    if (index <= jmlItem){
        for(i=index;i<jmlItem;i++)
        {
        	document.getElementById('txtDetailnama' + (i)).value =  document.getElementById('txtDetailnama' + (i+1)).value; 
            document.getElementById('txtDetailjabatan' + (i)).value =  document.getElementById('txtDetailjabatan' + (i+1)).value;
            document.getElementById('txtDetailtelp' + (i)).value =  document.getElementById('txtDetailtelp' + (i+1)).value;
            document.getElementById('txtDetailemail' + (i)).value =  document.getElementById('txtDetailemail' + (i+1)).value;
        }
        removeItem();
    }
} 

function errMsg() {
	<?php 
	if( $_SESSION["errAlert"] ==true){	
		echo "alert('" . $_SESSION["errAlert"] . "')";
	}
	?>
}

function cmdDate_onclick(txtDate){
		var nowDate = new Date;
		initCalendar (nowDate, txtDate, '8pt');
	}

function frmSubmit(){ 
    op = document.input.txtOp.value;

    if (op == "1" || op == "2")
    { 
    	if(document.input.txtcontact_tipe.value == "")
    	{
    		alert("tipe kontak masih kosong");
    		document.input.txtcontact_tipe.focus();	
    		return false; 
    	}
    	
    	if(document.input.txtcontact_code.value == "")
    	{
    		alert("kode kontak masih kosong");	
    		document.input.txtcontact_code.focus();
    		return false; 
    	}
    	
    	if(document.input.txtcontact_name.value == "")
    	{
    		alert("nama kontak masih kosong");
    		document.input.txtcontact_name.focus();
	
    		return false; 
    	}

    	
    	document.input.txtJmlItem.value = jmlItem;     
    }

    if (op == "1")
        msg = 'Confirm add data contact ?';
    else if (op == "2")
        msg = 'Confirm edit data contact ?';
    else if (op == "3")
        msg = 'Confirm delete data contact ?';
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

<BODY  onLoad="errMsg()">
<form name="input" method="post" >
<input type ="hidden" name="txtOp" value="<?php echo $_SESSION["op"]; ?>" />
<input type ="hidden" name="txtID" value="<?php echo $_SESSION["ID"]; ?>" /> 

<table width="75%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
	<tr bgcolor="white" >
	<td class="contentTitleTable" align="center">
	<?php echo $_SESSION["lblTitle"] ?>	</td>
	</tr>
	<tr bgcolor="white">
	<td height="250" valign="top" align="left">
		
		<table width="100%">
		
			<tr class="font10black"> 
	          <td width="5%">&nbsp;</td>
	          <td width="25%">&nbsp;</td>
	          <td width="1%">&nbsp;</td>
	          <td >&nbsp;</td>
	        </tr>
	        
	        <tr class="font10black">
          <td></td>
          <td>  Tipe</td>
          <td>:</td>
          <td>
          <?php  echo getComboBox($_SESSION["modeView"], "txtcontact_tipe", $_SESSION["contact_tipe"], $rsContactType, ""); ?>  
          </td>
</tr >


	        <tr class="font10black">
          <td></td>
          <td>  Kode</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtcontact_code", $_SESSION["contact_code"], 20, 20, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  Nama</td>
          <td>:</td>
          <td> 
          <?php  echo getTextBox($_SESSION["modeView"], "txtcontact_init", $_SESSION["contact_init"], 10, 5, ""); ?>
          &nbsp;
          <?php  echo getTextBox($_SESSION["modeView"], "txtcontact_name", $_SESSION["contact_name"], 50, 50, ""); ?> </td>
</tr >


<tr class="font10black"> 
<td></td>
          <td valign="top">  Alamat</td>
          <td valign="top">:</td>
          <td>
		  	<?php  echo getTextBox($_SESSION["modeView"], "txtalamat", $_SESSION["alamat"], 50, 50, ""); ?>
		  	<br />
		  	<?php  echo getTextBox($_SESSION["modeView"], "txtalamat2", $_SESSION["alamat2"], 50, 50, ""); ?>
		  </td>
</tr >

<tr class="font10black">
          <td style="height: 23px"></td>
          <td style="height: 23px">  Kota</td>
          <td style="height: 23px">:</td>
          <td style="height: 23px"> <?php  echo getComboBox($_SESSION["modeView"], "txtkota", $_SESSION["kota"],  $rsKota, ""); ?></td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  Kode Pos</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtkodepos", $_SESSION["kodepos"], 10, 10, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  Negara</td>
          <td>:</td>
          <td> <?php  echo getComboBox($_SESSION["modeView"], "txtnegara", $_SESSION["negara"],  $rsNegara, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  Telp</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txttelp", $_SESSION["telp"], 50, 30, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  Fax</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtfax", $_SESSION["fax"], 50, 30, ""); ?> </td>
</tr >
<tr class="font10black">
          <td style="height: 23px"></td>
          <td style="height: 23px">  Email</td>
          <td style="height: 23px">:</td>
          <td style="height: 23px"> <?php  echo getTextBox($_SESSION["modeView"], "txtemail", $_SESSION["email"], 50, 30, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  Website</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtwebsite", $_SESSION["website"], 50, 30, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  NPWP</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtnpwp", $_SESSION["npwp"], 50, 30, ""); ?> </td>
</tr >

<tr class="font10black"> 
<td></td>
          <td colspan="3">  <b>Contact Person</b></td> 
</tr >

<tr class="font10black"> 
<td></td>
          <td colspan="3">
            
          	<table width="100%"  cellspacing="1" bgcolor="silver" id="tblContactPerson" > 				
				<?php
				if($_SESSION["modeView"] == "1"){  
				?>
				<tr bgcolor="white"  align='center'>
					<td align="right">
					&nbsp;
					</td>
					<td><?php echo getTextBox(1, "txtDetailnama0", "", 50, 30, ""); ?></td>
					<td><?php echo getTextBox(1, "txtDetailjabatan0", "", 50, 30, ""); ?></td>
					<td><?php echo getTextBox(1, "txtDetailtelp0", "", 50, 30, ""); ?></td>
					<td><?php echo getTextBox(1, "txtDetailemail0", "", 50, 30, ""); ?></td>
					
					<td nowrap>
						<input class="button" type="button" name="btnAddItem" value="Add Item" onClick="AddItem();" />
					</td>
				</tr>
				<?php 
				}
				?>
				<tr class="contentTitleTable" align="center">
					<td>No</td> 
					<td>Nama</td><td>Jabatan</td><td>Telp / HP</td><td>Email</td><td></td> 
				</tr>
				
				<?php
					$i = 0;
					while ($datadetail = mysql_fetch_array($rsdetail)) 
					{
						$i++;
						echo "<tr bgcolor='#ffffff' class='font10black'>";
						
						echo "<td align='center'>$i";
						echo "</td>"; 
						
						echo "<td>";
						echo getTextBox($_SESSION["modeView"], "txtDetailnama$i", $datadetail["nama"], 50, 30, " readonly");
						echo "</td>";
						
						echo "<td>";
						echo getTextBox($_SESSION["modeView"], "txtDetailjabatan$i", $datadetail["jabatan"], 50, 30, " readonly");
						echo "</td>";
						
						echo "<td>";
						echo getTextBox($_SESSION["modeView"], "txtDetailtelp$i", $datadetail["telp"], 50, 30, " readonly");
						echo "</td>";
						
						echo "<td>";
						echo getTextBox($_SESSION["modeView"], "txtDetailemail$i", $datadetail["email"], 50, 30, " readonly");
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

					
			</table>
			<?php  echo getHiddenBox($_SESSION["modeView"], "txtJmlItem","<?php echo $jmlItem;?>"); ?>
          </td> 
</tr >

<tr class="font10black">
          		<td colspan=4 height="10"></td>
</tr>
			
			<tr class="font10black">
          		<td colspan=4 align="center">

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
<tr class="font10black">
          		<td colspan=4 height="10"></td>
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
 	$_SESSION["contact_code"] = "";
	$_SESSION["contact_name"] = "";
	$_SESSION["contact_tipe"] = "";
	$_SESSION["contact_init"] = ""; 
	$_SESSION["alamat"] = "";
$_SESSION["alamat2"] = "";
$_SESSION["kota"] = "";
$_SESSION["kodepos"] = "";
$_SESSION["negara"] = "";
$_SESSION["telp"] = "";
$_SESSION["fax"] = "";
$_SESSION["email"] = "";
$_SESSION["website"] = "";
$_SESSION["npwp"] = "";

}
?>

