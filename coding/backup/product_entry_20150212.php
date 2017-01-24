<?php
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	
	//$sql = "select * from tGroupUser order by GroupUserName";							
	//$rsGroupUser = $oDB->ExecuteReader($sql);
	
	if (isset($_POST["txtOp"]))
	{
		$_SESSION["op"] = $_POST["txtOp"];
        $_SESSION["ID"] = $_POST["txtID"];

        if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
        {
            $_SESSION["product_code"] = $_POST["txtproduct_code"];
			$_SESSION["product_name"] = $_POST["txtproduct_name"];
			$_SESSION["harga_beli"] = $_POST["txtharga_beli"];
			$_SESSION["harga_jual"] = $_POST["txtharga_jual"]; 
			$_SESSION["saldo_awal"] = $_POST["txtsaldo_awal"];
			
        }
       	FormProcess(); 
	}
	else
	{
		$_SESSION["op"] = $_GET["op"];
		
		if ($_SESSION["op"] == "1")
		{
            $_SESSION["modeView"] = "1"; 
			ClearSession();
			
            $_SESSION["btnLabel"] = "Save Data";
            $_SESSION["lblTitle"] = "New Data";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT product_code, product_name, harga_beli, harga_jual, saldo_awal FROM mst_product a WHERE a.product_code ='" .$_SESSION["ID"]. "'";
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["product_code"] = $data["product_code"];
				$_SESSION["product_name"] = $data["product_name"];
				$_SESSION["harga_beli"] = $data["harga_beli"];
				$_SESSION["harga_jual"] = $data["harga_jual"];
				$_SESSION["saldo_awal"] = $data["saldo_awal"];
				
			}
			else
				eror("Data Kosong");
	       	
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
    if($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
    {
	   
		$array2d[] = array("product_code", $_SESSION["product_code"], 1);
		$array2d[] = array("product_name", $_SESSION["product_name"], 1);
		$array2d[] = array("harga_beli", $_SESSION["harga_beli"], 0);
		$array2d[] = array("harga_jual", $_SESSION["harga_jual"], 0);
		$array2d[] = array("saldo_awal", $_SESSION["saldo_awal"], 0);
 
        
        if ($_SESSION["op"] == "1")
        {
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlInsert("mst_product", $array2d);
            $strTemp = "Data has been successfully inserted";
        }            
        else
        {          
            
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("mst_product", $array2d, "where product_code='" .$_SESSION["ID"] . "'" );	
            $strTemp = "Data has been successfully updated";
        }
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from mst_product where product_code='" . $_SESSION["ID"] . "'";
        $strTemp = "Data has been successfully deleted";
    }
    else
        eror("invalid op");

    global $oDB; 
	$oDB->ExecuteNonQuery($sqlCmd);	
	header('location:global_notification.php?from=product&strMsg=' . htmlspecialchars($strTemp));

}

function FormLoad()	
{	
	global $oDB;  
	global $clsformatInteger;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List Barang</title>
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

function cmdDate_onclick(txtDate){
		var nowDate = new Date;
		initCalendar (nowDate, txtDate, '8pt');
	}

function setNormal(){
    //var i = 0; 
  

    //for(i=1;i<=jmlItem;i++)
    //{ 
    //	document.getElementById('txtDetailJumlah' + (i)).value = formatBilangan(document.getElementById('txtDetailJumlah' + (i)).value); 
    //} 
    
    document.getElementById('txtharga_jual').value = formatBilangan(document.getElementById('txtharga_jual').value);
    document.getElementById('txtharga_beli').value = formatBilangan(document.getElementById('txtharga_beli').value);
	document.getElementById('txtsaldo_awal').value = formatBilangan(document.getElementById('txtsaldo_awal').value);
	
}


function frmSubmit(){ 
    op = document.input.txtOp.value;

    if (op == "1" || op == "2")
    { 
     	setNormal();
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
	  document.input.submit();
	}
	
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
	        
	        <tr class="font10black">
          <td></td>
          <td>  Kode Barang</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtproduct_code", $_SESSION["product_code"], 20, 20, ""); ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  Nama Barang</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtproduct_name", $_SESSION["product_name"], 50, 50, ""); ?> </td>
</tr >

<tr class="font10black">
          <td></td>
          <td>  Harga Beli</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtharga_beli", $_SESSION["harga_beli"], 20, 20, $clsformatInteger); ?> </td>
</tr >

<tr class="font10black">
          <td></td>
          <td>  Harga Jual</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtharga_jual", $_SESSION["harga_jual"], 20, 20, $clsformatInteger); ?> </td>
</tr >

<tr class="font10black">
          <td></td>
          <td>  Saldo Awal</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtsaldo_awal", $_SESSION["saldo_awal"], 20, 20, $clsformatInteger); ?> </td>
</tr >

 
			
			<tr class="font10black">
          		<td colspan=4 align="center">

			<?php 
			if ($_SESSION["op"] == "1" || $_SESSION["op"] == "2" || $_SESSION["op"] == "3")
			{ 
			?>
              <input class="button" type="button" name="cmdSubmit" value="<?php echo $_SESSION["btnLabel"] ?>" onClick="frmSubmit();" />&nbsp;&nbsp;&nbsp;
			<?php
			}
			?>
			  <input class='button' type='button' name='cmdBack' value='Back To List' onclick='window.history.back()' />

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

