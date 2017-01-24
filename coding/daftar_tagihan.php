<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession(); 
	$pageTitle = "Daftar Tagihan Piutang";
	if (isset($_GET["halaman"])){	
	 
		$halaman = $_GET["halaman"];		
		$posisi = ($halaman-1) * $_SESSION["param_jml_record_paging"]; 
		
		$customer = $_GET["customer"];
		$divisi = $_GET["divisi"];
	}
	else{
		$posisi = 0;
		$halaman = 1;	
		
		$customer = $_GET["customer"];		
		$divisi = $_GET["divisi"];
	} 
	
	$sql2 = "select a.transaksi_kode as no_invoice, a.transaksi_tgl as tgl_invoice, ifnull(total,0) as jml_invoice, (ifnull(bayar,0)+ ifnull(b.paid,0)) as telah_bayar
,(ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)- ifnull(d.total_retur,0)) as piutang
, '' ket_bayar, a.contact_code as kode_customer, c.contact_name as nama_customer, c.alamat, d.total_retur as jml_retur, e.contact_name as nama_sales, a.kode_wilayah, f.reff as status_faktur
from trx_master a
left join 
(
	select a.contact_code, b.no_invoice, sum(ifnull(jml_bayar,0)) as paid
	from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode	
	where a.transaksi_tipe in (18) and a.transaksi_tgl <= NOW()
	group by a.contact_code, b.no_invoice
)b on a.contact_code = b.contact_code and a.transaksi_kode = b.no_invoice

left join 
(
	select sum(ifnull(sisa,0)) as total_retur, no_reff
	from trx_master a 
	where a.transaksi_tipe=8 and a.transaksi_tgl <= NOW()
	group by no_reff
)d on a.transaksi_kode = d.no_reff

inner join mst_contact c on a.contact_code = c.contact_code
left join mst_contact e on a.sales_code = e.contact_code
left join mst_reff f on a.stFaktur = f.kodereff and f.tipereff=28 
where a.transaksi_tipe in (6, 7) and (ifnull(total,0)  - ifnull(bayar,0)- ifnull(b.paid,0)) <> 0 
and a.transaksi_tgl <= NOW() and a.stFaktur=1 ";

	if ($customer != "") $sql2 = $sql2 . " and a.contact_code ='$customer' "; 
	if ($divisi != "") $sql2 = $sql2 . "and a.kode_divisi= '$divisi' ";  
	
	$sql = $sql2 . " limit $posisi, " . $_SESSION["param_jml_record_paging"];

	//eror($sql);
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);	
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs); 
	
	$rs2 = $oDB->ExecuteReader($sql2);	
	$jmlHalaman = ceil(mysql_num_rows($rs2) /$_SESSION["param_jml_record_paging"]); 
	
	//echo $sql
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_name,', ', left(ifnull(alamat,''), 50)) FROM mst_contact where contact_tipe = 3 order by contact_name";
    $rscustomer = $oDB->ExecuteReader($sqlCmd);	
 
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

