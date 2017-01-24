<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Mutasi Piutang Detail";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 
	$tgl1 = trim($_GET["tgl1"]);
	$tgl2 = trim($_GET["tgl2"]); 
	$customer= trim($_GET["kode"]); 	 
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
					<td>Kode Customer</td>
					<td>:</td>
					<td>
						<?php  echo $customer; ?>
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
					<td>Customer</td> 
					<td>Tgl Trans</td>
					<td>Kode Trans</td>
                    <td>Tgl Faktur</td>
					<td>No Faktur</td>
					<td>Piutang</td>
					<td>Bayar</td>
					<td>Saldo</td>
				</tr>

				<?php					
					$sql = "select (sum(jml_in) - sum(jml_out)) as saldo_awal 
					from trx_invoice 
					where contact_code='$customer' 
					and tgl_transaksi < '$tgl1'";
					$rsSaldo = $oDB->ExecuteReader($sql);
					$rSaldo = mysql_fetch_array($rsSaldo);
					
					//$saldoAwal = 0;
					$saldoAwal = $rSaldo[0]; 
				 
					echo "<tr class='font10black' bgcolor='white'>";
					echo "<td>&nbsp;</td>"; 
					echo "<td colspan='7' valign='top'>Saldo Awal</td>"; 
					echo "<td align='right'>" .setNumber($saldoAwal). "</td>";
					echo "</tr>"; 
	 
					$sql = "select a.*, b.contact_name from trx_invoice a inner join mst_contact b on a.contact_code = b.contact_code ";
					$sql = $sql . "where a.contact_code='$customer' ";
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
						
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							 
							$saldo = $saldo + $data["jml_in"] - $data["jml_out"];
							
							
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td valign='top'>$i</td>";
							echo "<td valign='top'>" .$data["contact_code"] . " - " .$data["contact_name"] . "</td>";
							echo "<td valign='top'>".$data["tgl_transaksi"]."</td>";
							echo "<td valign='top'>".$data["no_transaksi"]."</td>"; 
							echo "<td valign='top'>".$data["tgl_invoice"]."</td>";
							echo "<td valign='top'>".$data["no_invoice"]."</td>"; 
							
							echo "<td align='right'>".setNumber($data["jml_in"])."</td>";
							echo "<td align='right'>".setNumber($data["jml_out"])."</td>";
							echo "<td align='right'>".setNumber($saldo)."</td>";
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
