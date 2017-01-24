<?php
	include "include/clsDataAccess.php";
	include "include/global.php"; 
	include "include/clsBisnisProses.php";
	
	cekSession();
	$dataValue = array();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	
	$tableGen = "barang_upload";
	$tableName = "mst_photo_sole";
	$pageTitle = "Upload Photo Sole";
	$pagePrefix = "product_upload_photo";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);		
	$sql = "select * from form_generator where tableName='$tableGen' order by sortNo";
	//eror($sql);
	$rsGen = $oDB->ExecuteReader($sql); 
	if (mysql_num_rows($rsGen) == 0){
		eror("Generator $tableName belum disetting");	
	} 
		
	if (isset($_POST["txtOp"])){		            
		include "gen_RetrieveForm.php";			
       	FormProcess(); 
	}
	
	//******* form load
	else
	{
		$product_code = retrieveS($_GET["product_code"]);			
		include "gen_ClearData.php";
			
		FormLoad();
	}

function FormProcess()
{	
	global $rsGen;
	global $dataValue;
	global $oDB; 
	global $tableName;	
	global $pagePrefix;
	global $lokasifile_photo_sole;
	global $product_code;
	   
	include "gen_PutToArray.php";
		
	$lokasi_file = $_FILES['txtnama_file_file']['tmp_name'];
	$nama_file   = $_FILES['txtnama_file_file']['name'];
	
	$product_code = retrieveS($_POST["txtproduct_code"]);
		
		//eror($nama_file);
	if ($nama_file != ""){
		$directory = $lokasifile_photo_sole . "/" . $product_code;
		if (is_dir($directory)){
		}
		else{
			$handle = mkdir ($directory);
		}
		
		$ke_namafile =  $directory . "/" . $nama_file;
		move_uploaded_file($lokasi_file, $ke_namafile);
		//eror($ke_namafile);
		$array2d[] = array("nama_file", $nama_file, 1); 			
	}
	
	$array2d[] = array("kode_barang", $product_code, 1); 
	$array2d[] = array("CreateDate", "NOW()", 0);
	$array2d[] = array("CreateBy", $_SESSION["userid"], 1); 
	$sqlCmd = sqlInsert($tableName, $array2d);
	$strTemp = "Data has been successfully inserted";
	
	//eror($sqlCmd);    
	$oDB->ExecuteNonQuery($sqlCmd);	
	$strMsg = "Data berhasil disimpan<br /><a href='product_upload_photo.php?product_code=$product_code'>Back</a>";
	eror($strMsg);

}

function FormLoad()	
{	
	global $oDB;  
	global $clsformatInteger;
	global $rsGen;
	global $dataValue;
	global $lokasifile_photo_sole;	
	global $cssMandatory;
	global $pageTitle;
	global $product_code;
	
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

function errMsg() {
	<?php 
	if( $_SESSION["errAlert"] ==true){	
		echo "alert('" . $_SESSION["errMsg"] . "')";
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
		<?php
include "gen_ValidasiMandatory.php";
		?> 
    }

    if (op == "1")
        msg = 'Confirm upload photo ?';
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

-->
</Script>

<BODY  onLoad="errMsg()" >
<form name="input" method="post" enctype='multipart/form-data' >
<input type ="hidden" name="txtOp" value="1" />

<table width="100%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
	<tr bgcolor="white" >
	<td class="contentTitleTable" align="center">
	<?php echo $pageTitle; ?>	</td>
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
            <tr class="font10black"> 
	          <td colspan=4 align="center">&nbsp;
              </td> 
	        </tr>
            <?
			}
			?>
            
            <?php
            if (($product_code != "0") && ($product_code != "0")){
				echo "<tr class='font10black'>";
				echo "<td>&nbsp;</td><td>Kode Barang</td><td>:</td><td><b>$product_code</b><input type='hidden' name='txtproduct_code' id='txtproduct_code' value='$product_code' /></td>";
				echo "</tr>";
			}
			?>
            
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
				
				echo "</td>";
				echo "</tr>";
				
				$i++;
			}
			?>  
			
            <tr height="10"><td colspan=4 align="center"></td></tr>
                
			<tr class="font10black">
          		<td colspan=4 align="center">
              <input class="button" type="button" name="cmdSubmit" value="Save" onClick="frmSubmit();" />		  
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
}
?>

