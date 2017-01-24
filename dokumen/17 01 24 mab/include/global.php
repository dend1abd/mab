<?php 
//session_start(); 
include "koneksi.php";

$clsformatInteger = "style='TEXT-ALIGN: RIGHT;'  onChange='this.value=formatCurrency3(this.value);'";
$clsformatIntegerReadOnly = "style='TEXT-ALIGN: RIGHT; background-color: #CCCCCC;'  onChange='this.value=formatCurrency3(this.value);'";
$clsformatIntegerMandatory = "style='TEXT-ALIGN: RIGHT; background-color: #FCF;'  onChange='this.value=formatCurrency3(this.value);'";
$clsReadOnly = "style='background-color: #CCCCCC;'";
$clsMandatory = "style='background-color: #FCF;'";


//$hostDB = "localhost";
//$userDB = "root";
//$passDB = "";
//$nameDB = "vtec-sia";

$clsInputForm1 = "class=detailedViewTextBox onFocus=\"this.className='detailedViewTextBoxOn'\" onBlur=\"this.className='detailedViewTextBox'\"";
$clsInputForm2 = "class=detailedViewTextBox2 onFocus=\"this.className='detailedViewTextBoxOn2'\" onBlur=\"this.className='detailedViewTextBox2'\"";

$ajaxGetCust = " onchange=\"getLookup(this, 'txtCustKet', 'getCustomer.php')\" ";
$ajaxGetVessel1 = " onchange=\"getLookup(this, 'txtVessel1Ket', 'getVessel.php')\" ";
$ajaxGetVessel2 = " onchange=\"getLookup(this, 'txtVessel2Ket', 'getVessel.php')\" ";
$ajaxGetCountry = " onchange=\"getLookup(this, 'txtcountryket', 'getcountry.php')\" ";

$ajaxgetport1 = " onchange=\"getLookup(this, 'txtPolKet', 'getport.php')\" ";
$ajaxgetport2 = " onchange=\"getLookup(this, 'txtTransitKet', 'getport.php')\" ";
$ajaxgetport3 = " onchange=\"getLookup(this, 'txtPodKet', 'getport.php')\" ";

$ajaxgetPerkiraan = " onchange=\"getLookup(this, 'txtDetailPerkiraan0', 'getPerkiraan.php')\" ";
$ajaxgetProduct = " onchange=\"getLookup(this, 'txtDetailproduct_name0', 'getProduct.php')\" ";
$ajaxgetProductBeli = " onchange=\"getBarang(this, 1)\" ";
$ajaxgetProductJual = " onchange=\"getBarang(this, 2)\" ";
$pageTitle = ".:: Mitra Alam Bandung ::.";

$lokasifile_photo_sole = "img_sole";

