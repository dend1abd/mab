<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "sales_return_entry.php";
	$pageTitle = "List Transaksi Retur Penjualan";
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);
		$divisi = trim($_POST["txtDivisi"]);
		$customer = trim($_POST["txtCustomer"]);
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		$divisi = "";
		$customer = "";
	}	
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);

    $sqlCmd = "SELECT contact_code, CONCAT(contact_name,', ', left(ifnull(alamat,''), 50)) FROM mst_contact where contact_tipe = 3 order by contact_name";
    $rsCustomer = $oDB->ExecuteReader($sqlCmd);	
	 
	$array2d[] = array("No Retur", "transaksi_kode", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Tgl Retur", "transaksi_tgl", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Kode Divisi", "kode_divisi", "left", "varchar", "10%", "notsum");
	$array2d[] = array("No Faktur", "no_reff", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Tgl Faktur", "tgl_reff", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Customer", "b.contact_name as supplier", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Karyawan", "c.contact_name as sales", "left", "varchar", "10%", "notsum");	
	$sql = "from trx_master a ";
	$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code and b.contact_tipe=3 ";
	$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code and c.contact_tipe=4 ";
	$sql = $sql . "where transaksi_tipe=8 ";
	
	if ($divisi <> "") $sql = $sql . "and a.kode_divisi='$divisi' ";
	$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2' "; 
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

    if (document.getElementById("txtCustomer").value == ""){
		alert("Silahkan pilih customer terlebih dahulu");
		document.getElementById("txtCustomer").focus();
		return false;	
	}
	
	divisi = document.getElementById("txtDivisi").value;	
	customer = document.getElementById("txtCustomer").value;
    self.location="<?php echo $pageEdit; ?>?op=1&customer=" + customer+ "&divisi=" + divisi; 
	//self.location="sales_pilih_order.php?customer=" + customer + "&divisi=" + divisi; 

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
		include "form_search_retur_jual.php";
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
