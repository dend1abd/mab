<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "sales_by_order_entry.php";
	$pageTitle = "Update Status Faktur Penjualan";
	$transaksi_tipe = "6";
	
	$errAlert = false;
	
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);
		$customer = trim($_POST["txtCustomer"]);
		$divisi = trim($_POST["txtDivisi"]);
		$tagihan = trim($_POST["txttagihan"]);
		
		$aksi = trim($_POST["txtaksi"]);
		$jml = trim($_POST["txtjml"]);
		
		if ($aksi == 1){
			for ($i=1; $i<=$jml; $i++){
				$faktur = trim($_POST["txtNofaktur_$i"]);
				$status = trim($_POST["txtStFaktur_$i"]);
				
				if ($status != ""){
					$sql = "update trx_master set stFaktur='$status' where transaksi_kode='$faktur'";
					//echo($sql);
					$oDB->ExecuteNonQuery($sql);				
				}
			}
			$errAlert = true;
			$errMsg = "Data sudah tersimpan";
			//header('location:global_notification.php?strMsg=' . htmlspecialchars("Data sudah tersimpan"));
		}		
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		$customer = "";
		$divisi = "";
		$tagihan = "";
	}	
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_name,', ', left(ifnull(alamat,''), 50)) FROM mst_contact where contact_tipe = 3 order by contact_name";
    $rsCustomer = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select transaksi_kode, CONCAT(transaksi_kode,', ', left(ifnull(transaksi_tgl,''), 50)) from trx_master where transaksi_tipe=16";
    $rsTagihan = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=28 order by kodereff";
    $rsStFaktur = $oDB->ExecuteReader($sqlCmd);	
	
	$sql = "select a.transaksi_kode as no_invoice, a.transaksi_tgl as tgl_invoice, ifnull(total,0) as jml_invoice, (ifnull(bayar,0)+ ifnull(b.paid,0)) as telah_bayar
,(ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)- ifnull(d.total_retur,0)) as piutang
, '' ket_bayar, a.contact_code as kode_customer, c.contact_name as nama_customer, c.alamat, d.total_retur as jml_retur, e.contact_name as nama_sales, a.kode_wilayah, f.reff as status_faktur, a.stFaktur 
, g.transaksi_kode as no_tagihan, a.kode_divisi
from trx_master a
left join 
(
	select a.contact_code, b.no_invoice, sum(ifnull(jml_bayar,0)) as paid
	from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode	
	where a.transaksi_tipe in (18) and a.transaksi_tgl <= NOW()
	group by a.contact_code, b.no_invoice
)b on a.contact_code = b.contact_code and a.transaksi_kode = b.no_invoice

left join 
(
	select sum(ifnull(sisa,0)) as total_retur, no_reff
	from trx_master a 
	where a.transaksi_tipe=8 and a.transaksi_tgl <= NOW()
	group by no_reff
)d on a.transaksi_kode = d.no_reff

inner join mst_contact c on a.contact_code = c.contact_code
left join mst_contact e on a.sales_code = e.contact_code
left join mst_reff f on a.stFaktur = f.kodereff and f.tipereff=28
left join trx_kontrabon g on a.transaksi_kode=g.no_invoice 
where a.transaksi_tipe in (6, 7) ";
//and (ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) <> 0 ";



	if ($customer != "") $sql = $sql . " and a.contact_code='$customer'";
	if ($divisi != "") $sql = $sql . " and a.kode_divisi='$divisi'";
	if ($tagihan != "") 
		$sql = $sql . " and g.transaksi_kode='$tagihan'";
	else
		$sql = $sql . " and (a.transaksi_tgl >= '$tgl1' and a.transaksi_tgl <= '$tgl2' ) ";	
	
	$sql = $sql . " order by a.kode_divisi, a.transaksi_kode ";
	

//echo($sql);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $pageTitle; ?></title
></head>
<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmCari(){  
	document.getElementById("txtaksi").value = 0;
    document.frmList.submit();
}

function frmCekStatus(){  
	if (document.getElementById("txtjml").value == 0){
		alert("Data tidak ada");
		return false;
	}
	
	if (confirm("Confirm cek status ?")){
		jml = parseInt(document.getElementById("txtjml").value);
		for(i=1;i<=jml;i++){
			piutang = eval(document.getElementById('txtPiutang_' + (i)).value);
			if(piutang > 0)
			{
				document.getElementById('txtStFaktur_' + (i)).value = "1";
			}		
			else			
				document.getElementById('txtStFaktur_' + (i)).value = "3";
		}
		alert("Set kirim ulang selesai, silahkan klik tombol save untuk menyimpannya");
	}
	
}

function frmSave(){  
	if (document.getElementById("txtjml").value == 0){
		alert("Data tidak ada");
		return false;
	}
	
	if (confirm("Confirm save data ?")){
		document.getElementById("txtaksi").value = 1;
		document.frmList.submit();
	}
}

