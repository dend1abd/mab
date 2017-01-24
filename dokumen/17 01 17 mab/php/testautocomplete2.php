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
	
	<style>
		.fixed-height {
			padding: 1px;
			max-height: 200px;
			overflow: auto;
		}
	</style>

		
<Script Language="JavaScript">
<!--

var data = [
			{ value: "AL", label: "Alabama" },
			{ value: "AK", label: "Alaska" },
			{ value: "AZ", label: "Arizona" },
			{ value: "AR", label: "Arkansas" },
			{ value: "CA", label: "California" },
			{ value: "CO", label: "Colorado" },
			{ value: "CT", label: "Connecticut" },
			{ value: "DE", label: "Delaware" },
			{ value: "FL", label: "Florida" },
			{ value: "GA", label: "Georgia" },
			{ value: "HI", label: "Hawaii" },
			{ value: "ID", label: "Idaho" },
			{ value: "IL", label: "Illinois" },
			{ value: "IN", label: "Indiana" },
			{ value: "IA", label: "Iowa" },
			{ value: "KS", label: "Kansas" },
			{ value: "KY", label: "Kentucky" },
			{ value: "LA", label: "Louisiana" },
			{ value: "ME", label: "Maine" },
			{ value: "MD", label: "Maryland" },
			{ value: "MA", label: "Massachusetts" },
			{ value: "MI", label: "Michigan" },
			{ value: "MN", label: "Minnesota" },
			{ value: "MS", label: "Mississippi" },
			{ value: "MO", label: "Missouri" },
			{ value: "MT", label: "Montana" },
			{ value: "NE", label: "Nebraska" },
			{ value: "NV", label: "Nevada" },
			{ value: "NH", label: "New Hampshire" },
			{ value: "NJ", label: "New Jersey" },
			{ value: "NM", label: "New Mexico" },
			{ value: "NY", label: "New York" },
			{ value: "NC", label: "North Carolina" },
			{ value: "ND", label: "North Dakota" },
			{ value: "OH", label: "Ohio" },
			{ value: "OK", label: "Oklahoma" },
			{ value: "OR", label: "Oregon" },
			{ value: "PA", label: "Pennsylvania" },
			{ value: "RI", label: "Rhode Island" },
			{ value: "SC", label: "South Carolina" },
			{ value: "SD", label: "South Dakota" },
			{ value: "TN", label: "Tennessee" },
			{ value: "TX", label: "Texas" },
			{ value: "UT", label: "Utah" },
			{ value: "VT", label: "Vermont" },
			{ value: "VA", label: "Virginia" },
			{ value: "WA", label: "Washington" },
			{ value: "WV", label: "West Virginia" },
			{ value: "WI", label: "Wisconsin" },
			{ value: "WY", label: "Wyoming" }
		];


$(function() {
			$("#autocomplete1").autocomplete({
				source: data
			});
			$("#autocomplete2").autocomplete({
				source: data,
				focus: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox
					$(this).val(ui.item.label);
				},
				select: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox and hidden field
					$(this).val(ui.item.label);
					$("#autocomplete2-value").val(ui.item.value);
				}
			});
		}).autocomplete("widget").addClass("fixed-height");

-->
</Script>

<body>

<p>Default Behavior<br>
		<input id="autocomplete1" type="text" placeholder="U.S. state name" name="code"></p>
	<p>Modified Behavior<br>
		<input id="autocomplete2" type="text" placeholder="U.S. state name">
		<input id="autocomplete2-value" type="text" name="code"></p>

</body>

</html>
