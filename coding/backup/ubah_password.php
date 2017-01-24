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
	
	if (isset($_POST["txtPasswordLama"]))
	{
		$sql = "select user_pass from mst_user where user_id='" .$_SESSION["userid"]. "'";
		$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs);
		
		$passwordLama = $_POST["txtPasswordLama"];
		$passwordBaru = $_POST["txtPasswordBaru"];
		
		if ($numRows == 0)
		{
			$_SESSION["errAlert"] 	= true;
			$_SESSION["errMsg"] 	= "User tidak ada";
		}
		else{
		
			$data = mysql_fetch_array($rs);
			if ($data[0] != encrypt($passwordLama)){
				$_SESSION["errAlert"] 	= true;
				$_SESSION["errMsg"] 	= "Password lama salah";
			}
			else{
				$sqlCmd="update mst_user set user_pass='" . encrypt($passwordBaru). "' where user_id='" .$_SESSION["userid"]. "'";
				$strTemp = "Password anda telah berubah";
				$oDB->ExecuteNonQuery($sqlCmd);	
				header('location:global_notification.php?strMsg=' . htmlspecialchars($strTemp));

			}
		}
	
	}
	else
	{
		$passwordLama = "";
		$passwordBaru = "";	
	}

?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List product</title>
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

	if (document.getElementById("txtPasswordLama").value == ""){
		alert("Silahkan isi password lama anda");
		return;
	}
	
	if (document.getElementById("txtPasswordBaru").value == ""){
		alert("Silahkan isi password baru anda");
		return;
	}
	
	if (document.getElementById("txtPasswordBaru").value == document.getElementById("txtPasswordLama").value){
		alert("isian pasword baru sama dengan password lama");
		return;
	}
	
	if (document.getElementById("txtPasswordBaru2").value == ""){
		alert("Silahkan isi konfirmasi password baru anda");
		return;
	}
	
	if (document.getElementById("txtPasswordBaru").value != document.getElementById("txtPasswordBaru2").value){
		alert("Konfirmasi password baru tidak sama");
		return;
	}

	msg = "anda yakin akan ubah password ?";
	if(confirm(msg)){
	  document.input.submit();
	}
	
} 

-->
</Script>

<BODY  onLoad="errMsg()">
<form name="input" method="post" >

<table width="70%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
	<tr bgcolor="white" >
		<td class="contentTitleTable" align="center">
		Ubah Password	
		</td>
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
          <td> <?php echo $_SESSION["userid"]; ?></td>
		</tr >
	
		<tr class="font10black">
          <td></td>
          <td>  Password Lama</td>
          <td>:</td>
          <td> <input type="password" id="txtPasswordLama" name="txtPasswordLama" value="<?php echo $passwordLama; ?>" class="thin" /></td>
		</tr >
		
		<tr class="font10black">
          <td></td>
          <td>  Password Baru</td>
          <td>:</td>
          <td> <input type="password" id="txtPasswordBaru" name="txtPasswordBaru" value="<?php echo $passwordBaru; ?>" class="thin" /></td>
		</tr >
		
		<tr class="font10black">
          <td></td>
          <td>  Konfirmasi Password Baru</td>
          <td>:</td>
          <td> <input type="password" id="txtPasswordBaru2" name="txtPasswordBaru2" value="<?php echo $passwordBaru; ?>" class="thin" /></td>
		</tr >
 
			
			<tr class="font10black">
          		<td colspan=4 align="center"> 
              <input class="button" type="button" name="cmdSubmit" value="Submit" onClick="frmSubmit();" />

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

function ClearSession()
{
	
}
?>

