<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Mutasi Barang";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
	
	//$_SESSION["param_jml_record_paging"] = 2;
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]); 
		$kelBarang = trim($_POST["txtKelBarang"]);
		$jenBarang = trim($_POST["txtJenBarang"]);
		$merBarang = trim($_POST["txtMerBarang"]);
		
		$halaman = trim($_POST["txtHalaman"]);
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
	}
	else
	{
		$numRow = 0;
		$tgl1 = date("Y-m-d"); 
		$tgl2 = date("Y-m-d"); 
		$kelBarang = "";
		$jenBarang = "";
		$merBarang = "";
		
		$posisi = 0;
		$halaman = 1;
	} 	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=16 order by reff"; 
	$rsKelBarang = $oDB->ExecuteReader($sqlCmd);
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=17 order by reff"; 
	$rsJenisBarang = $oDB->ExecuteReader($sqlCmd);
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=18 order by reff"; 
	$rsMerekBarang = $oDB->ExecuteReader($sqlCmd);
	
		 
	$sql = "select a.product_code, a.product_name, c.reff as merek, d.reff as kelompok, e.reff as jenis,
size1, size2, size3, size4, size5, size6, size7, size8,
sum(ifnull(b.qty, 0)) as sawal, 
sum(ifnull(b.qtysize1, 0)) as sawal1,
sum(ifnull(b.qtysize2, 0)) as sawal2,
sum(ifnull(b.qtysize3, 0)) as sawal3,
sum(ifnull(b.qtysize4, 0)) as sawal4,
sum(ifnull(b.qtysize5, 0)) as sawal5,
sum(ifnull(b.qtysize6, 0)) as sawal6,
sum(ifnull(b.qtysize7, 0)) as sawal7,
sum(ifnull(b.qtysize8, 0)) as sawal8,
sum(ifnull(f.qty_in, 0)) as masuk, 
sum(ifnull(f.qtysize1_in, 0)) as masuk1,
sum(ifnull(f.qtysize2_in, 0)) as masuk2,
sum(ifnull(f.qtysize3_in, 0)) as masuk3,
sum(ifnull(f.qtysize4_in, 0)) as masuk4,
sum(ifnull(f.qtysize5_in, 0)) as masuk5,
sum(ifnull(f.qtysize6_in, 0)) as masuk6,
sum(ifnull(f.qtysize7_in, 0)) as masuk7,
sum(ifnull(f.qtysize8_in, 0)) as masuk8,
sum(ifnull(f.qty_out, 0)) as keluar, 
sum(ifnull(f.qtysize1_out, 0)) as keluar1,
sum(ifnull(f.qtysize2_out, 0)) as keluar2,
sum(ifnull(f.qtysize3_out, 0)) as keluar3,
sum(ifnull(f.qtysize4_out, 0)) as keluar4,
sum(ifnull(f.qtysize5_out, 0)) as keluar5,
sum(ifnull(f.qtysize6_out, 0)) as keluar6,
sum(ifnull(f.qtysize7_out, 0)) as keluar7,
sum(ifnull(f.qtysize8_out, 0)) as keluar8,
sum(ifnull(b.qty, 0) + ifnull(f.qty_in, 0) - ifnull(f.qty_out, 0) ) as sakhir, 
sum(ifnull(b.qtysize1, 0) + ifnull(f.qtysize1_in, 0) - ifnull(f.qtysize1_out, 0) ) as sakhir1,
sum(ifnull(b.qtysize2, 0) + ifnull(f.qtysize2_in, 0) - ifnull(f.qtysize2_out, 0) ) as sakhir2,
sum(ifnull(b.qtysize3, 0) + ifnull(f.qtysize3_in, 0) - ifnull(f.qtysize3_out, 0) ) as sakhir3,
sum(ifnull(b.qtysize4, 0) + ifnull(f.qtysize4_in, 0) - ifnull(f.qtysize4_out, 0) ) as sakhir4,
sum(ifnull(b.qtysize5, 0) + ifnull(f.qtysize5_in, 0) - ifnull(f.qtysize5_out, 0) ) as sakhir5,
sum(ifnull(b.qtysize6, 0) + ifnull(f.qtysize6_in, 0) - ifnull(f.qtysize6_out, 0) ) as sakhir6,
sum(ifnull(b.qtysize7, 0) + ifnull(f.qtysize7_in, 0) - ifnull(f.qtysize7_out, 0) ) as sakhir7,
sum(ifnull(b.qtysize8, 0) + ifnull(f.qtysize8_in, 0) - ifnull(f.qtysize8_out, 0) ) as sakhir8   
from mst_product a
left join trx_persediaan b on a.product_code=b.product_code and  b.tgl_transaksi < '$tgl1'
left join mst_reff c on a.kode_merek=c.kodereff and c.tipereff=18
left join mst_reff d on a.kode_kelompok=d.kodereff and d.tipereff=16
left join mst_reff e on a.kode_jenis=e.kodereff and e.tipereff=17
left join trx_persediaan f on a.product_code=f.product_code and  f.tgl_transaksi between '$tgl1' and '$tgl2' ";

