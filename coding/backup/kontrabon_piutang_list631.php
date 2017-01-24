<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "kontrabon_piutang_entry.php";
	$pageTitle = "List Tagihan Piutang";
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);
		//$customer = trim($_POST["txtCustomer"]);
		$divisi = trim($_POST["txtDivisi"]);
		$sales = trim($_POST["txtSales"]);
		$wilayah = trim($_POST["txtKodeWilayah"]);
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		//$customer = "";
		$divisi = "";
		$sales = "";
		$wilayah = "";
	}	
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);	
	 
	$array2d[] = array("No Tagihan", "transaksi_kode", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Tanggal", "transaksi_tgl", "left", "varchar", "10%", "notsum");	 
	$array2d[] = array("Kode Divisi", "kode_divisi", "left", "varchar", "10%", "notsum");	 
	$array2d[] = array("Kode Wilayah", "a.kode_wilayah", "left", "varchar", "10%", "notsum");	 
	$array2d[] = array("Sales", "c.contact_name as sales", "left", "varchar", "10%", "notsum");	 
	$array2d[] = array("Supir", "b.contact_name as Customer", "left", "varchar", "10%", "notsum");	 
	$array2d[] = array("No Mobil", "no_mobil", "left", "varchar", "10%", "notsum");	 
	$sql = "from trx_master a ";
	$sql = $sql . "left join mst_contact b on a.supir_code=b.contact_code "; 
	$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code "; 
	$sql = $sql . "where transaksi_tipe=16 ";
	$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'"; 
	
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe = 4 order by contact_name"; 
    $rsSales = $oDB->ExecuteReader($sqlCmd);
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=27 order by reff"; 
    $rsKodeWilayah = $oDB->ExecuteReader($sqlCmd);
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
tgl1 = document.getElementById("txtTgl1").value;	
tgl2 = document.getElementById("txtTgl2").value;
sales = document.getElementById("txtSales").value;
wilayah = document.getElementById("txtKodeWilayah").value;

    self.location="<?php echo $pageEdit; ?>?op=1&divisi=" + divisi+"&tgl1=" + tgl1+"&tgl2=" + tgl2+"&sales=" + sales+"&wilayah=" + wilayah; 
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
		include "form_search_kontrabon.php";
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
