<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe in (2, 3)"; 
    $rsSupplier = $oDB->ExecuteReader($sqlCmd);
    
    $sqlCmd = "SELECT kodereff, reff FROM mst_reff where tipereff = 13"; 
    $rsCaraBayar = $oDB->ExecuteReader($sqlCmd);
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]); 
		$supplier = trim($_POST["txtSupplier"]); 
		$cara_bayar = trim($_POST["txtcara_bayar"]);
		
		
		$sql = "select a.transaksi_kode, transaksi_tgl, a.bayar, keterangan,  a.contact_code, b.contact_name as supplier, e.cara_bayar, e.perkiraan_code, e.perkiraan_name, e.jumlah, e.no_reff, e.tgl_reff, e.ket_reff, c.reff from trx_master a ";
		$sql = $sql . "inner join trx_bayar e on a.transaksi_kode=e.transaksi_kode ";
		$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code ";
		$sql = $sql . "left join mst_reff c on e.cara_bayar=c.kodereff and tipereff=13";
		$sql = $sql . "where transaksi_tipe=10 ";
		$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'";
		if ($supplier != ""){
			$sql = $sql . "and a.contact_code='$supplier' ";
		} 
		
		if ($cara_bayar != ""){
			$sql = $sql . "and e.cara_bayar='$cara_bayar' ";
		} 
			
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs);
		
		eror($sql);
	}
	else
	{
		$numRow = 0;
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d"); 
		$supplier = "";
		$stOrder = "";
		$cara_bayar = "";
		$sql = "";
	} 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Lapora Penjualan</title>
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
		<td class="font12Bold" style="height: 24px"> Laporan Pembayaran Piutang</td>
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
					<td>Dari</td>
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
							if ($cara_bayar == "1") {
								$checked1 = " checked";
								$checked2 = " ";
							}
							else{
								$checked1 = " ";
								$checked2 = " checked";
							}
						?>
						<input type="radio" name="txtcara_bayar" value="1" <?php echo $checked1; ?> />Summary&nbsp;&nbsp;&nbsp;
						<input type="radio" name="txtcara_bayar" value="2" <?php echo $checked2; ?> />Detail
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
					if ($cara_bayar == "1"){
						$colspan = 6;
					?>
					<td>Tanggal</td>
					<td>Kode Transaksi</td>					
					<td>Dari</td>
					<td>Jumlah</td>
					<td>Keterangan</td>
					<?php
					}else{
						$colspan = 9;
						echo "<td>Tanggal</td>";
						echo "<td>Kode Transaksi</td>";
						echo "<td>Dari</td>";
						echo "<td>No Invoice</td>";
						echo "<td>Tgl Invoice</td>";
						echo "<td>Amount Invoice</td>";
						echo "<td>Jml Bayar</td>";
						echo "<td>Ket Bayar</td>";
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
 
						$tTotal = 0;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							?>						
							<tr class='font10black' bgcolor='#ffffff'>
								<td><?php echo $i; ?></td>
								
								<?php
								if ($cara_bayar == "1"){
								?>
								<td><?php echo $data["transaksi_tgl"] ?> </td>
								<td><?php echo $data["transaksi_kode"] ?> </td>
								<td><?php echo $data["contact_code"] . "-" . $data["supplier"]; ?>  </td>
								<td align="right"><?php echo setNumber($data["bayar"]) ?> </td>
								<td><?php echo $data["keterangan"] ?> </td>
								<?php
									$tTotal = $tTotal + $data["bayar"];
								}
								else{
									echo "<td>" .$data["transaksi_tgl"]. "</td>";
									echo "<td>" .$data["transaksi_kode"]. "</td>";
									echo "<td>" .$data["contact_code"]. " - " .$data["supplier"]. "</td>";
									echo "<td >" .$data["no_invoice"]. "</td>";
									echo "<td >" .$data["tgl_invoice"]. "</td>"; 
									echo "<td align='right'>" .setNumber($data["jml_invoice"]). "</td>";
									echo "<td align='right'>" .setNumber($data["jml_bayar"]). "</td>";
									echo "<td >" .$data["ket_bayar"]. "</td>";
									$tTotal = $tTotal + $data["jml_bayar"];								
						
								}	
								?>							
							</tr>
						<?php							
						}
						if ($cara_bayar == "1"){
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td colspan='4' align='right'><b>Total</b></td>";
							echo "<td align='right'><b>" .setNumber($tTotal). "</b></td>";
							echo "<td ></td>";
							echo "</tr>";
						}
						else{
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td colspan='7' align='right'><b>Total</b></td>";
							echo "<td align='right'><b>" .setNumber($tTotal). "</b></td>";
							echo "<td ></td>";
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
