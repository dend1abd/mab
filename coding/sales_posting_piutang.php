<?php
	$sqlCmd = "delete from trx_invoice where no_transaksi='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);
	
	//subtotal
	/*$sqlCmd = "insert into trx_invoice
	(jenis_transaksi, sub_transaksi, no_transaksi, tgl_transaksi, jml_in, jml_out, contact_code, no_invoice, tgl_invoice, no_reff, createdate, createby, jml_invoice  )
	select transaksi_tipe, 1, a.transaksi_kode, transaksi_tgl, sub_total, 0, contact_code, transaksi_kode, transaksi_tgl, no_reff, NOW(), '" .$_SESSION["userid"]. 
	"', total from trx_master a
	where a.transaksi_kode='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);	
	
	//discount
	$sqlCmd = "insert into trx_invoice
	(jenis_transaksi, sub_transaksi, no_transaksi, tgl_transaksi, jml_in, jml_out, contact_code, no_invoice, tgl_invoice, no_reff, createdate, createby , jml_invoice )
	select transaksi_tipe, 2, a.transaksi_kode, transaksi_tgl, 0, disc_amount, contact_code, transaksi_kode, transaksi_tgl, no_reff, NOW(), '" .$_SESSION["userid"]. 
	"', total from trx_master a
	where a.transaksi_kode='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);	
	
	//ppn
	$sqlCmd = "insert into trx_invoice
	(jenis_transaksi, sub_transaksi, no_transaksi, tgl_transaksi, jml_in, jml_out, contact_code, no_invoice, tgl_invoice, no_reff, createdate, createby, jml_invoice  )
	select transaksi_tipe, 3, a.transaksi_kode, transaksi_tgl, ppn_amount, 0, contact_code, transaksi_kode, transaksi_tgl, no_reff, NOW(), '" .$_SESSION["userid"]. 
	"', total from trx_master a
	where a.transaksi_kode='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);	*/
	
	
	//************** total
	$sqlCmd = "insert into trx_invoice
	(jenis_transaksi, sub_transaksi, no_transaksi, tgl_transaksi, jml_in, jml_out, contact_code, no_invoice, tgl_invoice, no_reff, createdate, createby, jml_invoice  )
	select transaksi_tipe, 3, a.transaksi_kode, transaksi_tgl, total, 0, contact_code, transaksi_kode, transaksi_tgl, no_reff, NOW(), '" .$_SESSION["userid"]. 
	"', total from trx_master a
	where (total <> 0 and total is not null) and a.transaksi_kode='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);	
	
	//************ bayar
	$sqlCmd = "insert into trx_invoice
	(jenis_transaksi, sub_transaksi, no_transaksi, tgl_transaksi, jml_in, jml_out, contact_code, no_invoice, tgl_invoice, no_reff, createdate, createby, jml_invoice  )
	select transaksi_tipe, 4, a.transaksi_kode, transaksi_tgl, 0, bayar, contact_code, transaksi_kode, transaksi_tgl, no_reff, NOW(), '" .$_SESSION["userid"]. 
	"', total from trx_master a
	where (bayar <> 0 and bayar is not null) and a.transaksi_kode='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);	
?>