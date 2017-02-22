<?php
define('SALT', 'sepatu'); 

define('aksiTambah', "1"); 
define('aksiUbah', "2"); 
define('aksiHapus', "3"); 
define('aksiLihat', "4"); 

define('aksiTambahEnript', encrypt("1")); 
define('aksiUbahEnript', encrypt("2")); 
define('aksiHapusEnript', encrypt("3")); 
define('aksiLihatEnript', encrypt("4"));
	
	function getKodeBarang($hostDB, $userDB, $passDB, $nameDB)
	{
		//echo $hostDB;
		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
		
		$sql = "select stringvalue from app_config where kode ='kode barang'";
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$currentYear = $r[0];
		
		$sql = "select stringvalue, numbervalue + 1 from app_config where kode ='kode barang'";
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$Postfix 	= $r[0];
		$NoUrut 	= right("0000" . $r[1], 4);
		
        $result = $NoUrut . $Postfix;
		return $result;
	}
	
	function getNewKode($hostDB, $userDB, $passDB, $nameDB, $keyKode)
	{
		//echo $hostDB;
		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
		
		$sql = "select stringvalue from app_config where kode ='$keyKode'";
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$currentYear = $r[0];
		
		$sql = "select stringvalue, numbervalue + 1 from app_config where kode ='$keyKode'";
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$Postfix 	= $r[0];
		$NoUrut 	= right("0000" . $r[1], 4);
		
        $result = $NoUrut . $Postfix;
		return $result;
	}
	
	function setIncKode($hostDB, $userDB, $passDB, $nameDB, $keyKode)
	{
		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
		
		$sql = "update app_config set numbervalue = numbervalue + 1 where kode ='$keyKode'";
		$rs = $lDB->ExecuteNonQuery($sql);
		
		return true;
	}
	
	function getNewKode2($hostDB, $userDB, $passDB, $nameDB, $keyKode)
	{
		//echo $hostDB;
		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
		
		$sql = "select right(stringvalue, 2) from app_config where kode ='Current Year'";
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$currentYear = $r[0];
		
		$sql = "select stringvalue, numbervalue + 1 from app_config where kode ='$keyKode'";
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$Postfix 	= $r[0];
		$NoUrut 	= right("0000" . $r[1], 4);
		
        $result = $Postfix . $currentYear  . $NoUrut; 
		return $result;
	}
	
	function getKodeJurnalKas($hostDB, $userDB, $passDB, $nameDB)
	{
		//echo $hostDB;
		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		
		$sql = "select string_value, int_value  + 1 from mst_config where ket ='kode jurnal kas'";
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$Postfix 	= $r[0];
		$NoUrut 	= right("0000" . $r[1], 4);
		
        $result = $Postfix . right(date("Y"),2) . right("0".date("m"), 2) . $NoUrut;
		return $result;
	}
	
	function updateKodeJurnalKas($hostDB, $userDB, $passDB, $nameDB)
	{
		//echo $hostDB;
		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		
		$sql = "update mst_config set int_value = int_value + 1 where ket ='kode jurnal kas'";
		$rs = $lDB->ExecuteNonQuery($sql);
	}
	
	function getKodeJurnalBank($hostDB, $userDB, $passDB, $nameDB)
	{
		//echo $hostDB;
		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		
		$sql = "select string_value, int_value  + 1 from mst_config where ket ='kode jurnal bank'";
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$Postfix 	= $r[0];
		$NoUrut 	= right("0000" . $r[1], 4);
		
        $result = $Postfix . right(date("Y"),2) . right("0".date("m"), 2) . $NoUrut;
		return $result;
	}
	
	function updateKodeJurnalBank($hostDB, $userDB, $passDB, $nameDB)
	{
		//echo $hostDB;
		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		
		$sql = "update mst_config set int_value = int_value + 1 where ket ='kode jurnal bank'";
		$rs = $lDB->ExecuteNonQuery($sql);
	}
	
	function getKodeJurnalTransaksi($hostDB, $userDB, $passDB, $nameDB)
	{
		//echo $hostDB;
		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		
		$sql = "select string_value, int_value  + 1 from mst_config where ket ='kode jurnal transaksi'";
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$Postfix 	= $r[0];
		$NoUrut 	= right("0000" . $r[1], 4);
		
        $result = $Postfix . right(date("Y"),2) . right("0".date("m"), 2) . $NoUrut;
		return $result;
	}
	
	function updateKodeJurnalTransaksi($hostDB, $userDB, $passDB, $nameDB)
	{
		//echo $hostDB;
		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		
		$sql = "update mst_config set int_value = int_value + 1 where ket ='kode jurnal transaksi'";
		$rs = $lDB->ExecuteNonQuery($sql);
	}
	
	function getKodeJurnalMemorial($hostDB, $userDB, $passDB, $nameDB)
	{
		//echo $hostDB;
		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		
		$sql = "select string_value, int_value  + 1 from mst_config where ket ='kode jurnal memorial'";
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$Postfix 	= $r[0];
		$NoUrut 	= right("0000" . $r[1], 4);
		
        $result = $Postfix . right(date("Y"),2) . right("0".date("m"), 2) . $NoUrut;
		return $result;
	}
	
	function updateKodeJurnalMemorial($hostDB, $userDB, $passDB, $nameDB)
	{
		//echo $hostDB;
		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		
		$sql = "update mst_config set int_value = int_value + 1 where ket ='kode jurnal memorial'";
		$rs = $lDB->ExecuteNonQuery($sql);
	}
	
	function getKodeTransaksi($tipeTransaksi, $hostDB, $userDB, $passDB, $nameDB)
	{		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		//eror($tipeTransaksi);
		$sql = "select string_value, int_value  + 1 from mst_config where kode ='$tipeTransaksi'";
		
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$Postfix 	= $r[0];
		$NoUrut 	= right("0000" . $r[1], 4);
		
        $result = $Postfix . right(date("Y"),2) . right("0".date("m"), 2) . $NoUrut;
		return $result;
	}
	
	function getKodeTransaksi2($tipeTransaksi, $hostDB, $userDB, $passDB, $nameDB, $divisi)
	{		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		$fieldName = "";
		if ($divisi == "M") $fieldName = "mab_urut";
		if ($divisi == "S") $fieldName = "maf_urut";
		if ($divisi == "T") $fieldName = "mat_urut";
		//eror($tipeTransaksi);
		$sql = "select prefiks, $fieldName  + 1 from mst_runno where urutan = $tipeTransaksi";
		//eror($sql);
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$Postfix 	= $r[0];
		$NoUrut 	= right("0000" . $r[1], 4);
		
        $result = $Postfix .$divisi. right(date("Y"),2) . right("0".date("m"), 2) . $NoUrut;
		return $result;
	}
	
	function updateKodeTransaksi2($tipeTransaksi, $hostDB, $userDB, $passDB, $nameDB, $divisi)
	{		
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 		
		
		$fieldName = "";
		if ($divisi == "M") $fieldName = "mab_urut";
		if ($divisi == "S") $fieldName = "maf_urut";
		if ($divisi == "T") $fieldName = "mat_urut";
		
		$sql = "update mst_runno set $fieldName = $fieldName + 1 where urutan = $tipeTransaksi";		
		
		$rs = $lDB->ExecuteNonQuery($sql);
	} 
	
	function updateKodeTransaksi($tipeTransaksi, $hostDB, $userDB, $passDB, $nameDB)
	{
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 		
		$sql = "update mst_config set int_value = int_value + 1 where kode ='$tipeTransaksi'";		
		
		$rs = $lDB->ExecuteNonQuery($sql);
	}
	
	


