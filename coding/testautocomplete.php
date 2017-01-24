<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Untitled 1</title>
</head>

	<link rel="stylesheet" href="jquery-ui-1.10.3/themes/base/jquery.ui.all.css" />
	<script src="jquery-ui-1.10.3/jquery-1.9.1.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
	<script src="jquery-ui-1.10.3/ui/jquery.ui.menu.js"></script> 
	<script src="jquery-ui-1.10.3/ui/jquery.ui.autocomplete.js"></script>	
	<script src="jquery-ui-1.10.3/demos/demos.css"></script>	

		
<Script Language="JavaScript">
<!--
jQuery(document).ready(function($){
var availableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"BASIC",
			"C",
			"C++",
			"Clojure",
			"COBOL",
			"ColdFusion",
			"Erlang",
			"Fortran",
			"Groovy",
			"Haskell",
			"Java",
			"JavaScript",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
		];

	$('#zipsearch').autocomplete({source:availableTags , minLength:2});
});
-->
</Script>

<body>
<form action="search.php" method="post">
	Enter your zipcode:
	<input type="text" id="zipsearch" />
 
	<br />
	<input type="submit" value="Search" />
</form>
</body>

</html>
