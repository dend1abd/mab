<?php
	include "include/clsDataAccess.php";
	include "include/global.php"; 
	include "include/clsBisnisProses.php";
	
	cekSession();
	$dataValue = array();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	
	$tableGen = "barang";
	$tableName = "mst_product";
	$pageTitle = "Barang";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);		
	$sql = "select * from form_generator where tableName='$tableGen' order by sortNo";
	//eror($sql);
	$rsGen = $oDB->ExecuteReader($sql); 
	if (mysql_num_rows($rsGen) == 0){
		eror("Generator $tableName belum disetting");	
	} 
		
	if (isset($_POST["txtOp"]))
	{
		$_SESSION["op"] = $_POST["txtOp"];
        $_SESSION["ID"] = $_POST["txtID"];

        if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
        {            
			include "gen_RetrieveForm.php";			
        }
       	FormProcess(); 
	}
	
	//******* form load
	else
	{
		$_SESSION["op"] = retrieveS($_GET["op"]);
		$_SESSION["ID"] = "";
		
		if ($_SESSION["op"] == "1")
		{
            $_SESSION["modeView"] = "1"; 
            $_SESSION["btnLabel"] = "Save Data";
            $_SESSION["lblTitle"] = "New Data $pageTitle";
			
			include "gen_ClearData.php";
			
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }		
			
			$whereKondisi = "where product_code ='" .$_SESSION["ID"]. "'";
			include "gen_RetrieveData.php"; 
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data";
                $_SESSION["lblTitle"]  = "Edit Data";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data";
                    $_SESSION["lblTitle"]  = "Delete Data";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data";
			}
        }
        else    
            eror("invalid op");
			
		FormLoad();
	}

function FormProcess()
{	
	global $rsGen;
	global $dataValue;
	global $oDB; 
	global $tableName;	
	
	global $hostDB; 
	global $userDB; 
	global $passDB; 
	global $nameDB; 
	
	$whereKondisi = "where product_code ='" .$_SESSION["ID"]. "'";
	
    if($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
    {
	   
		include "gen_PutToArray.php";
        
        if ($_SESSION["op"] == "1")
        {
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1); 
            $sqlCmd = sqlInsert($tableName, $array2d);
            $strTemp = "Tambah Data Sukses";
			
			updateRunNo($hostDB, $userDB, $passDB, $nameDB, "kode barang");
        }            
        else
        {          
            
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate($tableName, $array2d, $whereKondisi );	
            $strTemp = "Update Data Sukses";
        }
		$oDB->ExecuteNonQuery($sqlCmd);	
		
		$sqlCmd = "UPDATE mst_product, (select size1, size2, size3, size4, size5, size6, size7, size8, size9, size10 from mst_size where kode_size='" .retrieveS($_POST["txtkode_size"]). "') abc 
		set 
		mst_product.size1 = abc.size1,
		mst_product.size2 = abc.size2,
		mst_product.size3 = abc.size3,
		mst_product.size4 = abc.size4,
		mst_product.size5 = abc.size5,
		mst_product.size6 = abc.size6,
		mst_product.size7 = abc.size7,
		mst_product.size8 = abc.size8,
		mst_product.size9 = abc.size9,
		mst_product.size10 = abc.size10 
		where mst_product.product_code='" .retrieveS($_POST["txtproduct_code"]). "'";
		$oDB->ExecuteNonQuery($sqlCmd);	

    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from $tableName $whereKondisi";
		$oDB->ExecuteNonQuery($sqlCmd);	
        $strTemp = "Delete Data Sukses";
    }
    else
        eror("invalid op");
		
	//eror($sqlCmd);    
	
	header('location:global_notification.php?from=product&strMsg=' . htmlspecialchars($strTemp));

}

