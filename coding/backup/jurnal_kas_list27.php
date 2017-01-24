<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "jurnal_kas_entry.php";
	$pageTitle = "List Jurnal Kas";
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);
		//$divisi = trim($_POST["txtDivisi"]);
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
	 
	$array2d[] = array("Kode Jurnal", "jurnal_code", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Tgl Jurnal", "jurnal_date", "left", "varchar", "10%", "notsum");	 
	$array2d[] = array("Perkiraan", "perkiraan_header_code", "left", "varchar", "10%", "notsum");	 
	$array2d[] = array("Status D/K", "c.Reff", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Jumlah", "jumlah", "right", "money", "10%", "notsum");
	$sql = "from trx_jurnal a ";
	$sql = $sql . "inner join mst_perkiraan b on a.perkiraan_header_code=b.perkiraan_code ";
	$sql = $sql . "inner join mst_reff c on a.status_debet_kredit = c.kodereff and tipereff=1 ";
	$sql = $sql . "where tipe_jurnal in (1, 2, 3) and jurnal_date between '$tgl1' and '$tgl2'"; 
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
