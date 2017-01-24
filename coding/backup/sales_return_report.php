<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Retur Penjualan Barang";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = retrieveS($_POST["txtTgl1"]);
		$tgl2 = retrieveS($_POST["txtTgl2"]);
		$contact_code = retrieveS($_POST["txtcontact_code"]);
		$sales_code = retrieveS($_POST["txtsales_code"]);
		$product_name  = retrieveS($_POST["txtproduct_name"]);
		$product_code  = retrieveS($_POST["txtproduct_code"]);
		
		$divisi  = retrieveS($_POST["txtdivisi"]);
		//$warna  = retrieveS($_POST["txtwarna"]);
		
		$halaman = trim($_POST["txtHalaman"]);
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
	}
	else
	{
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d");  
		$contact_code = "";
		$sales_code = "";
		$product_name  = "";
		$product_code  = "";
		
		$divisi  = "";
		//$warna  = "";
		
		$posisi = 0;
		$halaman = 1;
	} 
	
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe=3 order by contact_name"; 
    $rsCustomer = $oDB->ExecuteReader($sqlCmd); 
    
	$sqlCmd = "SELECT contact_code, contact_name FROM mst_contact where contact_tipe=4 order by contact_name"; 
    $rsKaryawan = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=14 order by reff"; 
    $rsWarna = $oDB->ExecuteReader($sqlCmd);
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff"; 
    $rsdivisi = $oDB->ExecuteReader($sqlCmd);
		
	$sql = "select a.transaksi_tgl, a.transaksi_kode, a.contact_code, a.sales_code, b.contact_name as customer, c.contact_name as sales, d.*, a.kode_divisi, a.no_reff, a.tgl_reff from trx_master a ";
	$sql = $sql . "inner join trx_detail d on a.transaksi_kode = d.transaksi_kode ";
	$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code ";
	$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code ";
	$sql = $sql . "where a.transaksi_tipe in (8) ";
	$sql = $sql . "and a.transaksi_tgl between '$tgl1' and '$tgl2' ";  
	
	if ($product_code != ""){
		$sql = $sql . "and d.product_code = '$product_code' ";  
	}
	
	if ($contact_code != ""){
		$sql = $sql . "and a.contact_code = '$contact_code' ";  
	}
	
	if ($sales_code != ""){
		$sql = $sql . "and a.sales_code = '$sales_code' ";  
	}
	
	if ($divisi != ""){
		$sql = $sql . "and a.kode_divisi= '$divisi' ";  
	} 
	
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
                	<td width="50%" valign="top">
                    	<table>
                        	<tr class='font10black'>
                                <td>Periode Tanggal</td>
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
                                <td>Divisi</td>
                                <td>:</td>
                                <td>
                                <?php  echo getComboBox(1, "txtdivisi", $divisi, $rsdivisi, ""); ?> 
                                </td>
                            </tr>                           
                        </table>
                    </td>
                    
                    <td valign="top">
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
                            <tr class='font10black'>
                                <td>Sales</td>
                                <td>:</td>
                                <td>
                                <?php  echo getComboBox(1, "txtsales_code", $sales_code, $rsKaryawan, ""); ?>					
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
					<td>No Retur</td>
                    <td>Divisi</td>
					<td>Customer</td>
					<td>Sales</td>
					<td>Nama Barang</td> 
					<td>Qty</td>  
                    <td>Satuan</td>  
					<td>Harga</td> 
					<td>Sub Total</td>
					<td>Disc</td>  
					<td>Total</td>
					<td>Ket</td>  
                    <td>No Faktur</td>  
                    <td>Tgl Faktur</td>  
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
					$sumqty = 0;
					$sumsub_total = 0;
					$sumdisc_amount = 0;
					$sumtotal = 0;
					while ($data = mysql_fetch_array($rs)) 
					{
						$i++;
						$nourut = $posisi + $i;
						
						?>						
						<tr class='font10black' bgcolor='#ffffff'>
							<td><?php echo $nourut; ?></td>
							<td><?php echo $data["transaksi_tgl"] ?> </td>
							<td><?php echo $data["transaksi_kode"] ?> </td> 
                            <td><?php echo $data["kode_divisi"] ?> </td> 
							<td><?php echo $data["contact_code"] . "-" . $data["customer"]; ?> </td>
							<td><?php echo $data["sales_code"] . "-" . $data["sales"];?> </td> 
							<td><?php echo $data["product_code"] . "-" . $data["product_name"];?> </td> 
							<td align="right"><?php echo $data["qty"] ?> </td>
                            <td align="right"><?php echo $data["satuan"] ?> </td> 
							<td align="right"><?php echo setNumber($data["harga"]) ?> </td>
							<td align="right"><?php echo setNumber($data["sub_total"]) ?> </td>
							<td align="right"><?php echo setNumber($data["disc_amount"]) ?> </td> 
							<td align="right"><?php echo setNumber($data["total"]) ?> </td>
							<td><?php echo $data["ket_detail"] ?> </td>
                            <td><?php echo $data["no_reff"] ?> </td>
                            <td><?php echo $data["tgl_reff"] ?> </td>
						</tr>	
						<?php
						
						$sumqty = $sumqty + $data["qty"];
						$sumsub_total = $sumsub_total + $data["sub_total"]; 
						$sumdisc_amount = $sumdisc_amount + $data["disc_amount"]; 
						$sumtotal = $sumtotal + $data["total"];
					}	
					echo "<tr class='font10black' bgcolor='#ffffff'>";
					echo "<td align='right' colspan=7>&nbsp;</td>";
					echo "<td align='right'>" .setNumber($sumqty). "</td>"; 
					echo "<td align='right' colspan=2>&nbsp;</td>";
					echo "<td align='right'>" .setNumber($sumsub_total). "</td>";
					echo "<td align='right'>" .setNumber($sumdisc_amount). "</td>";
					echo "<td align='right'>" .setNumber($sumtotal). "</td>";
					echo "<td align='right' colspan=3>&nbsp;</td>";
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

