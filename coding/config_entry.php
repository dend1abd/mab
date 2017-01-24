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
            $_SESSION["kode"] = $_POST["txtkode"];
$_SESSION["ket"] = $_POST["txtket"];
$_SESSION["int_value"] = $_POST["txtint_value"];
$_SESSION["des_value"] = $_POST["txtdes_value"];
$_SESSION["string_value"] = $_POST["txtstring_value"];
$_SESSION["date1_value"] = $_POST["txtdate1_value"];
$_SESSION["date2_value"] = $_POST["txtdate2_value"];
 
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
			
            $_SESSION["btnLabel"] = "Save Data config";
            $_SESSION["lblTitle"] = "New Data config";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT id, kode, ket, int_value, des_value, string_value, date1_value, date2_value FROM mst_config a WHERE a.id =" .$_SESSION["ID"];
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["kode"] = $data[1];
$_SESSION["ket"] = $data[2];
$_SESSION["int_value"] = $data[3];
$_SESSION["des_value"] = $data[4];
$_SESSION["string_value"] = $data[5];
$_SESSION["date1_value"] = $data[6];
$_SESSION["date2_value"] = $data[7];
 
			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data config";
                $_SESSION["lblTitle"]  = "Edit Data config";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data config";
                    $_SESSION["lblTitle"]  = "Delete Data config";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data config";
			}
        }
        else    
            eror("invalid op");
    	
		FormLoad();
	}

function FormProcess()
{	
    if($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
    {
	   
		$array2d[] = array("kode", $_SESSION["kode"], 1);
$array2d[] = array("ket", $_SESSION["ket"], 1);
$array2d[] = array("int_value", $_SESSION["int_value"], 0);
$array2d[] = array("des_value", $_SESSION["des_value"], 0);
$array2d[] = array("string_value", $_SESSION["string_value"], 1);
$array2d[] = array("date1_value", $_SESSION["date1_value"], 1);
$array2d[] = array("date2_value", $_SESSION["date2_value"], 1);

        
        if ($_SESSION["op"] == "1")
        {
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlInsert("mst_config", $array2d);
            $strTemp = "Data has been successfully inserted";
        }            
        else
        {          
            
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("mst_config", $array2d, "where id=" .$_SESSION["ID"] );	
            $strTemp = "Data has been successfully updated";
        }
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from mst_config where id=" . $_SESSION["ID"];
        $strTemp = "Data has been successfully deleted";
    }
    else
        eror("invalid op");

    global $oDB; 
	$oDB->ExecuteNonQuery($sqlCmd);	
	header('location:global_notification.php?strMsg=' . htmlspecialchars($strTemp));

}

function FormLoad()
{	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List config</title>
</head>

<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!-- 

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
         
    }

    if (op == "1")
        msg = 'Confirm add data config ?';
    else if (op == "2")
        msg = 'Confirm edit data config ?';
    else if (op == "3")
        msg = 'Confirm delete data config ?';
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

<table width="70%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
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
          <td>  kode</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtkode", $_SESSION["kode"], 20, 20, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  ket</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtket", $_SESSION["ket"], 30, 30, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  integer value</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtint_value", $_SESSION["int_value"], 20, 20, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  desimal value</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtdes_value", $_SESSION["des_value"], 20, 20, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  string value</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtstring_value", $_SESSION["string_value"], 20, 20, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  date1 value</td>
          <td>:</td>
          <td> <?php  echo getDatePic($_SESSION["modeView"], "txtdate1_value", $_SESSION["date1_value"], ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  date2 value</td>
          <td>:</td>
          <td> <?php  echo getDatePic($_SESSION["modeView"], "txtdate2_value", $_SESSION["date2_value"], ""); ?> </td>
</tr >
 
			
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
	$_SESSION["id"] = "";
$_SESSION["kode"] = "";
$_SESSION["ket"] = "";
$_SESSION["int_value"] = "";
$_SESSION["des_value"] = "";
$_SESSION["string_value"] = "";
$_SESSION["date1_value"] = "";
$_SESSION["date2_value"] = "";

}
?>

