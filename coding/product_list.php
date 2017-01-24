<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "product_entry.php";
	$pageTitle = "List Data Barang";	
	
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 	 
	$array2d[] = array("Kode Barang", "product_code", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Nama Barang", "product_name", "left", "varchar", "10%", "notsum"); 
	/*$array2d[] = array("Kode Kelompok", "kode_kelompok", "left", "varchar", "10%", "notsum"); 
	$array2d[] = array("Kode Jenis", "kode_jenis", "left", "varchar", "10%", "notsum"); 
    $array2d[] = array("Kode Unit", "kode_unit", "left", "varchar", "10%", "notsum");   	
	$array2d[] = array("Harga Jual", "harga_jual", "right", "money", "10%", "notsum"); 
	*/
	$array2d[] = array("Satuan", "kode_sat", "left", "varchar", "10%", "notsum"); 
	$array2d[] = array("Harga Jual", "harga_jual", "right", "money", "10%", "notsum");
	$array2d[] = array("Saldo Awal", "saldo_awal", "right", "money", "10%", "notsum");
	$array2d[] = array("Divisi", "kode_artikel", "left", "varchar", "10%", "notsum"); 
	$array2d[] = array("Keterangan", "keterangan", "left", "varchar", "10%", "notsum");
	
	$sql = "from mst_product "; 
	if (isset($_POST["txtKode"])){
		$kode = trim($_POST["txtKode"]);
	}
	else
	{
		$kode = ""; 
	}
	
	if ($kode != "")
		$sql = $sql . " where product_code='$kode' or product_name like '%$kode%' ";			
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
		include "form_search2.php";
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