<?php
	
$sql = "select a.transaksi_kode,  
a.contact_code,
b.product_code,
b.product_name,
b.kode_warna,
0 as harga,
0 as sub_total,
0 as disc_persen,
0 as disc_amount,
0 as total,
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
where c.transaksi_tipe = 9 
group by no_order, product_code, contact_code  
)abc 
on a.transaksi_kode = abc.no_order and b.product_code = abc.product_code and a.contact_code = abc.contact_code 
where a.transaksi_tipe = 5 and a.contact_code='$customer' 
and (IFNULL(b.qty, 0) - IFNULL(abc.d_qty, 0)) > 0

";

//eror($sql);
	$rsOrder = $oDB->ExecuteReader($sql); 	
	echo "<table width='100%'  cellspacing='1' bgcolor='silver' id='tblDetail' >";
	echo "<tr class=\"contentTitleTable\" align=\"center\" >";
	echo "<td width=3% >No</td>";
	echo "<td>Kode Barang</td>";
	echo "<td>Nama Barang</td>";
	echo "<td>Qty</td>";
	echo "<td>Harga</td>";
	echo "<td>Sub Total</td>";
	echo "<td>Disc %</td>";
	echo "<td>Disc</td>";
	echo "<td>Total</td>";
	echo "<td>Ket</td>";
	echo "<td>No Order</td>";
	echo "</tr>";		
	
	if (mysql_num_rows($rsOrder) == 0){
		echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
		echo "<td colspan=11>Data order belum ada / sudah habis</td></tr>";
	}
	else
	{
		mysql_data_seek($rsOrder, 0);						
		$i = 0;
		$cssClass = "";
		
		$qty_sum = 0;
		$sub_total_sum = 0;
		$disc_amount_sum = 0;
		$total_sum = 0;
	
		while ($dataOrder = mysql_fetch_array($rsOrder)) 
		{
			$i++;
			echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
			echo "<td width=3% >$i</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetailproduct_code_$i", $dataOrder["product_code"], 20, 20, $cssClass . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetailproduct_name_$i", $dataOrder["product_name"], 30, 30, $cssClass . " readonly"); 
			echo "</td>";
			
			$cssClass = $clsformatInteger;
			echo "<td>";
			echo getTextBox("1", "txtdetailqty_$i", setNumber($dataOrder["qty"]), 3, 3, $cssClass . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetailharga_$i", setNumber($dataOrder["harga"]), 12, 12, $cssClass . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetailsub_total_$i", setNumber($dataOrder["sub_total"]), 12, 12, $cssClass . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetaildisc_persen_$i", setNumber($dataOrder["disc_persen"]), 3, 3, $cssClass . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetaildisc_amount_$i", setNumber($dataOrder["disc_amount"]), 12, 12, $cssClass . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetailtotal_$i", setNumber($dataOrder["total"]), 15, 15, $cssClass . " readonly"); 
			echo "</td>";
			
			$cssClass = "";
			echo "<td>";
			echo getTextBox("1", "txtdetailket_detail_$i", $dataOrder["ket_detail"], 12, 12, $cssClass . " readonly"); 
			echo "</td>";		
			
			echo "<td>";
			echo getTextBox("1", "txtdetailno_order_$i", $dataOrder["transaksi_kode"], 12, 12, $cssClass . " readonly"); 
			echo "</td>";		
			
			echo "</tr>";
			
			echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
			echo "<td align='center' colspan=2>size x qty</td>";
			echo "<td colspan=9>";
				
				echo "<table width=\"100%\"  cellspacing=\"1\" bgcolor=\"silver\" id=\"tblJurnalDetailItem\" >";
				echo "<tr bgcolor=\"white\" class=\"font10black\">";
				
				for ($j=1; $j<=8; $j++){
					echo "<td nowrap>";
					$value = retrieveS($dataOrder["kode_size$j"]); 
					echo getTextBox("1", "txtdetailsize" .$j. "_" . $i, $value, 10, 3, "readonly"); 
					echo " x ";
					$value = retrieveS($dataOrder["qty$j"]); 
					echo getTextBox("1", "txtdetailqtysize" .$j. "_" . $i, $value, 10, 5, ""); 
					echo "</td>";	
				}
				
				echo "</tr>";
				echo "</table>";
				
			echo "</td>";
			echo "</tr>";
			
			$qty_sum = $qty_sum + $dataOrder["qty"];
			$sub_total_sum = $sub_total_sum + $dataOrder["sub_total"];
			$disc_amount_sum = $disc_amount_sum + $dataOrder["disc_amount"];
			$total_sum = $total_sum + $dataOrder["total"];
		}
		
		echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
		echo "<td width=3% ></td>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo "</td>";
		
		$cssClass = $clsformatInteger;
		echo "<td>";
		echo getTextBox("1", "txtdetailqty_sum", setNumber($qty_sum), 3, 3, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetailsub_total_sum", setNumber($sub_total_sum), 12, 12, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetaildisc_amount_sum", setNumber($disc_amount_sum), 15, 15, $cssClass . " readonly"); 
		echo "</td>";
		echo "<td>";
		echo getTextBox("1", "txtdetailtotal_sum", setNumber($total_sum), 12, 12, $cssClass . " readonly"); 
		echo "</td>";
		
		$cssClass = "";
		echo "<td>";
		echo "</td>";				
		echo "<td>";
		echo getHiddenBox("1", "txtJmlItem","$i");
		echo "</td>";				
		echo "</tr>";
	}
	echo "</table>";
	
	if (mysql_num_rows($rsOrder) == 0){
		eror("");			
	}
?>