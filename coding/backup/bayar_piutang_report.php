<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Pembayaran Piutang";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);
		$contact_code = trim($_POST["txtcontact_code"]); 
		$divisi  = retrieveS($_POST["txtdivisi"]);
				
		$halaman = trim($_POST["txtHalaman"]);
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		$contact_code = ""; 
		$divisi  = "";
		
		$posisi = 0;
		$halaman = 1;
	} 
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_name,', ', left(ifnull(alamat,''), 50)) FROM mst_contact where contact_tipe = 3 order by contact_name"; 
    $rsCustomer = $oDB->ExecuteReader($sqlCmd); 
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff"; 
    $rsdivisi = $oDB->ExecuteReader($sqlCmd);
	
	
$sql = "select a.transaksi_kode, a.transaksi_tgl, a.bayar
, ifnull(b.jml_cash,0) as jml_cash
, ifnull(c.jml_transfer,0) as jml_transfer
, ifnull(d.jml_giro,0) as jml_giro
, ifnull(e.jml_lain,0) as jml_lain
, keterangan, contact_name
from trx_master a 
left join 
(
	select sum(ifnull(jumlah,0)) as jml_cash , transaksi_kode from trx_cara_bayar
	where cara_bayar=1
	group by transaksi_kode
)b on a.transaksi_kode=b.transaksi_kode

left join 
(
	select sum(ifnull(jumlah,0)) as jml_transfer , transaksi_kode from trx_cara_bayar
	where cara_bayar=2
	group by transaksi_kode
)c on a.transaksi_kode=c.transaksi_kode

left join 
(
	select sum(ifnull(jumlah,0)) as jml_giro , transaksi_kode from trx_cara_bayar
	where cara_bayar=3
	group by transaksi_kode
)d on a.transaksi_kode=d.transaksi_kode

left join 
(
	select sum(ifnull(jumlah,0)) as jml_lain , transaksi_kode from trx_cara_bayar
	where cara_bayar not in (1,2,3)
	group by transaksi_kode
)e on a.transaksi_kode=e.transaksi_kode

left join mst_contact h on a.contact_code=h.contact_code

where a.transaksi_tipe=18 and a.transaksi_tgl between '$tgl1' and '$tgl2'";  
		
	/*$sql = "select a.transaksi_kode, transaksi_tgl, a.bayar, keterangan,  a.contact_code, b.contact_name as supplier, e.no_invoice, e.tgl_invoice, e.jml_invoice, e.jml_bayar, e.ket_bayar from trx_master a ";
	$sql = $sql . "inner join trx_bayar e on a.transaksi_kode=e.transaksi_kode ";
	$sql = $sql . "inner join mst_contact b on a.contact_code=b.contact_code ";
	$sql = $sql . "where transaksi_tipe=18 ";
	$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'";  */
	
	if ($contact_code != ""){
		$sql = $sql . "and a.contact_code = '$contact_code' ";    
	}		
	if ($divisi != "") $sql = $sql . "and a.kode_divisi= '$divisi' ";  

	//eror($sql);
	
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
					<td>Customer</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtcontact_code", $contact_code, $rsCustomer, ""); ?> 
					</td>
				</tr> 
				<tr class='font10black'>
                                <td>Divisi</td>
                                <td>:</td>
                                <td>
                                <?php  echo getComboBoxEx(1, "txtdivisi", $divisi, $rsdivisi, "-- All --", ""); ?>
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
                    <?php
					echo "<td>Tanggal</td>";
                    echo "<td>Kode Transaksi</td>";
                    echo "<td>Customer</td>";
                    echo "<td>Cash</td>";
                    echo "<td>Transfer</td>";
                    echo "<td>Giro</td>";
					echo "<td>Lainnya</td>";
					echo "<td>Total Bayar</td>";
					echo "<td>No Faktur</td>";
					echo "<td>Tgl Faktur</td>";
					echo "<td>Bayar Faktur</td>";   
                    echo "<td>Ket Bayar</td>";					
					?>
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
					
					$sumBayar = 0;
					$sumCash = 0;
					$sumTransfer = 0;
					$sumGiro = 0;
					$sumLain = 0;
					
					while ($data = mysql_fetch_array($rs)) 
					{
						$i++;
						$nourut = $posisi + $i;
						
						$sumBayar = $sumBayar + $data["bayar"];
						$sumCash = $sumCash + $data["jml_cash"]; 
						$sumTransfer = $sumTransfer + $data["jml_transfer"]; 
						$sumGiro = $sumGiro + $data["jml_giro"]; 
						$sumLain = $sumLain + $data["jml_lain"]; 
									
						?>						
						<tr class='font10black' bgcolor='#ffffff'>
							<td align="center"><?php echo $nourut; ?></td>
							<td><?php echo $data["transaksi_tgl"] ?> </td>
							<td><?php echo $data["transaksi_kode"] ?> </td> 
							<td><?php echo $data["contact_name"]; ?> </td> 
							<td align="right"><?php echo setNumber($data["jml_cash"]) ?> </td>
							<td align="right"><?php echo setNumber($data["jml_transfer"]) ?> </td>
							<td align="right"><?php echo setNumber($data["jml_giro"]) ?> </td>
							<td align="right"><?php echo setNumber($data["jml_lain"]) ?> </td>							
                            <td align="right"><?php echo setNumber($data["bayar"]) ?> </td> 
<?php
$sql = "select no_invoice, tgl_invoice, jml_bayar, ket_bayar from trx_bayar where transaksi_kode='" .$data["transaksi_kode"]. "'";
$rsBayar = $oDB->ExecuteReader($sql);
								$j=0;
								while ($bayar = mysql_fetch_array($rsBayar)) 
								{
									if($j==0){
										echo "<td align='left' >" .$bayar["no_invoice"]. "</td>";
										echo "<td align='left' >" .$bayar["tgl_invoice"]. "</td>";
										echo "<td align='right' >" .setNumber($bayar["jml_bayar"]). "</td>";
										echo "<td align='left' >" .$bayar["ket_bayar"]. "</td>";
									}
									else{
										echo "</tr><tr class='font10black' bgcolor='#ffffff'><td colspan=9>&nbsp;</td><td align='left' >" .$bayar["no_invoice"]. "</td>";
										echo "<td align='left' >" .$bayar["tgl_invoice"]. "</td>";
										echo "<td align='right' >" .setNumber($bayar["jml_bayar"]). "</td>";
										echo "<td align='left' >" .$bayar["ket_bayar"]. "</td>";
									}
									$j++;
								}
?>							
							</tr>	
						<?php
					}	
					echo "<tr class='font10black' bgcolor='#ffffff'>";
					echo "<td colspan='4'>&nbsp;</td>";
					echo "<td align='right'><b>" . setNumber($sumCash) . "</b></td>";
					echo "<td align='right'><b>" . setNumber($sumTransfer) . "</b></td>";
					echo "<td align='right'><b>" . setNumber($sumGiro) . "</b></td>";
					echo "<td align='right'><b>" . setNumber($sumLain) . "</b></td>";
                                                                                          echo "<td align='right'><b>" . setNumber($sumBayar) . "</b></td>"; 
					echo "<td align='right' colspan=5>&nbsp;</td>";
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