function submit(index){
	//alert(<?php echo $customer ?>);
	//window.opener.document.getElementById("txtdetailproduct_code_0").value;
	
	jmlItem = parseInt(window.opener.document.getElementById("txtJmlItem").value) + 1; 
	var table = window.opener.document.getElementById("tblDetail");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount  -1); 	
    row.bgColor = "white"  
	
	var cell0 = row.insertCell(0); 
    cell0.innerHTML = "<div class='font10black' align='center'><img src='images/delmini.gif' onClick='delRow(" +jmlItem+ ");'></div >";	
	
	var cell1 = row.insertCell(1); 
    cell1.innerHTML = "<div class='font10black' align='center'>" +jmlItem+ "</div >";	
	 
	nilai = document.getElementById("txtDetailno_invoice" + index).value;//alert(nilai);
	<?php
	
	$clsformatIntegerMandatory = "style='TEXT-ALIGN: RIGHT; background-color: #CCCCCC'  onChange='this.value=formatCurrency3(this.value);'";
	$clsReadOnly = "style='background-color: #CCCCCC'";

	$elName = "txtDetailno_invoice";
	$name ="\" + '$elName' + jmlItem + \"";		 
	$texbox =  getTextBox("1", $name, "\" +nilai+ \"", 40, 15, $clsReadOnly);
	?>	
	var cell2 = row.insertCell(2);cell2.innerHTML = "<div class='font10black' align='center'><?php echo $texbox ?></div >";	
	
	nilai = document.getElementById("txtDetailtgl_invoice" + index).value;//alert(nilai);
	<?php
	$elName = "txtDetailtgl_invoice";
	$name ="\" + '$elName' + jmlItem + \"";		 
	$texbox =  getTextBox("1", $name, "\" +nilai+ \"", 30, 15, $clsReadOnly);
	?>
	var cell3 = row.insertCell(3); cell3.innerHTML = "<div class='font10black' align='center'><?php echo $texbox ?></div >";
	
	nilai = document.getElementById("txtDetailnama_customer" + index).value;//alert(nilai);
	<?php
	$elName = "txtDetailnama_customer";
	$name ="\" + '$elName' + jmlItem + \"";		 
	$texbox =  getTextBox("1", $name, "\" +nilai+ \"", 50, 15, $clsReadOnly);
	?>
	nilai2 = document.getElementById("txtDetailkode_customer" + index).value;//alert(nilai);
	<?php
	$elName = "txtDetailkode_customer";
	$name ="\" + '$elName' + jmlItem + \"";		 
	$texbox = $texbox . getHiddenBox("1", $name, "\" +nilai2+ \"");
	?>
	var cell4 = row.insertCell(4); cell4.innerHTML = "<div class='font10black' align='center'><?php echo $texbox ?></div >";
	
	nilai = document.getElementById("txtDetailjml_invoice" + index).value;//alert(nilai);
	<?php
	$elName = "txtDetailjml_invoice";
	$name ="\" + '$elName' + jmlItem + \"";		 
	$texbox =  getTextBox("1", $name, "\" +nilai+ \"", 40, 15, $clsformatIntegerMandatory);
	?>
	var cell5 = row.insertCell(5); cell5.innerHTML = "<div class='font10black' align='center'><?php echo $texbox ?></div >";
	
	nilai = document.getElementById("txtDetailjml_retur" + index).value;//alert(nilai);
	<?php
	$elName = "txtDetailjml_retur";
	$name ="\" + '$elName' + jmlItem + \"";		 
	$texbox =  getTextBox("1", $name, "\" +nilai+ \"", 40, 15, $clsformatIntegerMandatory);
	?>
	var cell6 = row.insertCell(6); cell6.innerHTML = "<div class='font10black' align='center'><?php echo $texbox ?></div >";
	
	nilai = document.getElementById("txtDetailtelah_bayar" + index).value;//alert(nilai);
	<?php
	$elName = "txtDetailtelah_bayar";
	$name ="\" + '$elName' + jmlItem + \"";		 
	$texbox =  getTextBox("1", $name, "\" +nilai+ \"", 40, 15, $clsformatIntegerMandatory);
	?>
	var cell7 = row.insertCell(7); cell7.innerHTML = "<div class='font10black' align='center'><?php echo $texbox ?></div >";
	
	nilai = document.getElementById("txtDetailjml_hutang" + index).value;//alert(nilai);
	<?php
	$elName = "txtDetailjml_hutang";
	$name ="\" + '$elName' + jmlItem + \"";		 
	$texbox =  getTextBox("1", $name, "\" +nilai+ \"", 40, 15, $clsformatIntegerMandatory);
	?>
	var cell8 = row.insertCell(8); cell8.innerHTML = "<div class='font10black' align='center'><?php echo $texbox ?></div >";
	
	nilai = document.getElementById("txtDetailnama_sales" + index).value;//alert(nilai);
	<?php
	$elName = "txtDetailnama_sales";
	$name ="\" + '$elName' + jmlItem + \"";		 
	$texbox =  getTextBox("1", $name, "\" +nilai+ \"", 40, 15, $clsReadOnly);
	?>
	var cell9 = row.insertCell(9); cell9.innerHTML = "<div class='font10black' align='center'><?php echo $texbox ?></div >";
	
	nilai = document.getElementById("txtDetailkode_wilayah" + index).value;//alert(nilai);
	<?php
	$elName = "txtDetailkode_wilayah";
	$name ="\" + '$elName' + jmlItem + \"";		 
	$texbox =  getTextBox("1", $name, "\" +nilai+ \"", 20, 15, $clsReadOnly);
	?>
	var cell10 = row.insertCell(10); cell10.innerHTML = "<div class='font10black' align='center'><?php echo $texbox ?></div >";
	
	nilai = document.getElementById("txtDetailstatus_faktur" + index).value;//alert(nilai);
	<?php
	$elName = "txtDetailstatus_faktur";
	$name ="\" + '$elName' + jmlItem + \"";		 
	$texbox =  getTextBox("1", $name, "\" +nilai+ \"", 20, 15, $clsReadOnly);
	?>
	var cell11 = row.insertCell(11); cell11.innerHTML = "<div class='font10black' align='center'><?php echo $texbox ?></div >";
	
	//alert(jmlItem);
	window.opener.document.getElementById("txtJmlItem").value = jmlItem;
	window.opener.sumJumlah();
	
	window.close();	
} 

function frmCari(){  
	document.frmList.action = "product_lookup.php"
    document.frmList.submit();
}

function frmGoto(url){  
    self.location=url; 
}


