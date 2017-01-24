<?php
	if (mysql_num_rows($rsGen) == 0){
		eror("Retrieve Form Eror : Generator $tableName belum disetting");	
	}	
	
	mysql_data_seek($rsGen, 0);
	$i = 0;	
	$value = "";
	while ($dataGen = mysql_fetch_array($rsGen)) 
	{
		$i++;
		$value = "";		
		
		if ($tableGen == "barang"){
			if ($dataGen["FieldName"] == "counter"){
				$value = getRunNoYYMM($hostDB, $userDB, $passDB, $nameDB, "kode barang"); 
			}	
		}
		
		if ( ($tableGen == "trx_jual_by_order") || ($tableGen == "trx_gd_pro_in_by_order") || ($tableGen == "trx_gd_pro_out_by_order") || ($tableGen == "trx_retur_jual") ){
			if ($dataGen["FieldName"] == "contact_code"){ 
				$value = $customer; 
			}	
		} 
		
		if ( ($tableGen == "trx_order_jual") 
			|| ($tableGen == "trx_delivery_order") 
			|| ($tableGen == "trx_jual_by_order") 	
			|| ($tableGen == "trx_jual_non_order")
			|| ($tableGen == "trx_retur_jual")	
			|| ($tableGen == "trx_beli_non_order")
			|| ($tableGen == "trx_retur_beli")			
			
			){
			
			if ($dataGen["FieldName"] == "kel_beli"){
				$value = $divisi; 
			}
			
			if ($dataGen["FieldName"] == "kode_divisi"){
				$value = $divisi; 
			}
			
			if ($dataGen["FieldName"] == "sales_code"){
				$value = "A1000001"; 
			}
		}		
		
		if ($tableGen == "trx_terima_hasil_produksi"){
			if ($dataGen["FieldName"] == "contact_code"){
				$value = $customer; 
			}	
		}
		
		if ($tableGen == "trx_delivery_order") {
			if ($dataGen["FieldName"] == "contact_code"){
				$value = $customer; 
			}	
		}
		
		if ($tableGen == "trx_jual_by_order"){
			if ($dataGen["FieldName"] == "no_reff"){
				$value = $no_order; 
			}	
			
			if ($dataGen["FieldName"] == "tgl_reff"){
				$value = $tgl_order; 
			}	
		}
		
		
		
		$dataValue[] = $value; 
	} 
?>