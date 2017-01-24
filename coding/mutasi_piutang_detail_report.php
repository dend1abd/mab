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
                    <td>Tipe Trans</td>
					<td>Kode Trans</td>
					<td>No Faktur</td>
					<td>Piutang</td>
					<td>Bayar</td>
					<td>Saldo</td>
				</tr>

				<?php					
$sql = "
	select ifnull(b.total,0) - ifnull(b.bayar,0) - ifnull(d.paid,0) as piutang
from mst_contact a

left join 
(
select contact_code, sum(ifnull(total,0)) as total, sum(ifnull(bayar,0)) as bayar  from trx_master 	
where transaksi_tipe in (6, 7, 8) and transaksi_tgl < '$tgl1'
group by contact_code
)b on a.contact_code = b.contact_code

left join 
(
select contact_code, sum(ifnull(jml_bayar,0)) as paid
from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode	
where a.transaksi_tipe in (18) and a.transaksi_tgl < '$tgl1'
group by a.contact_code
)d on a.contact_code = d.contact_code

where a.contact_tipe=3 and a.contact_code='$customer' ";
					$rsSaldo = $oDB->ExecuteReader($sql);
					$rSaldo = mysql_fetch_array($rsSaldo);
					
					//$saldoAwal = 0;
					$saldoAwal = $rSaldo[0]; 
				 
					echo "<tr class='font10black' bgcolor='white'>";
					echo "<td>&nbsp;</td>"; 
					echo "<td colspan='7' valign='top'>Saldo Awal</td>"; 
					echo "<td align='right'>" .setNumber($saldoAwal). "</td>";
					echo "</tr>"; 
	 
					$sql = "					
select 
a.contact_code, a.contact_name, b.*
from mst_contact a
left join (
select transaksi_kode, transaksi_kode as faktur, transaksi_tgl, transaksi_tipe, contact_code, ifnull(total,0) as total, ifnull(bayar,0) as bayar 
from trx_master where transaksi_tipe in (6, 7, 8)

union 
select a.transaksi_kode, b.no_invoice as faktur, a.transaksi_tgl, a.transaksi_tipe, contact_code, 0 as total, ifnull(b.jml_bayar,0) as bayar  
from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode
where a.transaksi_tipe= 18
)b on a.contact_code = b.contact_code
where a.contact_tipe=3 and  a.contact_code='$customer' and transaksi_tgl between '$tgl1' and '$tgl2' order by transaksi_tgl "; 
					
					$rs = $oDB->ExecuteReader($sql);
					$numRows = mysql_num_rows($rs);
				
					$colspan = 9;
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
							 
							$saldo = $saldo + $data["total"] - $data["bayar"];						
							
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td valign='top'>$i</td>";
							echo "<td valign='top'>" .$data["contact_code"] . " - " .$data["contact_name"] . "</td>";							
							echo "<td valign='top'>".$data["transaksi_tipe"]."</td>";
							echo "<td valign='top'>".$data["transaksi_kode"]."</td>";
							echo "<td valign='top'>".$data["transaksi_tgl"]."</td>"; 
							echo "<td valign='top'>".$data["faktur"]."</td>";
							
							echo "<td align='right'>".setNumber($data["total"])."</td>";
							echo "<td align='right'>".setNumber($data["bayar"])."</td>";
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
