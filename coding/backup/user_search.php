<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head> 

<?php include("include/headerfile.php"); ?>

<Script Language="JavaScript">
<!--

function frmNew(){  
    parent.location="user_entry.php?op=1"; 
}

function frmCari(){  
    //document.frmList.submit();
	
	if (document.frmList.txtName.value == ""){
		alert("Silahkan isi user id / nama");
		return false;
	}
	window.open("user_list.php?txtName="+document.frmList.txtName.value,"rightResult");
}

-->
</Script>
<body> 

<form method="post" name="frmList">
<table width="20%" border="0" cellpadding="2" cellspacing="1">
	<tr class='font10black'>
		<td>Search :</td>
	</tr> 
	<tr class='font10black'>
		<td>User ID / Name : <input type='text' name='txtName' id='txtName' value='' class='thin'></td>
	</tr> 
	<tr class='font10black'>
		<td>
		<input type="button" name="btCari" value="Cari" class ="button" onClick="frmCari();" />
		&nbsp;
		<input type="button" name="btTambah" value="Create User" class ="button" onClick="frmNew();" />

		</td>
	</tr> 

</form>
</body> 
</html>