$sql = $sql . "where 1=1 ";
if ($merBarang != "") $sql = $sql . "and a.kode_merek='$merBarang' ";
if ($kelBarang != "") $sql = $sql . "and a.kode_kelompok='$kelBarang' ";
if ($jenBarang != "") $sql = $sql . "and a.kode_jenis='$jenBarang' "; 

$sql = $sql . "group by 
a.product_code, a.product_name, c.reff, d.reff, e.reff, 
size1, size2, size3, size4, size5, size6, size7, size8 ";

	$sql2 = $sql . " limit $posisi, " . $_SESSION["param_jml_record_paging"]; 
	
	$rs2 = $oDB->ExecuteReader($sql);	
	$jmlHalaman = ceil(mysql_num_rows($rs2) /$_SESSION["param_jml_record_paging"]);

	$rs = $oDB->ExecuteReader($sql2);
	$numRows = mysql_num_rows($rs);
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

function frmBrowse(){	
	if (document.getElementById("txtTgl1").value == ""){
		alert("silahkan isi periode tanggal");
		document.getElementById("txtTgl").focus();
		return false;
	}
	if (document.getElementById("txtTgl2").value == ""){
		alert("silahkan isi periode tanggal");
		document.getElementById("txtTgl2").focus();
		return false;
	}
	document.frmList.submit();
}

function frmSubmit(){	
	document.getElementById("txtHalaman").value = "1";
	frmBrowse();
}

function pageNoKlik(halaman){
	//alert(halaman);
	document.getElementById("txtHalaman").value = halaman;
	frmBrowse();
}

function link1(kodebarang){ 	
	tgl1 = document.getElementById("txtTgl1").value;
	tgl2 = document.getElementById("txtTgl2").value;	
	url = "mutasi_product_detail_report.php?kode=" +kodebarang+ "&tgl1=" +tgl1+ "&tgl2=" +tgl2
	
	lookupWindow(url, "mutasi_barang_detail_" + kodebarang)
	//alert(url);
}

-->
</Script>


