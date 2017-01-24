<?php
	include "include/clsDataAccess.php";
	include "include/clsBisnisProses.php";
	include "include/global.php";	
	
	cekSession();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	$pageTitle = "Setting Kode Perkiraan Jurnal Transaksi";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	//$sql = "select * from tGroupUser order by GroupUserName";							
	//$rsGroupUser = $oDB->ExecuteReader($sql);
	
	if (isset($_POST["txtPasswordLama"]))
	{		
	
	}
	else
	{		 
	}
	
	$sql = "select * from app_config";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs);
	$data = mysql_fetch_array($rs);

?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $pageTitle; ?></title>
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
	msg = "Confirm Update Data ?";
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
          <td colspan="3">  Penjualan</td> 
		</tr >
		
        
		<tr class="font10black">
          <td></td>
          <td>  Tunai</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(, "txtjurnal_purchase_tunai_debet", $data["jurnal_purchase_tunai_debet"], 30, 30, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(, "txtjurnal_purchase_tunai_kredit", $data["jurnal_purchase_tunai_kredit"], 30, 30, ""); 
		  ?>        
          </td>
		</tr > 
 
			
        <tr class="font10black">
            <td colspan=4 align="center"> 
          <input class="button" type="button" name="cmdSubmit" value="Update" onClick="frmSubmit();" />

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