function errMsg() {
	<?php 
	if($errAlert == true){
		echo "alert('$errMsg');";
	}
	?>
}

-->
</Script>  

<body onLoad="errMsg();">

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
					<?php  echo getDatePicMand(1, "txtTgl1", $tgl1, ""); ?>
					 s/d 
					<?php  echo getDatePicMand(1, "txtTgl2", $tgl2, ""); ?>
					</td>
				</tr>
                <tr class='font10black'>
					<td>Divisi</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtDivisi", $divisi, $rsArtikel, ""); ?>
					</td>
				</tr>
                <tr class='font10black'>
					<td>Customer</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtCustomer", $customer, $rsCustomer, ""); ?>
					</td>
				</tr>
				<tr class='font10black'>
					<td>No Tagihan</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txttagihan", $tagihan, $rsTagihan, ""); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button" onClick="frmCari();" />
		&nbsp;
		<input type="button" name="btTambah" value="Save" class ="button" onClick="frmSave();" />
		&nbsp;
		<input type="button" name="btTambah" value="Cek Status" class ="button" onClick="frmCekStatus();" />
		
		</td>
	</tr>
	
	<tr>
		<td>		
        
		
		<?php
	echo "<table width=\"$tableWidth\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#d29fec\" align=\"left\">";
	echo "<tr class=\"contentTitleTable\" align=\"center\">";
	echo "<td>No</td>";
	echo "<td>No Faktur</td>";
	echo "<td>Tgl Faktur</td>";
	echo "<td>Customer</td>";
	echo "<td>Jumlah</td>";
	echo "<td>Retur</td>";
	echo "<td>Sudah Bayar</td>";
	echo "<td>Piutang</td>";
	echo "<td>Sales</td>";
	echo "<td>Kode Wilayah</td>";
	echo "<td>No Tagihan</td>";
	echo "<td>No Pembayaran</td>";
	echo "<td>Update Status</td>";	
	echo "</tr>";
	
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs);
	$i = 0;
	if ($numRows == 0){
		$colspan = 12;
		echo "<tr class='font10black' bgcolor='#ffffff' align='center'><td colspan=\"$colspan\">Data tidak ada</td></tr>";
	}
	else{		
		while ($data = mysql_fetch_array($rs)) 
		{
			$i++;
			$jml_invoice = $data["jml_invoice"];
			$telah_bayar = $data["telah_bayar"];
			$jml_hutang = $data["piutang"];
			$stFaktur = $data["stFaktur"];
			
			$noBayar = "";
			$noFaktur = $data["no_invoice"];			
			
			$sqlCmd = "select transaksi_kode from trx_bayar where no_invoice='$noFaktur'"; 
			$rsBayar = $oDB->ExecuteReader($sqlCmd);
			$detilBayar = mysql_num_rows($rsBayar);
			while ($bayar = mysql_fetch_array($rsBayar)){
				$noBayar = $noBayar . $bayar["transaksi_kode"] . " ";
			} 
									
									
			echo "<tr class='font10black' bgcolor='#ffffff' align='center'><td>$i</td>";
				
			echo "<td align='center'>" .$data["no_invoice"]. "</td>";
			
			echo "<td align='left'>" .$data["tgl_invoice"]."</td>";
			
			$link = "pembayaran_piutang_entry.php?op=1&customer=" .$data["kode_customer"]. "&divisi=" . $data["kode_divisi"];
			echo "<td align='left'><a href='$link'>" .$data["nama_customer"]."</a></td>";

			echo "<td align='right'>".setNumber($jml_invoice)."</td>";
			
			echo "<td align='right'>".setNumber($data["jml_retur"])."</td>";
			
			echo "<td align='right'>" .setNumber($telah_bayar)."</td>";
			
			echo "<td align='right'>".setNumber($jml_hutang)."</td>";

			echo "<td align='left'>".$data["nama_sales"]."</td>";

			echo "<td align='left'>".$data["kode_wilayah"]."</td>";
			echo "<td align='left'>".$data["no_tagihan"]."</td>";
			echo "<td align='left'>".$noBayar."</td>";
			
			$key = $data["no_invoice"]; 
			
			echo "<td align='center'>";
			echo getComboBox(1, "txtStFaktur_$i", "$stFaktur", $rsStFaktur, "" );
			echo getHiddenBox(1, "txtNofaktur_$i", "$key");
			echo getHiddenBox(1, "txtPiutang_$i", "$jml_hutang");
			echo "</td></tr>";
		}
	}
	echo "</table><input type='hidden' name='txtjml' id='txtjml' value='$i'><input type='hidden' name='txtaksi' id='txtaksi' value='0'>";
	
?>

		</td>
	</tr>	
</table>

</form>
</body>
</html>