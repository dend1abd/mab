<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "customer_entry.php";
	$pageTitle = "List Customer";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);		
	
	if (isset($_POST["txtKode"])){
		$kode = trim($_POST["txtKode"]); 		
	}
	else
	{
		$kode = "";
	}
	
	$array2d[] = array("Kode Customer", "a.contact_code", "center", "varchar", "10%", "notsum");
	$array2d[] = array("Nama Customer", "a.contact_name", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Alamat", "a.alamat", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Kota", "a.kota", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Telp", "a.telp", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Sales", "b.contact_name", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Wilayah", "a.kode_wilayah", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Saldo Awal", "a.saldo", "right", "money", "10%", "notsum");
	//$array2d[] = array("Status", "a.status_kerja", "left", "varchar", "10%", "notsum");
	//$array2d[] = array("Keterangan", "a.ket", "left", "varchar", "10%", "notsum");
		
	$sql = "from mst_contact a ";
	$sql = $sql . "left join mst_contact b on a.sales_code=b.contact_code ";
	$sql = $sql . "where a.contact_tipe=3 ";
	if ($kode != "")
		$sql = $sql . "and (a.contact_code = '$kode' or a.contact_name like '%$kode%') ";
	$sql = $sql . "order by a.contact_code ";
 
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

