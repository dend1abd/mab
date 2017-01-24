<?php
	include "include/clsDataAccess.php";
	include "include/global.php";	
	
	cekSession();
	
function get_menu($data, $parent = "") {
	static $i = 1;
	$tab = str_repeat("\t\t", $i);
	if (isset($data[$parent])) {
		$html = "\n$tab<ul>";
		$i++;
		foreach ($data[$parent] as $v) {
			$child = get_menu($data, $v->MenuKode);
			$html .= "\n\t$tab<li>";
			if($v->MenuLink == "")
				$html .= '<span class="folder">' .$v->MenuName. '</span>';
			else
				$html .= '<span class="file"><a href="'.$v->MenuLink.'" target="downFrame">'.$v->MenuName.'</a></span>';
				
			if ($child) {
				$i--;
				$html .= $child;
				$html .= "\n\t$tab";
			}
			$html .= '</li>';
		}
		$html .= "\n$tab</ul>";
		return $html;
	} else {
		return false;
	}
}

mysql_connect($hostDB, $userDB, $passDB);
mysql_select_db($nameDB);

if ($_SESSION["groupUserId"] == 1)
	$sql = "SELECT * FROM mst_menu where (isHidden is null or isHidden=0) ORDER BY MenuKode ";
else
	$sql = "select a.* from mst_menu a inner join mst_menu_akses b on a.MenuKode = b.MenuKode where b.UserGroup_ID=" .$_SESSION["groupUserId"] . " and (isHidden is null or isHidden=0) ORDER BY a.MenuKode";

//eror($sql);	
$result = mysql_query($sql);
$numRows = mysql_num_rows($result);

if ($numRows > 0)
{

while ($row = mysql_fetch_object($result)) {
	$data[$row->MenuParent][] = $row;
}

$menu = get_menu($data); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>menu</title>
</head>

	<link rel="stylesheet" href="jquery.treeview/jquery.treeview.css" />
    <link rel="stylesheet" href="jquery.treeview/red-treeview.css" />
	<link rel="stylesheet" href="jquery.treeview/demo/screen.css" />
	
	<script type="text/javascript" src="jquery.treeview/jquery.min.js"></script>
	<script src="jquery.treeview/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview/jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript">
	$(document).ready(function(){
		$("#browser").treeview(
			{
				collapsed: true
			}
		);
	}); 
	</script>
	
	<style type="text/css">
A:link {text-decoration: none}
A:visited {text-decoration: none}
A:active {text-decoration: none}
A:hover {text-decoration: underline}
</style>

	
<body topmargin="0">

<div id="main"> 
	Menu   
	<div  id="browser" class="filetree" >
	 <?php
		echo $menu;
	 ?>
	</div> 
</div>
	
</body></html>

<?php
}
else
	echo "menu belum disetting";
?>