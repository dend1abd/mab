<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "gudang_produksi_in_by_order_entry.php";
	$pageTitle = "List Penerimaan Hasil Produksi by Order";
	$transaksi_tipe = "9";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);		
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);	
		$customer = trim($_POST["txtCustomer"]);
		$divisi = trim($_POST["txtDivisi"]);
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		$customer = "";
		$divisi = "";
	}
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe = 3 order by contact_name";
    $rsCustomer = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);	
	
	$array2d[] = array("Kode Transaksi", "transaksi_kode", "center", "varchar", "10%", "notsum");
	$array2d[] = array("Tanggal", "transaksi_tgl", "center", "date", "10%", "notsum");
	$array2d[] = array("Customer", "b.contact_name", "left", "varchar", "30%", "notsum");
	$array2d[] = array("Petugas Gudang", "c.contact_name", "left", "varchar", "30%", "notsum");
	$array2d[] = array("Keterangan", "keterangan", "left", "varchar", "30%", "notsum");
	
	$sql = "from trx_master a ";
	$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code ";
	$sql = $sql . "left join mst_contact c on a.petugas_kode=c.contact_code ";
	$sql = $sql . "where transaksi_tipe = $transaksi_tipe ";
	$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'"; 
	if ($customer != "")
		$sql = $sql . "and a.contact_code = '$customer' "; 
	$sql = $sql . "order by transaksi_tgl ";
 
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
    if (document.getElementById("txtCustomer").value == ""){
		alert("Silahkan pilih customer terlebih dahulu");
		document.getElementById("txtCustomer").focus();
		return false;	
	}
	customer = document.getElementById("txtCustomer").value;
    self.location="<?php echo $pageEdit; ?>?op=1&customer=" + customer; 
}

function frmCari(){  
    document.frmList.submit();
}

-->
</Script> 

<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr class="font12Bold">
		<td><?php echo $pageTitle; ?></td>
	</tr> 
    <?php
    include "form_search_jual.php";
	?>
	
	<tr>
		<td>		
        <?php        
		include "grid_render.php";
		?>
		</td>
	</tr>	
</table>

</form>
</body>
</html>

