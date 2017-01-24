<?php
	$sqlCmd = "delete from trx_invoice where no_transaksi='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);
	
	$sqlCmd = "insert into trx_invoice
	(jenis_transaksi, sub_transaksi, no_transaksi, tgl_transaksi, jml_in, jml_out, contact_code, no_invoice, tgl_invoice, no_reff, createdate, createby  )

	select transaksi_tipe, 1, a.transaksi_kode, transaksi_tgl, sub_total, 0, a.transaksi_kode, transaksi_tgl, 
	from trx_master a
	where a.transaksi_kode='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);
	
	
?>

