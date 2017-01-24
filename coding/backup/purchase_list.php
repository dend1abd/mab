<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "purchase_entry.php";
	$pageTitle = "List Transaksi Pembelian non Order";
	$transaksi_tipe = "3";
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]); 
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
	}	
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 
	 
	$array2d[] = array("Tgl Pembelian", "transaksi_tgl", "left", "varchar", "10%", "notsum");		$array2d[] = array("No Pembelian", "transaksi_kode", "left", "varchar", "10%", "notsum");	
	
	$array2d[] = array("No Invoice", "no_invoice", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Tgl Invoice", "tgl_invoice", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Supplier", "b.contact_name as supplier", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Karyawan", "c.contact_name as sales", "left", "varchar", "10%", "notsum");	
	$sql = "from trx_master a ";
	$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code and b.contact_tipe=2 ";
	$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code and c.contact_tipe=4 ";
	$sql = $sql . "where transaksi_tipe=$transaksi_tipe ";
	$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2' "; 
	$sql = $sql . "order by transaksi_tgl, transaksi_kode"; 
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $pageTitle; ?></title
></head>
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
