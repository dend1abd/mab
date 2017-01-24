<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan saldo Piutang Detail";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 
	$tgl = trim($_GET["tgl"]);
	$customer = trim($_GET["customer"]); 	 
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
					<td>Piutang per Tanggal</td>
					<td>:</td>
					<td>
					<?php  echo $tgl; ?>					
                    </td>
				</tr>
                <?php
                $sql = "select * from mst_contact where contact_code='$customer'";
				$rsCustomer = $oDB->ExecuteReader($sql);
				$rCustomer = mysql_fetch_array($rsCustomer);
				?>
				<tr class="font10black"> 
					<td valign='top'>Customer</td>
					<td valign='top'>:</td>
					<td valign='top'>
						<?php  
						echo $customer . " - " . $rCustomer["contact_name"] . "<br/ >"  .  $rCustomer["alamat"] . "<br />" . "Telp : " . $rCustomer["telp"] . " Fax : " . $rCustomer["fax"];
						;
						
						?>
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
					<td>Tgl Faktur</td>
                    <td>No Faktur</td>
					<td>Nilai Faktur</td>
					<td>Telah bayar</td>
					<td>Jumlah Piutang</td>
				</tr>

				<?php 					
					//********* detail transaksi
					$sql = "select a.transaksi_kode as no_invoice, a.transaksi_tgl as tgl_invoice, ifnull(total,0) as jml_invoice, (ifnull(bayar,0)+ ifnull(b.paid,0)) as telah_bayar
,(ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) as jml_hutang
,(ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) as jml_bayar
, '' ket_bayar
from trx_master a
left join 
(
	select a.contact_code, b.no_invoice, sum(ifnull(jml_bayar,0)) as paid
	from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode	
	where a.transaksi_tipe in (18) and a.transaksi_tgl <= '$tgl'
	group by a.contact_code, b.no_invoice
)b on a.contact_code = b.contact_code and a.transaksi_kode = b.no_invoice
where a.transaksi_tipe in (6, 7, 8) and (ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) <> 0
and a.contact_code ='$customer' and a.transaksi_tgl <= '$tgl' order by a.transaksi_tgl, a.transaksi_kode 
";
					
					$rs = $oDB->ExecuteReader($sql);
					$numRows = mysql_num_rows($rs);
				
					$colspan = 7;
					if ($numRows == 0){
						echo "<tr><td class='font10black' colspan=$colspan align='center' bgcolor='#ffffff'> Data tidak ada</td></tr>";
					}
					else
					{
						$i = 0;
						$sum1 = 0;
						$sum2 = 0;
						$sum3 = 0;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							$sum1 = $sum1 + $data["jml_invoice"];
							$sum2 = $sum2 + $data["telah_bayar"];
							$sum3 = $sum3 + $data["jml_hutang"];
							
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td valign='top'>$i</td>";							
							echo "<td valign='top'>".$data["tgl_invoice"]."</td>";
							echo "<td valign='top'>" .$data["no_invoice"]. "</td>";
							echo "<td align='right'>".setNumber($data["jml_invoice"])."</td>";
							echo "<td align='right'>".setNumber($data["telah_bayar"])."</td>";
							echo "<td align='right'>".setNumber($data["jml_hutang"])."</td>";
							echo "</tr>";						
						}
						echo "<tr class='font10black' bgcolor='#ffffff'><td colspan=3>&nbsp;</td>";
						echo "<td align='right'>".setNumber($sum1)."</td>";
						echo "<td align='right'>".setNumber($sum2)."</td>";
						echo "<td align='right'>".setNumber($sum3)."</td>";						
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
