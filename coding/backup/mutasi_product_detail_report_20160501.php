<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Mutasi Barang Detail";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 
	$tgl1 = trim($_GET["tgl1"]);
	$tgl2 = trim($_GET["tgl2"]); 
	$barang= trim($_GET["kode"]); 	 
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
					<?php  echo $tgl1 . " s/d ". $tgl2; ?>					
                    </td>
				</tr>
				<tr class="font10black"> 
					<td>Kode Barang</td>
					<td>:</td>
					<td>
						<?php  echo $barang; ?>
					</td>
				</tr>

			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCetak" value="Cetak" class ="button" onclick="window.print();"/> 
		</td> 
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable" align="center">
					<td>No</td> 
					<td>Barang</td> 
					<td>Tgl Trans</td>
					<td>Kode Trans</td>
					<td>Beli</td>
					<td>Jual</td>
					<td>Saldo</td>
				</tr>

				<?php 
				
					$sql = "select size1, size2, size3, size4, size5, size6, size7, size8 from mst_product where product_code='$barang'";
					$rsBarang = $oDB->ExecuteReader($sql);
					$rBarang = mysql_fetch_array($rsBarang);
					
					$sql = "select 
					IFNULL(sum(ifnull(qty_in, 0) - ifnull(qty_out, 0)),0) as sawal,
					IFNULL(sum(ifnull(qtysize1_in, 0) - ifnull(qtysize1_out, 0)),0) as sawal1,
					IFNULL(sum(ifnull(qtysize2_in, 0) - ifnull(qtysize2_out, 0)),0) as sawal2,
					IFNULL(sum(ifnull(qtysize3_in, 0) - ifnull(qtysize3_out, 0)),0) as sawal3,
					IFNULL(sum(ifnull(qtysize4_in, 0) - ifnull(qtysize4_out, 0)),0) as sawal4,
					IFNULL(sum(ifnull(qtysize5_in, 0) - ifnull(qtysize5_out, 0)),0) as sawal5,
					IFNULL(sum(ifnull(qtysize6_in, 0) - ifnull(qtysize6_out, 0)),0) as sawal6,
					IFNULL(sum(ifnull(qtysize7_in, 0) - ifnull(qtysize7_out, 0)),0) as sawal7,
					IFNULL(sum(ifnull(qtysize8_in, 0) - ifnull(qtysize8_out, 0)),0) as sawal8 
					from trx_persediaan 
					where product_code='$barang' 
					and tgl_transaksi < '$tgl1'";
					$rsSaldo = $oDB->ExecuteReader($sql);
					$rSaldo = mysql_fetch_array($rsSaldo);
					
					//$saldoAwal = 0;
					$saldoAwal = $rSaldo[0];
					
					$sawal = "";
					if ($rBarang["size1"] != "") $sawal = $sawal .  $rBarang["size1"] . "/" .$rSaldo["sawal1"]. "; ";
					if ($rBarang["size2"] != "") $sawal = $sawal .  $rBarang["size2"] . "/" .$rSaldo["sawal2"]. "; ";
					if ($rBarang["size3"] != "") $sawal = $sawal .  $rBarang["size3"] . "/" .$rSaldo["sawal3"]. "; ";
					if ($rBarang["size4"] != "") $sawal = $sawal .  $rBarang["size4"] . "/" .$rSaldo["sawal4"]. "; ";
					if ($rBarang["size5"] != "") $sawal = $sawal .  $rBarang["size5"] . "/" .$rSaldo["sawal5"]. "; ";
					if ($rBarang["size6"] != "") $sawal = $sawal .  $rBarang["size6"] . "/" .$rSaldo["sawal6"]. "; ";
					if ($rBarang["size7"] != "") $sawal = $sawal .  $rBarang["size7"] . "/" .$rSaldo["sawal7"]. "; ";
					if ($rBarang["size8"] != "") $sawal = $sawal .  $rBarang["size8"] . "/" .$rSaldo["sawal8"]. "; ";
				 
					echo "<tr class='font10black' bgcolor='white'>";
					echo "<td>&nbsp;</td>"; 
					echo "<td colspan='5' valign='top'>Saldo Awal</td>"; 
					echo "<td align='right'><b>" .setNumber($saldoAwal). "</b><br />$sawal</td>";
					echo "</tr>"; 
	 
					$sql = "select * from trx_persediaan ";
					$sql = $sql . "where product_code='$barang' ";
					$sql = $sql . "and tgl_transaksi between '$tgl1' and '$tgl2'"; 
					
					$rs = $oDB->ExecuteReader($sql);
					$numRows = mysql_num_rows($rs);
				
					$colspan = 7;
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
						
						$saldo1 = $rSaldo["sawal1"];
						$saldo2 = $rSaldo["sawal2"];
						$saldo3 = $rSaldo["sawal3"];
						$saldo4 = $rSaldo["sawal4"];
						$saldo5 = $rSaldo["sawal5"];
						$saldo6 = $rSaldo["sawal6"];
						$saldo7 = $rSaldo["sawal7"];
						$saldo8 = $rSaldo["sawal8"];
						
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							
							$sbeli = "";
							if ($rBarang["size1"] != "") $sbeli = $sbeli .  $rBarang["size1"] . "/" .$data["qtysize1_in"]. "; ";
							if ($rBarang["size2"] != "") $sbeli = $sbeli .  $rBarang["size2"] . "/" .$data["qtysize2_in"]. "; ";
							if ($rBarang["size3"] != "") $sbeli = $sbeli .  $rBarang["size3"] . "/" .$data["qtysize3_in"]. "; ";
							if ($rBarang["size4"] != "") $sbeli = $sbeli .  $rBarang["size4"] . "/" .$data["qtysize4_in"]. "; ";
							if ($rBarang["size5"] != "") $sbeli = $sbeli .  $rBarang["size5"] . "/" .$data["qtysize5_in"]. "; ";
							if ($rBarang["size6"] != "") $sbeli = $sbeli .  $rBarang["size6"] . "/" .$data["qtysize6_in"]. "; ";
							if ($rBarang["size7"] != "") $sbeli = $sbeli .  $rBarang["size7"] . "/" .$data["qtysize7_in"]. "; ";
							if ($rBarang["size8"] != "") $sbeli = $sbeli .  $rBarang["size8"] . "/" .$data["qtysize8_in"]. "; ";
							
							$sjual = "";
							if ($rBarang["size1"] != "") $sjual = $sjual .  $rBarang["size1"] . "/" .$data["qtysize1_out"]. "; ";
							if ($rBarang["size2"] != "") $sjual = $sjual .  $rBarang["size2"] . "/" .$data["qtysize2_out"]. "; ";
							if ($rBarang["size3"] != "") $sjual = $sjual .  $rBarang["size3"] . "/" .$data["qtysize3_out"]. "; ";
							if ($rBarang["size4"] != "") $sjual = $sjual .  $rBarang["size4"] . "/" .$data["qtysize4_out"]. "; ";
							if ($rBarang["size5"] != "") $sjual = $sjual .  $rBarang["size5"] . "/" .$data["qtysize5_out"]. "; ";
							if ($rBarang["size6"] != "") $sjual = $sjual .  $rBarang["size6"] . "/" .$data["qtysize6_out"]. "; ";
							if ($rBarang["size7"] != "") $sjual = $sjual .  $rBarang["size7"] . "/" .$data["qtysize7_out"]. "; ";
							if ($rBarang["size8"] != "") $sjual = $sjual .  $rBarang["size8"] . "/" .$data["qtysize8_out"]. "; ";
							 
							$saldo = $saldo + $data["qty_in"] - $data["qty_out"];
							
							$saldo1 = $saldo1 + $data["qtysize1_in"] - $data["qtysize1_out"];
							$saldo2 = $saldo2 + $data["qtysize2_in"] - $data["qtysize2_out"];
							$saldo3 = $saldo3 + $data["qtysize3_in"] - $data["qtysize3_out"];
							$saldo4 = $saldo4 + $data["qtysize4_in"] - $data["qtysize4_out"];
							$saldo5 = $saldo5 + $data["qtysize5_in"] - $data["qtysize5_out"];
							$saldo6 = $saldo6 + $data["qtysize6_in"] - $data["qtysize6_out"];
							$saldo7 = $saldo7 + $data["qtysize7_in"] - $data["qtysize7_out"];
							$saldo8 = $saldo8 + $data["qtysize8_in"] - $data["qtysize8_out"];
							
							$saldoKet = "";
							if ($rBarang["size1"] != "") $saldoKet = $saldoKet .  $rBarang["size1"] . "/" .$saldo1. "; ";
							if ($rBarang["size2"] != "") $saldoKet = $saldoKet .  $rBarang["size2"] . "/" .$saldo2. "; ";
							if ($rBarang["size3"] != "") $saldoKet = $saldoKet .  $rBarang["size3"] . "/" .$saldo3. "; ";
							if ($rBarang["size4"] != "") $saldoKet = $saldoKet .  $rBarang["size4"] . "/" .$saldo4. "; ";
							if ($rBarang["size5"] != "") $saldoKet = $saldoKet .  $rBarang["size5"] . "/" .$saldo5. "; ";
							if ($rBarang["size6"] != "") $saldoKet = $saldoKet .  $rBarang["size6"] . "/" .$saldo6. "; ";
							if ($rBarang["size7"] != "") $saldoKet = $saldoKet .  $rBarang["size7"] . "/" .$saldo7. "; ";
							if ($rBarang["size8"] != "") $saldoKet = $saldoKet .  $rBarang["size8"] . "/" .$saldo8. "; ";
							
							
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td valign='top'>$i</td>";
							echo "<td valign='top'>" .$data["product_code"]. " - ".$data["product_name"]. "</td>";
							echo "<td valign='top'>".$data["tgl_transaksi"]."</td>";
							echo "<td valign='top'>".$data["no_transaksi"]."</td>"; 
							echo "<td align='right'><b>".setNumber($data["qty_in"])."</b><br />$sbeli</td>";
							echo "<td align='right'><b>".setNumber($data["qty_out"])."</b><br />$sjual</td>";
							echo "<td align='right'><b>".setNumber($saldo)."</b><br />$saldoKet</td>";
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
