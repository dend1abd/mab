<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	if (isset($_POST["txtKode"])){
		$kode = trim($_POST["txtKode"]);
	}
	else
	{
		$kode = ""; 
	}
	
	//$halaman = $_GET["halaman"];
	if (isset($_GET["halaman"])){		
		$halaman = $_GET["halaman"];
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
	}
	else{
		$posisi = 0;
		$halaman = 1;	
	}
	
	
	$sql = "select perkiraan_code, perkiraan_name, tglawal, saldoawal, stdk, stac, stkas, stbank, reff, kode_divisi from mst_perkiraan a left join mst_reff b on a.stDK = b.kodereff and b.tipereff=1 limit $posisi, " . $_SESSION["param_jml_record_paging"];
	$sql2 = "select perkiraan_code, perkiraan_name from mst_perkiraan";

	//eror($sql);
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs); 
	
	$rs2 = $oDB->ExecuteReader($sql2);	
	$jmlHalaman = ceil(mysql_num_rows($rs2) /$_SESSION["param_jml_record_paging"]);
	//echo $jmlHalaman; 
	//echo $sql
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List perkiraan</title>
</head>
<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmNew(){  
    self.location="perkiraan_entry.php?op=1"; 
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
		<td class="font12Bold">List perkiraan</td>
	</tr>  
	<tr>
		<td>  
		<input type="button" name="btTambah" value="Tambah" class ="button" onClick="frmNew();" />
		&nbsp;
		<?php 
			if ($jmlHalaman > 1)
				echo "Page :";
			for($i=1; $i<$jmlHalaman; $i++){
				if($i != $halaman){
					echo "<a href=$_SERVER[PHP_SELF]?halaman=$i>$i</a> | ";
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
					<td>Perkiraan Code</td>
					<td>Perkiraan Name</td>
					<td>Kode Divisi</td>
					<td>Saldo Awal</td>
					<td>Saldo Awal Per Tanggal</td>
					<td>D/K</td>
					<td>stAC</td>
					<td>stKas</td>
					<td>stBank</td>
					<td>&nbsp;</td>
				</tr>
				<?php
				if ($numRows == 0)
				{
				?>
				<tr >
					<td colspan="11" bgcolor="white">Data tidak ada</td> 
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
						?>						
						<tr class='font10black' bgcolor='#ffffff'>
							<td><?php echo $nourut; ?></td>
							<td><?php echo $data[0] ?> </td>
							<td><?php echo $data[1] ?> </td>
							<td><?php echo $data["kode_divisi"] ?> </td>
							<td align="right"><?php echo setNumber($data[3]) ?> </td>
							<td align="center"><?php echo $data[2] ?> </td>							
							<td><?php echo $data["reff"] ?> </td>
							<td align="center"><?php echo $data[5] ?> </td>
							<td align="center"><?php echo $data[6] ?> </td>
							<td align="center"><?php echo $data[7] ?> </td>
							<td align="center">
							<a href="perkiraan_entry.php?op=2&ID=<?php echo $data[0]?>">Edit</a> 
							|
							<a href="perkiraan_entry.php?op=3&ID=<?php echo $data[0]?>">Delete</a> 
							|
							<a href="perkiraan_entry.php?op=4&ID=<?php echo $data[0]?>">View</a> 
							</td>
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