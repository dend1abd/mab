<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe =2"; 
    $rsSupplier = $oDB->ExecuteReader($sqlCmd);
    
    $sqlCmd = "SELECT kodereff, reff FROM mst_reff where tipereff =8"; 
    $rsStatus = $oDB->ExecuteReader($sqlCmd);
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]); 
		$supplier = trim($_POST["txtSupplier"]); 
		$tipeLap = trim($_POST["txtTipeLap"]);
		
		if ($tipeLap == "1"){
			$sql = "select transaksi_kode, transaksi_tipe, transaksi_tgl, a.contact_code, sales_code, sub_total, sub_qty, disc_persen, disc_amount, ppn_persen, ppn_amount, total, bayar, sisa, keterangan, b.contact_name as supplier, c.contact_name as sales, stOrder, no_reff, a.no_invoice, a.tgl_invoice from trx_master a ";
			$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code and b.contact_tipe=2 ";
			$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code and c.contact_tipe=4 ";
			$sql = $sql . "where transaksi_tipe=2 ";
			$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'";
			if ($supplier != ""){
				$sql = $sql . "and a.contact_code='$supplier' ";
			} 

		}
		else{
			$sql = "select a.transaksi_kode, transaksi_tgl, a.contact_code, b.contact_name, a.sales_code, c.contact_name as sales, e.product_code, e.product_name, e.qty, e.harga_beli, e.disc_amount, e.sub_total, e.total, no_reff, e.ket_detail, a.no_invoice, a.tgl_invoice from trx_master a ";
			$sql = $sql . "inner join trx_detail e on a.transaksi_kode=e.transaksi_kode ";
			$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code and b.contact_tipe=2 ";
			$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code and c.contact_tipe=4 ";
			$sql = $sql . "where transaksi_tipe=2 ";
			$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'";
			if ($supplier != ""){
				$sql = $sql . "and a.contact_code='$supplier' ";
			} 

		}
		
		//if ($perkiraancode != "")
		//	$sql = $sql . " and kodeac = '$perkiraancode'";
		//echo $sql;
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs);
	}
	else
	{
		$numRow = 0;
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d"); 
		$supplier = "";
		$stOrder = "";
		$tipeLap = "1";
		$sql = "";
	} 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Lapora Pembelian</title>
</head>

<?php include("include/headerfile.php"); ?>
<Script Language="JavaScript">
<!--
	
function frmSubmit(){
	
	if (document.getElementById("txtTgl1").value == ""){
		alert("silahkan isi periode tanggal");
		document.getElementById("txtTgl1").focus();
	}
	
	if (document.getElementById("txtTgl2").value == ""){
		alert("silahkan isi periode tanggal");
		document.getElementById("txtTgl2").focus();
	}

	document.frmList.submit();
}
-->
</Script>


