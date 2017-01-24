<?php
	include "include/clsDataAccess.php"; 
	include "include/global.php";	
	include "include/clsBisnisProses.php";
	
	cekSession();
	$pageTitle = "Cara Pembayaran Hutang";
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	if (isset($_POST["txtOp"]))
	{
		FormProcess(); 
	}
	else
	{
		$_SESSION["op"] = $_GET["op"];
		if (isset($_GET["kode"]))
			$transaksi_kode = retrieveS($_GET["kode"]);
		else
			eror("kode kosong");
    	
		FormLoad();
	}

function FormProcess()
{	
	global $oDB; 
	
	//******** cara pembayaran
	$_SESSION["ID"] = $_POST["txtID"];
	
	$sqlCmd = "delete from trx_cara_bayar where transaksi_kode='" .$_SESSION["ID"]. "'";	
	$oDB->ExecuteNonQuery($sqlCmd);
	
	$jmlItemCaraBayar = $_POST["txtJmlItemCaraBayar"];
	for($i=1; $i<=$jmlItemCaraBayar; $i++){
		unset($array2d);
		$array2d[] = array("transaksi_kode", $_SESSION["ID"], 1); 
		$array2d[] = array("cara_bayar", $_POST["txtDetailcara_bayar$i"], 1);
		$array2d[] = array("perkiraan_code", $_POST["txtDetailperkiraan_code$i"], 1);
		$array2d[] = array("perkiraan_name", $_POST["txtDetailperkiraan_name$i"], 1);
		$array2d[] = array("jumlah",$_POST["txtDetailjumlah$i"], 0);
		$array2d[] = array("no_reff", $_POST["txtDetailno_reff$i"], 1); 
		$array2d[] = array("tgl_reff", $_POST["txtDetailtgl_reff$i"], 1);
		$array2d[] = array("ket_reff", $_POST["txtDetailket_reff$i"], 1);
		
		$sqlCmd = sqlInsert("trx_cara_bayar", $array2d); 
		//echo $sqlCmd . "<br />";
		$oDB->ExecuteNonQuery($sqlCmd);
	} 
	
	header("location:pembayaran_hutang_cetak.php?kode=" .$_SESSION["ID"]); 
}

function FormLoad()
{		
	global $oDB;  
	global $clsformatInteger;
	global $transaksi_kode;
	global $pageTitle;
	
	$sql  = "select * from trx_master where transaksi_kode='$transaksi_kode'";
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs);		
	if($numRows >0){				
		$data	=	mysql_fetch_array($rs);	
		$contact_code = $data["contact_code"];
		$transaksi_tgl = $data["transaksi_tgl"];
		$bayar = $data["bayar"]; 	
	}
	else{
		eror("Data not found");
	} 
	
	$sqlCmd = "SELECT contact_code, CONCAT(contact_code,' - ', contact_name) FROM mst_contact where contact_tipe in (2, 3, 4)"; 
    $rsCustomer = $oDB->ExecuteReader($sqlCmd);
	
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
		echo "alert('" . $_SESSION["errAlert"] . "')";
	}
	?>
}   

function frmSubmit(){ 
    op = document.input.txtOp.value; 
	msg = 'Confirm save data ?';
	 
	if(confirm(msg)){  
	
		document.input.txtJmlItemCaraBayar.value = jmlItemCaraBayar;
		sumJumlahCaraBayar();
		setNormalCaraBayar();
			
		document.getElementById("btSubmit").disabled = true; 
		document.getElementById("btBack").disabled = true 
		document.input.submit();
	}
	
}
-->
</Script>

<body onLoad="errMsg()">
<form name="input" method="post" >
<input type ="hidden" name="txtOp" value="<?php echo $_SESSION["op"]; ?>" />
<input type ="hidden" name="txtID" value="<?php echo $transaksi_kode; ?>" /> 

<table width="90%" cellpadding="0" cellspacing="1" bgcolor="navy" align="center">
	<tr bgcolor="white" >
	<td class="contentTitleTable" align="center">
	<?php echo $pageTitle ?>	</td>
	</tr>
	<tr bgcolor="white">
	<td height="250" valign="top" align="left">
		
		<table width="100%">
		
			<tr>
				<td width=50% valign="top"> <!-- kiri-->
					<table width="100%"> 
						<tr class="font10black">
						  <td width="3%" ></td>
						  <td width="30%" >  Kode Transaksi</td>
						  <td width="1%" >:</td>
						  <td > <?php  echo $transaksi_kode; ?> </td>
						</tr >
						<tr class="font10black">
						  <td ></td>
						  <td >  Tgl Transaksi</td>
						  <td >:</td>
						  <td > <?php  echo $transaksi_tgl; ?> </td>
						</tr >  
					</table>
				</td>
				
				<td  valign="top"> <!-- kanan-->
					<table width="100%">
						<tr class="font10black">
						  <td style="width: 3%"></td>
						  <td width="30%">Customer</td>
						  <td width="1%">:</td> 
						  <td> <?php  
						  echo getComboBox(2, "txtcontact_code", $contact_code, $rsCustomer, ""); 		  
						  ?> 
                          </td> 
						</tr >
                        <tr class="font10black">
						  <td ></td>
						  <td >  Jumlah Bayar</td>
						  <td >:</td>
						  <td > <?php  
						  echo setNumber($bayar); 
						  echo getHiddenBox(1, "txtjml_bayar", $bayar); 		  
						  ?> </td>
						</tr >


					</table>
				</td> 
			</tr>

            <?php include "cara_bayar.php"; ?>
			
			<tr>
				<td colspan=2 align='center'> 
					 <?php 
				if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2" || $_SESSION["op"] == "3")
				{ 
				?>
				  <input class="button" type="button" name="btSubmit" id="btSubmit" value="Save" onClick="frmSubmit();" />
				<?php
				}
				?>
				  <input class='button' type='button' name='btBack' id='btBack' value='Back To List' onclick='window.history.back()' />
				</td> 
			</tr>
           
           <tr height="10">
				<td colspan=2 align='center'>
				</td>				
			</tr>

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
}
?>

