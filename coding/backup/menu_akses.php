<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	$_SESSION["errAlert"] 	= false;
	$_SESSION["errMsg"] 	= "";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$sql="select kodereff, reff from mst_reff where tipeReff=10 and kodereff <> 1 order by reff ";
	$rsGroupUser = $oDB->ExecuteReader($sql);
	
	if (isset($_POST["txtGroupUser"])){
		$GroupUser= trim($_POST["txtGroupUser"]);
		
		$op= trim($_GET["op"]);		
		if ($op == "1"){
			$jml= trim($_POST["txtJml"]);
			
			$sqlCmd= "delete from mst_menu_akses where UserGroup_ID=$GroupUser";
			$oDB->ExecuteNonQuery($sqlCmd);
			
			for($i=1; $i<=$jml; $i++){
				if (isset($_POST["txtCek_$i"])){
					if ($_POST["txtCek_$i"] == "on") {
					
						$menuKode = $_POST["txtMenuKode_$i"];
						$sqlCmd= "insert into mst_menu_akses (UserGroup_ID, MenuKode) values ($GroupUser, '$menuKode')";
						$oDB->ExecuteNonQuery($sqlCmd);
					}
				}
			}
			
			$_SESSION["errAlert"] = true;
			$_SESSION["errMsg"] = "data sudah tersimpan";
		}
		
		$sql = "select a.MenuKode, MenuName, MenuParent, IFNULL(b.MenuKode, '0') as akses from mst_menu a left join mst_menu_akses b on a.MenuKode = b.MenuKode and b.UserGroup_ID=$GroupUser";
		$rs = $oDB->ExecuteReader($sql);
		$numRows = mysql_num_rows($rs);
		
		$sql = "select user_id, user_nama from mst_user where group_user_id=$GroupUser";
		//eror($sql);
		$rs2 = $oDB->ExecuteReader($sql);
		$numRows2 = mysql_num_rows($rs2);
		
		//echo $sql;
	}
	else
	{
		$GroupUser= ""; 
		$numRows = 0;
	} 
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List Menu</title>
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


function frmNew(){  
    self.location="menu_entry.php?op=1"; 
}

function frmShow(){ 
	document.frmList.action = "menu_akses.php?op=0" 
    document.frmList.submit();
}

function frmSave(){ 
	document.frmList.action = "menu_akses.php?op=1" 
    document.frmList.submit();
}


-->
</Script> 

<body onLoad="errMsg()">

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr class="font12Bold">
		<td>Menu Access</td>
	</tr> 
	<tr>
		<td>		
			<table >
				<tr >
					<td>Group User</td>
					<td>:</td>
					<td>
					<?php  echo getComboBox(1, "txtGroupUser", $GroupUser, $rsGroupUser , "onChange='frmShow();'"); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr> 
	
	<?php
		if ($numRows > 0)
		{
	?>
	
	<tr>
		<td> 
		<input type="button" name="btCari" value="Save" class ="button" onClick="frmSave();" />
		</td>
	</tr>
	
	
	
	<tr>
		<td>		
			<table width="100%" cellpadding="2" cellspacing="1" >
			<tr>
				<td width="50%" valign="top">				
					<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
						<tr class="contentTitleTable">
							<td>No</td> 
							<td>Menu</td><td>Akses</td>
						</tr>
						
						<?php
						
							$i = 0;
							
							while ($data = mysql_fetch_array($rs)) 
							{
								$i++;
								
								$spasi = "";	
		//						echo substr($data[0], 1, 1) . "<br />";
								if (substr($data[0], 3, 1) != "0") 
									$spasi = $spasi . "-----";		
									
								if (substr($data[0], 5, 1) != "0") 
									$spasi = $spasi . "-----";		
									
								if (substr($data[0], 7, 1) != "0") 
									$spasi = $spasi . "-----";
									
								if (substr($data[0], 9, 1) != "0") 
									$spasi = $spasi . "-----";
								
								?>						
								<tr class='font10black' bgcolor='#ffffff'>
									<td align="center"><?php echo $i; ?></td>
									<td align="left"><?php echo $spasi . $data[0] . " - " . $data[1] ?> </td>
									<td align="center">
									<?php  
										if ($data["akses"] == "0")
											$checked = "";
										else
											$checked = " checked ";
									?> 
									<input type="hidden" name="txtMenuKode_<?php echo $i ?>" id="txtMenuKode_<?php echo $i ?>" value="<?php echo $data[0]?>" />
									<input type="checkbox" name="txtCek_<?php echo $i ?>" id="txtCek_<?php echo $i ?>" <?php echo $checked; ?> />
									</td>
		
								</tr>	
								<?php
							}
						?>
						<input type="hidden" name="txtJml" id="txtJml" value="<?php echo $numRows; ?>" />
					</table>
				</td>
				<td valign="top">					
					<b>List User </b><br />
					<table width="50%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
						<tr class="contentTitleTable">
							<td>No</td> 
							<td>User ID</td><td>Name</td>
						</tr>
						<?php 
							if ($numRows2 == 0){
							?>
								<tr class='font10black' bgcolor='#ffffff'>
									<td colspan="3">user belum ada</td>
								</tr>
							<?php
							}
							else{
								$i = 0;							
								while ($data2 = mysql_fetch_array($rs2)) 
								{
									$i++;
								?>	
									<tr class='font10black' bgcolor='#ffffff'>									
										<td align="center"><?php echo $i; ?></td>
										<td align="left"><?php echo $data2[0]; ?></td>
										<td align="left"><?php echo $data2[1]; ?></td>									
									</tr>
								<?php
								}
							}								
						?>
					</table>
				</td>
			</tr>
			</table> 
		</td>
	</tr>	
	
	<?php 
		}
	?>
</table>

</form>
</body>
</html>

