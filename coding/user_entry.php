<?php
	include "include/clsDataAccess.php";
	include "include/clsBisnisProses.php";
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
            $_SESSION["user_id_x"] = $_POST["txtuser_id"];
			$_SESSION["user_nama"] = $_POST["txtuser_nama"];
			$_SESSION["group_user_id"] = $_POST["txtgroup_user_id"];
			$_SESSION["level_user_id"] = $_POST["txtlevel_user_id"];
			$_SESSION["status_aktif"] = $_POST["txtstatus_aktif"];
			
			if ($_SESSION["op"] == "1"){			
				if (cekAdaData("mst_user", "user_id='" .$_SESSION["user_id_x"]. "'")){
					$_SESSION["errAlert"] = true;
					$_SESSION["errMsg"] = "error create user, user id " .$_SESSION["user_id_x"]. " sudah ada";
				}
			}
        }
        
        if ($_SESSION["errAlert"] == true)
        	FormLoad();
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
			
            $_SESSION["btnLabel"] = "Save Data";
            $_SESSION["lblTitle"] = "New Data User";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT * FROM mst_user a WHERE a.user_id ='" .$_SESSION["ID"] . "'";
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				
				$_SESSION["user_id_x"] = $data["user_id"];
				$_SESSION["user_nama"] = $data["user_nama"];
				$_SESSION["group_user_id"] = $data["group_user_id"];
				$_SESSION["level_user_id"] = $data["level_user_id"];
				$_SESSION["status_aktif"] = $data["status_aktif"];
 
			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data";
                $_SESSION["lblTitle"]  = "Edit Data User";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data";
                    $_SESSION["lblTitle"]  = "Delete Data User";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data";
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
		$array2d[] = array("user_nama", $_SESSION["user_nama"], 1);
		$array2d[] = array("group_user_id", $_SESSION["group_user_id"], 0);
		$array2d[] = array("level_user_id", $_SESSION["level_user_id"], 0);
		$array2d[] = array("status_aktif", $_SESSION["status_aktif"], 0);

        
        if ($_SESSION["op"] == "1")
        {
        	$array2d[] = array("user_id", $_SESSION["user_id_x"], 1);
			$array2d[] = array("user_pass", encrypt("123456"), 1);
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlInsert("mst_user", $array2d);
            $strTemp = "Data has been successfully inserted";
        }            
        else
        {          
            
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("mst_user", $array2d, "where user_id='" .$_SESSION["ID"] . "'" );	
            $strTemp = "Data has been successfully updated";
        }
    }
    elseif ($_SESSION["op"] == "3")
    {
    	 
    }
    else
        eror("invalid op");

    global $oDB; 
	$oDB->ExecuteNonQuery($sqlCmd);	
	header('location:global_notification.php?strMsg=' . htmlspecialchars($strTemp));

}

function FormLoad()
{	
	global $oDB;
	
	$sql="select kodereff, reff from mst_reff where tipeReff=10 and kodereff <> 1 order by reff ";
	$rsGroupUser = $oDB->ExecuteReader($sql);
	
	$sql="select kodereff, reff from mst_reff where tipeReff=26 ";
	$rsLevelUser = $oDB->ExecuteReader($sql);
	
	$sql="select kodereff, reff from mst_reff where tipeReff=9 order by reff desc";
	$rsYaTidak = $oDB->ExecuteReader($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List User</title>
</head>

<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!-- 

function errMsg() {					
	<?php 
	if( $_SESSION["errAlert"] ==true){	
		echo "alert('" . $_SESSION["errMsg"] . "')";
	}
	?>
}

function frmSubmit(){ 
    op = document.input.txtOp.value;

    if (op == "1" || op == "2")
    { 
    	 
        if (document.input.txtuser_id.value==""){
			alert("Silahkan isi user id");
			document.input.txtuser_id.focus();
			return false;
		}
		 
		
		if (document.input.txtuser_nama.value==""){
			alert("Silahkan isi nama user");
			document.input.txtuser_nama.focus();
			return false;
		}
		
		if (document.input.txtgroup_user_id.value==""){
			alert("Silahkan pilih group user");
			document.input.txtgroup_user_id.focus();
			return false;
		}
		
		if (document.input.txtlevel_user_id.value==""){
			alert("Silahkan pilih level user");
			document.input.txtlevel_user_id.focus();
			return false;
		}
		
		if (document.input.txtstatus_aktif.value==""){
			alert("Silahkan pilih status aktif");
			document.input.txtstatus_aktif.focus();
			return false;
		}
    }

    if (op == "1")
        msg = 'Confirm add data User ?';
    else if (op == "2")
        msg = 'Confirm edit data User ?';
    else if (op == "3")
        msg = 'Confirm delete data User ?';
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
          <td>  User ID</td>
          <td>:</td>
          <td> 
          <?php  
          	if ($_SESSION["op"] == 2){
          		echo $_SESSION["user_id_x"];
          		echo getHIddenBox($_SESSION["modeView"], "txtuser_id", $_SESSION["user_id_x"]);
          	}
          	else
          		echo getTextBox($_SESSION["modeView"], "txtuser_id", $_SESSION["user_id_x"], 20, 20, ""); 
          	
          	?> </td>
</tr >
<tr class="font10black">
          <td style="height: 23px"></td>
          <td style="height: 23px">  Nama</td>
          <td style="height: 23px">:</td>
          <td style="height: 23px"> <?php  echo getTextBox($_SESSION["modeView"], "txtuser_nama", $_SESSION["user_nama"], 50, 30, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  Group User</td>
          <td>:</td>
          <td>
          <?php  echo getComboBox(1, "txtgroup_user_id", $_SESSION["group_user_id"], $rsGroupUser , ""); ?>
          </td>
</tr >

<tr class="font10black">
          <td></td>
          <td>  Level User</td>
          <td>:</td>
          <td>
          <?php  echo getComboBox(1, "txtlevel_user_id", $_SESSION["level_user_id"], $rsLevelUser , ""); ?>
          </td>
</tr >

<tr class="font10black">
          <td></td>
          <td>  Status Aktif</td>
          <td>:</td>
          <td> 
          <?php  echo getComboBox(1, "txtstatus_aktif", $_SESSION["status_aktif"], $rsYaTidak, ""); ?>
           </td>
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

$_SESSION["user_id_x"] = "";
$_SESSION["user_pass"] = "";
$_SESSION["user_nama"] = "";
$_SESSION["group_user_id"] = "";
$_SESSION["status_aktif"] = "1";

}
?>