<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td class="font12Bold" style="height: 24px"><?php echo $pageTitle; ?></td>
	</tr> 
	<tr>
		<td style="height: 53px">		
			<table >
				<tr class="font10black">
					<td>Periode</td>
					<td>:</td>
					<td>
					<?php  echo getDatePicMand(1, "txtTgl1", $tgl1, ""); ?>
					 s/d 
					<?php  
					echo getDatePicMand(1, "txtTgl2", $tgl2, ""); 
					echo getHiddenBox(1, "txtHalaman", $halaman);
					?> 
					</td>
				</tr>
				
				<tr class="font10black"> 
					<td>Kelompok Barang</td>
					<td>:</td>
					<td>
						<?php  echo getComboBoxEx(1, "txtKelBarang", $kelBarang, $rsKelBarang, "-- All --", ""); ?>
					</td>
				</tr>
				
				<tr class="font10black"> 
					<td>Jenis Barang</td>
					<td>:</td>
					<td>
						<?php  echo getComboBoxEx(1, "txtJenBarang", $jenBarang, $rsJenisBarang, "-- All --", ""); ?>
					</td>
				</tr>
				
				<tr class="font10black"> 
					<td>Merek Barang</td>
					<td>:</td>
					<td>
						<?php  echo getComboBoxEx(1, "txtMerBarang", $merBarang, $rsMerekBarang, "-- All --", ""); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button" onclick="frmSubmit()"/>&nbsp;
		<input type="button" name="btCetak" value="Cetak" class ="button" onclick="window.print();"/>         
		</td> 
	</tr>
    
    <tr>
		<td>  
        	<?php 
			if ($jmlHalaman > 1)
				echo "Page :";
			for($i=1; $i<$jmlHalaman; $i++){
				if($i != $halaman){
					echo "<a href='#' onClick='pageNoKlik($i)'>$i</a> | ";
				}
				else{
					echo "<b>$i</b> | ";
				}
			}
		?>
		</td> 
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable" align="center">
					<td>No</td> 
					<td>Kode Barang</td>
					<td>Nama Barang</td>
					<td>Kelompok Barang</td>
					<td>Jenis Barang</td>
					<td>Merek Barang</td>
                    <td>Saldo Awal</td>
					<td>Beli</td>
					<td>Jual</td>
					<td>Saldo Akhir</td>
				</tr>

				<?php 
				
					$colspan = 8;
					if ($numRows == 0)
					{
					?>
					<tr >
						<td class='font10black' colspan="<?php echo $colspan; ?>"  bgcolor="white" align="center">Data not found</td> 
					</tr>
					
					<?php
					}
					else
					{
						$i = 0; 
						
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++; 	
							$nourut = $posisi + $i;
							
							$sawal = "<br />";
if ($data["size1"] != "") $sawal = $sawal .  $data["size1"] . "/" .$data["sawal1"]. "; ";
							if ($data["size2"] != "") $sawal = $sawal .  $data["size2"] . "/" .$data["sawal2"]. "; ";
							if ($data["size3"] != "") $sawal = $sawal .  $data["size3"] . "/" .$data["sawal3"]. "; ";
							if ($data["size4"] != "") $sawal = $sawal .  $data["size4"] . "/" .$data["sawal4"]. "; ";
							if ($data["size5"] != "") $sawal = $sawal .  $data["size5"] . "/" .$data["sawal5"]. "; ";
							if ($data["size6"] != "") $sawal = $sawal .  $data["size6"] . "/" .$data["sawal6"]. "; ";
							if ($data["size7"] != "") $sawal = $sawal .  $data["size7"] . "/" .$data["sawal7"]. "; ";
							if ($data["size8"] != "") $sawal = $sawal .  $data["size8"] . "/" .$data["sawal8"]. "; ";
							
							$masuk = "<br />";
if ($data["size1"] != "") $masuk = $masuk .  $data["size1"] . "/" .$data["masuk1"]. "; ";
							if ($data["size2"] != "") $masuk = $masuk .  $data["size2"] . "/" .$data["masuk2"]. "; ";
							if ($data["size3"] != "") $masuk = $masuk .  $data["size3"] . "/" .$data["masuk3"]. "; ";
							if ($data["size4"] != "") $masuk = $masuk .  $data["size4"] . "/" .$data["masuk4"]. "; ";
							if ($data["size5"] != "") $masuk = $masuk .  $data["size5"] . "/" .$data["masuk5"]. "; ";
							if ($data["size6"] != "") $masuk = $masuk .  $data["size6"] . "/" .$data["masuk6"]. "; ";
							if ($data["size7"] != "") $masuk = $masuk .  $data["size7"] . "/" .$data["masuk7"]. "; ";
							if ($data["size8"] != "") $masuk = $masuk .  $data["size8"] . "/" .$data["masuk8"]. "; ";
							
							$keluar = "<br />";
if ($data["size1"] != "") $keluar = $keluar .  $data["size1"] . "/" .$data["keluar1"]. "; ";
							if ($data["size2"] != "") $keluar = $keluar .  $data["size2"] . "/" .$data["keluar2"]. "; ";
							if ($data["size3"] != "") $keluar = $keluar .  $data["size3"] . "/" .$data["keluar3"]. "; ";
							if ($data["size4"] != "") $keluar = $keluar .  $data["size4"] . "/" .$data["keluar4"]. "; ";
							if ($data["size5"] != "") $keluar = $keluar .  $data["size5"] . "/" .$data["keluar5"]. "; ";
							if ($data["size6"] != "") $keluar = $keluar .  $data["size6"] . "/" .$data["keluar6"]. "; ";
							if ($data["size7"] != "") $keluar = $keluar .  $data["size7"] . "/" .$data["keluar7"]. "; ";
							if ($data["size8"] != "") $keluar = $keluar .  $data["size8"] . "/" .$data["keluar8"]. "; ";
							
							$sakhir = "<br />";
if ($data["size1"] != "") $sakhir = $sakhir .  $data["size1"] . "/" .$data["sakhir1"]. "; ";
							if ($data["size2"] != "") $sakhir = $sakhir .  $data["size2"] . "/" .$data["sakhir2"]. "; ";
							if ($data["size3"] != "") $sakhir = $sakhir .  $data["size3"] . "/" .$data["sakhir3"]. "; ";
							if ($data["size4"] != "") $sakhir = $sakhir .  $data["size4"] . "/" .$data["sakhir4"]. "; ";
							if ($data["size5"] != "") $sakhir = $sakhir .  $data["size5"] . "/" .$data["sakhir5"]. "; ";
							if ($data["size6"] != "") $sakhir = $sakhir .  $data["size6"] . "/" .$data["sakhir6"]. "; ";
							if ($data["size7"] != "") $sakhir = $sakhir .  $data["size7"] . "/" .$data["sakhir7"]. "; ";
							if ($data["size8"] != "") $sakhir = $sakhir .  $data["size8"] . "/" .$data["sakhir8"]. "; ";
							
							$link = "<a href='#' onClick=\"link1('" .$data["product_code"]. "')\">" .$data["product_code"]. "</a>";
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td valign='top'>$nourut</td>";
							echo "<td valign='top'>" .$link. "</td>";
							echo "<td valign='top'>" .$data["product_name"]. "</td>";
							echo "<td valign='top'>".$data["kelompok"]."</td>";
							echo "<td valign='top'>".$data["jenis"]."</td>";
							echo "<td valign='top'>".$data["merek"]."</td>";
							echo "<td align='right'><b>" .setNumber($data["sawal"]). "</b>" . $sawal . "</td>"; 
							echo "<td align='right'><b>" .setNumber($data["masuk"]). "</b>" . $masuk . "</td>";  
							echo "<td align='right'><b>" .setNumber($data["keluar"]). "</b>" . $keluar . "</td>";
							echo "<td align='right'><b>" .setNumber($data["sakhir"]). "</b>" . $sakhir . "</td>";
							
							echo "</tr>";						
						}
					} 
				?>
			</table>
		</td>
	</tr>	
</table>

</form>

</body>

</html>
