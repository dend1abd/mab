<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	$plain = "if retrieveS(RSDet(identitasPenerima_penyelenggaraPenerimaAkhir_nasabah_korporasi_bidangUsaha";
	$plain = "123132";
	
	$enc = encrypt($plain);
	$dec = decrypt($enc);
	
	echo "Plain : $plain <br />";
	echo "Enkrip : $enc <br />";
	echo "Dekrip : $dec <br />";
	echo tulis();

	function tulis()
	{
		return aksiTambah;
	}
?>

