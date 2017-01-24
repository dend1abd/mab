<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);  
		
		$sql = "select jurnal_code, jurnal_date, perkiraan_header_code, status_debet_kredit, jumlah, perkiraan_name, c.Reff from trx_jurnal a ";
		$sql = $sql . "inner join mst_perkiraan b on a.perkiraan_header_code=b.perkiraan_code ";
		$sql = $sql . "inner join mst_reff c on a.status_debet_kredit = c.kodereff and tipereff=1 ";
		$sql = $sql . "where tipe_jurnal in (4) and jurnal_date between '$tgl1' and '$tgl2'";
		//eror($sql);	
		$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs);
	}
	else
	{ 
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
	}	
	  
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List Jurnal</title>
</head>
<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmNew(){  
    self.location="jurnal_bank_entry.php?op=1"; 
}

function frmCari(){  
    document.frmList.submit();
}

-->
</Script> 

<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td class="font12Bold">List Jurnal Bank</td>
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
				<tr class="contentTitleTable"align="center">
					<td>No</td> 
					<td>Kode Jurnal</td><td>Tgl Jurnal</td><td>Perkiraan Header</td><td>Status D/K</td><td>Jumlah</td>
					<td>&nbsp;</td>
				</tr>
				<?php
				if (isset($_POST["txtTgl1"])){ 
					if ($numRows == 0)
					{
					?>
					<tr >
						<td class='font10black' colspan="7" bgcolor="white" align="center">Data tidak ada</td> 
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
								<td><?php echo $data["jurnal_code"] ?> </td>
								<td><?php echo $data["jurnal_date"] ?> </td>
								<td><?php echo $data["perkiraan_header_code"] . " - " . $data["perkiraan_name"] ?> </td>
								<td><?php echo $data["Reff"] ?> </td>
								<td align="right"><?php echo setNumber($data["jumlah"]) ?> </td>
								<td>
								<a href="jurnal_bank_entry.php?op=2&ID=<?php echo $data[0]?>">Edit</a> 
								|
								<a href="jurnal_bank_entry.php?op=3&ID=<?php echo $data[0]?>">Delete</a> 
								|
								<a href="jurnal_bank_entry.php?op=4&ID=<?php echo $data[0]?>">View</a> 
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

