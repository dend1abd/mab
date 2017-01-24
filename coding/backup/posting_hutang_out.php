<?php
	$sqlCmd = "delete from trx_invoice where no_transaksi='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd); 
	
	
	//************** total
	$sqlCmd = "insert into trx_invoice
	(jenis_transaksi, sub_transaksi, no_transaksi, tgl_transaksi, jml_in, jml_out, contact_code, no_invoice, tgl_invoice, no_reff, createdate, createby, jml_invoice  )
	select transaksi_tipe, 3, a.transaksi_kode, transaksi_tgl, 0, jml_bayar, a.contact_code, b.no_invoice, b.tgl_invoice, no_reff, NOW(), '" .$_SESSION["userid"]. 
	"', jml_invoice from trx_master a inner join trx_bayar b on a.transaksi_kode = b.transaksi_kode 
	where (jml_bayar <> 0 and jml_bayar is not null) and a.transaksi_kode='" .$_SESSION["ID"]. "'";
	$oDB->ExecuteNonQuery($sqlCmd);	 
?>

