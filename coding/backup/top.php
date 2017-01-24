<?php 
	include "include/clsDataAccess.php";
	include "include/global.php";
	
	cekSession();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>top</title>

<style type="text/css">
A:link {text-decoration: none; color: white;}
A:visited {text-decoration: none; color: white;}
A:active {text-decoration: none; color: white;}
A:hover {text-decoration: underline}
.auto-style1 {
	font-family: Tahoma;
	font-size: 11px;
	font-style: normal;
	font-weight: bold;
	color : White;
	line-height : 17px;
}
</style>

</head>
	<link rel="stylesheet" href="include/style.css" />
<body background="images/bg_top.jpg" topmargin="0" leftmargin="0">

<table width="100%" align="center" cellpadding="0" cellspacing="0">
<tr ><td> <img src="images/top.jpg" class="auto-style2" />
</td></tr>
<tr><td align="center" class="auto-style1">
<?php
	echo $_SESSION["param_company_name"] . " | user : " . $_SESSION["nama"]. " | <a href='logout.php'>logout</a>";
?>

</td></tr>
</table>


</body>

</html>
