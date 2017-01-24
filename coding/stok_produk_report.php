<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Stok Barang";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
	
	//$_SESSION["param_jml_record_paging"] = 2;
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$tgl = trim($_POST["txtTgl"]);  
		$kelBarang = trim($_POST["txtKelBarang"]);
		$jenBarang = trim($_POST["txtJenBarang"]);
		$merBarang = trim($_POST["txtMerBarang"]);
		
		$halaman = trim($_POST["txtHalaman"]);
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
	}
	else
	{
		$numRow = 0;
		$tgl = date("Y-m-d"); 
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
, ifnull(b.qty, 0) - ifnull(c.qty, 0) as stok
, ifnull(b.qty_size1, 0) - ifnull(c.qty_size1, 0) as stok1
, ifnull(b.qty_size2, 0) - ifnull(c.qty_size2, 0) as stok2
, ifnull(b.qty_size3, 0) - ifnull(c.qty_size3, 0) as stok3
, ifnull(b.qty_size4, 0) - ifnull(c.qty_size4, 0) as stok4
, ifnull(b.qty_size5, 0) - ifnull(c.qty_size5, 0) as stok5
, ifnull(b.qty_size6, 0) - ifnull(c.qty_size6, 0) as stok6
, ifnull(b.qty_size7, 0) - ifnull(c.qty_size7, 0) as stok7
, ifnull(b.qty_size8, 0) - ifnull(c.qty_size8, 0) as stok8

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
	and transaksi_tgl < '$tgl'
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
	and transaksi_tgl < '$tgl'
	group by product_code	
)c on a.product_code=c.product_code

left join mst_reff h on a.kode_merek=h.kodereff and h.tipereff=18
left join mst_reff i on a.kode_kelompok=i.kodereff and i.tipereff=16
left join mst_reff j on a.kode_jenis=j.kodereff and j.tipereff=17 
where 1=1 ";

if ($merBarang != "") $sql = $sql . "and a.kode_merek='$merBarang' ";
if ($kelBarang != "") $sql = $sql . "and a.kode_kelompok='$kelBarang' ";
if ($jenBarang != "") $sql = $sql . "and a.kode_jenis='$jenBarang' "; 

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
	if (document.getElementById("txtTgl").value == ""){
		alert("silahkan isi tanggal stok");
		document.getElementById("txtTgl").focus();
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
					<td>Stok Per Tanggal</td>
					<td>:</td>
					<td>
					<?php  
					echo getHiddenBox(1, "txtHalaman", $halaman);	
					echo getDatePicMand(1, "txtTgl", $tgl, ""); ?> 
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
					<td>Stok</td>
					<td>Stok per Size</td>
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
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td>$nourut</td>";
							echo "<td>" .$data["product_code"]. "</td>";
							echo "<td>" .$data["product_name"]. "</td>";
							echo "<td>".$data["kelompok"]."</td>";
							echo "<td>".$data["jenis"]."</td>";
							echo "<td>".$data["merek"]."</td>";
							echo "<td align='right'>".setNumber($data["stok"])."</td>"; 
							
							echo "<td>";
							if ($data["size1"] != "") echo $data["size1"] . "/" .$data["stok1"]. "; ";
							if ($data["size2"] != "") echo $data["size2"] . "/" .$data["stok2"]. "; ";
							if ($data["size3"] != "") echo $data["size3"] . "/" .$data["stok3"]. "; ";
							if ($data["size4"] != "") echo $data["size4"] . "/" .$data["stok4"]. "; ";
							if ($data["size5"] != "") echo $data["size5"] . "/" .$data["stok5"]. "; ";
							if ($data["size6"] != "") echo $data["size6"] . "/" .$data["stok6"]. "; ";
							if ($data["size7"] != "") echo $data["size7"] . "/" .$data["stok7"]. "; ";
							if ($data["size8"] != "") echo $data["size8"] . "/" .$data["stok8"]. "; ";
							echo "</td>";
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
