<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
	if (isset($_GET["txtName"])){
		$kode = trim($_GET["txtName"]);
	}
	else
	{
		$kode = ""; 
	}
	
	if ($kode == "")
		eror("kriteria kosong");
	
	$sql = "select user_id, user_nama, group_user_id from mst_user where user_nama<>'admin' and (user_id='$kode' or user_nama like '%$kode%')";
	
	$oDB = new clsDataAccess($hostDB, $userDB, $passDB, $nameDB);
	$rs = $oDB->ExecuteReader($sql);
	$numRows = mysql_num_rows($rs); 
	
	//echo $sql
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>List User</title>
</head>
<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmNew(){  
    self.location="user_entry.php?op=1"; 
}

function frmCari(){  
    document.frmList.submit();
}

-->
</Script> 

<body>

<form method="post" name="frmList">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
	<tr>
		<td>List User</td>
	</tr>
	
	<tr>
		<td>		
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d29fec" align="left">
				<tr class="contentTitleTable">
					<td>No</td> 
					<td>User ID</td><td>Nama</td>
					<td>&nbsp;</td>
				</tr>
				<?php
				if ($numRows == 0)
				{
				?>
				<tr >
					<td colspan="4" bgcolor="white">User dengan ID/Nama '<?php echo $kode; ?>' Data tidak ada</td> 
				</tr>
				
				<?php
				}
				else
				{
					$i = 0;
					while ($data = mysql_fetch_array($rs)) 
					{
						$i++;
						?>						
						<tr class='font10black' bgcolor='#ffffff'>
							<td><?php echo $i; ?></td>
							<td><?php echo $data[0] ?> </td><td><?php echo $data[1] ?> </td>
							<td>
							<a href="user_entry.php?op=2&ID=<?php echo $data[0]?>" target="MainAccount">Edit</a>
							</td>
						</tr>	
						<?php
					}
				}
				?>
			</table>
		</td>
	</tr>	
</table>

</form>
</body>
</html>

