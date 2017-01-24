<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();
	$pageTitle = "Sales Pilih Order";
	$customer = retrieveS($_GET["customer"]);
	$divisi = retrieveS($_GET["divisi"]);
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 	
	
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe = 3 order by contact_name";
    $rsCustomer = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);
	
	$sqlCmd = "select a.transaksi_kode, concat(a.transaksi_kode, ' / ', a.transaksi_tgl) as transaksi_kode, b.no_reff from trx_master a
	left join trx_master b on a.transaksi_kode=b.no_reff and b.transaksi_tipe=6
	where a.transaksi_tipe=5 and a.kode_divisi='$divisi' and b.no_reff is null and a.contact_code='$customer' order by a.transaksi_kode ";
	$rsOrder = $oDB->ExecuteReader($sqlCmd);	
	//eror($sqlCmd);
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
	
function frmNew(){  
	if (document.getElementById("txtno_order").value == ""){
		alert("Silahkan pilih no order terlebih dahulu");
		document.getElementById("txtno_order").focus();
		return false;	
	}
	
	divisi = document.getElementById("txtdivisi").value;
	customer = document.getElementById("txtcustomer").value;
	no_order = document.getElementById("txtno_order").value;
	self.location="sales_by_order_entry.php?op=1&divisi=" + divisi + "&customer=" + customer + "&no_order=" + no_order; 
}

function frmBack(){  
	self.location="sales_by_order_list.php";
}

-->
</Script>

<body onLoad="errMsg()">
<form name="input" method="post" >

<table width="50%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
	<tr bgcolor="white" >
	<td class="contentTitleTable" align="center">
	<?php echo $pageTitle ?>	</td>
	</tr>
	<tr bgcolor="white">
	<td height="250" valign="top" align="left">
		
		<table width="80%" align='center'>			
				<tr class='font10black'>
					<td colspan=3>&nbsp;</td>
				</tr>
                
                 <tr class='font10black'>
					<td>Divisi</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(2, "txtdivisi", $divisi, $rsArtikel, ""); 
						echo getHiddenBox(1, "txtdivisi", $divisi);
					?>
					</td>
				</tr>
                <tr class='font10black'>
					<td>Customer</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(2, "txtcustomer", $customer, $rsCustomer, ""); 
						echo getHiddenBox(1, "txtcustomer", $customer);
					?>
					</td>
				</tr>                
				<tr class='font10black'>
					<td>No Order / Tgl Order</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtno_order", "", $rsOrder, ""); ?>
					</td>
				</tr>
				<tr class='font10black'>
					<td colspan=3>&nbsp;</td>
				</tr>
				<tr class='font10black'>
					<td colspan=3>
					<input type="button" name="btBack" value="Back" class ="button" onClick="frmBack();" />
					&nbsp;
					<input type="button" name="btSubmit" value="Submit" class ="button" onClick="frmNew();" />
					</td>
				</tr>
				<tr class='font10black'>
					<td colspan=3>&nbsp;</td>
				</tr>
		</table>
	</td>
	</tr> 
</table> 
</form> 
 
</BODY>
</HTML>


