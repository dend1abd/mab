<?php
	$no_order = $_SESSION["ID"];
	
	$sql = "select transaksi_kode from trx_master where transaksi_tipe=6 and no_reff='$no_order'";
	$no_faktur =  getSingleValue($hostDB, $userDB, $passDB, $nameDB, $sql); 	
	//eror($no_faktur);
	$sql = "delete from trx_detail where transaksi_kode='$no_faktur'";
	$oDB->ExecuteNonQuery($sql); 		
	
	$sql = "insert into trx_detail (transaksi_kode, product_code, product_name, satuan, qty, sub_total, disc_persen, disc_amount, total,
ket_detail,harga, UpdateDate, no_order)
select '$no_faktur',product_code, product_name, satuan, qty, sub_total, disc_persen, disc_amount, total,
ket_detail,harga,now(),'$no_order' from trx_detail where transaksi_kode='$no_order'";
	$oDB->ExecuteNonQuery($sql);	 
?>