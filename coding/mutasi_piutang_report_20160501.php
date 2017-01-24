<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Mutasi Piutang";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);
		$contact_code = trim($_POST["txtcontact_code"]); 
		
		$halaman = trim($_POST["txtHalaman"]);
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		$contact_code = ""; 
		
		$posisi = 0;
		$halaman = 1;
	} 
	
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe=3 order by contact_name"; 
    $rsCustomer = $oDB->ExecuteReader($sqlCmd); 
		
	$sql = "select a.contact_code, a.contact_name, ifnull(sum(b.jml_in) - sum(b.jml_out), 0) as saldo_awal, ifnull(sum(c.jml_in),0) piutang, ifnull(sum(c.jml_out),0) bayar, (ifnull(sum(b.jml_in),0) - ifnull(sum(b.jml_out),0) + ifnull(sum(c.jml_in),0) - ifnull(sum(c.jml_out),0)) as saldo_akhir from mst_contact a  ";
	$sql = $sql . "left join trx_invoice b on a.contact_code = b.contact_code and  b.tgl_transaksi < '$tgl1'  ";
	$sql = $sql . "left join trx_invoice c on a.contact_code = c.contact_code and  c.tgl_transaksi between '$tgl1' and '$tgl2' "; 
	
	$sql = $sql . "where a.contact_tipe = 3 ";
	
	if ($contact_code != ""){
		$sql = $sql . "and a.contact_code = '$contact_code' ";    
	}
	
	$sql = $sql . "group by a.contact_code, a.contact_name ";
	$sql = $sql . "having (ifnull(sum(b.jml_in),0) - ifnull(sum(b.jml_out),0) + ifnull(sum(c.jml_in),0) - ifnull(sum(c.jml_out),0)) <> 0 ";
	
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
	url = "mutasi_piutang_detail_report.php?kode=" +kode+ "&tgl1=" +tgl1+ "&tgl2=" +tgl2
	
	lookupWindow(url, "mutasi_piutang_detail_" + kode)
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
					<td>Customer</td>
					<td>:</td>
					<td>
                    <?php  echo getComboBoxEx(1, "txtcontact_code", $contact_code, $rsCustomer, "-- All --", ""); ?> 
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
					<td>Kode Customer</td>
					<td>Nama Customer</td>
					<td>Saldo Awal</td>
					<td>Piutang</td>
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
                            <td align="right"><?php echo setNumber($data["saldo_awal"]) ?> </td>
							<td align="right"><?php echo setNumber($data["piutang"]) ?> </td>
							<td align="right"><?php echo setNumber($data["bayar"]) ?> </td>
							<td align="right"><?php echo setNumber($data["saldo_akhir"]) ?> </td>                             
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

