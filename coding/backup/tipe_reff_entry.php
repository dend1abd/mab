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
        	$_SESSION["tipe_reff"] = $_POST["txttipe_reff"]; 
            $_SESSION["tipe_reff_desc"] = $_POST["txttipe_reff_desc"];
 
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
			
            $_SESSION["btnLabel"] = "Save Data tipe_reff";
            $_SESSION["lblTitle"] = "New Data tipe_reff";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT tipe_reff, tipe_reff_desc FROM mst_tipe_reff a WHERE a.tipe_reff =" .$_SESSION["ID"];
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["tipe_reff"] = $data[0];
				$_SESSION["tipe_reff_desc"] = $data[1];

 
			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data tipe_reff";
                $_SESSION["lblTitle"]  = "Edit Data tipe_reff";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data tipe_reff";
                    $_SESSION["lblTitle"]  = "Delete Data tipe_reff";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data tipe_reff";
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
	   
		$array2d[] = array("tipe_reff", $_SESSION["tipe_reff"], 0);
		$array2d[] = array("tipe_reff_desc", $_SESSION["tipe_reff_desc"], 1);


        
        if ($_SESSION["op"] == "1")
        {
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlInsert("mst_tipe_reff", $array2d);
            $strTemp = "Data has been successfully inserted";
        }            
        else
        {          
            
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("mst_tipe_reff", $array2d, "where tipe_reff=" .$_SESSION["ID"] );	
            $strTemp = "Data has been successfully updated";
        }
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from mst_tipe_reff where tipe_reff=" . $_SESSION["ID"];
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
<title>List tipe_reff</title>
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
        msg = 'Confirm add data tipe_reff ?';
    else if (op == "2")
        msg = 'Confirm edit data tipe_reff ?';
    else if (op == "3")
        msg = 'Confirm delete data tipe_reff ?';
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
          <td>  tipe_reff</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txttipe_reff", $_SESSION["tipe_reff"], 10, 10, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  tipe_reff_desc</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txttipe_reff_desc", $_SESSION["tipe_reff_desc"], 30, 30, ""); ?> </td>
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
	$_SESSION["tipe_reff"] = "";
$_SESSION["tipe_reff_desc"] = "";

}
?>

