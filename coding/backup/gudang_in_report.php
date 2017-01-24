<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Penerimaan Barang";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$transKode = "in (9, 10, 13)";
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = retrieveS($_POST["txtTgl1"]);
		$tgl2 = retrieveS($_POST["txtTgl2"]);
		$contact_code = retrieveS($_POST["txtcontact_code"]);
		$product_name  = retrieveS($_POST["txtproduct_name"]);
		$product_code  = retrieveS($_POST["txtproduct_code"]);
		$gudang = retrieveS($_POST["txtgudang"]); 
		
		$halaman = retrieveS($_POST["txtHalaman"]);
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		$contact_code = "";
		$product_name  = "";
		$product_code  = "";
		$gudang = "";
		
		$posisi = 0;
		$halaman = 1;
	} 
	
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe=3 order by contact_name"; 
    $rsCustomer = $oDB->ExecuteReader($sqlCmd); 
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe =5"; 
    $rsgudang = $oDB->ExecuteReader($sqlCmd); 
	
	$sql = "select a.transaksi_kode, transaksi_tgl, a.gudang_kode, b.contact_name as gudang, a.sales_code, c.contact_name as sales, a.contact_code, d.contact_name as customer, e.*  from trx_master a ";
	$sql = $sql . "inner join trx_detail e on a.transaksi_kode=e.transaksi_kode ";
	$sql = $sql . "left join mst_contact b on a.gudang_kode=b.contact_code and b.contact_tipe=5 ";
	$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code and c.contact_tipe=4 ";
	$sql = $sql . "left join mst_contact d on a.contact_code=d.contact_code ";
	$sql = $sql . "where transaksi_tipe $transKode ";
	$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'";
	
	if ($gudang != "") $sql = $sql . "and a.gudang_kode='$gudang' ";			
	if ($product_code != "") $sql = $sql . "and (e.product_code = '$product_code') ";
	if ($contact_code != "") $sql = $sql . "and a.contact_code = '$contact_code' ";  
	
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

function lookupBarang(){
	lookupWindow('product_lookup_report.php?tipe=0&kode=' + document.getElementById('txtproduct_code').value, 'product_list');	
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
			<table>
            	<tr>
                	<td width="50%">
                    	<table>
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
                            
                            <tr class="font10black"> 
                                <td>Gudang</td>
                                <td>:</td>
                                <td>
                                    <?php  echo getComboBox(1, "txtgudang", $gudang, $rsgudang, ""); ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    
                    <td>
                    	<table>
                            <tr class='font10black'>
                                <td>Kode Barang</td>
                                <td>:</td>
                                <td nowrap="nowrap">
                                <?php  
                                    echo getTextBox(1, "txtproduct_code", $product_code, 20, 20, ""); 
                                    echo "&nbsp;";						
                                    echo getTextBox(1, "txtproduct_name", $product_name, 40, 40, $clsReadOnly . " readonly"); 
                                    echo "<input class=\"button\" type=\"button\" name=\"btnLookUp\" value=\"...\" onClick='lookupBarang()' />";
                                
                                ?> 
                                </td>
                            </tr>
                            <tr class='font10black'>
                                <td>Customer</td>
                                <td>:</td>
                                <td>
                                <?php  echo getComboBox(1, "txtcontact_code", $contact_code, $rsCustomer, ""); ?> 
                                </td>
                            </tr>
                        </table>
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
					<td>Tanggal</td>
					<td>No Transaksi</td>
					<td>Customer</td>
                    <td>Petugas</td>
					<td>Gudang</td>
					<td>Nama Barang</td> 
					<td>Qty</td> 
					<td>Detail Qty</td>
					<td>Ket</td>  
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
						?>						
						<tr class='font10black' bgcolor='#ffffff'>
							<td><?php echo $nourut; ?></td>
							<td><?php echo $data["transaksi_tgl"] ?> </td>
							<td><?php echo $data["transaksi_kode"] ?> </td> 
							<td><?php echo $data["contact_code"] . "-" . $data["customer"]; ?> </td>
                            <td><?php echo $data["sales_code"] . "-" . $data["sales"]; ?> </td>
                            <td><?php echo $data["gudang_kode"] . "-" . $data["gudang"]; ?> </td>                            
							<td><?php echo $data["product_code"] . "-" . $data["product_name"];?> </td> 
							<td align="right"><?php echo $data["qty"] ?> </td>
							<td>
							<?php 
							$detil_size = "";
							if (($data["kode_size1"] != "") && ($data["qty_size1"] <> null) && ($data["qty_size1"] <> 0)) $detil_size = $detil_size .  $data["kode_size1"] . "/" .$data["qty_size1"]. "; ";
							if (($data["kode_size2"] != "") && ($data["qty_size2"] <> null) && ($data["qty_size2"] <> 0)) $detil_size = $detil_size .  $data["kode_size2"] . "/" .$data["qty_size2"]. "; ";
							if (($data["kode_size3"] != "") && ($data["qty_size3"] <> null) && ($data["qty_size3"] <> 0)) $detil_size = $detil_size .  $data["kode_size3"] . "/" .$data["qty_size3"]. "; ";
							if (($data["kode_size4"] != "") && ($data["qty_size4"] <> null) && ($data["qty_size4"] <> 0)) $detil_size = $detil_size .  $data["kode_size4"] . "/" .$data["qty_size4"]. "; ";
							if (($data["kode_size5"] != "") && ($data["qty_size5"] <> null) && ($data["qty_size5"] <> 0)) $detil_size = $detil_size .  $data["kode_size5"] . "/" .$data["qty_size5"]. "; ";
							if (($data["kode_size6"] != "") && ($data["qty_size6"] <> null) && ($data["qty_size6"] <> 0)) $detil_size = $detil_size .  $data["kode_size6"] . "/" .$data["qty_size6"]. "; ";
							if (($data["kode_size7"] != "") && ($data["qty_size7"] <> null) && ($data["qty_size7"] <> 0)) $detil_size = $detil_size .  $data["kode_size7"] . "/" .$data["qty_size7"]. "; ";
							if (($data["kode_size8"] != "") && ($data["qty_size8"] <> null) && ($data["qty_size8"] <> 0)) $detil_size = $detil_size .  $data["kode_size8"] . "/" .$data["qty_size8"]. "; ";								
							echo $detil_size; 
							?> 
							</td>
							<td><?php echo $data["ket_detail"] ?> </td>
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

