<?php   

	include "coding/include/clsDataAccess.php";
	include "coding/include/clsBisnisProses.php";
	include "coding/include/global.php";  
	 
	$errAlert 	= false;
	$errMsg 	= ""; 
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	
	 
	 
	$errAlert 	= false;
	$errMsg 	= ""; 
	$userId = "";
	//eror(encrypt("123456"));
	
	if (isset($_POST["txtUserId"])){
		
		$userId		= retrieveS($_POST["txtUserId"]);
		$password 	= retrieveS($_POST["txtPassword"]);
		
		$sql = "select user_pass, user_nama, group_user_id, status_aktif from mst_user where user_id='$userId'" ;
		//echo $sql;

		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs);
	
		if($numRows >0){				
			$r	=	mysql_fetch_array($rs);		
			if (trim($r[0]) == encrypt($password)){
				//session_start();
				//session_register("userid");
				//session_register("numpaging");
				
				if (trim($r[3]) == "1"){ 
					session_start(); 
					
					$_SESSION['sessiontime'] = time();					
					$_SESSION["userid"] = $userId;	
					$_SESSION["numpaging"] = 50;	 
					
					$_SESSION["nama"] = trim($r[1]);
					$_SESSION["groupUserId"] = trim($r[2]);
					
					//***** reading configuration					
					$sql = "select string_value from mst_config where ket='kode company'" ;
					$rsConfig1 = $oDB->ExecuteReader($sql);					
					$dataConfig1 = mysql_fetch_array($rsConfig1);
					$_SESSION["param_company_code"] = $dataConfig1[0]; 
					
					$sql = "select int_value from mst_config where ket='jml record paging'" ;
					$rsConfig2 = $oDB->ExecuteReader($sql);					
					$dataConfig2 = mysql_fetch_array($rsConfig2);
					$_SESSION["param_jml_record_paging"] = $dataConfig2[0];
					//eror($sql); 
					
					$sql = "select * from mst_contact where contact_tipe=1 and contact_code='" .$_SESSION["param_company_code"]. "'" ;
					$rsCompany = $oDB->ExecuteReader($sql);
					$dataCompany = mysql_fetch_array($rsCompany);
					$_SESSION["param_company_name"] = $dataCompany[2] . " " . $dataCompany[3];
					
					$sql = "select int_value from mst_config where ket='session timeout '" ;
					$rsConfig3 = $oDB->ExecuteReader($sql);					
					$dataConfig3 = mysql_fetch_array($rsConfig3);
					$_SESSION["expire"] = 60 * $dataConfig3[0];
					
					//**************** update counter
					$bln = date("m");
					$thn = right(date("Y"),2);
					$sql = "update mst_config set int_value=0, bln=" .$bln. ", thn=" .$thn. " where bln<>" .$bln. " and thn<>" .$thn. " and ket ='kode barang'";
					$oDB->ExecuteNonQuery($sql);

					header('location:coding/mainframeset.php');	
				}
				else{
					$errMsg = "Status user $userId sudah tidak aktif";
					$errAlert = true; 
				}
				//echo "asdas"
			}
			else{	
				$errMsg = "Password Salah";
				$errAlert = true;
			}		
		}
		else{
			$errMsg = "User Id $userId belum terdaftar";
			$errAlert = true;
		}
	}
	else{
		$userId		= "admin";
		$password 	= "123456";
	}
?>	
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $pageTitle; ?></title>
</head>
	<link rel="stylesheet" href="coding/include/style.css" />
	<link rel='SHORTCUT ICON' href="images/icon.ico" />
<Script Language="JavaScript">
<!--

function frmSubmit()
{
    f = document.frm;
	if(f.txtUserId.value=="")
    {
      alert("Silahkan isi user id")
      f.txtUserId.focus()
      return;
    }

	else if(f.txtPassword.value=="")
    {
      alert("Silahkan isi password")
      f.txtPassword.focus()
      return;
    }
	else
	// action="signup_cek.php"
	//f.action="signup_cek.php"
	f.submit();
		
}

function enterkey(evt) {
  var evt = (evt) ? evt : event
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode == 13) {
    frmSubmit()
  }
}

function errMsg() {
	<?php 
	if($errAlert == true){
		echo "alert('$errMsg');";
	}
	?>
}


-->
</Script>

<body onLoad="document.frm.txtUserId.focus(); errMsg(); document.body.onkeypress = enterkey;" topmargin="100">
<form method="post" name="frm">

<table align="center" width="400" cellpadding="0" cellspacing="1" bgcolor="navy" >
<tr height="270">
<td colspan="3" style="background-image: url(images/bg_login.jpg);" height="100" align="center" valign="middle" bgcolor="#FFFFFF">
	
	<table width="300" >

		<tr class="font12Bold">
			<td align="left">User ID</td>
			<td align="left">:</td>
			<td align="left"><input type="text" class="thin" name="txtUserId" value="<?php echo $userId; ?>" /> </td>
		</tr>
		<tr class="font12Bold">
			<td align="left">Password</td>
			<td align="left">:</td>
			<td align="left"><input type="password" class="thin" name="txtPassword" value="<?php echo $password; ?>" /> </td>
		</tr>
		
		<tr>
			<td colspan="2"><input type="button" class="buttonlogin" name="btnSubmit" value="Login" onClick="frmSubmit();" /> </td>
		</tr> 

	</table>
</td>
</tr>

</table>

	
</form>
</body>

</html>
