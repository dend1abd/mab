<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Mutasi Hutang";
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
	
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe=2 order by contact_name"; 
    $rsSupplier = $oDB->ExecuteReader($sqlCmd); 
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff"; 
    $rsdivisi = $oDB->ExecuteReader($sqlCmd);

		
	$sql = "
	select 
a.contact_code, a.contact_name, a.alamat, kota, telp, fax, email, hubungi_nama, hubungi_telp
, ifnull(b.total,0) as jual_total, ifnull(b.bayar,0) as awal_jual_bayar
, ifnull(d.paid,0) as awal_paid
, ifnull(b.total,0) - ifnull(b.bayar,0) - ifnull(d.paid,0) as awal_piutang
, ifnull(e.total,0) - ifnull(e.bayar,0) as piutang
, ifnull(g.paid,0) as bayar_piutang 
, ( ifnull(b.total,0) - ifnull(b.bayar,0) - ifnull(d.paid,0) ) + 
( ifnull(e.total,0) - ifnull(e.bayar,0) ) -
ifnull(g.paid,0) as akhir_piutang
from mst_contact a

left join 
(
select contact_code, sum(ifnull(total,0)) as total, sum(ifnull(bayar,0)) as bayar  from trx_master 	
where transaksi_tipe in (2, 3, 4) and transaksi_tgl < '$tgl1'
group by contact_code
)b on a.contact_code = b.contact_code

left join 
(
select contact_code, sum(ifnull(jml_bayar,0)) as paid
from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode	
where a.transaksi_tipe in (17) and a.transaksi_tgl < '$tgl1'
group by a.contact_code
)d on a.contact_code = d.contact_code

left join 
(
select contact_code, sum(ifnull(total,0)) as total, sum(ifnull(bayar,0)) as bayar  from trx_master 	
where transaksi_tipe in (2, 3, 4) and transaksi_tgl between '$tgl1' and '$tgl2' 
group by contact_code
)e on a.contact_code = e.contact_code

left join 
(
select contact_code, sum(ifnull(jml_bayar,0)) as paid
from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode	
where a.transaksi_tipe in (17) and a.transaksi_tgl between '$tgl1' and '$tgl2' 
group by a.contact_code
)g on a.contact_code = g.contact_code


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

function link1(kode){ 	
	tgl1 = document.getElementById("txtTgl1").value;
	tgl2 = document.getElementById("txtTgl2").value;	
	url = "mutasi_hutang_detail_report.php?kode=" +kode+ "&tgl1=" +tgl1+ "&tgl2=" +tgl2
	
	lookupWindow(url, "mutasi_hutang_detail_" + kode)
	//alert(url);
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
					<td>Kode Supplier</td>
					<td>Nama Supplier</td>
					<td>Saldo Awal</td>
					<td>Hutang</td>
					<td>Bayar</td>
					<td>Saldo Akhir</td> 
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
					
					while ($data = mysql_fetch_array($rs)) 
					{
						$i++;
						$nourut = $posisi + $i; 
						
						$link = "<a href='#' onClick=\"link1('" .$data["contact_code"]. "')\">" .$data["contact_code"]. "</a>";
					
						?>						
						<tr class='font10black' bgcolor='#ffffff'>
							<td align="center"><?php echo $nourut; ?></td>
							<td><?php echo $link ?> </td>
							<td><?php echo $data["contact_name"] ?> </td>  
                            <td align="right"><?php echo setNumber($data["awal_piutang"]) ?> </td>
							<td align="right"><?php echo setNumber($data["piutang"]) ?> </td>
							<td align="right"><?php echo setNumber($data["bayar_piutang"]) ?> </td>
							<td align="right"><?php echo setNumber($data["akhir_piutang"]) ?> </td>                             
						</tr>	
						<?php
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

