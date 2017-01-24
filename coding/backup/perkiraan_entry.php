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
            $_SESSION["perkiraan_code"] = $_POST["txtperkiraan_code"];
			$_SESSION["perkiraan_name"] = $_POST["txtperkiraan_name"]; 
			$_SESSION["parent"] = $_POST["txtparent"]; 
			$_SESSION["stDK"] = $_POST["txtstDK"]; 
			$_SESSION["stAC"] = $_POST["txtstAC"]; 
			$_SESSION["stKas"] = $_POST["txtstKas"]; 
			$_SESSION["stBank"] = $_POST["txtstBank"];
			$_SESSION["SaldoAwal"] = $_POST["txtSaldoAwal"];
			$_SESSION["TglAwal"] = $_POST["txtTglAwal"];
			$_SESSION["kode_divisi"] = $_POST["txtkode_divisi"];		
 
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
            $_SESSION["lblTitle"] = "New Data perkiraan";
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }
	        
	        $sqlCmd = "SELECT perkiraan_code, perkiraan_name, stDK, stAC, stKas, stBank, SaldoAwal, TglAwal, kode_divisi FROM mst_perkiraan a WHERE a.perkiraan_code='" .$_SESSION["ID"] . "'";
	        $rs = $oDB->ExecuteReader($sqlCmd);
			$numRows = mysql_num_rows($rs);		
			if($numRows >0){				
				$data	=	mysql_fetch_array($rs);	
				$_SESSION["perkiraan_code"] = $data[0];
				$_SESSION["perkiraan_name"] = $data[1];
				$_SESSION["stDK"] = $data[2];
				$_SESSION["stAC"] = $data[3];
				$_SESSION["stKas"] = $data[4];
				$_SESSION["stBank"] = $data[5];
				$_SESSION["SaldoAwal"] = $data["SaldoAwal"];
				$_SESSION["TglAwal"] = $data["TglAwal"];				
				$_SESSION["kode_divisi"] = $data["kode_divisi"];
			}
			else
				eror("Data Kosong");
	       	
			if ($_SESSION["op"] == "2")
			{
				$_SESSION["modeView"] = "1";
                $_SESSION["btnLabel"] = "Update Data";
                $_SESSION["lblTitle"]  = "Edit Data perkiraan";
			}
			else
			{
				$_SESSION["modeView"] = "2";
                if ($_SESSION["op"] == "3")
                {
                    $_SESSION["btnLabel"] = "Delete Data";
                    $_SESSION["lblTitle"]  = "Delete Data perkiraan";
                }
                else
                    $_SESSION["lblTitle"]  = "View Data perkiraan";
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
		$array2d[] = array("perkiraan_code", $_SESSION["perkiraan_code"], 1); 
		$array2d[] = array("perkiraan_name", $_SESSION["perkiraan_name"], 1);
		$array2d[] = array("parent", $_SESSION["parent"], 1);
		$array2d[] = array("stDK", $_SESSION["stDK"], 0); 
		$array2d[] = array("stAC", $_SESSION["stAC"], 0);
		$array2d[] = array("stKas", $_SESSION["stKas"], 0); 
		$array2d[] = array("stBank", $_SESSION["stBank"], 0);
		$array2d[] = array("SaldoAwal", $_SESSION["SaldoAwal"], 0); 
		$array2d[] = array("TglAwal", $_SESSION["TglAwal"], 1);
		$array2d[] = array("kode_divisi", $_SESSION["kode_divisi"], 1);
		
        if ($_SESSION["op"] == "1")
        {
        	$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlInsert("mst_perkiraan", $array2d);
            $strTemp = "Data has been successfully inserted";
        }            
        else
        {          
            
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate("mst_perkiraan", $array2d, "where perkiraan_code='" .$_SESSION["ID"] . "'" );	
            $strTemp = "Data has been successfully updated";
        }
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from mst_perkiraan where perkiraan_code='" .$_SESSION["ID"] . "'";
        $strTemp = "Data has been successfully deleted";
    }
    else
        eror("invalid op");

    global $oDB; 
	$oDB->ExecuteNonQuery($sqlCmd);	
	header('location:global_notification.php?from=perkiraan&strMsg=' . htmlspecialchars($strTemp));

}

