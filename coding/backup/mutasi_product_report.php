<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Mutasi Barang Detail";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe =5"; 
    $rsgudang = $oDB->ExecuteReader($sqlCmd); 
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]); 
		$barang= trim($_POST["txtbarang"]);  
		
		 
		$sql = "select * from trx_persediaan ";
		//$sql = $sql . "inner join trx_detail e on a.transaksi_kode=e.transaksi_kode ";
		$sql = $sql . "where product_code='$barang' ";
		$sql = $sql . "and tgl_transaksi between '$tgl1' and '$tgl2'";

			
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
		$barang= "";
	} 
	
	$sqlCmd = "SELECT product_code, CONCAT(product_code,' - ', product_name) FROM mst_product"; 
    $rsBarang = $oDB->ExecuteReader($sqlCmd);
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
	
function frmSubmit(){
	
	if (document.getElementById("txtTgl1").value == ""){
		alert("silahkan isi periode tanggal");
		document.getElementById("txtTgl1").focus();
		return false;
	}
	
	if (document.getElementById("txtTgl2").value == ""){
		alert("silahkan isi periode tanggal");
		document.getElementById("txtTgl2").focus();
		return false;
	}
	
	if (document.getElementById("txtbarang").value == ""){
		alert("silahkan isi barang");
		document.getElementById("txtbarang").focus();
		return false;
	}

	document.frmList.submit();
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
					<?php  echo getDatePicMand(1, "txtTgl2", $tgl2, ""); ?>

					</td>
				</tr>
				<tr class="font10black"> 
					<td>Nama Barang</td>
					<td>:</td>
					<td>
						<?php  echo getComboBox(1, "txtbarang", $barang, $rsBarang, ""); ?>
					</td>
				</tr>

			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button" onclick="frmSubmit()"/>&nbsp;
		<input type="button" name="btCetak" value="Cetak" class ="button" onclick="window.print();"/>&nbsp; 
		<!--
		<input type="button" name="btToExcel" value="Save To Excel" class ="button"/>&nbsp; 
		<input type="button" name="btToPDF" value="Save To PDF" class ="button"/>&nbsp;  -->
		</td> 
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable" align="center">
					<td>No</td> 
					<td>Barang</td> 
					<td>Tanggal</td>
					<td>Kode Transaksi</td>
					<td>Ket</td>
					<td>Masuk</td>
					<td>Keluar</td>
					<td>Saldo</td>
				</tr>

				<?php
				if (isset($_POST["txtTgl1"])){
				
					$sql = "select IFNULL(sum(qty_in - qty_out),0) from trx_persediaan ";					
					$sql = $sql . "where product_code='$barang'";
					$sql = $sql . "and tgl_transaksi < '$tgl1'";
					$rsSaldo = $oDB->ExecuteReader($sql);
					$rSaldo = mysql_fetch_array($rsSaldo);
					
					$sql = "select IFNULL(saldo_awal,0) from mst_product ";					
					$sql = $sql . "where product_code='$barang'";
					$rsSaldo2 = $oDB->ExecuteReader($sql);
					$rSaldo2 = mysql_fetch_array($rsSaldo2);
					
					//$saldoAwal = 0;
					$saldoAwal = $rSaldo[0] + $rSaldo2[0];
				 
					echo "<tr class='font10black' bgcolor='white'>";
					echo "<td>&nbsp;</td>"; 
					echo "<td colspan='6' >Saldo Awal</td>"; 
					echo "<td align='right'>" .setNumber($saldoAwal). "</td>";
					echo "</tr>";
				
					$colspan = 8;
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
						
						$tQty = 0;
						$saldo = $saldoAwal;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							 
							$saldo = $saldo + $data["qty_in"] + $data["qty_out"]; 					
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td>$i</td>";
							echo "<td>" .$data["product_code"]. " - ".$data["product_name"]. "</td>";
							echo "<td>".$data["tgl_transaksi"]."</td>";
							echo "<td>".$data["no_transaksi"]."</td>";
							echo "<td>".$data["ketdetail"]."</td>";
							echo "<td align='right'>".setNumber($data["qty_in"])."</td>";
							echo "<td align='right'>".setNumber($data["qty_out"])."</td>";							
							echo "<td align='right'>" .setNumber($saldo). "</td>";
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
