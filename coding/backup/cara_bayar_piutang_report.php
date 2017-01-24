<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$transaksi_tipe = "18";
	$pageTitle = "Laporan Cara Pembayaran Piutang";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe in (3)"; 
    $rsCustomer = $oDB->ExecuteReader($sqlCmd);
    
    $sqlCmd = "SELECT kodereff, reff FROM mst_reff where tipereff = 13"; 
    $rsCaraBayar = $oDB->ExecuteReader($sqlCmd);
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff"; 
    $rsdivisi = $oDB->ExecuteReader($sqlCmd);

	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]); 
		$customer = trim($_POST["txtcustomer"]); 
		$cara_bayar = trim($_POST["txtcara_bayar"]);
		$divisi  = retrieveS($_POST["txtdivisi"]);

	}
	else
	{
		$numRow = 0;
		$tgl1 = date("Y-m-01"); //date("Y-m-d");
		//$tgl2 = date("Y-m-d"); 
		$tgl2 = date("Y-m-t"); 
		$customer = "";
		$stOrder = "";
		$cara_bayar = "";
		$sql = "";
		$divisi  = "";
	} 

	$sql = "select a.transaksi_kode, transaksi_tgl, a.bayar, keterangan,  a.contact_code, b.contact_name as customer, e.cara_bayar, e.perkiraan_code, e.perkiraan_name, e.jumlah, e.no_reff, e.tgl_reff, e.ket_reff, c.reff from trx_master a ";
	$sql = $sql . "inner join trx_cara_bayar e on a.transaksi_kode=e.transaksi_kode ";
	$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code ";
	$sql = $sql . "left join mst_reff c on e.cara_bayar=c.kodereff and tipereff=13 ";
	$sql = $sql . "where transaksi_tipe = $transaksi_tipe ";
	$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'";
	
	if ($customer != ""){
		$sql = $sql . "and a.contact_code='$customer' ";
	} 
	
	if ($cara_bayar != ""){
		$sql = $sql . "and e.cara_bayar='$cara_bayar' ";
	} 
	
	if ($divisi != "") $sql = $sql . "and a.kode_divisi= '$divisi' ";  
	
	
	//eror($sql);
		
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $pageTitle?></title>
</head>

<?php include("include/headerfile.php"); ?>
<Script Language="JavaScript">
<!--
	
function frmSubmit(){
	
	if (document.getElementById("txtTgl1").value == ""){
		alert("silahkan isi periode tanggal");
		document.getElementById("txtTgl1").focus();
	}
	
	if (document.getElementById("txtTgl2").value == ""){
		alert("silahkan isi periode tanggal");
		document.getElementById("txtTgl2").focus();
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
					<?php  echo getDatePicMand(1, "txtTgl1", $tgl1, ""); ?>
					 s/d 
					<?php  echo getDatePicMand(1, "txtTgl2", $tgl2, ""); ?>

					</td>
				</tr>
				<tr class="font10black"> 
					<td>Customer</td>
					<td>:</td>
					<td>
						<?php  echo getComboBox(1, "txtcustomer", $customer, $rsCustomer, ""); ?>
					</td>
				</tr>
				<tr class="font10black"> 
					<td>Cara Bayar</td>
					<td>:</td>
					<td>
						<?php  echo getComboBox(1, "txtcara_bayar", $cara_bayar, $rsCaraBayar , ""); ?>
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
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable" align="center">
					<td>No</td> 
					
					<?php
					
					$colspan = 10;
					echo "<td>Tanggal</td>";
					echo "<td>Kode Transaksi</td>";
					echo "<td>Customer</td>";
					echo "<td>Cara Bayar</td>";
					echo "<td>Jumlah</td>";
					echo "<td>Perkiraan</td>";
					echo "<td>No Reff</td>";
					echo "<td>Tgl Reff</td>";
					echo "<td>Ket Reff</td>"; 
					?>
				</tr>
				<?php
				
					if ($numRows == 0)
					{
					?>
					<tr >
						<td class='font10black' colspan="<?php echo $colspan; ?>"  bgcolor="white" align="center">Data tidak ada</td> 
					</tr>
					
					<?php
					}
					else
					{
						$i = 0;
 
						$tTotal = 0;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							?>						
							<tr class='font10black' bgcolor='#ffffff'>
								<td><?php echo $i; ?></td>
						
								<?php
								echo "<td>" .$data["transaksi_tgl"]. "</td>";
								echo "<td>" .$data["transaksi_kode"]. "</td>";
								echo "<td>" .$data["contact_code"]. " - " .$data["customer"]. "</td>";
								echo "<td >" .$data["reff"]. "</td>"; 
								echo "<td align='right'>" .setNumber($data["jumlah"]). "</td>";
								echo "<td>" .$data["perkiraan_code"]. " - " .$data["perkiraan_name"]. "</td>";
								echo "<td >" .$data["no_reff"]. "</td>";
								echo "<td >" .$data["tgl_reff"]. "</td>";
								echo "<td >" .$data["ket_reff"]. "</td>";
								
								$tTotal = $tTotal + $data["jumlah"];	
								?>							
							</tr>
						<?php							
						}
						 
						echo "<tr class='font10black' bgcolor='#ffffff'>";
						echo "<td colspan='5' align='right'><b>Total</b></td>";
						echo "<td align='right'><b>" .setNumber($tTotal). "</b></td>";
						echo "<td colspan='4' ></td>";
						echo "</tr>";
						
					}
				?>
			</table>
		</td>
	</tr>	
</table>

</form>

</body>

</html>
