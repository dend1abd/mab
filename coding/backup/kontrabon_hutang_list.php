<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "kontrabon_hutang_entry.php";
	$pageTitle = "List Kontrabon Hutang";
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);
		$supplier = trim($_POST["txtSupplier"]);
		$divisi = trim($_POST["txtDivisi"]);
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		$supplier = "";
		$divisi = "";
	}	
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);	
	 
	$array2d[] = array("No Kontrabon", "transaksi_kode", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Tgl Kontrabon", "transaksi_tgl", "left", "varchar", "10%", "notsum");	 
	$array2d[] = array("Supplier", "b.contact_name as Supplier", "left", "varchar", "10%", "notsum");	 
	$sql = "from trx_master a ";
	$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code "; 
	$sql = $sql . "where transaksi_tipe=15 ";
	$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'"; 
	
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe = 2 order by contact_name"; 
    $rsSupplier = $oDB->ExecuteReader($sqlCmd);
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
	if (document.getElementById("txtDivisi").value == ""){
		alert("Silahkan pilih Divisi terlebih dahulu");
		document.getElementById("txtDivisi").focus();
		return false;	
	}
	if (document.getElementById("txtSupplier").value == ""){
		alert("Silahkan pilih Supplier terlebih dahulu");
		document.getElementById("txtSupplier").focus();
		return false;	
	}
	
	divisi = document.getElementById("txtDivisi").value;	
	Supplier = document.getElementById("txtSupplier").value;
    self.location="<?php echo $pageEdit; ?>?op=1&supplier=" + Supplier + "&divisi=" + divisi; 
	//self.location="sales_pilih_order.php?Supplier=" + Supplier + "&divisi=" + divisi; 
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
		include "form_search_beli.php";
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
