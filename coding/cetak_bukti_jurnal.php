<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	$kode = trim($_GET["kode"]);
	
	if ($kode == "") 
		eror("Kode Bukti Kosong");
	
	$sql = "select jurnal_code, jurnal_date, keterangan, jumlah, status_debet_kredit, perkiraan_header_code, b.perkiraan_name from trx_jurnal a inner join mst_perkiraan b on a.perkiraan_header_code = b.perkiraan_code where jurnal_code='$kode'" ;
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs);  
	
	if ($numRows == 0)
		eror("Data tidak ada");
	
	$data = mysql_fetch_array($rs); 
	
	$sql = "select * from trx_jurnal_detail where jurnal_code='" .$data["jurnal_code"] . "'";
	$rsDetail = $oDB->ExecuteReader($sql);
	//$dataDetail = mysql_fetch_array($rsDetail);  
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Bukti Jurnal</title>
</head>

<?php include("include/headerfile.php"); ?>

<body leftmargin="0" topmargin="0" onload="window.print();">

<table width="800" border="0" cellpadding="2" cellspacing="1">
<tr class="invoiceTitle">
<td>
<?php
	echo $_SESSION["param_company_name"];
?>

</td>
</tr>  
<tr>
<td>

<table>
<tr class="invoiceTitle2">
<td colspan="3">Jurnal Voucher</td> 
</tr>
<tr class="font10black">
<td width="15%">No Bukti</td>
<td width="1%">:</td>
<td><?php echo $data[0]; ?></td>
</tr>

<tr class="font10black"> 
<td>Tanggal</td>
<td>:</td>
<td><?php echo $data[1]; ?></td>
</tr>

<tr class="font10black">  
<td colspan="3">
<table width="100%"  cellspacing="1" bgcolor="silver" id="tblJurnalDetail" > 
<tr class="contentTitleTable" align="center">  
<td>No</td>
							<td>Perkiraan</td>  
							<td>Tgl Dok</td>
							<td>No Dok</td>
							<td>Ket Dok</td>
							<td>Debet</td> 
							<td>Kredit</td> 
</tr>
<?php
if ($data["status_debet_kredit"] == 1){
	$debet = setNumber($data["jumlah"]);
	$kredit = "";
}
else{
	$debet = "";
	$kredit = setNumber($data["jumlah"]);
}

?>
<tr bgcolor='#ffffff' class='font10black'>  
<td>1</td>
							<td align="left"><?php echo $data["perkiraan_header_code"] . " - " . $data["perkiraan_name"]; ?></td>  
							<td></td>
							<td></td>
							<td></td>
							<td align="right"><?php echo $debet; ?></td> 
							<td align="right"><?php echo $kredit ; ?></td> 
</tr>

<?php 
$i = 1;
	while ($datadetail = mysql_fetch_array($rsDetail)) 
	{
		$i++;
		
		if ($data["status_debet_kredit"] == 1){
			$kredit = setNumber($datadetail["jumlah"]);
			$debet = "";
		}
		else{
			$kredit = "";
			$debet = setNumber($datadetail["jumlah"]);
		}

 ?>								

<tr bgcolor='#ffffff' class='font10black'> 
<td><?php echo $i; ?></td>
							<td><?php echo $datadetail["perkiraan_code"] . " - " . $datadetail["perkiraan_name"]; ?></td>  
							<td><?php echo $datadetail["tgl_dok"]; ?></td>
							<td><?php echo $datadetail["no_dok"]; ?></td>
							<td><?php echo $datadetail["ket_dok"]; ?></td>
							<td align="right"><?php echo $debet; ?></td> 
							<td align="right"><?php echo $kredit ; ?></td> </tr>
<?php
}
						?>

<tr bgcolor='#ffffff' class='font10black'> 
<td colspan="5" align="right">Total</td>
							<td align="right"><?php echo setNumber($data["jumlah"]); ?></td> 
							<td align="right"><?php echo setNumber($data["jumlah"]); ?></td> 
</tr>

<tr bgcolor='#ffffff' class='font10black'> 
<td colspan="7">Terbilang : #<?php echo terbilang($data[3]); ?> rupiah#</td>
</tr>

</table>
</td> 
</tr> 

<tr class="font10black"> 
<td>Ket</td>
<td>:</td>
<td><?php echo $data[2]; ?></td>
</tr>

<tr class="font10black">  
<td colspan="3">&nbsp;</td> 
</tr>

<tr class="font10black">  
<td colspan="3">
<table width="80%"  cellspacing="1" bgcolor="silver" id="tblJurnalDetail" > 
<tr bgcolor='#ffffff' class='font10black' align="center">  
			<td>Menyetujui</td>
			<td>Mengetahui</td>  
			<td>Penerima</td>
			<td>Dibuat Oleh</td> 
</tr>

<tr bgcolor='#ffffff' class='font10black' height="50"> 
 
							<td>&nbsp;</td>  
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td> 
</tr>

</table>

</td> 
</tr>



</table>

</td>
</tr>



</table> 

</body>

</html>
