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
                    <td>Tipe Trans</td>
					<td>Kode Trans</td>
					<td>Terima</td>
					<td>Keluar</td>
					<td>Saldo</td>
				</tr>

				<?php 
				
					$sql = "select size1, size2, size3, size4, size5, size6, size7, size8 from mst_product where product_code='$barang'";
					$rsBarang = $oDB->ExecuteReader($sql);
					$rBarang = mysql_fetch_array($rsBarang);
					
					$sql = "select ifnull(b.qty, 0) - ifnull(c.qty, 0) as awal
, ifnull(b.qty_size1, 0) - ifnull(c.qty_size1, 0) as awal_size1
, ifnull(b.qty_size2, 0) - ifnull(c.qty_size2, 0) as awal_size2
, ifnull(b.qty_size3, 0) - ifnull(c.qty_size3, 0) as awal_size3
, ifnull(b.qty_size4, 0) - ifnull(c.qty_size4, 0) as awal_size4
, ifnull(b.qty_size5, 0) - ifnull(c.qty_size5, 0) as awal_size5
, ifnull(b.qty_size6, 0) - ifnull(c.qty_size6, 0) as awal_size6
, ifnull(b.qty_size7, 0) - ifnull(c.qty_size7, 0) as awal_size7
, ifnull(b.qty_size8, 0) - ifnull(c.qty_size8, 0) as awal_size8
					from mst_product a
					inner join 
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

