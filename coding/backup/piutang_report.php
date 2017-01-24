<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Piutang";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
	
	//$_SESSION["param_jml_record_paging"] = 2;
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$tgl = trim($_POST["txtTgl"]);  
		$customer = trim($_POST["txtcustomer"]); 
		$sales_code = trim($_POST["txtsales_code"]);
		$wilayah_code = trim($_POST["txtwilayah_code"]);
		$divisi  = retrieveS($_POST["txtdivisi"]);
		$sisa  = retrieveS($_POST["txtsisa"]);
		
		$halaman = trim($_POST["txtHalaman"]);
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
	}
	else
	{
		$numRow = 0;
		$tgl = date("Y-m-d"); 
		$customer = ""; 
		$sales_code = "";
		$divisi  = "";
		$wilayah_code = "";
		$sisa  = "";
		
		$posisi = 0;
		$halaman = 1;
	} 
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_name,', ', left(ifnull(alamat,''), 50)) FROM mst_contact where contact_tipe = 3 order by contact_name";
    $rscustomer = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe=4 order by contact_name"; 
    $rsKaryawan = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff"; 
    $rsdivisi = $oDB->ExecuteReader($sqlCmd);
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=27 order by reff"; 
    $rswilayah = $oDB->ExecuteReader($sqlCmd);
	
	$sqlCmd = "select '1' kode, '= Nol' as ket  
union
select '2' kode, '!= nol' as ket";  
	$rssisa = $oDB->ExecuteReader($sqlCmd);
	
	$sql = "select a.transaksi_kode as no_invoice, a.transaksi_tgl as tgl_invoice, ifnull(total,0) as jml_invoice, (ifnull(bayar,0)+ ifnull(b.paid,0)) as telah_bayar
,(ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)- ifnull(d.total_retur,0)) as jml_hutang
, '' ket_bayar, a.contact_code, c.contact_name, c.alamat, d.total_retur, e.contact_name as sales_name, a.kode_wilayah, f.reff as stfaktur
from trx_master a
left join 
(
	select a.contact_code, b.no_invoice, sum(ifnull(jml_bayar,0)) as paid
	from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode	
	where a.transaksi_tipe in (18) and a.transaksi_tgl <= '$tgl'
	group by a.contact_code, b.no_invoice
)b on a.contact_code = b.contact_code and a.transaksi_kode = b.no_invoice

left join 
(
	select sum(ifnull(sisa,0)) as total_retur, no_reff
	from trx_master a 
	where a.transaksi_tipe=8 and a.transaksi_tgl <= '$tgl'
	group by no_reff
)d on a.transaksi_kode = d.no_reff

inner join mst_contact c on a.contact_code = c.contact_code
left join mst_contact e on a.sales_code = e.contact_code
left join mst_reff f on a.stFaktur = f.kodereff and f.tipereff=28 
where a.transaksi_tipe in (6, 7) and (ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) <> 0 
and a.transaksi_tgl <= '$tgl' ";

	if ($customer != "") $sql = $sql . " and a.contact_code ='$customer' "; 
	if ($divisi != "") $sql = $sql . "and a.kode_divisi= '$divisi' ";  
	if ($sales_code != "") $sql = $sql . "and a.sales_code = '$sales_code' ";  	
	if ($wilayah_code != "") $sql = $sql . "and a.kode_wilayah= '$wilayah_code' ";  
	
	if ($sisa == "1") $sql = $sql . "and (ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)- ifnull(d.total_retur,0)) = 0 ";  
	if ($sisa == "2") $sql = $sql . "and (ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)- ifnull(d.total_retur,0)) <> 0 ";  
	//if ($sisa == "3") $sql = $sql . "and (ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)- ifnull(d.total_retur,0)) < 0 ";  
	
	$sql = $sql . " order by transaksi_tgl, transaksi_kode"; 
	
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
	if (document.getElementById("txtTgl").value == ""){
		alert("silahkan isi tanggal stok");
		document.getElementById("txtTgl").focus();
	}
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

