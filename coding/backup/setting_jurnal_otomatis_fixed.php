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
	
	if (isset($_POST["txtjurnal_purchase_tunai_debet"]))
	{		
		$array2d[] = array("jurnal_purchase_tunai_debet", retrieveS($_POST["txtjurnal_purchase_tunai_debet"]), 1);
		$array2d[] = array("jurnal_purchase_tunai_kredit", retrieveS($_POST["txtjurnal_purchase_tunai_kredit"]), 1);
		$array2d[] = array("jurnal_purchase_hutang_debet", retrieveS($_POST["txtjurnal_purchase_hutang_debet"]), 1);
		$array2d[] = array("jurnal_purchase_hutang_kredit", retrieveS($_POST["txtjurnal_purchase_hutang_kredit"]), 1);
		$array2d[] = array("jurnal_purchase_disc_debet", retrieveS($_POST["txtjurnal_purchase_disc_debet"]), 1);
		$array2d[] = array("jurnal_purchase_disc_kredit", retrieveS($_POST["txtjurnal_purchase_disc_kredit"]), 1);
		$array2d[] = array("jurnal_purchase_ppn_debet", retrieveS($_POST["txtjurnal_purchase_ppn_debet"]), 1);
		$array2d[] = array("jurnal_purchase_ppn_kredit", retrieveS($_POST["txtjurnal_purchase_ppn_kredit"]), 1);
		$array2d[] = array("jurnal_sales_tunai_debet", retrieveS($_POST["txtjurnal_sales_tunai_debet"]), 1);
		$array2d[] = array("jurnal_sales_tunai_kredit", retrieveS($_POST["txtjurnal_sales_tunai_kredit"]), 1);
		$array2d[] = array("jurnal_sales_piutang_debet", retrieveS($_POST["txtjurnal_sales_piutang_debet"]), 1);
		$array2d[] = array("jurnal_sales_piutang_kredit", retrieveS($_POST["txtjurnal_sales_piutang_kredit"]), 1);
		$array2d[] = array("jurnal_sales_disc_debet", retrieveS($_POST["txtjurnal_sales_disc_debet"]), 1);
		$array2d[] = array("jurnal_sales_disc_kredit", retrieveS($_POST["txtjurnal_sales_disc_kredit"]), 1);
		$array2d[] = array("jurnal_sales_ppn_debet", retrieveS($_POST["txtjurnal_sales_ppn_debet"]), 1);
		$array2d[] = array("jurnal_sales_ppn_kredit", retrieveS($_POST["txtjurnal_sales_ppn_kredit"]), 1);
		$array2d[] = array("jurnal_purchase_return_tunai_debet", retrieveS($_POST["txtjurnal_purchase_return_tunai_debet"]), 1);
		$array2d[] = array("jurnal_purchase_return_tunai_kredit", retrieveS($_POST["txtjurnal_purchase_return_tunai_kredit"]), 1);
		$array2d[] = array("jurnal_purchase_return_piutang_debet", retrieveS($_POST["txtjurnal_purchase_return_piutang_debet"]), 1);
		$array2d[] = array("jurnal_purchase_return_piutang_kredit", retrieveS($_POST["txtjurnal_purchase_return_piutang_kredit"]), 1);
		$array2d[] = array("jurnal_purchase_return_disc_debet", retrieveS($_POST["txtjurnal_purchase_return_disc_debet"]), 1);
		$array2d[] = array("jurnal_purchase_return_disc_kredit", retrieveS($_POST["txtjurnal_purchase_return_disc_kredit"]), 1);
		$array2d[] = array("jurnal_purchase_return_ppn_debet", retrieveS($_POST["txtjurnal_purchase_return_ppn_debet"]), 1);
		$array2d[] = array("jurnal_purchase_return_ppn_kredit", retrieveS($_POST["txtjurnal_purchase_return_ppn_kredit"]), 1);
		$array2d[] = array("jurnal_sales_return_tunai_debet", retrieveS($_POST["txtjurnal_sales_return_tunai_debet"]), 1);
		$array2d[] = array("jurnal_sales_return_tunai_kredit", retrieveS($_POST["txtjurnal_sales_return_tunai_kredit"]), 1);
		$array2d[] = array("jurnal_sales_return_hutang_debet", retrieveS($_POST["txtjurnal_sales_return_hutang_debet"]), 1);
		$array2d[] = array("jurnal_sales_return_hutang_kredit", retrieveS($_POST["txtjurnal_sales_return_hutang_kredit"]), 1);
		$array2d[] = array("jurnal_sales_return_disc_debet", retrieveS($_POST["txtjurnal_sales_return_disc_debet"]), 1);
		$array2d[] = array("jurnal_sales_return_disc_kredit", retrieveS($_POST["txtjurnal_sales_return_disc_kredit"]), 1);
		$array2d[] = array("jurnal_sales_return_ppn_debet", retrieveS($_POST["txtjurnal_sales_return_ppn_debet"]), 1);
		$array2d[] = array("jurnal_sales_return_ppn_kredit", retrieveS($_POST["txtjurnal_sales_return_ppn_kredit"]), 1);
		
		 $sqlCmd = sqlUpdate("app_config", $array2d, "" );
		 $oDB->ExecuteNonQuery($sqlCmd);
         
		 $_SESSION["errAlert"] = true;
		$_SESSION["errMsg"] = "Data sudah tersimpan"; 
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
          <td colspan="3">  <b>Pembelian</b></td> 
		</tr >        
		<tr class="font10black">
          <td></td>
          <td>  Tunai</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_tunai_debet", $data["jurnal_purchase_tunai_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_tunai_kredit", $data["jurnal_purchase_tunai_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr > 
        <tr class="font10black">
          <td></td>
          <td>  Hutang</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_hutang_debet", $data["jurnal_purchase_hutang_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_hutang_kredit", $data["jurnal_purchase_hutang_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr >
        <tr class="font10black">
          <td></td>
          <td>  Diskon</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_disc_debet", $data["jurnal_purchase_disc_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_disc_kredit", $data["jurnal_purchase_disc_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr >
        <tr class="font10black">
          <td></td>
          <td>  PPN</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_ppn_debet", $data["jurnal_purchase_ppn_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_ppn_kredit", $data["jurnal_purchase_ppn_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr >
        
        <tr class="font10black">
          <td></td>
          <td colspan="3">  <b>Penjualan</b></td> 
		</tr >        
		<tr class="font10black">
          <td></td>
          <td>  Tunai</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_tunai_debet", $data["jurnal_sales_tunai_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_tunai_kredit", $data["jurnal_sales_tunai_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr > 
        <tr class="font10black">
          <td></td>
          <td>  Piutang</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_piutang_debet", $data["jurnal_sales_piutang_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_piutang_kredit", $data["jurnal_sales_piutang_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr >
        <tr class="font10black">
          <td></td>
          <td>  Diskon</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_disc_debet", $data["jurnal_sales_disc_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_disc_kredit", $data["jurnal_sales_disc_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr >
        <tr class="font10black">
          <td></td>
          <td>  PPN</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_ppn_debet", $data["jurnal_sales_ppn_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_ppn_kredit", $data["jurnal_sales_ppn_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr >
        
        <tr class="font10black">
          <td></td>
          <td colspan="3">  <b>Retur Pembelian</b></td> 
		</tr >        
		<tr class="font10black">
          <td></td>
          <td>  Tunai</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_return_tunai_debet", $data["jurnal_purchase_return_tunai_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_return_tunai_kredit", $data["jurnal_purchase_return_tunai_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr > 
        <tr class="font10black">
          <td></td>
          <td>  Piutang</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_return_piutang_debet", $data["jurnal_purchase_return_piutang_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_return_piutang_kredit", $data["jurnal_purchase_return_piutang_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr >
        <tr class="font10black">
          <td></td>
          <td>  Diskon</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_return_disc_debet", $data["jurnal_purchase_return_disc_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_return_disc_kredit", $data["jurnal_purchase_return_disc_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr >
        <tr class="font10black">
          <td></td>
          <td>  PPN</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_return_ppn_debet", $data["jurnal_purchase_return_ppn_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_purchase_return_ppn_kredit", $data["jurnal_purchase_return_ppn_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr >
        
        <tr class="font10black">
          <td></td>
          <td colspan="3">  <b>Retur Penjualan</b></td> 
		</tr >        
		<tr class="font10black">
          <td></td>
          <td>  Tunai</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_return_tunai_debet", $data["jurnal_sales_return_tunai_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_return_tunai_kredit", $data["jurnal_sales_return_tunai_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr > 
        <tr class="font10black">
          <td></td>
          <td>  Hutang</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_return_hutang_debet", $data["jurnal_sales_return_hutang_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_return_hutang_kredit", $data["jurnal_sales_return_hutang_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr >
        <tr class="font10black">
          <td></td>
          <td>  Diskon</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_return_disc_debet", $data["jurnal_sales_return_disc_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_return_disc_kredit", $data["jurnal_sales_return_disc_kredit"], 30, 15, ""); 
		  ?>        
          </td>
		</tr >
        <tr class="font10black">
          <td></td>
          <td>  PPN</td>
          <td>:</td>
          <td> 
          Debet : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_return_ppn_debet", $data["jurnal_sales_return_ppn_debet"], 30, 15, ""); 
		  ?>
          &nbsp;
          Kredit : 
          <?php
          echo getTextBox(1, "txtjurnal_sales_return_ppn_kredit", $data["jurnal_sales_return_ppn_kredit"], 30, 15, ""); 
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

