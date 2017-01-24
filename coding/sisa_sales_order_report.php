<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Sisa Order Penjualan Barang";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = retrieveS($_POST["txtTgl1"]);
		$tgl2 = retrieveS($_POST["txtTgl2"]);
		$contact_code = retrieveS($_POST["txtcontact_code"]);
		$sales_code = retrieveS($_POST["txtsales_code"]);
		$product_name  = retrieveS($_POST["txtproduct_name"]);
		$product_code  = retrieveS($_POST["txtproduct_code"]);
		
		$artikel  = retrieveS($_POST["txtartikel"]);
		$warna  = retrieveS($_POST["txtwarna"]);
		
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
		
		$artikel  = "";
		$warna  = "";
		
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
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);
		
	/*$sql = "select a.transaksi_tgl, a.transaksi_kode, a.contact_code, a.sales_code, b.contact_name as customer, c.contact_name as sales, d.* from trx_master a ";
	$sql = $sql . "inner join trx_detail d on a.transaksi_kode = d.transaksi_kode ";
	$sql = $sql . "left join mst_contact b on a.contact_code=b.contact_code ";
	$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code ";
	$sql = $sql . "where a.transaksi_tipe=4 ";
	$sql = $sql . "and a.transaksi_tgl between '$tgl1' and '$tgl2' ";  */
	
	$sql = "select a.transaksi_tgl, a.transaksi_kode, a.contact_code, a.sales_code, c.contact_name as customer, d.contact_name as sales, 
b.product_code,
b.product_name,
b.kode_warna,
b.harga,
b.sub_total,
b.disc_persen,
b.disc_amount,
b.total,
b.ket_detail,
IFNULL(b.qty, 0) as b_qty, 
IFNULL(abc.d_qty, 0) as d_qty,
IFNULL(b.qty,0) - IFNULL(abc.d_qty,0) as qty,
IFNULL(b.qty_size1,0) - IFNULL(abc.d_qty_size1,0) as qty1,    
IFNULL(b.qty_size2,0) - IFNULL(abc.d_qty_size2,0) as qty2,
IFNULL(b.qty_size3,0) - IFNULL(abc.d_qty_size3,0) as qty3,
IFNULL(b.qty_size4,0) - IFNULL(abc.d_qty_size4,0) as qty4,
IFNULL(b.qty_size5,0) - IFNULL(abc.d_qty_size5,0) as qty5,
IFNULL(b.qty_size6,0) - IFNULL(abc.d_qty_size6,0) as qty6,
IFNULL(b.qty_size7,0) - IFNULL(abc.d_qty_size7,0) as qty7,
IFNULL(b.qty_size8,0) - IFNULL(abc.d_qty_size8,0) as qty8,
IFNULL(b.qty_size9,0) - IFNULL(abc.d_qty_size9,0) as qty9,
IFNULL(b.qty_size10,0) - IFNULL(abc.d_qty_size10,0) as qty10,
b.kode_size1,
b.kode_size2,
b.kode_size3,
b.kode_size4,
b.kode_size5,
b.kode_size6,
b.kode_size7,
b.kode_size8,
b.kode_size9,
b.kode_size10
from 
trx_master a
inner join trx_detail b on a.transaksi_kode=b.transaksi_kode
inner join mst_product e on e.product_code = b.product_code 
left join mst_contact c on a.contact_code=c.contact_code 
left join mst_contact d on a.sales_code=d.contact_code 
left join
(
select sum(IFNULL(d.qty, 0)) as d_qty,  
sum(IFNULL(d.qty_size1, 0)) as d_qty_size1, 
sum(IFNULL(d.qty_size2, 0)) as d_qty_size2, 
sum(IFNULL(d.qty_size3, 0)) as d_qty_size3, 
sum(IFNULL(d.qty_size4, 0)) as d_qty_size4, 
sum(IFNULL(d.qty_size5, 0)) as d_qty_size5, 
sum(IFNULL(d.qty_size6, 0)) as d_qty_size6, 
sum(IFNULL(d.qty_size7, 0)) as d_qty_size7, 
sum(IFNULL(d.qty_size8, 0)) as d_qty_size8, 
sum(IFNULL(d.qty_size9, 0)) as d_qty_size9, 
sum(IFNULL(d.qty_size10, 0)) as d_qty_size10, 
d.no_order, d.product_code, c.contact_code from trx_master c 
inner join trx_detail d on c.transaksi_kode=d.transaksi_kode 
where c.transaksi_tipe=6 
group by no_order, product_code, contact_code  
)abc 
on a.transaksi_kode = abc.no_order and b.product_code = abc.product_code and a.contact_code = abc.contact_code 
where a.transaksi_tipe=5 
and (IFNULL(b.qty, 0) - IFNULL(abc.d_qty, 0)) > 0 
and a.transaksi_tgl between '$tgl1' and '$tgl2' ";
	
	if ($product_code != ""){
		$sql = $sql . "and b.product_code = '$product_code' ";  
	}
	
	if ($contact_code != ""){
		$sql = $sql . "and a.contact_code = '$contact_code' ";  
	}
	if ($sales_code != ""){
		$sql = $sql . "and a.sales_code = '$sales_code' ";  
	}		
	
	if ($artikel != ""){
		$sql = $sql . "and e.kode_artikel = '$artikel' ";  
	}
	
	if ($warna != ""){
		$sql = $sql . "and e.kode_warna = '$warna' ";  
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
			<table >
				<tr>
                	<td width="50%">
                    	<table>
                        	<tr class='font10black'>
                                <td>Tanggal Order</td>
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
                                <td>Artikel</td>
                                <td>:</td>
                                <td>
                                <?php  echo getComboBox(1, "txtartikel", $artikel, $rsArtikel, ""); ?> 
                                </td>
                            </tr>
                            
                            <tr class='font10black'>
                                <td>Warna</td>
                                <td>:</td>
                                <td>
                                <?php  echo getComboBox(1, "txtwarna", $warna, $rsWarna, ""); ?> 
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
					<td>No Order</td>
					<td>Customer</td>
					<td>Sales</td>
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
							<td><?php echo $data["sales_code"] . "-" . $data["sales"];?> </td> 
							<td><?php echo $data["product_code"] . "-" . $data["product_name"];?> </td> 
							<td align="right"><?php echo $data["qty"] ?> </td>
							<td>
							<?php 
							$detil_size = "";
							if ($data["kode_size1"] != "") $detil_size = $detil_size .  $data["kode_size1"] . "/" .$data["qty1"]. "; ";
							if ($data["kode_size2"] != "") $detil_size = $detil_size .  $data["kode_size2"] . "/" .$data["qty2"]. "; ";
							if ($data["kode_size3"] != "") $detil_size = $detil_size .  $data["kode_size3"] . "/" .$data["qty3"]. "; ";
							if ($data["kode_size4"] != "") $detil_size = $detil_size .  $data["kode_size4"] . "/" .$data["qty4"]. "; ";
							if ($data["kode_size5"] != "") $detil_size = $detil_size .  $data["kode_size5"] . "/" .$data["qty5"]. "; ";
							if ($data["kode_size6"] != "") $detil_size = $detil_size .  $data["kode_size6"] . "/" .$data["qty6"]. "; ";
							if ($data["kode_size7"] != "") $detil_size = $detil_size .  $data["kode_size7"] . "/" .$data["qty7"]. "; ";
							if ($data["kode_size8"] != "") $detil_size = $detil_size .  $data["kode_size8"] . "/" .$data["qty8"]. "; ";								
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

