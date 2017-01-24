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
	
		 
	$sql = "
select a.product_code, a.product_name, h.reff as merek, i.reff as kelompok, j.reff as jenis
, size1, size2, size3, size4, size5, size6, size7, size8
, ifnull(b.qty, 0) - ifnull(c.qty, 0) as awal
, ifnull(b.qty_size1, 0) - ifnull(c.qty_size1, 0) as awal_size1
, ifnull(b.qty_size2, 0) - ifnull(c.qty_size2, 0) as awal_size2
, ifnull(b.qty_size3, 0) - ifnull(c.qty_size3, 0) as awal_size3
, ifnull(b.qty_size4, 0) - ifnull(c.qty_size4, 0) as awal_size4
, ifnull(b.qty_size5, 0) - ifnull(c.qty_size5, 0) as awal_size5
, ifnull(b.qty_size6, 0) - ifnull(c.qty_size6, 0) as awal_size6
, ifnull(b.qty_size7, 0) - ifnull(c.qty_size7, 0) as awal_size7
, ifnull(b.qty_size8, 0) - ifnull(c.qty_size8, 0) as awal_size8

, ifnull(d.qty, 0) as trx_in
, ifnull(d.qty_size1, 0) as trx_in_size1
, ifnull(d.qty_size2, 0) as trx_in_size2
, ifnull(d.qty_size3, 0) as trx_in_size3
, ifnull(d.qty_size4, 0) as trx_in_size4
, ifnull(d.qty_size5, 0) as trx_in_size5
, ifnull(d.qty_size6, 0) as trx_in_size6
, ifnull(d.qty_size7, 0) as trx_in_size7
, ifnull(d.qty_size8, 0) as trx_in_size8

, ifnull(e.qty, 0) as trx_out
, ifnull(e.qty_size1, 0) as trx_out_size1
, ifnull(e.qty_size2, 0) as trx_out_size2
, ifnull(e.qty_size3, 0) as trx_out_size3
, ifnull(e.qty_size4, 0) as trx_out_size4
, ifnull(e.qty_size5, 0) as trx_out_size5
, ifnull(e.qty_size6, 0) as trx_out_size6
, ifnull(e.qty_size7, 0) as trx_out_size7
, ifnull(e.qty_size8, 0) as trx_out_size8

, ifnull(b.qty, 0) - ifnull(c.qty, 0) + ifnull(d.qty, 0) - ifnull(e.qty, 0) as akhir

, ifnull(b.qty_size1, 0) - ifnull(c.qty_size1, 0) + ifnull(d.qty_size1, 0) - ifnull(e.qty_size1, 0) as akhir_size1
, ifnull(b.qty_size2, 0) - ifnull(c.qty_size2, 0) + ifnull(d.qty_size2, 0) - ifnull(e.qty_size2, 0) as akhir_size2
, ifnull(b.qty_size3, 0) - ifnull(c.qty_size3, 0) + ifnull(d.qty_size3, 0) - ifnull(e.qty_size3, 0) as akhir_size3
, ifnull(b.qty_size4, 0) - ifnull(c.qty_size4, 0) + ifnull(d.qty_size4, 0) - ifnull(e.qty_size4, 0) as akhir_size4
, ifnull(b.qty_size5, 0) - ifnull(c.qty_size5, 0) + ifnull(d.qty_size5, 0) - ifnull(e.qty_size5, 0) as akhir_size5
, ifnull(b.qty_size6, 0) - ifnull(c.qty_size6, 0) + ifnull(d.qty_size6, 0) - ifnull(e.qty_size6, 0) as akhir_size6
, ifnull(b.qty_size7, 0) - ifnull(c.qty_size7, 0) + ifnull(d.qty_size7, 0) - ifnull(e.qty_size7, 0) as akhir_size7
, ifnull(b.qty_size8, 0) - ifnull(c.qty_size8, 0) + ifnull(d.qty_size8, 0) - ifnull(e.qty_size8, 0) as akhir_size8

 from mst_product a

left join 
(select product_code, ifnull(sum(ifnull(qty,0)),0) as qty
	, ifnull(sum(ifnull(qty_size1,0)),0) as qty_size1
	, ifnull(sum(ifnull(qty_size2,0)),0) as qty_size2
	, ifnull(sum(ifnull(qty_size3,0)),0) as qty_size3
	, ifnull(sum(ifnull(qty_size4,0)),0) as qty_size4
	, ifnull(sum(ifnull(qty_size5,0)),0) as qty_size5
	, ifnull(sum(ifnull(qty_size6,0)),0) as qty_size6
	, ifnull(sum(ifnull(qty_size7,0)),0) as qty_size7
	, ifnull(sum(ifnull(qty_size8,0)),0) as qty_size8
	from trx_detail td1 
	inner join trx_master tm1 
	on td1.transaksi_kode = tm1.transaksi_kode and tm1.transaksi_tipe in (9,10, 13)
	and transaksi_tgl < '$tgl1'
	group by product_code	
)b on a.product_code=b.product_code


