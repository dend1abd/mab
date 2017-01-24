<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "delivery_order_entry.php";
	$pageTitle = "List Transaksi Pengiriman Barang / Delivery Order (DO)";
	$transaksi_tipe = "19";	
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);
		$divisi = trim($_POST["txtDivisi"]);
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		$divisi = "";
	}	
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);	
	
	$array2d[] = array("No DO", "transaksi_kode", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Tgl DO", "transaksi_tgl", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Divisi", "CONCAT(a.kode_divisi, ' - ', d.reff) as divisi", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Supir", "b.contact_name as supir", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("No Mobil", "no_mobil", "left", "varchar", "10%", "notsum");
$array2d[] = array("No SJ", "no_reff", "left", "varchar", "10%", "notsum");	
	$sql = "from trx_master a ";
	$sql = $sql . "left join mst_contact b on a.supir_code=b.contact_code ";
	$sql = $sql . "left join mst_reff d on a.kode_divisi=d.kodereff and d.tipereff=23 ";
	$sql = $sql . "where transaksi_tipe = $transaksi_tipe ";
	
	if ($divisi <> "") $sql = $sql . "and a.kode_divisi='$divisi' "; 
	$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'"; 	
	$sql = $sql . "order by transaksi_tgl, transaksi_kode "; 
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
	divisi = document.getElementById("txtDivisi").value;
    self.location="<?php echo $pageEdit; ?>?op=1&divisi=" + divisi; 
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
		include "form_search_divisi.php";
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
