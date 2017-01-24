<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	$pageTitle = "Neraca Saldo";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select perkiraan_code, concat(perkiraan_code, '-', perkiraan_name) from mst_perkiraan";  
	$rsPerkiraan = $oDB->ExecuteReader($sqlCmd);	
	
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]); 
		$divisi = trim($_POST["txtDivisi"]);
		$perkiraancode = trim($_POST["txtperkiraan"]);		
	}
	else
	{
		$kode = ""; 
		$numRow = 0;
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d"); 
		$perkiraancode = ""; 
		$divisi = "";		
		$sql = "";
	} 
	
	$sql = "select perkiraan_code, perkiraan_name, stdk, 0 as saldoawaldebet, 0 as saldoawalkredit, 0 as mutasidebet, 0 as mutasikredit, 0 as saldoakhirdebet, 0 as saldoakhirkredit from mst_perkiraan a " ;
	//$sql = $sql . " where tgl_transaksi between '$tgl1' and '$tgl2'";
	if ($perkiraancode != "")
		$sql = $sql . " and kodeac = '$perkiraancode'";

	$rs = $oDB->ExecuteReader($sql);
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
	
function frmSubmit(){
	
	if (document.getElementById("txtTgl1").value == ""){
		alert("silahkan isi periode tanggal");
		document.getElementById("txtTgl1").focus();
		return false;
	}
	
	if (document.getElementById("txtTgl2").value == ""){
		alert("silahkan isi periode tanggal");
		document.getElementById("txtTgl2").focus();
		return false;
	}

	document.frmList.submit();
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
					<td>Periode</td>
					<td>:</td>
					<td>
					<?php  echo getDatePic(1, "txtTgl1", $tgl1, ""); ?>
					 s/d 
					<?php  echo getDatePic(1, "txtTgl2", $tgl2, ""); ?>

					</td>
				</tr>
				<tr class="font10black"> 
					<td>Perkiraan</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtperkiraan", $perkiraancode, $rsPerkiraan, ""); ?>
					</td>
				</tr>
				
				<tr class='font10black'>
					<td>Divisi</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtDivisi", $divisi, $rsArtikel, ""); ?>
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
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable" align="center">
					<td style="height: 24px">No</td>  
					<td style="height: 24px">Perkiraan</td>
					<td style="height: 24px">Saldo Awal Debet</td>  
					<td style="height: 24px">Saldo Awal Kredit</td>
					<td style="height: 24px">Mutasi Debet</td>  
					<td style="height: 24px">Mutasi Kredit</td>
					<td style="height: 24px">Saldo Akhir Debet</td>  
					<td style="height: 24px">Saldo Akhir Kredit</td>
				</tr>
				<?php
				if (isset($_POST["txtTgl1"])){
					if ($numRows == 0)
					{
					?>
					<tr >
						<td class='font10black' colspan="8"  bgcolor="white" align="center">Data tidak ada</td> 
					</tr>
					
					<?php
					}
					else
					{
						$i = 0;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td>$i</td>";
							echo "<td>" .$data["perkiraan_code"]. " - " .$data["perkiraan_name"] ."</td>"; 
							echo "<td align='right'>" . setNumber($data["saldoawaldebet"]). "</td>";
							echo "<td align='right'>" . setNumber($data["saldoawalkredit"]). "</td>";
							echo "<td align='right'>" . setNumber($data["mutasidebet"]). "</td>";
							echo "<td align='right'>" . setNumber($data["mutasidebet"]). "</td>";
							echo "<td align='right'>" . setNumber($data["saldoakhirdebet"]). "</td>";
							echo "<td align='right'>" . setNumber($data["saldoakhirkredit"]). "</td>";
							echo "</tr>";
							
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
