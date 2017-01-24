<?php
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	$nSize = 8;
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	//$sql = "select * from tGroupUser order by GroupUserName";							
	//$rsGroupUser = $oDB->ExecuteReader($sql);
	
	if (isset($_POST["txtOp"]))
	{
		$_SESSION["op"] = $_POST["txtOp"];
        $_SESSION["ID"] = $_POST["txtID"];

        if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
        {            
		
			$_SESSION["kode_size"] = retrieveS($_POST["txtkode_size"]);
			for ($i=1; $i<=$nSize; $i++){
				$_SESSION["size$i"] = retrieveS($_POST["txtsize$i"]);
			} 
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
			
            $_SESSION["btnLabel"] = "Save Data";
            $_SESSION["lblTitle"] = "New Data Size";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT * FROM mst_size a WHERE a.kode_size ='" .$_SESSION["ID"] . "'";
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["kode_size"] = $data["kode_size"];
				$_SESSION["size1"] = $data["size1"];
				$_SESSION["size2"] = $data["size2"];
				$_SESSION["size3"] = $data["size3"];
				$_SESSION["size4"] = $data["size4"];
				$_SESSION["size5"] = $data["size5"];
				$_SESSION["size6"] = $data["size6"];
				$_SESSION["size7"] = $data["size7"];
				$_SESSION["size8"] = $data["size8"];
				$_SESSION["size9"] = $data["size9"];
				$_SESSION["size10"] = $data["size10"];
 			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data";
                $_SESSION["lblTitle"]  = "Edit Data Size";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data";
                    $_SESSION["lblTitle"]  = "Delete Data Size";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data Size";
			}
        }
        else    
            eror("invalid op");
    	
		FormLoad();
	}

function FormProcess()
{	
	global $nSize;
    if($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
    {
	   
		$array2d[] = array("kode_size", $_SESSION["kode_size"], 1);
		
		for($i=1; $i <= $nSize; $i++)
			$array2d[] = array("size$i", $_SESSION["size$i"], 1);
		
        
        if ($_SESSION["op"] == "1")
        {
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlInsert("mst_size", $array2d);
            $strTemp = "Data has been successfully inserted";
        }            
        else
        {          
            
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("mst_size", $array2d, "where kode_size='" .$_SESSION["ID"] . "'" );	
            $strTemp = "Data has been successfully updated";
        }
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from mst_size where kode_size='" . $_SESSION["ID"] . "'";
        $strTemp = "Data has been successfully deleted";
    }
    else
        eror("invalid op");

    global $oDB; 
	$oDB->ExecuteNonQuery($sqlCmd);	
	header('location:global_notification.php?from=size&strMsg=' . htmlspecialchars($strTemp));

}

function FormLoad() 
{	
	global $oDB; 
	global $nSize; 
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
        msg = 'Confirm add data?';
    else if (op == "2")
        msg = 'Confirm edit data';
    else if (op == "3")
        msg = 'Confirm delete data?';
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
          <td style="height: 23px"></td>
          <td style="height: 23px">  Kode Size</td>
          <td style="height: 23px">:</td>
          <td style="height: 23px"> <?php  echo getTextBox($_SESSION["modeView"], "txtkode_size", $_SESSION["kode_size"], 30, 30, ""); ?> </td>
	</tr >
	<tr class="font10black">
          <td></td>
          <td valign="top">  Size</td>
          <td valign="top">:</td>
          <td valign="top"> 
		  	<table width="70%" cellpadding="2" cellspacing="1" bgcolor="navy" >
            <tr bgcolor="#FFFFFF">
            <?php
            for ($i=1; $i<=$nSize; $i++){
				echo "<td>";
				echo "Size $i";
				echo "</td>";
			}
			?>
            </tr>
            <tr bgcolor="#FFFFFF">
            <?php
            for ($i=1; $i<=$nSize; $i++){
				echo "<td>";
				echo getTextBox($_SESSION["modeView"], "txtsize$i", $_SESSION["size$i"], 10, 5, "");
				echo "</td>";
			}
			?>
            </tr>
            </table>
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
	global $nSize;
//$_SESSION["op"] = ""
	$_SESSION["btnLabel"] = "";
	$_SESSION["lblTitle"] = "";
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	$_SESSION["id"] = "";
	$_SESSION["kode_size"] = "";

	for ($i=1; $i<=$nSize; $i++){
		$_SESSION["size$i"] = "";
	}
}
?>

