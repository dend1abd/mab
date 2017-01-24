<?php
	
$sql = "select a.transaksi_kode,  
a.contact_code,
b.product_code,
b.product_name,
b.kode_warna,
b.harga,
b.satuan,
b.sub_total,
b.disc_persen,
b.disc_amount,
b.total,
b.ket_detail,
IFNULL(b.qty, 0) as b_qty, 
IFNULL(abc.d_qty, 0) as d_qty,
IFNULL(b.qty,0) - IFNULL(abc.d_qty,0) as qty 
from 
trx_master a
inner join trx_detail b on a.transaksi_kode=b.transaksi_kode
left join
(
select sum(IFNULL(d.qty, 0)) as d_qty,
d.no_order, d.product_code, c.contact_code from trx_master c 
inner join trx_detail d on c.transaksi_kode=d.transaksi_kode 
where c.transaksi_tipe= 19
group by no_order, product_code, contact_code  
)abc 
on a.transaksi_kode = abc.no_order and b.product_code = abc.product_code and a.contact_code = abc.contact_code 
where a.transaksi_tipe=5 and a.contact_code='$customer' 
and (IFNULL(b.qty, 0) - IFNULL(abc.d_qty, 0)) > 0

";

	$rsOrder = $oDB->ExecuteReader($sql); 	
	echo "<table width='100%'  cellspacing='1' bgcolor='silver' id='tblDetail' >";
	echo "<tr class=\"contentTitleTable\" align=\"center\" >";
	echo "<td >&nbsp;</td>";
	echo "<td width=3% >No</td>";
	echo "<td>Kode Barang</td>";
	echo "<td>Nama Barang</td>";
	echo "<td>Qty</td>";
	echo "<td>Satuan</td>";
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
		$clsformatInteger = "style='TEXT-ALIGN: RIGHT'  onChange='this.value=formatCurrency3(this.value);'";
		$clsformatIntegerReadOnly = "style='TEXT-ALIGN: RIGHT; background-color: #CCCCCC'  onChange='this.value=formatCurrency3(this.value);'";
		$clsformatIntegerMandatory = "style='TEXT-ALIGN: RIGHT; background-color: #93F'  onChange='this.value=formatCurrency3(this.value);'";
		$clsReadOnly = "style='background-color: #CCCCCC'";
		$clsMandatory = "style='background-color: #FCF'";

		
		$qty_sum = 0;
		$sub_total_sum = 0;
		$disc_amount_sum = 0;
		$total_sum = 0;
	
		while ($dataOrder = mysql_fetch_array($rsOrder)) 
		{
			$i++;
			echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
			echo "<td>";
			if($_SESSION["modeView"] == "1"){
				echo "<img src='images/delmini.gif' onClick='delRow($i);'>";  
			}
			echo "</td>";
			echo "<td width=3% >$i</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetailproduct_code_$i", $dataOrder["product_code"], 20, 20, $clsReadOnly . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetailproduct_name_$i", $dataOrder["product_name"], 30, 30, $clsReadOnly . " readonly"); 
			echo "</td>";
			
			$cssClass = $clsformatInteger;
			echo "<td>";
			echo getTextBox("1", "txtdetailqty_$i", setNumber($dataOrder["qty"]), 3, 3, $clsformatInteger . " "); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetailsatuan_$i", $dataOrder["satuan"], 7, 7, $clsReadOnly . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetailharga_$i", "0", 12, 12, $clsformatIntegerReadOnly . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetailsub_total_$i", "0", 12, 12, $clsformatIntegerReadOnly . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetaildisc_persen_$i", "0", 3, 3, $clsformatIntegerReadOnly . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetaildisc_amount_$i", "0", 12, 12, $clsformatIntegerReadOnly . " readonly"); 
			echo "</td>";
			echo "<td>";
			echo getTextBox("1", "txtdetailtotal_$i", "0", 15, 15, $clsformatIntegerReadOnly . " readonly"); 
			echo "</td>";
			
			$cssClass = "";
			echo "<td>";
			echo getTextBox("1", "txtdetailket_detail_$i", $dataOrder["ket_detail"], 12, 12,  " "); 
			echo "</td>";		
			
			echo "<td>";
			echo getTextBox("1", "txtdetailno_order_$i", $dataOrder["transaksi_kode"], 12, 12,  " readonly"); 
			echo "</td>";		
			
			echo "</tr>"; 
			
			$qty_sum = $qty_sum + $dataOrder["qty"]; 
		}
		
		echo "<tr class=\"font10black\" bgcolor=\"white\"  align=\"center\" >";
		echo "<td>&nbsp;</td>";
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