<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td class="font12Bold" style="height: 24px"> Laporan Pembelian</td>
	</tr> 
	<tr>
		<td style="height: 53px">		
			<table >
				<tr class="font10black">
					<td>Periode</td>
					<td>:</td>
					<td>
					<?php  echo getDatePic(1, "txtTgl1", $tgl1, ""); ?>
					 s/d 
					<?php  echo getDatePic(1, "txtTgl2", $tgl2, ""); ?>

					</td>
				</tr>
				<tr class="font10black"> 
					<td>Supplier</td>
					<td>:</td>
					<td>
						<?php  echo getComboBox(1, "txtSupplier", $supplier, $rsSupplier, ""); ?>
					</td>
				</tr>
				<tr class="font10black"> 
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
						<?php
							if ($tipeLap == "1") {
								$checked1 = " checked";
								$checked2 = " ";
							}
							else{
								$checked1 = " ";
								$checked2 = " checked";
							}
						?>
						<input type="radio" name="txtTipeLap" value="1" <?php echo $checked1; ?> />Summary&nbsp;&nbsp;&nbsp;
						<input type="radio" name="txtTipeLap" value="2" <?php echo $checked2; ?> />Detail
					</td>
				</tr>

			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button" onclick="frmSubmit()"/>&nbsp;
		<input type="button" name="btCetak" value="Cetak" class ="button" onclick="window.print();"/>&nbsp; 
		<input type="button" name="btToExcel" value="Save To Excel" class ="button"/>&nbsp; 
		<input type="button" name="btToPDF" value="Save To PDF" class ="button"/>&nbsp;  
		</td> 
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable" align="center">
					<td>No</td> 
					
					<?php
					if ($tipeLap == "1"){
						$colspan = 16;
					?>
					<td>Tgl Transaksi</td>
					<td>Kode Transaksi</td>
					<td>No Invoice</td>
					<td>Tgl Invoice</td>
					<td>Supplier</td>
					<td>Petugas</td>
					<td>Qty</td>
					<td>Sub Total</td>					
					<td>Disc</td>
					<td>PPN</td>
					<td>Total</td>
					<td>Bayar</td>
					<td>Hutang</td>
					<td>Keterangan</td>
					<td>No Order</td>
					<?php
					}else{
						$colspan = 15;
						echo "<td>Tgl Transaksi</td>";
						echo "<td>Kode Transaksi</td>";
						echo "<td>No Invoice</td>";
						echo "<td>Tgl Invoice</td>";
						echo "<td>Supplier</td>";
						echo "<td>Petugas</td>";
						echo "<td>Produk</td>";
						echo "<td>Qty</td>";
						echo "<td>Harga</td>";
						echo "<td>Sub Total</td>";
						echo "<td>Disc</td>";
						echo "<td>Total</td>";
						echo "<td>Ket</td>";
						echo "<td>No Order</td>";
					}
					?>
				</tr>
				<?php
				if (isset($_POST["txtTgl1"])){
					if ($numRows == 0)
					{
					?>
					<tr >
						<td class='font10black' colspan="<?php echo $colspan; ?>"  bgcolor="white" align="center">Data tidak ada</td> 
					</tr>
					
					<?php
					}
					else
					{
						$i = 0;
						
						$tSubTotal = 0;
						$tDisc = 0;
						$tPPN = 0;
						$tTotal = 0;
						$tUangMuka = 0;
						$tSisaBayar = 0;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							?>						
							<tr class='font10black' bgcolor='#ffffff'>
								<td><?php echo $i; ?></td>
								
								<?php
								if ($tipeLap == "1"){
								?>
								<td><?php echo $data[2] ?> </td>
								<td><?php echo $data[0] ?> </td>
								<td><?php $data["no_invoice"] ?> </td>
								<td><?php $data["tgl_invoice"] ?> </td>
								<td><?php echo $data[3] . "-" . $data["supplier"]; ?> 
								</td><td><?php echo $data[4] . "-" . $data["sales"];?> </td>
								<td align="right"><?php echo setNumber($data[6]) ?> </td>
								<td align="right"><?php echo setNumber($data[5]) ?> </td>
								<td align="right"><?php echo setNumber($data["disc_amount"]) ?> </td>
								<td align="right"><?php echo setNumber($data["ppn_amount"]) ?> </td>
								<td align="right"><?php echo setNumber($data["total"]) ?> </td>
								<td align="right"><?php echo setNumber($data["bayar"]) ?> </td>
								<td align="right"><?php echo setNumber($data["sisa"]) ?> </td>
								<td><?php echo $data["keterangan"] ?> </td>
								<td><?php echo $data["no_reff"] ?> </td> 
								<?php
									$tSubTotal = $tSubTotal + $data[5];
									$tDisc = $tDisc + $data["disc_amount"];
									$tPPN = $tPPN + $data["ppn_amount"];
									$tTotal = $tTotal + $data["total"];
									$tUangMuka = $tUangMuka + $data["bayar"];
									$tSisaBayar = $tSisaBayar + $data["sisa"];
								}
								else{
									echo "<td>" .$data["transaksi_tgl"]. "</td>";
									echo "<td>" .$data["transaksi_kode"]. "</td>";
									echo "<td>" .$data["no_invoice"]. "</td>";
									echo "<td>" .$data["tgl_invoice"]. "</td>";
									echo "<td>" .$data["contact_code"]. " - " .$data["contact_name"]. "</td>";
									echo "<td>" .$data["sales_code"]. " - " .$data["sales"]. "</td>";
									echo "<td>" .$data["product_code"]. " - " .$data["product_name"]. "</td>";
									echo "<td align='right'>" .setNumber($data["qty"]). "</td>";
									echo "<td align='right'>" .setNumber($data["harga_beli"]). "</td>";
									echo "<td align='right'>" .setNumber($data["sub_total"]). "</td>";
									echo "<td align='right'>" .setNumber($data["disc_amount"]). "</td>";
									echo "<td align='right'>" .setNumber($data["total"]). "</td>";
									echo "<td >" .$data["ket_detail"]. "</td>";
									echo "<td >" .$data["no_reff"]. "</td>";
									
									$tSubTotal = $tSubTotal + $data["sub_total"];
									$tDisc = $tDisc + $data["disc_amount"];
									$tTotal = $tTotal + $data["total"];								
						
								}	
								?>							
							</tr>
						<?php							
						}
						if ($tipeLap == "1"){
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td colspan='8' align='right'><b>Total</b></td>";
							echo "<td align='right'><b>" .setNumber($tSubTotal). "</b></td>";
							echo "<td align='right'><b>" .setNumber($tDisc). "</b></td>";
							echo "<td align='right'><b>" .setNumber($tPPN). "</b></td>";
							echo "<td align='right'><b>" .setNumber($tTotal). "</b></td>";
							echo "<td align='right'><b>" .setNumber($tUangMuka). "</b></td>";
							echo "<td align='right'><b>" .setNumber($tSisaBayar). "</b></td>";
							echo "<td colspan=2></td>";
							echo "</tr>";
						}
						else{
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td colspan='10' align='right'><b>Total</b></td>";
							echo "<td align='right'><b>" .setNumber($tSubTotal). "</b></td>";
							echo "<td align='right'><b>" .setNumber($tDisc). "</b></td>";
							echo "<td align='right'><b>" .setNumber($tTotal). "</b></td>";
							echo "<td colspan=2></td>";
							echo "</tr>";
						}
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
