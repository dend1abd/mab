<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$tableWidth = "100%";
	$pageEdit = "sales_by_order_entry.php";
	$pageTitle = "Update Status Piutang";
	$transaksi_tipe = "6";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	 
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]);
		$customer = trim($_POST["txtCustomer"]);
		$divisi = trim($_POST["txtDivisi"]);
		$stfaktur = trim($_POST["txtStFaktur"]);
		
		$aksi = trim($_POST["txtaksi"]);
		$jml = trim($_POST["txtjml"]);
		
		if ($aksi == 1){
			for ($i=1; $i<=$jml; $i++){
				$faktur = trim($_POST["txtNofaktur_$i"]);
				$status = trim($_POST["txtStFaktur_$i"]);
				
				if ($status != ""){
					$sql = "update trx_master set stfaktur='$status' where transaksi_kode='$faktur'";
					//echo($sql);
					$oDB->ExecuteNonQuery($sql);				
				}
			}
			header('location:global_notification.php?strMsg=' . htmlspecialchars("Data sudah tersimpan"));
		}
		
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		$customer = "";
		$divisi = "";
		$stfaktur = "";
	}	
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_name,', ', left(ifnull(alamat,''), 50)) FROM mst_contact where contact_tipe = 3 order by contact_name";
    $rsCustomer = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=28 order by reff";
    $rsStFaktur = $oDB->ExecuteReader($sqlCmd);	
	
	$array2d[] = array("No Faktur", "transaksi_kode", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Tgl Faktur", "transaksi_tgl", "left", "varchar", "10%", "notsum");
	$array2d[] = array("Kode Divisi", "kode_divisi", "left", "varchar", "10%", "notsum");
	$array2d[] = array("No Order", "no_reff", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Tgl Order", "tgl_reff", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Customer", "b.contact_name as supplier", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Karyawan", "c.contact_name as sales", "left", "varchar", "10%", "notsum");	
	$array2d[] = array("Status", "stFaktur", "left", "varchar", "0", "notsum");	
	$sql = "from trx_master a ";
	$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code and b.contact_tipe=3 ";
	$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code and c.contact_tipe=4 ";
	$sql = $sql . "where transaksi_tipe in (6, 7) ";
	$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2' "; 	
	
	if ($customer != "") $sql = $sql . "and a.contact_code='$customer'";
	if ($divisi != "") $sql = $sql . "and a.kode_divisi='$divisi'";
	if ($stfaktur != "") $sql = $sql . "and a.stfaktur='$stfaktur'";
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
					<td>Status Faktur</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtStFaktur", $stfaktur, $rsStFaktur, ""); ?>
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
		</td>
	</tr>
	
	<tr>
		<td>		
        
		
		<?php
	echo "<table width=\"$tableWidth\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#d29fec\" align=\"left\">";
	echo "<tr class=\"contentTitleTable\" align=\"center\">";
	echo "<td>No</td>";
	
	//$xx = "insert into $tableName(";
	$arrField = $array2d;
	$pjg = count($arrField);
	//eror("as");
	$fields = "";
	for ($k=0;$k<$pjg;$k++)
	{
		$titleName = $arrField[$k][0];
		$fieldName = $arrField[$k][1];			
		$align = $arrField[$k][2];
		
		if ($arrField[$k][4] != "0")
			echo "<td>$titleName</td>";	
			
		if($k == 0)
			$fields = $fieldName ;
		else
			$fields = $fields . ", " . $fieldName ;	
		
	}
	echo "<td>Update Status</td>";	
	echo "</tr>";
	
	$sql = "select $fields $sql";
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs);
	$i = 0;
	if ($numRows == 0){
		$colspan = $pjg+3;
		echo "<tr class='font10black' bgcolor='#ffffff' align='center'><td colspan=\"$colspan\">Data tidak ada</td></tr>";
	}
	else{		
		while ($data = mysql_fetch_array($rs)) 
		{
			$i++;
			echo "<tr class='font10black' bgcolor='#ffffff' align='center'><td>$i</td>";
			for ($k=0;$k<$pjg;$k++)
			{
				$titleName = $arrField[$k][0];
				$fieldName = $arrField[$k][1];			
				$align = $arrField[$k][2];				
				$fieldType = $arrField[$k][3];			
				$value = $data[$k];
				
				if ($k==0) $faktur=$value;
				if ($k==7) $status=$value;
				
				if ($fieldType == "money") $value = setNumber($value);
				if ($arrField[$k][4] != "0")
					echo "<td align='$align'>$value</td>";			
			}	
			
			$key = $data[0];
			$editLink = "<a href=\"$pageEdit?op=2&ID=$key\">Edit</a>"; 
			$delLink = "<a href=\"$pageEdit?op=3&ID=$key\">Delete</a>"; 
			$viewLink = "<a href=\"$pageEdit?op=4&ID=$key\">View</a>"; 
			
			echo "<td align='center'>";
			echo getComboBox(1, "txtStFaktur_$i", "$status", $rsStFaktur, "" );
			echo getHiddenBox(1, "txtNofaktur_$i", "$faktur");
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
