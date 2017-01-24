<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Saldo Hutang";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
	
	//$_SESSION["param_jml_record_paging"] = 2;
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$tgl = trim($_POST["txtTgl"]);  
		$contact_code = trim($_POST["txtcontact_code"]); 
		$divisi  = retrieveS($_POST["txtdivisi"]);
		
		$halaman = trim($_POST["txtHalaman"]);
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
	}
	else
	{
		$numRow = 0;
		$tgl = date("Y-m-d"); 
		$contact_code = ""; 
		$divisi  = "";
		
		$posisi = 0;
		$halaman = 1;
	} 	
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe = 2 order by contact_name";
	$rsSupplier = $oDB->ExecuteReader($sqlCmd); 
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff"; 
    $rsdivisi = $oDB->ExecuteReader($sqlCmd);
	
	$sql = "
	select 
a.contact_code, a.contact_name, a.alamat, kota, telp, fax, email, hubungi_nama, hubungi_telp
, ifnull(b.total,0) as beli_total, ifnull(b.bayar,0) as beli_bayar
, ifnull(d.paid,0) as paid
, ifnull(b.total,0) - ifnull(b.bayar,0) - ifnull(d.paid,0) as piutang
from mst_contact a

left join 
(
select contact_code, sum(ifnull(total,0)) as total, sum(ifnull(bayar,0)) as bayar  from trx_master 	
where transaksi_tipe in (2, 3, 4) and transaksi_tgl <= '$tgl'
group by contact_code
)b on a.contact_code = b.contact_code

left join 
(
select contact_code, sum(ifnull(jml_bayar,0)) as paid
from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode	
where a.transaksi_tipe in (17) and a.transaksi_tgl <= '$tgl'
group by a.contact_code
)d on a.contact_code = d.contact_code

where a.contact_tipe=2	";
	
	if ($contact_code != "") $sql = $sql . "and a.contact_code='$contact_code' ";
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

function link1(supplier){ 	
	tgl = document.getElementById("txtTgl").value;
	url = "saldo_hutang_detail_report.php?supplier=" +supplier+ "&tgl=" +tgl
	lookupWindow(url, "saldo_hutang_" + supplier)
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
		<td style="height: 53px">		
			<table >
				<tr class="font10black">
					<td>Hutang Per Tanggal</td>
					<td>:</td>
					<td>
					<?php  
					echo getHiddenBox(1, "txtHalaman", $halaman);	
					echo getDatePicMand(1, "txtTgl", $tgl, ""); ?> 
					</td>
				</tr>
				
				<tr class="font10black"> 
					<td>Supplier</td>
					<td>:</td>
					<td>
						<?php  echo getComboBoxEx(1, "txtcontact_code", $contact_code, $rsSupplier, "-- All --", ""); ?>
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
					<td>Supplier</td>
					<td>Alamat</td>
					<td>Kota</td>
					<td>Telp</td>
					<td>Fak</td>
					<td>Email</td>
                    <td>Hubungi</td>
                    <td>Jml Hutang</td>
				</tr>

				<?php 
				
					$colspan = 9;
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
						$sumPiutang = 0;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++; 	
							$nourut = $posisi + $i;
							$link = "<a href='#' onClick=\"link1('" .$data["contact_code"]. "')\">" .$data["contact_code"]. "- " . $data["contact_name"] . "</a>";
							
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td>$nourut</td>";
							echo "<td>$link</td>";
							echo "<td>".$data["alamat"]."</td>";
							echo "<td>".$data["kota"]."</td>";
							echo "<td>".$data["telp"]."</td>";
							echo "<td>".$data["fax"]."</td>";
							echo "<td>".$data["email"]."</td>";
							echo "<td>".$data["hubungi_nama"] . " - " . $data["hubungi_telp"] ."</td>";							
							echo "<td align='right'>".setNumber($data["piutang"])."</td>"; 							
							echo "</tr>";						
							
							$sumPiutang = $sumPiutang  + $data["piutang"];
						}
						echo "<tr class='font10black' bgcolor='#ffffff'>";
						echo "<td colspan=8>&nbsp;</td>";
						echo "<td align='right'><b>".setNumber($sumPiutang)."</b></td></tr>"; 
					} 
				?>
			</table>
		</td>
	</tr>	
</table>

</form>

</body>

</html>
