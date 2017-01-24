<?php
	include "include/clsDataAccess.php";
	include "include/clsBisnisProses.php";
	include "include/global.php";	
	
	cekSession();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	$pageTitle = "Setting Kode Perkiraan Jurnal Otomatis";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	//$sql = "select * from tGroupUser order by GroupUserName";							
	//$rsGroupUser = $oDB->ExecuteReader($sql);
	
	$_SESSION["errAlert"] = false;
	$_SESSION["errMsg"] = "";
	
	if (isset($_POST["txtcontact_name"]))
	{		 		  
		$array2d[] = array("contact_init", retrieveS($_POST["txtcontact_init"]), 1);
		$array2d[] = array("contact_name", retrieveS($_POST["txtcontact_name"]), 1); 
		
		$sqlCmd = sqlUpdate("mst_contact", $array2d, "where contact_tipe=1 and contact_code='" .retrieveS($_POST["txtcontact_code"]). "'" );
		$oDB->ExecuteNonQuery($sqlCmd);
         
		$_SESSION["errAlert"] = true;
		$_SESSION["errMsg"] = "Data sudah tersimpan"; 
	} 
	
	$sql = "select * from mst_contact where contact_tipe=1 and contact_code='001'";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs);
	$data = mysql_fetch_array($rs);
	
	if ($numRows == 0)
		eror("mst_contact dengan contact_tipe=1 and contact_code='001' belum ada");

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
		<?php echo $pageTitle; ?>	
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
          <td>  Nama Perusahaan</td>
          <td>:</td>
          <td>  
          <?php
		  echo getHiddenBox(1, "txtcontact_code", $data["contact_code"]);
          echo getTextBox(1, "txtcontact_init", $data["contact_init"], 5, 5, ""); 
		  echo "&nbsp;";
		  echo getTextBox(1, "txtcontact_name", $data["contact_name"], 30, 50, "");
		  ?>        
          </td>
		</tr >  
 
		 <tr class="font10black">
            <td colspan=4 align="center">&nbsp; 
            
            </td>
       </tr>	
        <tr class="font10black">
            <td colspan=4 align="center"> 
          <input class="button" type="button" name="cmdSubmit" value="Update" onClick="frmSubmit();" />

            </td>
       </tr> 
       <tr class="font10black">
            <td colspan=4 align="center">&nbsp; 
            
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

