<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	$pageTitle = "Laporan Pengeluaran Barang";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$transKode = "in (11, 12, 14)";
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe =5"; 
    $rsgudang = $oDB->ExecuteReader($sqlCmd); 
	
	if (isset($_POST["txtTgl1"])){
		$tgl1 = trim($_POST["txtTgl1"]);
		$tgl2 = trim($_POST["txtTgl2"]); 
		$gudang = trim($_POST["txtgudang"]); 
		$tipeLap = trim($_POST["txtTipeLap"]);
		//$kode  = trim($_POST["txtKode"]);
		
		$contact_code = retrieveS($_POST["txtcontact_code"]);
		$product_name  = retrieveS($_POST["txtproduct_name"]);
		$product_code  = retrieveS($_POST["txtproduct_code"]);
		
		if ($tipeLap == "1"){
			$sql = "select transaksi_kode, transaksi_tipe, transaksi_tgl, a.gudang_kode, sales_code, sub_qty, keterangan, b.contact_name as gudang, c.contact_name as sales, no_reff from trx_master a ";
			$sql = $sql . "left join mst_contact b on a.gudang_kode=b.contact_code and b.contact_tipe=5 ";
			$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code and c.contact_tipe=4 ";
			$sql = $sql . "where transaksi_tipe $transKode ";
			$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'";
			if ($gudang != ""){
				$sql = $sql . "and a.gudang_kode='$gudang' ";
			} 

		}
		else{
			$sql = "select a.transaksi_kode, transaksi_tgl, a.gudang_kode, b.contact_name as gudang, a.sales_code, c.contact_name as sales, e.product_code, e.product_name, e.qty, e.harga_beli, e.disc_amount, e.sub_total, e.total, no_reff, e.ket_detail from trx_master a ";
			$sql = $sql . "inner join trx_detail e on a.transaksi_kode=e.transaksi_kode ";
			$sql = $sql . "left join mst_contact b on a.gudang_kode=b.contact_code and b.contact_tipe=5 ";
			$sql = $sql . "left join mst_contact c on a.sales_code=c.contact_code and c.contact_tipe=4 ";
			$sql = $sql . "where transaksi_tipe $transKode ";
			$sql = $sql . "and transaksi_tgl between '$tgl1' and '$tgl2'";
			if ($gudang != ""){
				$sql = $sql . "and a.gudang_kode='$gudang' ";
			}
			
			if ($kode != ""){
				$sql = $sql . "and (e.product_code like '%$kode%' or e.product_name like '%$kode%') ";
			} 

		}
		
		//if ($perkiraancode != "")
		//	$sql = $sql . " and kodeac = '$perkiraancode'";
		//eror($sql);
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs);
	}
	else
	{
		$numRow = 0;
		$tgl1 = date("Y-m-d");
		$tgl2 = date("Y-m-d"); 
		$gudang = "";
		$stOrder = "";
		$tipeLap = "1";
		$sql = "";
		//$kode = "";
		
		$contact_code = "";
		$product_name  = "";
		$product_code  = "";
	} 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $pageTitle ?></title>
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
		<td class="font12Bold" style="height: 24px"><?php echo $pageTitle ?></td>
	</tr> 
	<tr>
		<td style="height: 53px">	
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
                            
                            <tr class='font10black'>
                                <td>Gudang</td>
                                <td>:</td>
                                <td>
                                    <?php  echo getComboBox(1, "txtgudang", $gudang, $rsgudang, ""); ?>
                                </td>
                            </tr>
                            
                            <tr class='font10black'>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>
                                    <?php
                                        if ($tipeLap == "1") {
                                            $checked1 = " checked";
                                            $checked2 = " ";
                                        }
                                        else{
                                            $checked1 = " ";
                                            $checked2 = " checked";
                                        }
                                    ?>
                                    <input type="radio" name="txtTipeLap" value="1" <?php echo $checked1; ?> />Summary&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="txtTipeLap" value="2" <?php echo $checked2; ?> />Detail 
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
                        </table>
                    </td>
                </tr>				
			</table>
            
		</td>
	</tr> 
	<tr>
		<td> 
		<input type="button" name="btCari" value="Browse" class ="button" onclick="frmSubmit()"/>&nbsp;
		<input type="button" name="btCetak" value="Cetak" class ="button" onclick="window.print();"/>&nbsp; 
		<!--
		<input type="button" name="btToExcel" value="Save To Excel" class ="button"/>&nbsp; 
		<input type="button" name="btToPDF" value="Save To PDF" class ="button"/>&nbsp;  -->
		</td> 
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable" align="center">
					<td>No</td> 
					
					<?php
					if ($tipeLap == "1"){
						$colspan = 14;
					?>
					<td>Tanggal</td>
					<td>Kode Transaksi</td>					
					<td>gudang</td>
					<td>Petugas</td>
					<td>Qty</td>
					<td>Keterangan</td>
					<?php
					}else{
						$colspan = 13;
						echo "<td>Tanggal</td>";
						echo "<td>Kode Transaksi</td>";
						echo "<td>gudang</td>";
						echo "<td>Petugas</td>";
						echo "<td>Barang</td>";
						echo "<td>Qty</td>";
						echo "<td>Ket</td>";
					}
					?>
				</tr>
				<?php
				if (isset($_POST["txtTgl1"])){
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
						
						$tQty = 0;
						while ($data = mysql_fetch_array($rs)) 
						{
							$i++;
							?>						
							<tr class='font10black' bgcolor='#ffffff'>
								<td><?php echo $i; ?></td>
								
								<?php
								if ($tipeLap == "1"){
								?>
								<td><?php echo $data[2] ?> </td>
								<td><?php echo $data[0] ?> </td>
								<td><?php echo $data["gudang_kode"] . "-" . $data["gudang"]; ?> 
								</td><td><?php echo $data[4] . "-" . $data["sales"];?> </td>
								<td align="right"><?php echo setNumber($data["sub_qty"]) ?> </td>
								<td><?php echo $data["keterangan"] ?> </td>
								<?php
									$tQty = $tQty + $data["sub_qty"];
								}
								else{
									echo "<td>" .$data["transaksi_tgl"]. "</td>";
									echo "<td>" .$data["transaksi_kode"]. "</td>";
									echo "<td>" .$data["gudang_kode"]. " - " .$data["gudang"]. "</td>";
									echo "<td>" .$data["sales_code"]. " - " .$data["sales"]. "</td>";
									echo "<td>" .$data["product_code"]. " - " .$data["product_name"]. "</td>";
									echo "<td align='right'>" .setNumber($data["qty"]). "</td>";
									echo "<td >" .$data["ket_detail"]. "</td>";
									
									$tQty = $tQty + $data["qty"];								
						
								}	
								?>							
							</tr>
						<?php							
						}
						if ($tipeLap == "1"){
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td colspan='5' align='right'><b>Total</b></td>";
							echo "<td align='right'><b>" .setNumber($tQty). "</b></td>";
							echo "<td ></td>";
							echo "</tr>";
						}
						else{
							echo "<tr class='font10black' bgcolor='#ffffff'>";
							echo "<td colspan='6' align='right'><b>Total</b></td>";
							echo "<td align='right'><b>" .setNumber($tQty). "</b></td>";
							echo "<td ></td>";
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
