<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Faktur Penjualan Barang";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);
		$contact_code = trim($_POST["txtcontact_code"]);
		$sales_code = trim($_POST["txtsales_code"]);
		$wilayah_code = trim($_POST["txtwilayah_code"]);
		$divisi  = retrieveS($_POST["txtdivisi"]);
		
		$halaman = trim($_POST["txtHalaman"]);
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		$contact_code = "";
		$sales_code = "";
		$divisi  = "";
		$wilayah_code = "";
		$posisi = 0;
		$halaman = 1;
	} 
	
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe=3 order by contact_name"; 
    $rsCustomer = $oDB->ExecuteReader($sqlCmd); 
    
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe=4 order by contact_name"; 
    $rsKaryawan = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff"; 
    $rsdivisi = $oDB->ExecuteReader($sqlCmd);
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=27 order by reff"; 
    $rswilayah = $oDB->ExecuteReader($sqlCmd);
		
	$sql = "select a.*, b.contact_name as customer, b.alamat, c.contact_name as sales, f.reff as statusfaktur, g.total_retur from trx_master a ";
	$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code ";
	$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code ";
	$sql = $sql . "left join mst_reff f on a.stFaktur = f.kodereff and f.tipereff=28 ";
	
	$sql = $sql . "left join 
(
	select sum(ifnull(sisa,0)) as total_retur, no_reff
	from trx_master a 
	where a.transaksi_tipe=8 
	group by no_reff
)g on a.transaksi_kode = g.no_reff ";

	$sql = $sql . "where a.transaksi_tipe in (6, 7) ";
	$sql = $sql . "and a.transaksi_tgl between '$tgl1' and '$tgl2' ";  
	
	if ($contact_code != ""){
		$sql = $sql . "and a.contact_code = '$contact_code' ";  
	}
	if ($sales_code != ""){
		$sql = $sql . "and a.sales_code = '$sales_code' ";  
	}	
	
	if ($divisi != ""){
		$sql = $sql . "and a.kode_divisi= '$divisi' ";  
	}
	
	if ($wilayah_code != ""){
		$sql = $sql . "and a.kode_wilayah= '$wilayah_code' ";  
	}
	
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
	<tr class="font12Bold">
		<td><?php echo $pageTitle; ?></td>
	</tr> 
	<tr>
		<td>		
			<table >
				<tr class='font10black'>
					<td>Periode</td>
					<td>:</td>
					<td>
					<?php  
					echo getHiddenBox(1, "txtHalaman", $halaman);	
					echo getDatePicMand(1, "txtTgl1", $tgl1, ""); 
					?>
					 s/d 
					<?php  echo getDatePicMand(1, "txtTgl2", $tgl2, ""); ?> 
					</td>
				</tr>
                <tr class='font10black'>
                    <td>Divisi</td>
                    <td>:</td>
                    <td>
                    <?php  echo getComboBox(1, "txtdivisi", $divisi, $rsdivisi, ""); ?> 
                    </td>
                </tr>
				
				<tr class='font10black'>
					<td>Customer</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtcontact_code", $contact_code, $rsCustomer, ""); ?> 
					</td>
				</tr>
				<tr class='font10black'>
					<td>Sales</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtsales_code", $sales_code, $rsKaryawan, ""); ?>					
					</td>
				</tr>
				<tr class='font10black'>
					<td>Wilayah</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtwilayah_code", $wilayah_code, $rswilayah, ""); ?>					
					</td>
				</tr>
			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button" onClick="frmSubmit();" />
		&nbsp;
		<input type="button" name="btCetak" value="Cetak" class ="button" onclick="window.print();"/>&nbsp;
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
					<td>Tgl Faktur</td>
					<td>No Faktur</td>
                    <td>Divisi</td>
					<td>Customer</td>
					<td>Alamat</td>
					<td>Sales</td>
					<td>Sub Total</td> 
					<td>Disc</td>
					<td>PPN</td> 
					<td>Biaya Kirim</td>
					<td>Total</td> 
					<td>Retur</td>
					<td>Bayar</td> 
					<td>Piutang</td>
					<td>Ket</td>  
					<td>Status</td>
				</tr>
				<?php
				
				if ($numRows == 0)
				{
				?>
				<tr >
					<td colspan="16" bgcolor="white" align="center">Data tidak ada</td> 
				</tr>
				
				<?php
				}
				else
				{
					$i = 0;
					
					$sumSubTotal = 0;
					$sumDisc1 = 0; 
					$sumPPN = 0;
					$sumBiayaKirim = 0;
					$sumTotal = 0;
					$sumBayar = 0;
					$sumSisa = 0;
					$sumRetur = 0;
					
					while ($data = mysql_fetch_array($rs)) 
					{
						$i++;
						$nourut = $posisi + $i;
						
						$sumSubTotal = $sumSubTotal + $data["sub_total"];
						$sumDisc1 = $sumDisc1 + $data["disc_amount"]; 
						$sumPPN = $sumPPN + $data["ppn_amount"];
						$sumBiayaKirim = $sumBiayaKirim + $data["biaya_kirim"];
						$sumTotal = $sumTotal + $data["total"];
						$sumBayar = $sumBayar + $data["bayar"];
						$sumSisa = $sumSisa + $data["sisa"] - $data["total_retur"];
						$sumRetur = $sumRetur + $data["total_retur"];
					
						?>						
						<tr class='font10black' bgcolor='#ffffff'>
							<td><?php echo $nourut; ?></td>
							<td><?php echo $data["transaksi_tgl"] ?> </td>
							<td><?php echo $data["transaksi_kode"] ?> </td> 
                            <td><?php echo $data["kode_divisi"] ?> </td> 
							<td><?php echo $data["customer"]; ?> </td>
							<td><?php echo $data["alamat"]; ?> </td>
							<td><?php echo $data["sales"];?> </td>  
                            <td align="right"><?php echo setNumber($data["sub_total"]) ?> </td>
							<td align="right"><?php echo setNumber($data["disc_amount"]) ?> </td> 
                            <td align="right"><?php echo setNumber($data["ppn_amount"]) ?> </td> 
                            <td align="right"><?php echo setNumber($data["biaya_kirim"]) ?> </td> 
                            <td align="right"><?php echo setNumber($data["total"]) ?> </td> 
                            <td align="right"><?php echo setNumber($data["total_retur"]) ?> </td> 
							<td align="right"><?php echo setNumber($data["bayar"]) ?> </td> 
                            <td align="right"><?php echo setNumber($data["sisa"]- $data["total_retur"]) ?> </td> 
                            <td><?php echo $data["keterangan"] ?> </td>
							<td><?php echo $data["statusfaktur"] ?> </td>
                            
                            
						</tr>	
						<?php
					}	
					echo "<tr class='font10black' bgcolor='#ffffff'>";
					echo "<td align='right' colspan='7'>Total</td>";
					echo "<td align='right'><b>" . setNumber($sumSubTotal) . "</b></td>";
					echo "<td align='right'><b>" . setNumber($sumDisc1) . "</b></td>"; 
					echo "<td align='right'><b>" . setNumber($sumPPN) . "</b></td>";
					echo "<td align='right'><b>" . setNumber($sumBiayaKirim) . "</b></td>";
					echo "<td align='right'><b>" . setNumber($sumTotal) . "</b></td>";
					echo "<td align='right'><b>" . setNumber($sumRetur) . "</b></td>";
					echo "<td align='right'><b>" . setNumber($sumBayar) . "</b></td>";
					echo "<td align='right'><b>" . setNumber($sumSisa) . "</b></td>";
					echo "<td align='right' colspan=3>&nbsp;</td>";
					echo "</tr>";      
				}
				?>
			</table>
		</td>
	</tr>	
</table>

</form>
</body>
</html>

