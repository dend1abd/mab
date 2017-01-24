<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "gudang_produksi_in_non_order_entry.php";
	$pageTitle = "List Penerimaan Barang Hasil Produksi non Order";
	$transaksi_tipe = "10";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);		
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$divisi = trim($_POST["txtDivisi"]);
	}
	else
	{
		$tgl1 = date("Y-m-01");
		$tgl2 = date("Y-m-d");  
		$divisi = "";
	}
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);	
	
	$array2d[] = array("Kode Transaksi", "transaksi_kode", "center", "varchar", "10%", "notsum");
	$array2d[] = array("Tgl Transaksi", "transaksi_tgl", "center", "date", "10%", "notsum");
	//$array2d[] = array("Gudang", "b.contact_name", "left", "varchar", "30%", "notsum");
	$array2d[] = array("Customer", "d.contact_name", "left", "varchar", "30%", "notsum");
	$array2d[] = array("Petugas", "c.contact_name", "left", "varchar", "30%", "notsum");
	$array2d[] = array("Keterangan", "keterangan", "left", "varchar", "30%", "notsum");
	
	$sql = "from trx_master a ";
	//$sql = $sql . "left join mst_contact b on a.gudang_kode=b.contact_code ";
	$sql = $sql . "left join mst_contact c on a.petugas_kode=c.contact_code ";
	$sql = $sql . "left join mst_contact d on a.contact_code=d.contact_code ";
	$sql = $sql . "where transaksi_tipe = $transaksi_tipe ";
	$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'"; 
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
    self.location="<?php echo $pageEdit; ?>?op=1"; 
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
    include "form_search.php";
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

