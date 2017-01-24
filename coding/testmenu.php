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
			$html .= '<a href="'.$v->MenuLink.'">'.$v->MenuName.'</a>';
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

echo $menu;
?>