function link1(customer){ 	
	tgl = document.getElementById("txtTgl").value;
	url = "saldo_piutang_detail_report.php?customer=" +customer+ "&tgl=" +tgl
	lookupWindow(url, "salso_piutang_" + customer)
	//alert(url);
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
		<td style="height: 53px" width=100%>		
			<table width=100%>
				<tr><td width=50%>
				<table>
				<tr class="font10black">
					<td nowrap>Piutang Per Tanggal</td>
					<td>:</td>
					<td>
					<?php  
					echo getHiddenBox(1, "txtHalaman", $halaman);	
					echo getDatePicMand(1, "txtTgl", $tgl, ""); ?> 
					</td>
				</tr>
				
				<tr class="font10black"> 
					<td>Customer</td>
					<td>:</td>
					<td>
						<?php  echo getComboBoxEx(1, "txtcustomer", $customer, $rscustomer, "-- All --", ""); ?>
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
				
				<td width=50%>				
				<table>
				<tr class='font10black'>
                                <td nowrap>Status Piutang</td>
                                <td>:</td>
                                <td>
                                <?php  echo getComboBoxEx(1, "txtsisa", $sisa, $rssisa, "-- All --", ""); ?>
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
				
							
			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button" onclick="frmSubmit()"/>&nbsp;
		<input type="button" name="btCetak" value="Cetak" class ="button" onclick="window.print();"/>         
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
					<td>No Faktur</td>
                    <td>Tgl Faktur</td>                    
					<td>Customer</td>
					<td>Alamat</td>
					<td>Jumlah Piutang</td>
					<td>Telah bayar</td>
					<td>Retur</td>
					<td>Sisa Piutang</td>
					<td>Sales</td>
					<td>Kode Wilayah</td>
					<td>Status</td>
					<td>No Bayar</td>
					<td>Tgl Bayar</td>
					<td>Jml Bayar</td>
				</tr>

				<?php 

//********* detail transaksi					
				
					$colspan = 10;
					if ($numRows == 0)
					{
					?>
					<tr >
						<td class='font10black' colspan="<?php echo $colspan; ?>"  bgcolor="white" align="center">Data not found</td> 
					</tr>
					
					<?php
					}
					else
					{
						$i = 0;
						$sum1 = 0;
						$sum2 = 0;
						$sum3 = 0;
						$sum4 = 0;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++; 	
							$nourut = $posisi + $i;
							
							$sum1 = $sum1 + $data["jml_invoice"];
							$sum2 = $sum2 + $data["telah_bayar"];
							$sum3 = $sum3 + $data["total_retur"];
							$sum4 = $sum4 + $data["jml_hutang"];
							
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td valign='top'>$nourut</td>";					
							echo "<td valign='top'>" .$data["no_invoice"]. "</td>";
							echo "<td valign='top'>".$data["tgl_invoice"]."</td>";		
							echo "<td valign='top'>" .$data["contact_name"] ."</td>";														
							echo "<td valign='top'>" .$data["alamat"] ."</td>";
							echo "<td align='right'>".setNumber($data["jml_invoice"])."</td>";
							echo "<td align='right'>".setNumber($data["telah_bayar"])."</td>";
							echo "<td align='right'>".setNumber($data["total_retur"])."</td>";
							echo "<td align='right'>".setNumber($data["jml_hutang"])."</td>";
							echo "<td valign='top'>".$data["sales_name"]."</td>";		
							echo "<td valign='top'>" .$data["kode_wilayah"] ."</td>";
							echo "<td valign='top'>" .$data["stfaktur"] ."</td>";
							
							if ($data["telah_bayar"] ==0){
								echo "<td align='left' colspan=3>&nbsp;&nbsp;&nbsp;</td>";
							}
							else{
								$sqlCmd = "select a.transaksi_kode, b.transaksi_tgl, a.jml_bayar from trx_bayar a
inner join trx_master b on a.transaksi_kode=b.transaksi_kode where a.no_invoice='" .$data["no_invoice"]. "'"; 
								$rsBayar = $oDB->ExecuteReader($sqlCmd);
								$detilBayar = mysql_num_rows($rsBayar);
								
								if ($detilBayar ==0){
									echo "<td align='left' colspan=3>&nbsp;&nbsp;&nbsp;</td>";
								}
								
								else{
									$j=0;
									while ($bayar = mysql_fetch_array($rsBayar)) 
									{
										if($j==0){
											echo "<td align='left' >" .$bayar["transaksi_kode"]. "</td>";
											echo "<td align='left' >" .$bayar["transaksi_tgl"]. "</td>";
											echo "<td align='right' >" .setNumber($bayar["jml_bayar"]). "</td>";
										}
										else{
											echo "</tr><tr class='font10black' bgcolor='#ffffff'><td colspan=12>&nbsp;</td><td align='left' >" .$bayar["transaksi_kode"]. "</td>";
											echo "<td align='left' >" .$bayar["transaksi_tgl"]. "</td>";
											echo "<td align='right' >" .setNumber($bayar["jml_bayar"]). "</td>";
										}
										$j++;
									}
								}								
							}
							echo "</tr>";						
						}
						echo "<tr class='font10black' bgcolor='#ffffff'><td colspan=5 align='right'>Total</td>";
						echo "<td align='right'>".setNumber($sum1)."</td>";
						echo "<td align='right'>".setNumber($sum2)."</td>";
						echo "<td align='right'>".setNumber($sum3)."</td>";						
						echo "<td align='right'>".setNumber($sum4)."</td>";
						echo "<td align='right'colspan=6>&nbsp;&nbsp;&nbsp;</td>";
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