left join 
(select product_code, ifnull(sum(ifnull(qty,0)),0) as qty
	, ifnull(sum(ifnull(qty_size1,0)),0) as qty_size1
	, ifnull(sum(ifnull(qty_size2,0)),0) as qty_size2
	, ifnull(sum(ifnull(qty_size3,0)),0) as qty_size3
	, ifnull(sum(ifnull(qty_size4,0)),0) as qty_size4
	, ifnull(sum(ifnull(qty_size5,0)),0) as qty_size5
	, ifnull(sum(ifnull(qty_size6,0)),0) as qty_size6
	, ifnull(sum(ifnull(qty_size7,0)),0) as qty_size7
	, ifnull(sum(ifnull(qty_size8,0)),0) as qty_size8
	from trx_detail td1 
	inner join trx_master tm1 
	on td1.transaksi_kode = tm1.transaksi_kode and tm1.transaksi_tipe in (11,12, 14)
	and transaksi_tgl < '$tgl1'
	group by product_code	
)c on a.product_code=c.product_code


left join 
(select product_code, ifnull(sum(ifnull(qty,0)),0) as qty
	, ifnull(sum(ifnull(qty_size1,0)),0) as qty_size1
	, ifnull(sum(ifnull(qty_size2,0)),0) as qty_size2
	, ifnull(sum(ifnull(qty_size3,0)),0) as qty_size3
	, ifnull(sum(ifnull(qty_size4,0)),0) as qty_size4
	, ifnull(sum(ifnull(qty_size5,0)),0) as qty_size5
	, ifnull(sum(ifnull(qty_size6,0)),0) as qty_size6
	, ifnull(sum(ifnull(qty_size7,0)),0) as qty_size7
	, ifnull(sum(ifnull(qty_size8,0)),0) as qty_size8
	from trx_detail td1 
	inner join trx_master tm1 
	on td1.transaksi_kode = tm1.transaksi_kode and tm1.transaksi_tipe in (9,10, 13)
	and transaksi_tgl between '$tgl1' and '$tgl2'
	group by product_code	
)d on a.product_code=d.product_code


left join 
(select product_code, ifnull(sum(ifnull(qty,0)),0) as qty
	, ifnull(sum(ifnull(qty_size1,0)),0) as qty_size1
	, ifnull(sum(ifnull(qty_size2,0)),0) as qty_size2
	, ifnull(sum(ifnull(qty_size3,0)),0) as qty_size3
	, ifnull(sum(ifnull(qty_size4,0)),0) as qty_size4
	, ifnull(sum(ifnull(qty_size5,0)),0) as qty_size5
	, ifnull(sum(ifnull(qty_size6,0)),0) as qty_size6
	, ifnull(sum(ifnull(qty_size7,0)),0) as qty_size7
	, ifnull(sum(ifnull(qty_size8,0)),0) as qty_size8
	from trx_detail td1 
	inner join trx_master tm1 
	on td1.transaksi_kode = tm1.transaksi_kode and tm1.transaksi_tipe in (11,12, 14)
	and transaksi_tgl between '$tgl1' and '$tgl2'
	group by product_code	
)e on a.product_code=e.product_code 
left join mst_reff h on a.kode_merek=h.kodereff and h.tipereff=18
left join mst_reff i on a.kode_kelompok=i.kodereff and i.tipereff=16
left join mst_reff j on a.kode_jenis=j.kodereff and j.tipereff=17 ";

$sql = $sql . "where 1=1 ";
if ($merBarang != "") $sql = $sql . "and a.kode_merek='$merBarang' ";
if ($kelBarang != "") $sql = $sql . "and a.kode_kelompok='$kelBarang' ";
if ($jenBarang != "") $sql = $sql . "and a.kode_jenis='$jenBarang' "; 

//eror($sql);
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
					<td>Terima</td>
					<td>Keluar</td>
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
if ($data["size1"] != "") $sawal = $sawal .  $data["size1"] . "/" .$data["awal_size1"]. "; ";
							if ($data["size2"] != "") $sawal = $sawal .  $data["size2"] . "/" .$data["awal_size2"]. "; ";
							if ($data["size3"] != "") $sawal = $sawal .  $data["size3"] . "/" .$data["awal_size3"]. "; ";
							if ($data["size4"] != "") $sawal = $sawal .  $data["size4"] . "/" .$data["awal_size4"]. "; ";
							if ($data["size5"] != "") $sawal = $sawal .  $data["size5"] . "/" .$data["awal_size5"]. "; ";
							if ($data["size6"] != "") $sawal = $sawal .  $data["size6"] . "/" .$data["awal_size6"]. "; ";
							if ($data["size7"] != "") $sawal = $sawal .  $data["size7"] . "/" .$data["awal_size7"]. "; ";
							if ($data["size8"] != "") $sawal = $sawal .  $data["size8"] . "/" .$data["awal_size8"]. "; ";
							
							$masuk = "<br />";
