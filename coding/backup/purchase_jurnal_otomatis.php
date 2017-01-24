<?php
	$sqlCmd = "delete from trx_persediaan where no_transaksi='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);
	
	$sqlCmd = "insert into trx_persediaan (jenis_transaksi, no_transaksi, tgl_transaksi, product_code, product_name, qty
	, qtysize1, qtysize2, qtysize3, qtysize4, qtysize5, qtysize6, qtysize7, qtysize8, qtysize9, qtysize10
	)
	select transaksi_tipe, a.transaksi_kode, transaksi_tgl, product_code, product_name, -qty  
	, -qty_size1, -qty_size2, -qty_size3, -qty_size4, -qty_size5, -qty_size6, -qty_size7, -qty_size8, -qty_size9, -qty_size10
	from trx_master a
	inner join trx_Detail b on a.transaksi_kode=b.transaksi_kode where a.transaksi_kode='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);
?>