//include "cdatabase.php";

	function getMySqlDate($tgl){
		$namaBulan = array(1=>"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		
		if(($tgl =="" ) or ($tgl=="0000-00-00")){		
			return "";			
		}
		else{
			$tanggal = substr($tgl,8,2);
			$bulan = $namaBulan[intval(substr($tgl,5,2))];
			$tahun = substr($tgl,0,4);
			return $tanggal.'-'.$bulan.'-'.$tahun;		 
		}
	}
	
	function setMySqlDate($tgl){
		$namaBulan = array("Jan"=>"01", "Feb"=>"02", "Mar"=>"03", "Apr"=>"04", "May"=>"05", "Jun"=>"06", "Jul"=>"07", "Aug"=>"08", "Sep"=>"09", "Oct"=>"10", "Nov"=>"11", "Dec"=>"12");
		
		if(($tgl =="" ) or ($tgl=="0000-00-00")){		
			return "";			
		}
		else{
			$tanggal = substr($tgl,0,2);
			$bulan = $namaBulan[substr($tgl,3,3)];
			$tahun = substr($tgl,7,4);
			return $tahun.'-'.$bulan.'-'.$tanggal;		 
		}
	}
	
	function setDateIndo($tgl){
		$namaBulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		
		if(($tgl =="" ) or ($tgl=="0000-00-00")){		
			return "";			
		}
		else{
			$tanggal = substr($tgl,8,2);
			$bulan = $namaBulan[intval(substr($tgl,5,2))];
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
		}
	}
	
	function sqlInsert($tableName, $arrField){
		$field = "";
		$value = "";
		$flag = 0;
		$stField = "";
		$stValue = "";
		
		$xx = "insert into $tableName(";
		$pjg = count($arrField);
		for ($k=0;$k<$pjg;$k++)
		{
			$field = $arrField[$k][0];
			$value = $arrField[$k][1];			
			$flag = $arrField[$k][2];
			
			$value = str_replace("'", "''", $value);
			if($value == "")
				$value = "null";
			else{
				if($flag == 1)	
					$value = "'$value'";
			}
			$stField = $stField . $field . ", ";
			$stValue = $stValue . $value . ", ";			
		}
		$stField 	= substr($stField, 0, strlen($stField)-2);
		$stValue 	= substr($stValue, 0, strlen($stValue)-2);
		
		$xx = $xx . $stField . ") values (" . $stValue . ")";
		return $xx; 
	}
	
	function sqlUpdate($tableName, $arrField, $whereKondisi){
		$field = "";
		$value = "";
		$flag = 0;
		$stKal = "";
		
		$xx = "update $tableName set ";
		$pjg = count($arrField);
		for ($k=0;$k<$pjg;$k++)
		{
			$field = $arrField[$k][0];
			$value = $arrField[$k][1];
			$flag = $arrField[$k][2];
			
			$value = str_replace("'", "''", $value);
			if($value == "")
				$value = "null";
			else{
				if($flag == 1)	
					$value = "'$value'";
			}
			
			$stKal = $stKal . $field . " = " . $value . ", ";
		}
		$stKal 	= substr($stKal, 0, strlen($stKal)-2);
		
		$xx = $xx . $stKal . " " . $whereKondisi;
		return $xx; 
	}
	
	function cekSession(){	
		session_start();
		if(trim($_SESSION["userid"]) == ""){
			header('location:..\login.php');
		}
		
		if (time() - $_SESSION['sessiontime'] > $_SESSION['expire']){
			header('location:logout.php');
		}
		
		$_SESSION['sessiontime'] = time();
	}
	
	function inLevel($menuCode){	
		$intLevel = 0;
		
		if(substr($menuCode, 1, 2) <> "00"){
			$intLevel++;
			if(substr($menuCode, 3, 2) <> "00"){
				$intLevel++;			
				if(substr($menuCode, 5, 2) <> "00"){
					$intLevel++;
					if(substr($menuCode, 7, 3) <> "000"){
						$intLevel++;
					}
				}
			}
		}
		
		return $intLevel;
	}
	
	function AddSpace($banyak){	
		$space  = "";
		for ($k=0;$k<$banyak;$k++)
		{
			$space = $space . "&nbsp;";
		}
		
		return $space;
	}
	
	function getTextBox($modeView, $txtName, $txtValue, $MaxLen, $Size, $OthersProperties)	
	{
		if($modeView == "1")
			$result =  "<input type='text' name='$txtName' id='$txtName' size='$Size' maxlength='$MaxLen' value='$txtValue' class='thin' $OthersProperties />";	
		else
			$result =  $txtValue;
		return $result;
	}
	
	function getTextArea($modeView, $txtName, $txtValue, $nRows, $nCols, $OthersProperties)	
	{
		if($modeView == "1")
			$result =  "<textarea name='$txtName' id='$txtName' cols='$nCols' rows='$nRows' class='thin' $OthersProperties />$txtValue</textarea>";	
		else
			$result =  $txtValue;
		return $result;
	}
	
	function getHiddenBox($modeView, $txtName, $txtValue)	
	{
		if($modeView == "1")
			$result =  "<input type='hidden' name='$txtName' id='$txtName' value='$txtValue' />";	
		else
			$result =  $txtValue; 
		return $result;
	}
	
	function getComboBox($modeView, $txtName, $txtValue, $rs, $OthersProperties)	
	{               
		$result = "";    
		if($modeView == "1") {
			$result =  "<select name='$txtName' id='$txtName' class='thin' $OthersProperties >";
			$result =  $result . "<option value='' >-- Pilih --</option>"; 
			
			if (isset($rs)){
				if (mysql_num_rows($rs) > 0){
					mysql_data_seek($rs, 0);
					while ($row = mysql_fetch_array($rs)) {				
						if ($row[0] == $txtValue)
							$selected	= " selected";
						else
							$selected	= ""; 
		
						$result =  $result . "<option value='$row[0]' $selected>$row[1]</option>";
					}
				}
			}
			$result =  $result . "</select>"; 
		}
		else{ 
			if (isset($rs)){
				if (mysql_num_rows($rs) > 0){
					mysql_data_seek($rs, 0);
					while ($row = mysql_fetch_array($rs)) {
						if ($row[0] == $txtValue)
							$result	= $row[1];
					}  
				}
			}
		}
		return $result;
	}
	
	function getComboBoxEx($modeView, $txtName, $txtValue, $rs, $topCaption, $OthersProperties)	
	{               
		$result = "";    
		if($modeView == "1") {
			$result =  "<select name='$txtName' id='$txtName' class='thin' $OthersProperties >";
			$result =  $result . "<option value='' >$topCaption</option>"; 
			
			if (isset($rs)){
				if (mysql_num_rows($rs) > 0){
					mysql_data_seek($rs, 0);
					while ($row = mysql_fetch_array($rs)) {				
						if ($row[0] == $txtValue)
							$selected	= " selected";
						else
							$selected	= ""; 
		
						$result =  $result . "<option value='$row[0]' $selected>$row[1]</option>";
					}
				}
			}
			$result =  $result . "</select>"; 
		}
		else{ 
			if (isset($rs)){
				if (mysql_num_rows($rs) > 0){
					mysql_data_seek($rs, 0);
					while ($row = mysql_fetch_array($rs)) {
						if ($row[0] == $txtValue)
							$result	= $row[1];
					}  
				}
			}
		}
		return $result;
	}
	
	function getComboBox2($modeView, $txtName, $txtValue, $rs, $OthersProperties)	
	{                   
		if($modeView == "1") {
			$result =  "<select name='$txtName' id='$txtName' class='thin' $OthersProperties >"; 
			mysql_data_seek($rs, 0);
			while ($row = mysql_fetch_array($rs)) {
			
				if ($row[0] == $txtValue)
					$selected	= " selected";
				else
					$selected	= ""; 

				$result =  $result . "<option value='$row[0]' $selected>$row[1]</option>";
			}
			$result =  $result . "</select>"; 
		}
		else{ 
			mysql_data_seek($rs, 0);
			while ($row = mysql_fetch_array($rs)) {
				if ($row[0] == $txtValue)
					$result	= $row[1];
			}  
		} 
		
		return $result;
	}	
	
	function getComboBox3($modeView, $txtName, $txtValue, $rs, $OthersProperties)	
	{                   
		if($modeView == "1") {
			$result =  "<select name='$txtName' id='$txtName' class='thin' $OthersProperties >"; 
			mysql_data_seek($rs, 0);
			while ($row = mysql_fetch_array($rs)) {
			
				if ($row[0] == $txtValue)
					$selected	= " selected";
				else
					$selected	= ""; 

				$result =  $result . "<option value='$row[0]' $selected>$row[0] - $row[1]</option>";
			}
			$result =  $result . "</select>"; 
		}
		else{ 
			mysql_data_seek($rs, 0);
			while ($row = mysql_fetch_array($rs)) {
				if ($row[0] == $txtValue)
					$result	= $row[1];
			}  
		} 
		
		return $result;
	}	
	
	function getComboBox4($modeView, $txtName, $txtValue, $rs, $OthersProperties)	
	{                   
		if($modeView == "1") {
			$result =  "<select name='$txtName' id='$txtName' class='thin' $OthersProperties >"; 
			$result =  $result . "<option value='' >-- Pilih --</option>";  
			mysql_data_seek($rs, 0);
			while ($row = mysql_fetch_array($rs)) {
			
				if ($row[0] == $txtValue)
					$selected	= " selected";
				else
					$selected	= ""; 

				$result =  $result . "<option value='$row[0]' $selected>$row[0] - $row[1]</option>";
			}
			$result =  $result . "</select>"; 
		}
		else{ 
			mysql_data_seek($rs, 0);
			while ($row = mysql_fetch_array($rs)) {
				if ($row[0] == $txtValue)
					$result	= $row[1];
			}  
		} 
		
		return $result;
	}
	
	function getComboBox5($modeView, $txtName, $txtValue, $rs, $OthersProperties)	
	{               
		$result = "";    
		if($modeView == "1") {
			$result =  "<select name='$txtName' id='$txtName' class='thin' $OthersProperties >";
			$result =  $result . "<option value='' >-</option>"; 
			mysql_data_seek($rs, 0);
			while ($row = mysql_fetch_array($rs)) {
			
				if ($row[0] == $txtValue)
					$selected	= " selected";
				else
					$selected	= ""; 

				$result =  $result . "<option value='$row[0]' $selected>$row[1]</option>";
			}
			$result =  $result . "</select>"; 
		}
		else{ 
			mysql_data_seek($rs, 0);
			while ($row = mysql_fetch_array($rs)) {
				if ($row[0] == $txtValue)
					$result	= $row[1];
			}  
		}
		return $result;
	}
	
	function getDatePic($modeView, $txtName, $txtValue, $OthersProperties)	
	{
		if($modeView == "1"){ 
			$result = "";
			$result = $result . "<script>";
			$result = $result . "$(function() {";
			$result = $result . "$( '#" .$txtName. "' ).datepicker({";
			$result = $result . "showOn: 'button',";
			$result = $result . "buttonImage: 'images/calendar.gif',";
			$result = $result . "buttonImageOnly: true,";
			$result = $result . "changeMonth: true,";
	        $result = $result . "changeYear: true,";
	        $result = $result . "dateFormat: 'yy-mm-dd',";
	        $result = $result . "showAnim: 'slideDown'";
			 $result = $result . "});";
			$result = $result . "});";
			$result = $result . "</script>";
		
		//<img  src='javascript/images2/cal.gif' alt='$txtName' style='cursor:pointer' onclick=\"javascript:NewCssCal('$txtName','ddMMMyyyy', 'arrow')\">";	
	 		$result = $result . "<input type='text' name='$txtName' id='$txtName' size='10' value='$txtValue' , class='thin' $OthersProperties readonly />";
	 		$result = $result . "<img src='images/deltgl.gif' alt='Delete Tanggal' onClick=\"cmdDate_onDelete(document.getElementById('$txtName'))\" />";
	 	}
	 	else{
	 		$result = $txtValue;
	 	}
        
		return $result;
	}
	
	function getDatePicMand($modeView, $txtName, $txtValue, $OthersProperties)	
	{
		global $clsMandatory;
		if($modeView == "1"){ 
			$result = "";
			$result = $result . "<script>";
			$result = $result . "$(function() {";
			$result = $result . "$( '#" .$txtName. "' ).datepicker({";
			$result = $result . "showOn: 'button',";
			$result = $result . "buttonImage: 'images/calendar.gif',";
			$result = $result . "buttonImageOnly: true,";
			$result = $result . "changeMonth: true,";
	        $result = $result . "changeYear: true,";
	        $result = $result . "dateFormat: 'yy-mm-dd',";
	        $result = $result . "showAnim: 'slideDown'";
			 $result = $result . "});";
			$result = $result . "});";
			$result = $result . "</script>";
		
		//<img  src='javascript/images2/cal.gif' alt='$txtName' style='cursor:pointer' onclick=\"javascript:NewCssCal('$txtName','ddMMMyyyy', 'arrow')\">";	
	 		$result = $result . "<input type='text' name='$txtName' id='$txtName' size='10' value='$txtValue' , class='thin' $OthersProperties readonly $clsMandatory />"; 
	 	}
	 	else{
	 		$result = $txtValue;
	 	}
        
		return $result;
	}

	function getAutoComplete($modeView, $txtName, $txtValue, $size, $rs, $OthersProperties)	
	{
		$result = "";
		$tampil = "";

		if($modeView == "1") {		

			$result = $result . "<script> ";
			$result = $result . "var data_" .$txtName. " = [";

			if (isset($rs)){
				if (mysql_num_rows($rs) > 0){
					mysql_data_seek($rs, 0);
					$i = 0;
					while ($row = mysql_fetch_array($rs)) {										
						$i++;
						$kode = $row[0];
						$nama = $row[1];
						if ($row[0] == $txtValue) $tampil = $nama;

						$result = $result . "{value: \"$kode\", label: \"$nama\"}";
						if ($i < mysql_num_rows($rs)) $result = $result . ", ";
					}
				}
			}

			$result = $result . "];";
			
			$result = $result . "$(function() {";
			$result = $result . "	$('#" .$txtName. "_x').autocomplete({";
			$result = $result . "		source: data_" .$txtName. ",";
			$result = $result . "		focus: function(event, ui) {";
			$result = $result . "			event.preventDefault();";
			$result = $result . "			$(this).val(ui.item.label);";
	        $result = $result . "		},";
	        $result = $result . "		select: function(event, ui) {";
	        $result = $result . "			event.preventDefault();";
			$result = $result . "			$(this).val(ui.item.label);";
			$result = $result . "			$('#" .$txtName. "').val(ui.item.value);";
			$result = $result . "		}";
			$result = $result . "	});";
			$result = $result . "});";
			$result = $result . " </script>";

			$result = $result . "<input type='text' name='$txtName" ."_x". "' id='$txtName" ."_x". "' size='$size' value='$tampil' class='thin' $OthersProperties />"; 
			$result = $result . "<input type='hidden' name='$txtName' id='$txtName' value='$txtValue' />"; 
			
		}
		else{ 
			if (isset($rs)){
				if (mysql_num_rows($rs) > 0){
					mysql_data_seek($rs, 0);
					while ($row = mysql_fetch_array($rs)) {				
						if ($row[0] == $txtValue) $result	= $row[1];
					}
				}
			}
			$result = $result . "<input type='hidden' name='$txtName' id='$txtName' value='$txtValue' />"; 
		}
		return $result;
	}

	function getComboCust($modeView, $txtName, $txtValue, $size, $rs, $OthersProperties)	
	{
		$result = "";
		$tampil = "";

		if($modeView == "1") {		

			$result = $result . "<script> ";
			$result = $result . "var data_" .$txtName. " = [";

			if (isset($rs)){
				if (mysql_num_rows($rs) > 0){
					mysql_data_seek($rs, 0);
					$i = 0;
					while ($row = mysql_fetch_array($rs)) {										
						$i++;
						$kode = retrieveS($row[0]);
						$nama = retrieveS($row[1]);
						$sales_code = retrieveS($row[2]);
						$kode_wilayah = retrieveS($row[3]);
						if ($row[0] == $txtValue) $tampil = $nama;

						$result = $result . "{value: \"$kode\", label: \"$nama\", sales_code: \"$sales_code\", kode_wilayah: \"$kode_wilayah\"}";
						if ($i < mysql_num_rows($rs)) $result = $result . ", ";
					}
				}
			}

			$result = $result . "];";
			
			$result = $result . "$(function() {";
			$result = $result . "	$('#" .$txtName. "_x').autocomplete({";
			$result = $result . "		source: data_" .$txtName. ",";
			$result = $result . "		focus: function(event, ui) {";
			$result = $result . "			event.preventDefault();";
			$result = $result . "			$(this).val(ui.item.label);";
	        $result = $result . "		},";
	        $result = $result . "		select: function(event, ui) {";
	        $result = $result . "			event.preventDefault();";
			$result = $result . "			$(this).val(ui.item.label);";
			$result = $result . "			$('#" .$txtName. "').val(ui.item.value);";
			$result = $result . "			$('#txtsales_code').val(ui.item.sales_code);";
			$result = $result . "			$('#txtkode_wilayah').val(ui.item.kode_wilayah);";
			$result = $result . "		}";
			$result = $result . "	});";
			$result = $result . "});";
			$result = $result . " </script>";

			$result = $result . "<input type='text' name='$txtName" ."_x". "' id='$txtName" ."_x". "' size='$size' value='$tampil' class='thin' $OthersProperties />"; 
			$result = $result . "<input type='hidden' name='$txtName' id='$txtName' value='$txtValue' />"; 
			
		}
		else{ 
			if (isset($rs)){
				if (mysql_num_rows($rs) > 0){
					mysql_data_seek($rs, 0);
					while ($row = mysql_fetch_array($rs)) {				
						if ($row[0] == $txtValue) $result	= $row[1];
					}
				}
			}
			$result = $result . "<input type='hidden' name='$txtName' id='$txtName' value='$txtValue' />"; 
		}
		return $result;
	}
	
	function getDatePicJS($modeView, $txtName, $txtValue, $OthersProperties)	
	{
		          
 		//$result =  "<input type='text' name='$txtName' id='$txtName' size='10' value='$txtValue' , $OthersProperties /><img  src='javascript/images2/cal.gif' alt='$txtName' style='cursor:pointer' onclick=\"javascript:NewCssCal('$txtName','ddMMMyyyy', 'arrow')\">";	
        
		//return $result;
		
		/*$result = "";
		$result = $result . "<script>";
		$result = $result . "$('body').on('focus',\". $txtName\", (function() {";
		$result = $result . "$(this).datepicker({";
		$result = $result . "showOn: 'button',";
		$result = $result . "buttonImage: 'images/cal.gif',";
		$result = $result . "buttonImageOnly: true,";
		$result = $result . "changeMonth: true,";
        $result = $result . "changeYear: true,";
        $result = $result . "dateFormat: 'yy-mm-dd',";
        $result = $result . "showAnim: 'slideDown'";
		 $result = $result . "});";
		$result = $result . "});";
		$result = $result . "</script>"; */
	
	//<img  src='javascript/images2/cal.gif' alt='$txtName' style='cursor:pointer' onclick=\"javascript:NewCssCal('$txtName','ddMMMyyyy', 'arrow')\">";	
 		$result = $result . "<input type='text' name='$txtName' id='$txtName' size='15' value='$txtValue' , class='thin' $OthersProperties />";
        
		return $result;

	}
	
	function right($string,$chars) 
	{ 
		$vright = substr($string, strlen($string)-$chars,$chars); 
		return $vright; 
		
	}	
	
	function eror($msg)
	{
		die($msg);
		return true;
	}
	
	function setNumber($number) 
	{ 
		//eror($number);
		if ($number == "") 
			$result = 0;
		else
			$result = number_format($number, 0, ".",","); 
			
		return $result; 
		
	}
	
	function terbilang($angka) {
    $angka = (float)$angka;
    $bilangan = array(
            '',
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan',
            'sepuluh',
            'sebelas'
    );
 
    if ($angka < 12) {
        return $bilangan[$angka];
    } else if ($angka < 20) {
        return $bilangan[$angka - 10] . ' belas';
    } else if ($angka < 100) {
        $hasil_bagi = (int)($angka / 10);
        $hasil_mod = $angka % 10;
        return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
    } else if ($angka < 200) {
        return sprintf('seratus %s', terbilang($angka - 100));
    } else if ($angka < 1000) {
        $hasil_bagi = (int)($angka / 100);
        $hasil_mod = $angka % 100;
        return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
    } else if ($angka < 2000) {
        return trim(sprintf('seribu %s', terbilang($angka - 1000)));
    } else if ($angka < 1000000) {
        $hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
        $hasil_mod = $angka % 1000;
        return sprintf('%s ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
    } else if ($angka < 1000000000) {
 
        // hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
        $hasil_bagi = (int)($angka / 1000000);
        $hasil_mod = $angka % 1000000;
        return trim(sprintf('%s juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000) {
        // bilangan 'milyaran'
        $hasil_bagi = (int)($angka / 1000000000);
        $hasil_mod = fmod($angka, 1000000000);
        return trim(sprintf('%s milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000000) {                          // bilangan 'triliun'                           
    $hasil_bagi = $angka / 1000000000000;                           
    $hasil_mod = fmod($angka, 1000000000000);                           
    return trim(sprintf('%s triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));                       
    } 
    else {                            return 'Wow...';                       
     }                   
     } 
	 
	function retrieveS($text) 
	{ 	
		return htmlspecialchars($text); 
	}
?>