function FormLoad()	
{	
	global $oDB;  
	global $clsformatInteger;
	global $rsGen;
	global $dataValue;
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe = 2"; 
    $rsSupplier = $oDB->ExecuteReader($sqlCmd); 
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=12 order by reff";
    $rsNegara = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=16 order by reff";
    $rsKelBarang = $oDB->ExecuteReader($sqlCmd);	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=17 order by reff";
    $rsJenisBarang = $oDB->ExecuteReader($sqlCmd);	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=18 order by reff";
    $rsMerekBarang = $oDB->ExecuteReader($sqlCmd);	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kode_size, kode_size from mst_size order by kode_size";
    $rsKelSize  = $oDB->ExecuteReader($sqlCmd);	
	
	$sqlCmd = "select kode_size, concat( IFNULL(Size1, ''),'~', IFNULL(Size2, ''),'~', IFNULL(Size3, ''),'~', IFNULL(Size4, ''),'~', IFNULL(Size5, ''),'~', IFNULL(Size6, ''),'~', IFNULL(Size7, ''),'~', IFNULL(Size8, '') ) as size from mst_size";
	$rsKelSize2  = $oDB->ExecuteReader($sqlCmd);	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $_SESSION["lblTitle"]; ?></title>
</head>

<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!-- 

var arrSize = new Array();
<?php 
	mysql_data_seek($rsKelSize2 , 0);
	$iLoop = 0;
	while ($row = mysql_fetch_array($rsKelSize2)) {	
		echo "arrSize[$iLoop]='$row[1]';";
		$iLoop++;	
	}
?>

var arrJenisBarang = new Array();
var arrMerekBarang = new Array();
<?php 
	mysql_data_seek($rsJenisBarang , 0);
	$iLoop = 0;
	while ($row = mysql_fetch_array($rsJenisBarang)) {	
		echo "arrJenisBarang[$iLoop]='$row[1]';";
		$iLoop++;	
	}
	
	mysql_data_seek($rsMerekBarang , 0);
	$iLoop = 0;
	while ($row = mysql_fetch_array($rsMerekBarang)) {	
		echo "arrMerekBarang[$iLoop]='$row[1]';";
		$iLoop++;	
	}
?>

if (!Array.indexOf) {
  Array.prototype.indexOf = function (obj, start) {
    for (var i = (start || 0); i < this.length; i++) {
      if (this[i] == obj) {
        return i;
      }
    }
    return -1;
  }
}

function tampilkanSize(index){
	if(index >0){	
		//alert(arrSize[index-1]);
		
		sizes = arrSize[index-1];
		//arrSplit = sizes.split("~");
		
		document.getElementById('divDetailSize').innerHTML = sizes;
	}
	else{
		document.getElementById('divDetailSize').innerHTML = "";
	}
}	

function tampilkanNamaJenisBarang(index){
	if(index >0){	
		nama = arrJenisBarang[index-1];
	}
	else{
		nama = "";
	}
	return nama;
}	

function tampilkanNamaMerekBarang(index){
	if(index >0){	
		nama = arrMerekBarang[index-1];
	}
	else{
		nama = "";
	}
	return nama;
}


function errMsg() {
	<?php 
	if( $_SESSION["errAlert"] ==true){	
		echo "alert('" . $_SESSION["errAlert"] . "')";
	}
	?>
}

function setNormal(){
<?php
include "gen_JSSetNormal.php";
?>   
}

function frmSubmit(){ 
    op = document.input.txtOp.value;

    if (op == "1" || op == "2")
    {  
		if(document.getElementById("txtkode_artikel").value== "")
		{
			alert("Silahkan pilih divisi");
			document.getElementById("txtkode_artikel").focus();
			return false;
		}
		
		if(document.getElementById("txtkode_kelompok").value== "")
		{
			alert("Silahkan pilih kelompok barang");
			document.getElementById("txtkode_kelompok").focus();
			return false;
		}
		 
		
		
		if(document.getElementById("txtkode_jenis").value== "")
		{
			alert("Silahkan pilih Jenis Barang");
			document.getElementById("txtkode_jenis").focus();
			return false;
		}
		 
		if(document.getElementById("txtcounter").value== "")
		{
			alert("Silahkan isi counter");
			document.getElementById("txtcounter").focus();
			return false;
		}
		
		isiKodeBarang();		
		
		<?php
include "gen_ValidasiMandatory.php";
		?> 
		
		
    }

    if (op == "1")
        msg = 'Confirm add data ?';
    else if (op == "2")
        msg = 'Confirm edit data ?';
    else if (op == "3")
        msg = 'Confirm delete data ?';
    else
    {
        msg = 'invalid op';
        return false;
    } 	 
	if(confirm(msg)){
		if (op == "1" || op == "2")
    	{
			setNormal();
		}
	  document.input.submit();
	}
	
} 

function isiKodeBarang(){
	document.getElementById("txtproduct_code").value = document.getElementById("txtkode_artikel").value + "." + document.getElementById("txtkode_kelompok").value + "." + document.getElementById("txtkode_jenis").value + "." + document.getElementById("txtcounter").value;
		
		//namaJenisBarang = tampilkanNamaJenisBarang(document.getElementById("txtkode_jenis").selectedIndex);
		//namaMerekBarang = tampilkanNamaMerekBarang(document.getElementById("txtkode_merek").selectedIndex);
		//document.getElementById("txtproduct_name").value = document.getElementById("txtkode_merek").value + " " + namaJenisBarang ;
		//document.getElementById("txtproduct_name").value = namaMerekBarang + " " + namaJenisBarang ;
		
		//alert(tampilkanNamaJenisBarang(1));
		//alert(tampilkanNamaJenisBarang(document.getElementById("txtkode_jenis").selectedIndex));		
		//return false();
}

function frmUpload(){
	
	if(document.getElementById("txtkode_artikel").value== "")
		{
			alert("Silahkan pilih divisi");
			document.getElementById("txtkode_artikel").focus();
			return false;
		}
		
		if(document.getElementById("txtkode_kelompok").value== "")
		{
			alert("Silahkan pilih kelompok barang");
			document.getElementById("txtkode_kelompok").focus();
			return false;
		}
		 
		
		
		if(document.getElementById("txtkode_jenis").value== "")
		{
			alert("Silahkan pilih Jenis Barang");
			document.getElementById("txtkode_jenis").focus();
			return false;
		}
		 
		if(document.getElementById("txtcounter").value== "")
		{
			alert("Silahkan isi counter");
			document.getElementById("txtcounter").focus();
			return false;
		}
		
		isiKodeBarang();		
	
	kode_produk = document.getElementById("txtproduct_code").value;
	window.open("product_upload_photo.php?product_code=" + kode_produk , "winDetails", "height=450, width=640, location=0, menubar=0,scrollbars=1");
}

-->
</Script>

<BODY  onLoad="errMsg()">
<form name="input" method="post" >
<input type ="hidden" name="txtOp" value="<?php echo $_SESSION["op"]; ?>" />
<input type ="hidden" name="txtID" value="<?php echo $_SESSION["ID"]; ?>" /> 

<table width="70%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
	<tr bgcolor="white" >
	<td class="contentTitleTable" align="center">
	<?php echo $_SESSION["lblTitle"] ?>	</td>
	</tr>
	<tr bgcolor="white">
	<td height="250" valign="top" align="left">
		
		<table width="100%">
		
			<tr class="font10black"> 
	          <td width="5%">&nbsp;</td>
	          <td width="25%">&nbsp;</td>
	          <td width="1%">&nbsp;</td>
	          <td >&nbsp;</td>
	        </tr>
            
            <?php
            $i = 0;
			mysql_data_seek($rsGen, 0);
			while ($dataGen = mysql_fetch_array($rsGen)) 
			{
				
				//$initDataGen[] = ""; 
				echo "<tr class=\"font10black\">";
				echo "<td></td>";
				echo "<td>" .$dataGen["TitleName"]. "</td>";
				echo "<td>:</td>";
				echo "<td>";
				include "gen_SettingInputan.php";
				
				if ($dataGen["FieldName"] ==  "kode_size"){
					echo "<div id='divDetailSize'></div>";
				}
				
				if ($dataGen["FieldName"] ==  "product_code"){
					echo " (auto generated)";
				}
				
				if ($dataGen["FieldName"] ==  "product_name"){
					//echo " (auto generated)";
				}
				
				echo "</td>";
				
				$i++;
			}
			?>  
			
            <tr height="10"><td>&nbsp;</td><td colspan=3 class="font10black">Upload Gambar Barang : </td></tr>
            <tr height="10"><td>&nbsp;</td><td colspan=3>
            <?php
				global $lokasifile_photo_sole;
				if($_SESSION["ID"] != ""){
					$kode_barang = $_SESSION["ID"];
					$sql = "select * from mst_photo_sole where kode_barang='$kode_barang'";
					$rsPhoto = $oDB->ExecuteReader($sql);					
					echo "<table width=80% border=\"0\" cellpadding=\"3\" cellspacing=\"1\" bgcolor=\"#d29fec\" align=\"left\">";
					echo "<tr class=\"contentTitleTable\" align=\"center\">";
					echo "<td>No</td>";
					echo "<td>Judul</td>";
					echo "<td>Nama File</td>";
					echo "</tr>";
					if (mysql_num_rows($rsData) == 0){
						echo "<tr class=\"font10black\" bgcolor='#ffffff'><td colspan=5>Photo sole belum ada</td></tr>";
					}
					else{						
						$i = 0;
						while ($photo = mysql_fetch_array($rsPhoto)) 
						{			
							$i++;
							$namafile = $photo["nama_file"];
							
							echo "<tr class=\"font10black\" bgcolor='#ffffff'>";
							echo "<td>$i</td>";
							echo "<td valign='top'>" .$photo["judul"]. "</td>";
							echo "<td valign='top'><a href='" .$lokasifile_photo_sole . "/" . $kode_barang. "/$namafile' target='_blank'>" .$namafile. "</a></td>";
							echo "</tr>";
						}
					}
					echo "</table>";
				}
            ?>
            </td></tr>
            
            <tr height="10"><td colspan=4 align="center"></td></tr>
                
			<tr class="font10black">
          		<td colspan=4 align="center">

			<?php 
			if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2" || $_SESSION["op"] == "3")
			{ 
			?>
              <input class="button" type="button" name="cmdSubmit1" value="<?php echo $_SESSION["btnLabel"] ?>" onClick="frmSubmit();" />&nbsp;
              <input class="button" type="button" name="cmdSubmit2" value="Upload Gambar" onClick="frmUpload();" />&nbsp;
			<?php
			}
			?>
           	</td>
           </tr> 
           <tr height="10"><td colspan=4 align="center"></td></tr>
           
		</table>
	</td>
	</tr> 
</table> 
</form> 
 
</BODY>
</HTML>

<?php
}

function ClearSession()
{
//$_SESSION["op"] = ""
$_SESSION["btnLabel"] = "";
$_SESSION["lblTitle"] = "";
$_SESSION["errAlert"] 	= false;
$_SESSION["errMsg"] 	= "";
	$_SESSION["product_id"] = "";
$_SESSION["product_code"] = "";
$_SESSION["product_name"] = "";
$_SESSION["harga_beli"] = "0";
$_SESSION["harga_jual"] = "0";
$_SESSION["saldo_awal"] = "0"; 
}
?>

