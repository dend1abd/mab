<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);
		
		$sql = "select transaksi_kode, transaksi_tipe, transaksi_tgl, a.contact_code, sales_code, sub_total, sub_qty, disc_persen, disc_amount, ppn_persen, ppn_amount, total, bayar, sisa, keterangan, b.contact_name as supplier, c.contact_name as sales from trx_master a ";
		$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code and b.contact_tipe=5 ";
		$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code and c.contact_tipe=4 ";
		$sql = $sql . "where transaksi_tipe=11 ";
		$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'"; 
	
		$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs);
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
	}
	
	  
	
	//echo $sql
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List Koreksi Stok</title>
</head>
<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmNew(){  
    self.location="koreksi_stok_entry.php?op=1"; 
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
		<td>List Koreksi Stok</td>
	</tr> 
	<tr>
		<td>		
			<table >
				<tr class='font10black'>
					<td>Periode</td>
					<td>:</td>
					<td>
					<?php  echo getDatePic(1, "txtTgl1", $tgl1, ""); ?>
					 s/d 
					<?php  echo getDatePic(1, "txtTgl2", $tgl2, ""); ?>

					</td>
				</tr>
			</table>
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button" onClick="frmCari();" />
		&nbsp;
		<input type="button" name="btTambah" value="Tambah" class ="button" onClick="frmNew();" />
		</td>
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable" align="center">
					<td>No</td> 
					<td>Kode Transaksi</td><td>Tgl Transaksi</td><td>
					Gudang</td><td>Petugas</td><td>Qty</td>
					<td>&nbsp;</td>
				</tr>
				<?php
				if (isset($_POST["txtTgl1"])){
					if ($numRows == 0)
					{
					?>
					<tr >
						<td colspan="8" bgcolor="white" align="center">Data tidak ada</td> 
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
								<td><?php echo $data[0] ?> </td><td><?php echo $data[2] ?> </td><td><?php echo $data[3] . "-" . $data["supplier"]; ?> </td><td><?php echo $data[4] . "-" . $data["sales"];?> </td><td><?php echo $data[6] ?> </td>
								<td>
								<a href="koreksi_stok_entry.php?op=2&ID=<?php echo $data[0]?>">Edit</a> 
								|
								<a href="koreksi_stok_entry.php?op=3&ID=<?php echo $data[0]?>">Delete</a> 
								|
								<a href="koreksi_stok_entry.php?op=4&ID=<?php echo $data[0]?>">View</a> 
								</td>
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