inner join 
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
					where a.product_code='$barang' ";
					$rsSaldo = $oDB->ExecuteReader($sql);
					$rSaldo = mysql_fetch_array($rsSaldo);
					
					//eror($sql);
					
					//$saldoAwal = 0;
					$awal = $rSaldo[0];					
					$awal_label = "";
					if ($rBarang["size1"] != "") $awal_label = $awal_label .  $rBarang["size1"] . "/" .$rSaldo["awal_size1"]. "; ";
					if ($rBarang["size2"] != "") $awal_label = $awal_label .  $rBarang["size2"] . "/" .$rSaldo["awal_size2"]. "; ";
					if ($rBarang["size3"] != "") $awal_label = $awal_label .  $rBarang["size3"] . "/" .$rSaldo["awal_size3"]. "; ";
					if ($rBarang["size4"] != "") $awal_label = $awal_label .  $rBarang["size4"] . "/" .$rSaldo["awal_size4"]. "; ";
					if ($rBarang["size5"] != "") $awal_label = $awal_label .  $rBarang["size5"] . "/" .$rSaldo["awal_size5"]. "; ";
					if ($rBarang["size6"] != "") $awal_label = $awal_label .  $rBarang["size6"] . "/" .$rSaldo["awal_size6"]. "; ";
					if ($rBarang["size7"] != "") $awal_label = $awal_label .  $rBarang["size7"] . "/" .$rSaldo["awal_size7"]. "; ";
					if ($rBarang["size8"] != "") $awal_label = $awal_label .  $rBarang["size8"] . "/" .$rSaldo["awal_size8"]. "; ";
					
					$saldo = $awal;						
					$saldo1 = $rSaldo["awal_size1"];
					$saldo2 = $rSaldo["awal_size2"];
					$saldo3 = $rSaldo["awal_size3"];
					$saldo4 = $rSaldo["awal_size4"];
					$saldo5 = $rSaldo["awal_size5"];
					$saldo6 = $rSaldo["awal_size6"];
					$saldo7 = $rSaldo["awal_size7"];
					$saldo8 = $rSaldo["awal_size8"];
				 
					echo "<tr class='font10black' bgcolor='white'>";
					echo "<td>&nbsp;</td>"; 
					echo "<td colspan='6' valign='top'>Saldo Awal</td>"; 
					echo "<td align='right'><b>" .setNumber($saldo). "</b><br />$awal_label</td>";
					echo "</tr>"; 
	 				
					//********* detail transaksi
					$sql = "select b.product_code, b.product_name, a.transaksi_tgl, a.transaksi_kode, a.transaksi_tipe
					, ifnull(qty, 0) as qty
					, ifnull(qty_size1, 0) as qty_size1
					, ifnull(qty_size2, 0) as qty_size2
					, ifnull(qty_size3, 0) as qty_size3
					, ifnull(qty_size4, 0) as qty_size4
					, ifnull(qty_size5, 0) as qty_size5
					, ifnull(qty_size6, 0) as qty_size6
					, ifnull(qty_size7, 0) as qty_size7
					, ifnull(qty_size8, 0) as qty_size8	
					from trx_master a
					inner join trx_detail b on a.transaksi_kode = b.transaksi_kode
					where a.transaksi_tgl between '$tgl1' and '$tgl2'
					and b.product_code='$barang' and a.transaksi_tipe in (9, 10, 11, 12, 13, 14)";
					
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
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							
							$tipe = $data["transaksi_tipe"];
							if ( ($tipe == 9) || ($tipe == 10) || ($tipe == 13) ){
								$qty_in = $data["qty"];
								$qty_in1 = $data["qty_size1"];
								$qty_in2 = $data["qty_size2"];
								$qty_in3 = $data["qty_size3"];
								$qty_in4 = $data["qty_size4"];
								$qty_in5 = $data["qty_size5"];
								$qty_in6 = $data["qty_size6"];
								$qty_in7 = $data["qty_size7"];								
								$qty_in8 = $data["qty_size8"];
								
								$qty_out = 0;
								$qty_out1 = 0;
								$qty_out2 = 0;
								$qty_out3 = 0;
								$qty_out4 = 0;
								$qty_out5 = 0;
								$qty_out6 = 0;
								$qty_out7 = 0;
								$qty_out8 = 0;
							}
							else{
								$qty_out = $data["qty"];
								$qty_out1 = $data["qty_size1"];
								$qty_out2 = $data["qty_size2"];
								$qty_out3 = $data["qty_size3"];
								$qty_out4 = $data["qty_size4"];
								$qty_out5 = $data["qty_size5"];
								$qty_out6 = $data["qty_size6"];
								$qty_out7 = $data["qty_size7"];								
								$qty_out8 = $data["qty_size8"];
								
								$qty_in = 0;
								$qty_in1 = 0;
								$qty_in2 = 0;
								$qty_in3 = 0;
								$qty_in4 = 0;
								$qty_in5 = 0;
								$qty_in6 = 0;
								$qty_in7 = 0;
								$qty_in8 = 0;
							}	
							$saldo =  $saldo + $qty_in - $qty_out;							
							$saldo1 =  $saldo1 + $qty_in1 - $qty_out1;
							$saldo2 =  $saldo2 + $qty_in2 - $qty_out2;
							$saldo3 =  $saldo3 + $qty_in3 - $qty_out3;
							$saldo4 =  $saldo4 + $qty_in4 - $qty_out4;
							$saldo5 =  $saldo5 + $qty_in5 - $qty_out5;
							$saldo6 =  $saldo6 + $qty_in6 - $qty_out6;
							$saldo7 =  $saldo7 + $qty_in7 - $qty_out7;
							$saldo8 =  $saldo8 + $qty_in8 - $qty_out8;
							
							
							
							$in_label = "";
							if ($rBarang["size1"] != "") $in_label = $in_label .  $rBarang["size1"] . "/" .$qty_in1. "; ";
							if ($rBarang["size2"] != "") $in_label = $in_label .  $rBarang["size2"] . "/" .$qty_in2. "; ";
							if ($rBarang["size3"] != "") $in_label = $in_label .  $rBarang["size3"] . "/" .$qty_in3. "; ";
							if ($rBarang["size4"] != "") $in_label = $in_label .  $rBarang["size4"] . "/" .$qty_in4. "; ";
							if ($rBarang["size5"] != "") $in_label = $in_label .  $rBarang["size5"] . "/" .$qty_in5. "; ";
							if ($rBarang["size6"] != "") $in_label = $in_label .  $rBarang["size6"] . "/" .$qty_in6. "; ";
							if ($rBarang["size7"] != "") $in_label = $in_label .  $rBarang["size7"] . "/" .$qty_in7. "; ";
							if ($rBarang["size8"] != "") $in_label = $in_label .  $rBarang["size8"] . "/" .$qty_in8. "; ";
							
							$out_label = "";
							if ($rBarang["size1"] != "") $out_label = $out_label .  $rBarang["size1"] . "/" .$qty_out1. "; ";
							if ($rBarang["size2"] != "") $out_label = $out_label .  $rBarang["size2"] . "/" .$qty_out2. "; ";
							if ($rBarang["size3"] != "") $out_label = $out_label .  $rBarang["size3"] . "/" .$qty_out3. "; ";
							if ($rBarang["size4"] != "") $out_label = $out_label .  $rBarang["size4"] . "/" .$qty_out4. "; ";
							if ($rBarang["size5"] != "") $out_label = $out_label .  $rBarang["size5"] . "/" .$qty_out5. "; ";
							if ($rBarang["size6"] != "") $out_label = $out_label .  $rBarang["size6"] . "/" .$qty_out6. "; ";
							if ($rBarang["size7"] != "") $out_label = $out_label .  $rBarang["size7"] . "/" .$qty_out7. "; ";
							if ($rBarang["size8"] != "") $out_label = $out_label .  $rBarang["size8"] . "/" .$qty_out8. "; ";
							
							$saldo_label = "";
							if ($rBarang["size1"] != "") $saldo_label = $saldo_label .  $rBarang["size1"] . "/" .$saldo1. "; ";
							if ($rBarang["size2"] != "") $saldo_label = $saldo_label .  $rBarang["size2"] . "/" .$saldo2. "; ";
							if ($rBarang["size3"] != "") $saldo_label = $saldo_label .  $rBarang["size3"] . "/" .$saldo3. "; ";
							if ($rBarang["size4"] != "") $saldo_label = $saldo_label .  $rBarang["size4"] . "/" .$saldo4. "; ";
							if ($rBarang["size5"] != "") $saldo_label = $saldo_label .  $rBarang["size5"] . "/" .$saldo5. "; ";
							if ($rBarang["size6"] != "") $saldo_label = $saldo_label .  $rBarang["size6"] . "/" .$saldo6. "; ";
							if ($rBarang["size7"] != "") $saldo_label = $saldo_label .  $rBarang["size7"] . "/" .$saldo7. "; ";
							if ($rBarang["size8"] != "") $saldo_label = $saldo_label .  $rBarang["size8"] . "/" .$saldo8. "; ";
							
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td valign='top'>$i</td>";
							echo "<td valign='top'>" .$data["product_code"]. " - ".$data["product_name"]. "</td>";
							echo "<td valign='top'>".$data["transaksi_tgl"]."</td>";
							echo "<td valign='top'>".$data["transaksi_tipe"]."</td>"; 
							echo "<td valign='top'>".$data["transaksi_kode"]."</td>"; 
							echo "<td align='right'><b>".setNumber($qty_in)."</b><br />$in_label</td>";
							echo "<td align='right'><b>".setNumber($qty_out)."</b><br />$out_label</td>";
							echo "<td align='right'><b>".setNumber($saldo)."</b><br />$saldo_label</td>";
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