-->
</Script> 

<body>

<form method="get" name="frmList">

<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td class="font12Bold"><?php echo $pageTitle; ?></td>
	</tr>  
	<tr class="font10black">
		<td>		
			<table >            	
                <tr >
					<td>Divisi</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(2, "txtdivisi", $divisi, $rsArtikel, ""); ?>
					</td>
				</tr>
				
				<tr >
					<td>Customer</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(2, "txtcustomer", $customer, $rscustomer, ""); ?>
					
					<input type="hidden" name="customer" id="customer" value="<?php echo $customer;?>" />
                    <input type="hidden" name="divisi" id="divisi" value="<?php echo $divisi;?>" />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>  
		<!-- <input type="button" name="btCari" value="Browse" class ="button" onClick="frmCari();" /> -->
		<br />
		<?php 
			if ($jmlHalaman > 1)
				echo "Page :";
			for($i=1; $i<$jmlHalaman; $i++){
				if($i != $halaman){
					echo "<a href=$_SERVER[PHP_SELF]?halaman=$i&kode=$kode&customer=$customer>$i</a> | ";
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
							<td style="height: 22px">No</td>
							<td style="height: 22px">No Faktur</td> 
							<td style="height: 22px">Tgl Faktur</td>
							<td style="height: 22px">Customer</td> 
							<td style="height: 22px">Jumlah</td>							
							<td style="height: 22px">Retur</td>
							<td style="height: 22px">Sudah Bayar</td> 
							<td style="height: 22px">Piutang</td>
							<td style="height: 22px">Sales</td>
							<td style="height: 22px">Kode Wilayah</td>
							<td style="height: 22px">Status</td>
						</tr> 
				<?php
				
				if ($numRows == 0)
				{
					echo "<tr bgcolor='#ffffff' class='font10black'><td align='center' colspan=6>Data tidak ada</td></tr>";
				}
				else
				{
					$i = 0;
					$sumPiutang = 0;
					while ($datadetail = mysql_fetch_array($rs)) 
					{
						$i++;
						$nourut = $posisi + $i;
						
						$jml_invoice = $datadetail["jml_invoice"];
						$telah_bayar = $datadetail["telah_bayar"];
						$jml_hutang = $datadetail["piutang"];

						echo "<tr bgcolor='#ffffff' class='font10black'>";
						
						echo "<td align='center'>$i";
						echo "</td>"; 
						
						echo "<td align='left'>";
						echo "<a href=# onClick=\"submit($i)\">" .$datadetail["no_invoice"]. "</a>";
						echo getHiddenBox(1, "txtDetailno_invoice$i", $datadetail["no_invoice"]);
						echo "</td>";   
						
						echo "<td align='left'>";
						echo $datadetail["tgl_invoice"]; 	
						echo getHiddenBox(1, "txtDetailtgl_invoice$i", $datadetail["tgl_invoice"]);
						echo "</td>";

						echo "<td align='left'>";
						echo $datadetail["nama_customer"];
						echo getHiddenBox(1, "txtDetailkode_customer$i", $datadetail["kode_customer"]);
						echo getHiddenBox(1, "txtDetailnama_customer$i", $datadetail["nama_customer"]);
						echo "</td>";

						echo "<td align='right'>";
						echo setNumber($jml_invoice);
						echo getHiddenBox(1, "txtDetailjml_invoice$i", setNumber($jml_invoice));
						echo "</td>";
						
						echo "<td align='right'>";
						echo setNumber($datadetail["jml_retur"]);
						echo getHiddenBox(1, "txtDetailjml_retur$i", setNumber($datadetail["jml_retur"]));
						echo "</td>";
						
						echo "<td align='right'>";
						echo setNumber($telah_bayar);
						echo getHiddenBox(1, "txtDetailtelah_bayar$i", setNumber($telah_bayar));
						echo "</td>";
						
						echo "<td align='right'>";
						echo setNumber($jml_hutang);
						echo getHiddenBox(1, "txtDetailjml_hutang$i", setNumber($jml_hutang));
						echo "</td>";

						echo "<td align='left'>";
						echo $datadetail["nama_sales"];
						echo getHiddenBox(1, "txtDetailnama_sales$i", $datadetail["nama_sales"]);
						echo "</td>";

						echo "<td align='left'>";
						echo $datadetail["kode_wilayah"];
						echo getHiddenBox(1, "txtDetailkode_wilayah$i", $datadetail["kode_wilayah"]);
						echo "</td>";

						echo "<td align='left'>";
						echo $datadetail["status_faktur"];
						echo getHiddenBox(1, "txtDetailstatus_faktur$i", $datadetail["status_faktur"]);
						echo "</td>";
						
						echo "</tr>";
						
						$sumPiutang = $sumPiutang + $jml_hutang;
									
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