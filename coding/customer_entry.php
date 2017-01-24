<?php
	include "include/clsDataAccess.php";
	include "include/global.php"; 
	include "include/clsBisnisProses.php";
	
	cekSession();
	$dataValue = array();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	
	$tableGen = "customer";
	$tableName = "mst_contact";
	$pageTitle = "Customer";
	$pagePrefix = "customer";
	
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
		
		if ($_SESSION["op"] == "1")
		{
            $_SESSION["modeView"] = "1"; 
            $_SESSION["btnLabel"] = "Save Data";
            $_SESSION["lblTitle"] = "New Data $pageTitle";
			
			include "gen_ClearData.php";
			$dataValue[0] = getRunNo($hostDB, $userDB, $passDB, $nameDB, "kode customer");
			
			
        }
        elseif($_SESSION["op"] == "2" || $_SESSION["op"]=="3" || $_SESSION["op"]=="4")
        {
        	$_SESSION["ID"] = $_GET["ID"];
	        if($_SESSION["ID"] == "")
	        {
	        	eror("ID kosong");	       	
	        }		
			
			$whereKondisi = "where contact_code ='" .$_SESSION["ID"]. "'";
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
	global $pagePrefix;
	global $hostDB; 
	global $userDB; 
	global $passDB; 
	global $nameDB;
	
	$whereKondisi = "where contact_code ='" .$_SESSION["ID"]. "'";
	
    if($_SESSION["op"] == "1" || $_SESSION["op"] == "2")
    {
	   
		include "gen_PutToArray.php";
        
        if ($_SESSION["op"] == "1")
        {
        	$array2d[] = array("contact_tipe", "3", 0);
			$array2d[] = array("CreateDate", "NOW()", 0);
            $array2d[] = array("CreateBy", $_SESSION["userid"], 1); 
            $sqlCmd = sqlInsert($tableName, $array2d);
            $strTemp = "Data has been successfully inserted";
			
			updateRunNo($hostDB, $userDB, $passDB, $nameDB, "kode customer");
        }            
        else
        {          
            
			$array2d[] = array("UpdateDate", "NOW()", 0);
            $array2d[] = array("UpdateBy", $_SESSION["userid"], 1);
            
            $sqlCmd = sqlUpdate($tableName, $array2d, $whereKondisi );	
            $strTemp = "Data has been successfully updated";
        }
    }
    elseif ($_SESSION["op"] == "3")
    {
    	$sqlCmd = "delete from $tableName $whereKondisi";
        $strTemp = "Data has been successfully deleted";
    }
    else
        eror("invalid op");
		
	//eror($sqlCmd);    
	$oDB->ExecuteNonQuery($sqlCmd);	
	header('location:global_notification.php?from=' .$pagePrefix. '&strMsg=' . htmlspecialchars($strTemp));

}

function FormLoad()	
{	
	global $oDB;  
	global $clsformatInteger;
	global $rsGen;
	global $dataValue;
	
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
				echo "</td>";
				
				$i++;
			}
			?>  
			
            <tr height="10"><td colspan=4 align="center"></td></tr>
                
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
$_SESSION["contact_code"] = "";
$_SESSION["product_name"] = "";
$_SESSION["harga_beli"] = "0";
$_SESSION["harga_jual"] = "0";
$_SESSION["saldo_awal"] = "0"; 
}
?>

