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
            $_SESSION["stOrder"] = $_POST["txtstOrder"];
			$_SESSION["stOrder_ket"] = $_POST["txtstOrder_ket"]; 
        }
       	FormProcess(); 
	}
	else
	{
		$_SESSION["op"] = $_GET["op"];
		
		if ($_SESSION["op"] == "1")
		{
            
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT transaksi_kode, transaksi_tgl, stOrder, stOrder_ket FROM trx_master a WHERE a.transaksi_kode ='" .$_SESSION["ID"]. "'";
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["transaksi_kode"] = $data["transaksi_kode"];
				$_SESSION["transaksi_tgl"] = $data["transaksi_tgl"];
				$_SESSION["stOrder"] = $data["stOrder"];
				$_SESSION["stOrder_ket"] = $data["stOrder_ket"];
			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Status Order";
                $_SESSION["lblTitle"]  = "Edit Status Order";
			}
			else
			{
				 
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
	   
		$array2d[] = array("stOrder", $_SESSION["stOrder"], 0);
		$array2d[] = array("stOrder_ket", $_SESSION["stOrder_ket"], 1); 
 
        
        if ($_SESSION["op"] == "1")
        {
        	
        }            
        else
        {          
            
			$array2d[] = array("stOrder_input_date", "NOW()", 0);
            $array2d[] = array("stOrder_input_by", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("trx_master", $array2d, "where transaksi_kode='" .$_SESSION["ID"] . "'" );	
            $strTemp = "Data has been successfully updated";
        }
    }
    elseif ($_SESSION["op"] == "3")
    {
    	 
    }
    else
        eror("invalid op");

    global $oDB; 
	$oDB->ExecuteNonQuery($sqlCmd);	
	header('location:global_notification.php?strMsg=' . htmlspecialchars($strTemp));

}

function FormLoad()	
{	
	global $oDB;  
	global $clsformatInteger;
	
	$sqlCmd = "SELECT kodereff, reff FROM mst_reff where tipereff =8"; 
    $rsStatus = $oDB->ExecuteReader($sqlCmd);
    
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List product</title>
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
}


function frmSubmit(){ 
    op = document.input.txtOp.value;

    if (op == "1" || op == "2")
    { 
     	//setNormal();
    }

    if (op == "1")
        msg = 'Confirm add status order ?';
    else if (op == "2")
        msg = 'Confirm edit status order ?';
    else if (op == "3")
        msg = 'Confirm delete status order ?';
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
          <td>  No Order</td>
          <td>:</td>
          <td> <?php  echo $_SESSION["transaksi_kode"]; ?> </td>
</tr >
<tr class="font10black">
          <td></td>
          <td>  Tgl Order</td>
          <td>:</td>
          <td> <?php  echo $_SESSION["transaksi_tgl"]; ?> </td>
</tr >

<tr class="font10black">
          <td style="height: 3px"></td>
          <td style="height: 3px">  Status</td>
          <td style="height: 3px">:</td>
          <td style="height: 3px"> <?php echo getComboBox($_SESSION["modeView"], "txtstOrder", $_SESSION["stOrder"], $rsStatus, ""); ?> </td>
</tr >

<tr class="font10black">
          <td></td>
          <td>  Keterangan</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtstOrder_ket", $_SESSION["stOrder_ket"], 255, 30, ""); ?> </td>
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

}
?>