if ($data["size1"] != "") $masuk = $masuk .  $data["size1"] . "/" .$data["trx_in_size1"]. "; ";
							if ($data["size2"] != "") $masuk = $masuk .  $data["size2"] . "/" .$data["trx_in_size2"]. "; ";
							if ($data["size3"] != "") $masuk = $masuk .  $data["size3"] . "/" .$data["trx_in_size3"]. "; ";
							if ($data["size4"] != "") $masuk = $masuk .  $data["size4"] . "/" .$data["trx_in_size4"]. "; ";
							if ($data["size5"] != "") $masuk = $masuk .  $data["size5"] . "/" .$data["trx_in_size5"]. "; ";
							if ($data["size6"] != "") $masuk = $masuk .  $data["size6"] . "/" .$data["trx_in_size6"]. "; ";
							if ($data["size7"] != "") $masuk = $masuk .  $data["size7"] . "/" .$data["trx_in_size7"]. "; ";
							if ($data["size8"] != "") $masuk = $masuk .  $data["size8"] . "/" .$data["trx_in_size8"]. "; ";
							
							$keluar = "<br />";
if ($data["size1"] != "") $keluar = $keluar .  $data["size1"] . "/" .$data["trx_out_size1"]. "; ";
							if ($data["size2"] != "") $keluar = $keluar .  $data["size2"] . "/" .$data["trx_out_size2"]. "; ";
							if ($data["size3"] != "") $keluar = $keluar .  $data["size3"] . "/" .$data["trx_out_size3"]. "; ";
							if ($data["size4"] != "") $keluar = $keluar .  $data["size4"] . "/" .$data["trx_out_size4"]. "; ";
							if ($data["size5"] != "") $keluar = $keluar .  $data["size5"] . "/" .$data["trx_out_size5"]. "; ";
							if ($data["size6"] != "") $keluar = $keluar .  $data["size6"] . "/" .$data["trx_out_size6"]. "; ";
							if ($data["size7"] != "") $keluar = $keluar .  $data["size7"] . "/" .$data["trx_out_size7"]. "; ";
							if ($data["size8"] != "") $keluar = $keluar .  $data["size8"] . "/" .$data["trx_out_size8"]. "; ";
							
							$sakhir = "<br />";
if ($data["size1"] != "") $sakhir = $sakhir .  $data["size1"] . "/" .$data["akhir_size1"]. "; ";
							if ($data["size2"] != "") $sakhir = $sakhir .  $data["size2"] . "/" .$data["akhir_size2"]. "; ";
							if ($data["size3"] != "") $sakhir = $sakhir .  $data["size3"] . "/" .$data["akhir_size3"]. "; ";
							if ($data["size4"] != "") $sakhir = $sakhir .  $data["size4"] . "/" .$data["akhir_size4"]. "; ";
							if ($data["size5"] != "") $sakhir = $sakhir .  $data["size5"] . "/" .$data["akhir_size5"]. "; ";
							if ($data["size6"] != "") $sakhir = $sakhir .  $data["size6"] . "/" .$data["akhir_size6"]. "; ";
							if ($data["size7"] != "") $sakhir = $sakhir .  $data["size7"] . "/" .$data["akhir_size7"]. "; ";
							if ($data["size8"] != "") $sakhir = $sakhir .  $data["size8"] . "/" .$data["akhir_size8"]. "; ";
							
							$link = "<a href='#' onClick=\"link1('" .$data["product_code"]. "')\">" .$data["product_code"]. "</a>";
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td valign='top'>$nourut</td>";
							echo "<td valign='top'>" .$link. "</td>";
							echo "<td valign='top'>" .$data["product_name"]. "</td>";
							echo "<td valign='top'>".$data["kelompok"]."</td>";
							echo "<td valign='top'>".$data["jenis"]."</td>";
							echo "<td valign='top'>".$data["merek"]."</td>";
							echo "<td align='right'><b>" .setNumber($data["awal"]). "</b>" . $sawal . "</td>"; 
							echo "<td align='right'><b>" .setNumber($data["trx_in"]). "</b>" . $masuk . "</td>";  
							echo "<td align='right'><b>" .setNumber($data["trx_out"]). "</b>" . $keluar . "</td>";
							echo "<td align='right'><b>" .setNumber($data["akhir"]). "</b>" . $sakhir . "</td>";
							
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
