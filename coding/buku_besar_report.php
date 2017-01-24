<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Buku Besar";
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
		
		$sql = "select sum(debet) - sum(kredit) from trx_besar where kodeac = '$perkiraancode' and tgl_transaksi < '$tgl1'" ;
		//eror($sql); 
		$rsSaldo = $oDB->ExecuteReader($sql);
		
		$sql = "select tgl_transaksi, kodeac, b.perkiraan_name, no_transaksi, debet, kredit, ket, kodedc, no_reff, c.kode_divisi from trx_besar a 
		inner join mst_perkiraan b on a.kodeac=b.perkiraan_code 
		inner join mst_perkiraan c on a.kodedc=c.perkiraan_code " ; 
		$sql = $sql . " where tgl_transaksi between '$tgl1' and '$tgl2'"; 
		$sql = $sql . " and kodeac = '$perkiraancode'";
		if ($divisi !== "")  $sql = $sql . " and c.kode_divisi='$divisi' ";
		
		$sql = $sql . " order by tgl_transaksi, kodeac ";
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs);
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
	
	if (document.getElementById("txtperkiraan").value == ""){
		alert("silahkan isi perkiraan");
		document.getElementById("txtperkiraan").focus();
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
		<td class="font12Bold"><?php echo $pageTitle; ?></td>
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
					<td>Perkiraan * </td>
					<td>:</td>
					<td>  
					<?php  echo getComboBox(1, "txtperkiraan", $perkiraancode, $rsPerkiraan, ""); ?>
					</td>
				</tr>
				
				<tr class='font10black'>
					<td>Divisi</td>
					<td>:</td>
					<td>
					<?php  echo getComboBoxEx(1, "txtDivisi", $divisi, $rsArtikel, "--All--", ""); ?>
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
					<td>No</td> 
					<td>Tanggal</td>  
					<td>Kode Jurnal</td>
					<td>Uraian</td>  
					<td>Div</td>  
					<td>Kode AC</td>
					<td>No Reff</td>  
					<td>Debet</td>
					<td>Kredit</td>
					<td>Saldo</td> 
				</tr>
				<?php
				if (isset($_POST["txtTgl1"])){
					$dataSaldo = mysql_fetch_array($rsSaldo);
					$saldoawal = $dataSaldo[0];
					$saldo = $saldoawal;
					echo "<tr class='font10black' bgcolor='#ffffff'>"; 
					echo "<td colspan=9>Saldo Awal</td>"; 
					echo "<td align='right'>" . setNumber($saldoawal). "</td>"; 
					echo "</tr>";
						
					if ($numRows == 0)
					{
					?>
					<tr >
						<td class='font10black' colspan="10" bgcolor="white" align="center">Data tidak ada</td> 
					</tr>
					
					<?php
					}
					else
					{ 
						$i = 0;
						$sumDebet = 0;
						$sumKredit = 0;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td>$i</td>";
							echo "<td>$data[0]</td>";  
							echo "<td>$data[3]</td>";
							echo "<td>$data[6]</td>";
							echo "<td>" . $data["kode_divisi"] . "</td>";
							echo "<td>" . $data["kodedc"] . "</td>";
							echo "<td>" . $data["no_reff"] . "</td>";
							echo "<td align='right'>" . setNumber($data[4]). "</td>";
							echo "<td align='right'>" . setNumber($data[5]). "</td>"; 
							
							$saldo = $saldo + $data[4] - $data[5];
							echo "<td align='right'>" . setNumber($saldo). "</td>"; 
							echo "</tr>"; 
							
							$sumDebet = $sumDebet + $data["debet"];
							$sumKredit = $sumKredit + $data["kredit"];
						}
						echo "<tr class='font10black' bgcolor='#ffffff'>";
						echo "<td colspan=7 align='right'>Total</td>";
						echo "<td  align='right'>" . setNumber($sumDebet). "</td>"; 
						echo "<td  align='right'>" . setNumber($sumKredit). "</td>"; 
						echo "<td align='right'>&nbsp;</td>"; 
						echo "</tr>"; 
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
