<?php
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

mysql_connect('localhost', 'root', '');
mysql_select_db('vtec-sia');

$result = mysql_query("SELECT * FROM mst_menu ORDER BY MenuKode");
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
	
	$(document).ready(function(){
		$("#browser2").treeview(
			{
				collapsed: true
			}
		);
	});
	</script>
	
<body>

<div id="main"> 
	Menu 
		
	<ul id="browser" class="filetree" >
	
	<li>
		<span class="folder">Master</span>
		<ul>
			<li><span class="file">
				<a href="customer_list.php"  target="downFrame">Customer</a></span>				
			</li>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Supplier</a></span>				
			</li>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Barang</a></span>				
			</li>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Perkiraan</a></span>				
			</li>
		</ul>
	</li>
	
	<li>
		<span class="folder">Pembelian</span>
		<ul>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Order Pembelian</a></span>				
			</li>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Pembelian</a></span>				
			</li>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Retur Pembelian</a></span>				
			</li>
		</ul>
	</li>
	
	<li>
		<span class="folder">Penjualan</span>
		<ul>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Order Penjualan</a></span>				
			</li>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Penjualan</a></span>				
			</li>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Retur Penjualan</a></span>				
			</li>
		</ul>
	</li>
	
	<li>
		<span class="folder">Keuangan</span>
		<ul>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Pembayaran Hutang</a></span>				
			</li>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Pembayaran Piutang</a></span>				
			</li>
		</ul>
	</li>
	
	<li>
		<span class="folder">Akunting</span>
		<ul>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Jurnal Kas</a></span>				
			</li>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Junal Bank</a></span>				
			</li>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">Jurnal Memorial</a></span>				
			</li>
		</ul>
	</li>
	
	<li>
		<span class="folder">Report</span> 
	</li>
	
	<li>
		<span class="folder">Tool</span>
		<ul>
			<li>
				<span class="folder">System Maintenence</span>
				<ul>
					<li><span class="file">
						<a href="menu_list.php"  target="downFrame">Menu</a></span>				
					</li> 				
				</ul> 
			</li> 
		</ul>


		<ul>
			<li><span class="file">
				<a href="changepassword.php"  target="downFrame">User</a></span>				
			</li> 
		</ul>
	</li>

	
	<li>
		<span class="file">
			<a href="changepassword.php"  target="downFrame">Change Password</a></span>
	</li>
	<li>
		<span class="file">
			<a href="logout.php" target="downFrame">Logout</a></span>
	</li>
	</ul> 
	
	
	
</div>

<div  id="browser2" class="filetree" >
 <?php
	echo $menu;
 ?>
</div>

	
</body></html>