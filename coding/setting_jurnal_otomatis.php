<?php
	include "include/clsDataAccess.php";
	include "include/clsBisnisProses.php";
	include "include/global.php";	
	
	cekSession();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	$pageTitle = "Setting Kode Perkiraan Jurnal Otomatis";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	//$sql = "select * from tGroupUser order by GroupUserName";							
	//$rsGroupUser = $oDB->ExecuteReader($sql);
	
	$_SESSION["errAlert"] = false;
	$_SESSION["errMsg"] = "";
	
	if (isset($_POST["txtjml"]))
	{		
		//$array2d[] = array("jurnal_purchase_tunai_debet", retrieveS($_POST["txtjurnal_purchase_tunai_debet"]), 1); 1);
		$sql = "delete from mst_jurnal_setting";
		$oDB->ExecuteNonQuery($sql);
		
		$jml = retrieveS($_POST["txtjml"]);
		
		for($i=1; $i<=$jml; $i++){
			unset($array2d);
			
			$array2d[] = array("kode_transaksi", retrieveS($_POST["txtkode_transaksi_" . $i]), 1);
			$array2d[] = array("nama_transaksi", retrieveS($_POST["txtnama_transaksi_" . $i]), 1);
			$array2d[] = array("debet", retrieveS($_POST["txtdebet_" . $i]), 1);
			$array2d[] = array("kredit", retrieveS($_POST["txtkredit_" . $i]), 1);
			$array2d[] = array("ket", retrieveS($_POST["txtket_" . $i]), 1);
			
			$sql = sqlInsert("mst_jurnal_setting", $array2d);  
			//echo $sql;
			$oDB->ExecuteNonQuery($sql);
		}
         
		$_SESSION["errAlert"] = true;
		$_SESSION["errMsg"] = "Data sudah tersimpan"; 
	} 
	
	$sql = "select * from mst_jurnal_setting order by kode_transaksi";
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs);
	$jml = $numRows;

?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?php echo $pageTitle; ?></title>
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

function frmSubmit(){  
	msg = "Confirm Update Data ?";
	if(confirm(msg)){
	  document.input.submit();
	}
	
} 

-->
</Script>

<BODY  onLoad="errMsg()">
<form name="input" method="post" >

<table width="70%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
	<tr bgcolor="white" >
		<td class="contentTitleTable" align="center">
		<?php echo $pageTitle; ?>	
		</td>
	</tr>
    <tr bgcolor="white" >
		<td align="center">&nbsp;
		</td>
	</tr>
    
	<tr bgcolor="white">    
		<td height="250" valign="top" align="left" align="center">
		
		<table width='100%'  cellspacing='1' bgcolor='silver' id='tblDetail' >
			<tr class="contentTitleTable" align="center" >
              <td width="15%" align="center">Kode Transaksi</td>
	          <td width="25%" align="center">Nama Transaksi</td>
	          <td width="1%" align="center">Debet</td>
	          <td  align="center">Kredit</td>
              <td  align="center">Keterangan</td>
	        </tr>
            
            <?php
            mysql_data_seek($rs, 0);
			$i = 0;
			while ($data = mysql_fetch_array($rs)) 
			{ 
				$i++;
				echo "<tr class='font10black' bgcolor='white'>";	
				echo "<td>" . getTextBox(1, "txtkode_transaksi_" .$i , $data["kode_transaksi"], 10, 10, "") . "</td>";
				echo "<td>" . getTextBox(1, "txtnama_transaksi_" .$i , $data["nama_transaksi"], 50, 50, "") . "</td>";
				echo "<td>" . getTextBox(1, "txtdebet_" .$i , $data["debet"], 20, 20, "") . "</td>";
				echo "<td>" . getTextBox(1, "txtkredit_" .$i , $data["kredit"], 20, 20, "") . "</td>";
				echo "<td>" . getTextBox(1, "txtket_" .$i , $data["ket"], 50, 50, "") . "</td>";
				echo "</tr>";
			}			
			?>
            </table>
            </td>
            </tr>
       </tr>
       
        <tr class="font10black" bgcolor="#FFFFFF" height="30">
            <td align="center"> 
            <input type='hidden' name='txtjml' value='<?php echo $i; ?>'>
          <input class="button" type="button" name="cmdSubmit" value="Update" onClick="frmSubmit();" />
            </td>
       </tr> 
</table> 
</form> 
 
</BODY>
</HTML>

<?php 

function ClearSession()
{
	
}
?>

