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
            $_SESSION["MenuParent"] = $_POST["txtMenuParent"];
            $_SESSION["MenuKode"] = $_POST["txtMenuKode"];
			$_SESSION["MenuName"] = $_POST["txtMenuName"];
			$_SESSION["MenuLink"] = $_POST["txtMenuLink"]; 
			FormProcess();
        }
        else
	       	FormProcess(); 
	}
	else
	{
		$_SESSION["op"] = $_GET["op"];
		
		if ($_SESSION["op"] == "1")
		{
            $_SESSION["modeView"] = "1"; 
			ClearSession();
			
            $_SESSION["btnLabel"] = "Save Data Menu";
            $_SESSION["lblTitle"] = "New Data Menu";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT MenuKode, MenuParent, MenuName, MenuLink FROM mst_menu a WHERE a.MenuKode ='" .$_SESSION["ID"] . "'";
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["MenuKode"] = $data[0]; 
				$_SESSION["MenuParent"] = $data[1];
$_SESSION["MenuName"] = $data[2];
$_SESSION["MenuLink"] = $data[3];
 
			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data Menu";
                $_SESSION["lblTitle"]  = "Edit Data Menu";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data Menu";
                    $_SESSION["lblTitle"]  = "Delete Data Menu";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data Menu";
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
	   
		$array2d[] = array("MenuKode", $_SESSION["MenuKode"], 1);
		$array2d[] = array("MenuParent", $_SESSION["MenuParent"], 1); 
$array2d[] = array("MenuName", $_SESSION["MenuName"], 1); 
$array2d[] = array("MenuLink", $_SESSION["MenuLink"], 1);

        
        if ($_SESSION["op"] == "1")
        {
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlInsert("mst_menu", $array2d);
            $strTemp = "Data has been successfully inserted";
        }            
        else
        {          
            
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("mst_menu", $array2d, "where MenuKode='" .$_SESSION["ID"] . "'" );	
            $strTemp = "Data has been successfully updated";
        }
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from mst_menu where MenuKode='" .$_SESSION["ID"] . "'";
        $strTemp = "Data has been successfully deleted";
    }
    else
        eror("invalid op");

    global $oDB; 
	$oDB->ExecuteNonQuery($sqlCmd);	
	header('location:global_notification.php?from=menu&strMsg=' . htmlspecialchars($strTemp));

}

function FormLoad()
{	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List Menu</title>
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
       if (document.input.txtMenuKode.value==""){
			alert("Silahkan isi/pilih kode");
			document.input.txtMenuKode.focus()
			return false;
		}
		
		if (document.input.txtMenuName.value==""){
			alert("Silahkan isi/pilih Name");
			document.input.txtMenuName.focus()
			return false;
		}

  
    }

    if (op == "1")
        msg = 'Confirm add data Menu ?';
    else if (op == "2")
        msg = 'Confirm edit data Menu ?';
    else if (op == "3")
        msg = 'Confirm delete data Menu ?';
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
          <td>  Kode</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtMenuKode", $_SESSION["MenuKode"], 20, 20, ""); ?> </td>
</tr >

	        
	        <tr class="font10black">
          <td></td>
          <td>  Parent</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtMenuParent", $_SESSION["MenuParent"], 20, 20, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  Name</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtMenuName", $_SESSION["MenuName"], 50, 100, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  Link</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtMenuLink", $_SESSION["MenuLink"], 50, 100, ""); ?> </td>
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
	$_SESSION["MenuKode"] = "";
$_SESSION["MenuParent"] = "";
$_SESSION["MenuName"] = "";
$_SESSION["MenuLink"] = "";

}
?>

