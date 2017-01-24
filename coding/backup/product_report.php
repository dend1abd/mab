<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	if (isset($_POST["txtKode"])){
		$kode = trim($_POST["txtKode"]);
		$sql = "select product_code, product_name, harga_beli, harga_jual, stok_jualbeli, stok_keluarterima from mst_product"; 
		if ($kode != "")
			$sql = $sql . " where product_code='$kode' or product_name like '%$kode%' ";			
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs); 
	}
	else
	{
		$kode = ""; 
	}
	
	
	
	//echo $sql
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Data Barang</title>
</head>
<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmNew(){  
    self.location="product_entry.php?op=1"; 
}

function frmCari(){  
    document.frmList.submit();
}

-->
</Script> 

<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr class="font12Bold">
		<td style="height: 24px">Laporan Data Barang</td>
	</tr> 
	<tr class="font10black">
		<td>		
			<table >
				<tr >
					<td>Kode / Nama Barang</td>
					<td>:</td>
					<td>
					<?php  echo getTextBox(1, "txtKode", $kode, 20, 20, ""); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button" onclick="frmCari()"/>&nbsp;
		<input type="button" name="btCetak" value="Cetak" class ="button" onclick="window.print();"/>&nbsp; 
		<!--
		<input type="button" name="btToExcel" value="Save To Excel" class ="button"/>&nbsp; 
		<input type="button" name="btToPDF" value="Save To PDF" class ="button"/>&nbsp; -->
		</td>
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable" align="center">
					<td>No</td> 
					<td>Kode Barang</td><td>Nama Barang</td>
					<td>Harga Beli</td><td>Harga Jual</td>
					<td>Stok</td>
				</tr>
				<?php
				if (isset($_POST["txtKode"])){ 
					if ($numRows == 0)
					{
					?>
					<tr >
						<td colspan="8" bgcolor="white">Data tidak ada</td> 
					</tr>
					
					<?php
					}
					else
					{
						$i = 0;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							?>						
							<tr class='font10black' bgcolor='#ffffff'>
								<td><?php echo $i; ?></td>
								<td><?php echo $data[0] ?> </td><td><?php echo $data[1] ?> </td>
								<td align="right"><?php echo setNumber($data[2]) ?> </td><td align="right"><?php echo setNumber($data[3]) ?> </td>
								<td align="right"><?php echo setNumber($data[5]) ?> </td>
							</tr>	
							<?php
						}
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