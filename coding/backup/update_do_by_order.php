<?php
	$no_order = $_SESSION["ID"];
	
	$sql = "select distinct(a.transaksi_kode) from trx_master a inner join trx_detail b on a.transaksi_kode=b.transaksi_kode 
where transaksi_tipe=19  and no_order='$no_order'";
	$no_do =  getSingleValue($hostDB, $userDB, $passDB, $nameDB, $sql); 	
	
	$sql = "delete from trx_detail where transaksi_kode='$no_do' and no_order='$no_order' ";
	$oDB->ExecuteNonQuery($sql); 
		
	//************** total
	$sql = "insert into trx_detail (transaksi_kode, product_code, product_name, satuan, qty,
ket_detail,UpdateDate, no_order, kode_cust, nama_cust)

select '$no_do',product_code, product_name, satuan, qty, ket_detail, now(),'$no_order', a.contact_code, c.contact_name 
from trx_master a inner join trx_detail b on a.transaksi_kode=b.transaksi_kode 
left join mst_contact c on a.contact_code=c.contact_code where a.transaksi_kode='$no_order'";
	$oDB->ExecuteNonQuery($sql);	 
?>