function FormLoad()
{	
	global $oDB; 
	global $clsformatInteger;
	
	$sqlCmd = "SELECT kodereff, reff from mst_reff where tipereff=1"; 
    $rsDK = $oDB->ExecuteReader($sqlCmd);
    
    $sqlCmd = "SELECT kodereff, reff from mst_reff where tipereff=9"; 
    $rsYaTdk = $oDB->ExecuteReader($sqlCmd);
	
	$sqlCmd = "select kodereff, reff from mst_reff where tipereff=23 order by reff";
    $rsArtikel = $oDB->ExecuteReader($sqlCmd);	
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List perkiraan</title>
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

function frmSubmit(){ 
    op = document.input.txtOp.value;

    if (op == "1" || op == "2")
    { 
        document.getElementById('txtSaldoAwal').value = formatBilangan(document.getElementById('txtSaldoAwal').value); 
    }

    if (op == "1")
        msg = 'Confirm add data perkiraan ?';
    else if (op == "2")
        msg = 'Confirm edit data perkiraan ?';
    else if (op == "3")
        msg = 'Confirm delete data perkiraan ?';
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
          <td>  Kode Perkiraan</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtperkiraan_code", $_SESSION["perkiraan_code"], 20, 20, ""); ?> 
          &nbsp; Induk Perkiraan : 
          <?php  echo getTextBox($_SESSION["modeView"], "txtparent", $_SESSION["parent"], 20, 20, ""); ?> 
          </td>
</tr >
		<tr class="font10black">
          <td></td>
          <td>  Nama Perkiraan</td>
          <td>:</td>
          <td> <?php  echo getTextBox($_SESSION["modeView"], "txtperkiraan_name", $_SESSION["perkiraan_name"], 50, 50, ""); ?> </td>
		</tr >
		
		<tr class="font10black">
          <td></td>
          <td>  Divisi</td>
          <td>:</td>
          <td> <?php  echo getComboBox($_SESSION["modeView"], "txtkode_divisi", $_SESSION["kode_divisi"], $rsArtikel, ""); ?> </td>
		</tr >
		
		<tr class="font10black">
          <td></td>
          <td>  Status Debet/Kredit</td>
          <td>:</td>
          <td> <?php  echo getComboBox($_SESSION["modeView"], "txtstDK", $_SESSION["stDK"], $rsDK, ""); ?> </td>
		</tr >
		
		<tr class="font10black">
          <td></td>
          <td>  Status AC</td>
          <td>:</td>
          <td> <?php  echo getComboBox($_SESSION["modeView"], "txtstAC", $_SESSION["stAC"], $rsYaTdk , ""); ?> </td>
		</tr >
		
		<tr class="font10black">
          <td></td>
          <td>  Status Kas</td>
          <td>:</td>
          <td> <?php  echo getComboBox($_SESSION["modeView"], "txtstKas", $_SESSION["stKas"], $rsYaTdk , ""); ?> </td>
		</tr >
		
		<tr class="font10black">
          <td></td>
          <td>  Status Bank</td>
          <td>:</td>
          <td> <?php  echo getComboBox($_SESSION["modeView"], "txtstBank", $_SESSION["stBank"], $rsYaTdk , ""); ?> </td>
		</tr >
		

		<tr class="font10black">
          <td></td>
          <td>  Saldo Awal</td>
          <td>:</td>
          <td> 
          <?php  echo getTextBox($_SESSION["modeView"], "txtSaldoAwal", $_SESSION["SaldoAwal"], 50, 20, $clsformatInteger); ?> 
          &nbsp;per Tanggal&nbsp;
          <?php echo getDatePic($_SESSION["modeView"], "txtTglAwal", $_SESSION["TglAwal"], ""); ?>
          </td>
		</tr >

		
		<tr class="font10black">
          <td colspan="4" height="10"></td>
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
	$_SESSION["perkiraan_id"] = "";
$_SESSION["perkiraan_code"] = "";
$_SESSION["parent"] = "";
$_SESSION["perkiraan_name"] = "";
$_SESSION["stDK"] = "";
$_SESSION["stAC"] = "";
$_SESSION["stKas"] = "";
$_SESSION["stBank"] = "";
$_SESSION["SaldoAwal"] = "";
$_SESSION["TglAwal"] = "";
$_SESSION["kode_divisi"] = "";
}
?>

