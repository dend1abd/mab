<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();
	$customer = retrieveS($_GET["customer"]);
	
$sql = "select a.transaksi_kode,  
a.contact_code,
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
where c.transaksi_tipe=5 
group by no_order, product_code, contact_code  
)abc 
on a.transaksi_kode = abc.no_order and b.product_code = abc.product_code and a.contact_code = abc.contact_code 
where a.transaksi_tipe=4 and a.contact_code='$customer' 
and (IFNULL(b.qty, 0) - IFNULL(abc.d_qty, 0)) > 0

";

//eror($sql);

	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$rsGenDetail = $oDB->ExecuteReader($sql); 
	if (mysql_num_rows($rsGenDetail) == 0){
		eror("Data order belum ada");			
	}
	
	echo "<table width='100%'  cellspacing='1' bgcolor='silver' id='tblDetail' >";
	echo "<tr class=\"contentTitleTable\" align=\"center\" >";
	echo "<td width=3% >No</td>";
	echo "<td>Kode Barang</td>";
	echo "<td>Nama Barang</td>";
	echo "<td>Warna</td>";
	echo "<td>Qty</td>";
	echo "<td>Harga</td>";
	echo "<td>Sub Total</td>";
	echo "<td>Disc %</td>";
	echo "<td>Disc</td>";
	echo "<td>Total</td>";
	echo "<td>Ket</td>";
	echo "<td>No Order</td>";
	echo "</tr>";		
	
	
	mysql_data_seek($rsGenDetail, 0);						
	$i = 0;
	$cssClass = "";
	
	$qty_sum = 0;
	$sub_total_sum = 0;
	$disc_amount_sum = 0;
	$total_sum = 0;

	while ($dataGenDetail = mysql_fetch_array($rsGenDetail)) 
	{
		$i++;
		echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
		echo "<td width=3% >$i</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetailproduct_code_$i", $dataGenDetail["product_code"], 15, 15, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetailproduct_name_$i", $dataGenDetail["product_name"], 30, 30, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetailkode_warna_$i", $dataGenDetail["kode_warna"], 10, 10, $cssClass . " readonly"); 
		echo "</td>";
		
		$cssClass = $clsformatInteger;
		echo "<td>";
		echo getTextBox("1", "txtdetailqty_$i", setNumber($dataGenDetail["qty"]), 4, 4, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetailharga_$i", setNumber($dataGenDetail["harga"]), 15, 15, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetailsub_total_$i", setNumber($dataGenDetail["sub_total"]), 15, 15, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetaildisc_persen_$i", setNumber($dataGenDetail["disc_persen"]), 15, 15, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetaildisc_amount_$i", setNumber($dataGenDetail["disc_amount"]), 15, 15, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetailtotal_$i", setNumber($dataGenDetail["total"]), 15, 15, $cssClass . " readonly"); 
		echo "</td>";
		
		$cssClass = "";
		echo "<td>";
		echo getTextBox("1", "txtdetailket_detail_$i", $dataGenDetail["ket_detail"], 15, 15, $cssClass . " readonly"); 
		echo "</td>";		
		
		echo "<td>";
		echo getTextBox("1", "txtdetailno_order_$i", $dataGenDetail["transaksi_kode"], 15, 15, $cssClass . " readonly"); 
		echo "</td>";		
		
		echo "</tr>";
		
		echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
		echo "<td align='center' colspan=2>size x qty</td>";
		echo "<td colspan=10>";
			
			echo "<table width=\"100%\"  cellspacing=\"1\" bgcolor=\"silver\" id=\"tblJurnalDetailItem\" >";
			echo "<tr bgcolor=\"white\" class=\"font10black\">";
			
			for ($j=1; $j<=8; $j++){
				echo "<td nowrap>";
				$value = retrieveS($dataGenDetail["kode_size$j"]); 
				echo getTextBox("1", "txtdetailsize" .$j. "_" . $i, $value, 10, 3, "readonly"); 
				echo " x ";
				$value = retrieveS($dataGenDetail["qty$j"]); 
				echo getTextBox("1", "txtdetailqtysize" .$j. "_" . $i, $value, 10, 5, ""); 
				echo "</td>";	
			}
			
			echo "</tr>";
			echo "</table>";
			
		echo "</td>";
		echo "</tr>";
		
		$qty_sum = $qty_sum + $dataGenDetail["qty"];
		$sub_total_sum = $sub_total_sum + $dataGenDetail["sub_total"];
		$disc_amount_sum = $disc_amount_sum + $dataGenDetail["disc_amount"];
		$total_sum = $total_sum + $dataGenDetail["total"];
	}
	
	echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
		echo "<td width=3% ></td>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo "</td>";
		
		$cssClass = $clsformatInteger;
		echo "<td>";
		echo getTextBox("1", "txtdetailqty_sum", setNumber($qty_sum), 4, 4, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetailsub_total_sum", setNumber($sub_total_sum), 15, 15, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetaildisc_amount_sum", setNumber($disc_amount_sum), 15, 15, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetailtotal_sum", setNumber($total_sum), 15, 15, $cssClass . " readonly"); 
		echo "</td>";
		
		$cssClass = "";
		echo "<td>";
		echo "</td>";				
		echo "<td>";
		echo getHiddenBox("1", "txtJmlItem","$i");
		echo "</td>";				
		echo "</tr>";

?>