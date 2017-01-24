<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "size_entry.php";
	$pageTitle = "Size List";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 

	 
	$array2d[] = array("Kode Size", "kode_size", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Size 1", "size1", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Size 2", "size2", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Size 3", "size3", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Size 4", "size4", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Size 5", "size5", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Size 6", "size6", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Size 7", "size7", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Size 8", "size8", "left", "varchar", "10%", "notsum");
	
	$sql = "from mst_size "; 
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
		include "form_search3.php";
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