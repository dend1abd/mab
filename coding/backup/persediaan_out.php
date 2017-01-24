<?php
	$sqlCmd = "delete from trx_persediaan where no_transaksi='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);
	
	$sqlCmd = "insert into trx_persediaan (jenis_transaksi, no_transaksi, tgl_transaksi, product_code, product_name, 
	qty, qty_in, qty_out, 
	qtysize1, qtysize2, qtysize3, qtysize4, qtysize5, qtysize6, qtysize7, qtysize8, qtysize9, qtysize10,
	qtysize1_in, qtysize2_in, qtysize3_in, qtysize4_in, qtysize5_in, qtysize6_in, qtysize7_in, qtysize8_in, qtysize9_in, qtysize10_in,
	qtysize1_out, qtysize2_out, qtysize3_out, qtysize4_out, qtysize5_out, qtysize6_out, qtysize7_out, qtysize8_out, qtysize9_out, qtysize10_out,
	kode_gudang, harga
	)
	select transaksi_tipe, a.transaksi_kode, transaksi_tgl, product_code, product_name, 
	-qty, 0, qty,  
	-qty_size1, -qty_size2, -qty_size3, -qty_size4, -qty_size5, -qty_size6, -qty_size7, -qty_size8, -qty_size9, -qty_size10,
	0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
	qty_size1, qty_size2, qty_size3, qty_size4, qty_size5, qty_size6, qty_size7, qty_size8, qty_size9, qty_size10,	
	'-1', harga
	from trx_master a
	inner join trx_detail b on a.transaksi_kode=b.transaksi_kode where a.transaksi_kode='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);
?>