function encrypt($text) 
{ 
    return $text;
} 

function decrypt($text) 
{ 
    return $text;
} 

function encrypt2($text) 
{ 
    return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SALT, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)))); 
} 

function decrypt2($text) 
{ 
    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SALT, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
} 


function cekAdaData($tblName, $kondisi)
{
	//echo $hostDB;
	global $hostDB;
	global $userDB;
	global $passDB;
	global $nameDB;
	         
	$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
	
	$sql = "select count(*) from $tblName where $kondisi";
	$rs = $lDB->ExecuteReader($sql);
	$r	=	mysql_fetch_array($rs);	
	if ($r[0] == 0)
		return false;
	else
		return true;
}

function getComboData($kode)
{
	//echo $hostDB;
	global $hostDB;
	global $userDB;
	global $passDB;
	global $nameDB;
	         
	$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
	$comboData = null;
	
	$sql = "select query from combo_data where kode='$kode'";
	$rs = $lDB->ExecuteReader($sql);
	if (mysql_num_rows($rs) > 0){
		$r	=	mysql_fetch_array($rs);	
		$sql = retrieveS($r[0]);
		if ($sql != "")
			$comboData = $lDB->ExecuteReader($sql);			
	}
	return $comboData;
}

function getComboFaktur($customer)
{
	//echo $hostDB;
	global $hostDB;
	global $userDB;
	global $passDB;
	global $nameDB;
	         
	$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
	$comboData = null;
	$sql = "";
	//b.contact_name, '/', 
	$sql = "select transaksi_kode, concat(transaksi_kode, '/', transaksi_tgl, '/', ifnull(c.contact_name,'')) as no_faktur
from trx_master a
inner join mst_contact b on a.contact_code=b.contact_code
left join  mst_contact c on a.sales_code=c.contact_code
where transaksi_tipe in (6,7) and a.contact_code='$customer' ";
//eror($sql);
	$comboData = $lDB->ExecuteReader($sql);	
	return $comboData;
}

	function getRunNo($hostDB, $userDB, $passDB, $nameDB, $kode)
	{		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		$sql = "select string_value, int_value  + 1 from mst_config where ket ='$kode'";
		
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$Postfix 	= $r[0];
		$NoUrut 	= right("000000" . $r[1], 6);
		
        $result = $Postfix . $NoUrut;
		return $result;
	}
	
	function updateRunNo($hostDB, $userDB, $passDB, $nameDB, $kode)
	{		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 		
		$sql = "update mst_config set int_value = int_value + 1 where ket ='$kode'";		
		$rs = $lDB->ExecuteNonQuery($sql);
	}
	
	function getRunNoYYMM($hostDB, $userDB, $passDB, $nameDB, $kode)
	{		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		$sql = "select string_value, bln, thn, int_value  + 1 from mst_config where ket ='$kode'";
		
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$Postfix 	= $r[0];
		$month 	= $r[1];
		$year	= $r[2];
		$NoUrut 	= right("0000" . $r[3], 4);
		
		$result = $Postfix . $year . right("0" .$month, 2) . $NoUrut;
		return $result;
	}
	
	function getSingleValue($hostDB, $userDB, $passDB, $nameDB, $sql)
	{		         
 		$lDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB); 
		
		$rs = $lDB->ExecuteReader($sql);
		$r	=	mysql_fetch_array($rs);	
		$value 	= $r[0];
		return $value;
	}

?>