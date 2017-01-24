<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	$SQL = "";
	$password = "";
	$Result  = ""; 
	if (isset($_POST["txtSQL"])){ 
		$password = $_POST["txtpassword"];		
		$SQL = $_POST["txtSQL"];
		if ($password == "mysql@program")
		{				
			//echo $SQL;
			$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
			$oDB->ExecuteNonQuery($SQL);
			
			$Result  = " Result : Exec Command Done";
		}
		else
			$Result  = " Result : invalid password";
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Lapora Retur Penjualan</title>
</head>

<?php include("include/headerfile.php"); ?>
<Script Language="JavaScript">
<!--
	
function frmSubmit(){
	
	if (Trim(document.getElementById("txtpassword").value) == ""){
		alert("silahkan isi password");
		document.getElementById("txtpassword").focus();
		return false;
	}
	
	if (Trim(document.getElementById("txtSQL").value) == ""){
		alert("silahkan isi SQL");
		document.getElementById("txtSQL").focus();
		return false;
	}

	document.frmList.submit();
}
-->
</Script>


<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td class="font12Bold" style="height: 24px"> My SQL Command</td>
	</tr> 
	<tr>
		<td style="height: 53px">		
			<table >
				<tr class="font10black">
					<td valign="top">Password</td>
					<td valign="top">:</td>
					<td valign="top">
					<?php echo "<input type='password' id='txtpassword' name='txtpassword' value='$password' class='thin' />"; ?>
					</td>
				</tr>
				
				<tr class="font10black">
					<td valign="top">SQL</td>
					<td valign="top">:</td>
					<td valign="top">
					<?php echo "<textarea cols='150' rows='10' name='txtSQL' id='txtSQL' >$SQL</textarea>"; ?>
					</td>
				</tr>

			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Exec Command" class ="button" onclick="frmSubmit()"/>&nbsp;	</td> 
	</tr>
	
	<tr>
		<td> 
			<?php 
						echo $Result; 
			?>
		</td> 
	</tr>	
</table>

</form>

</body>

</html>
