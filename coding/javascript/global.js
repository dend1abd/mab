$(function(){
    /*
     * this swallows backspace keys on any non-input element.
     * stops backspace -> back
     */
    var rx = /INPUT|SELECT|TEXTAREA/i;

    $(document).bind("keydown keypress", function(e){
        if( e.which == 8 ){ // 8 == backspace
            if(!rx.test(e.target.tagName) || e.target.disabled || e.target.readOnly ){
                e.preventDefault();
            }
        }
    });
});
 

function lookupWindow(url, winname)
{
	//window.open("vessel_lookup.php?elid1=txtVessel1Id&elid2=txtVessel1Ket", "winDetails", "height=360, width=640, location=0,menubar=0,scrollbars=1,resizable=0");
	window.open(url, winname,  "height=360, width=640, location=0,menubar=0,scrollbars=1,resizable=0, modal=yes");
	//window.showModalDialog(url,winname,"dialogWidth:255px;dialogHeight:250px"); -> form modal but can't retrieve value
}



var xmlhttp = createRequestObject();

function createRequestObject() {
    var ro;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        ro = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        ro = new XMLHttpRequest();
    }
    return ro;
}

function getBarang(elValue, flagTransaksi)
{
    var kode = elValue.value;
    if (!kode) {
		//document.getElementById(elLookup).value = "";
		document.getElementById("txtdetailproduct_code_0").value = "";
		document.getElementById("txtdetailproduct_name_0").value = "";
		document.getElementById("txtdetailqty_0").value = "";
		document.getElementById("txtdetailharga_0").value = "";
		document.getElementById("txtdetailsub_total_0").value = "";
		document.getElementById("txtdetaildisc_persen_0").value = "";
		document.getElementById("txtdetaildisc_amount_0").value = "";
		document.getElementById("txtdetailtotal_0").value = "";
		document.getElementById("txtdetailket_detail_0").value = "";
		
		document.getElementById("txtdetailsize1_0").value = "";
		document.getElementById("txtdetailsize2_0").value = "";
		document.getElementById("txtdetailsize3_0").value = "";
		document.getElementById("txtdetailsize4_0").value = "";
		document.getElementById("txtdetailsize5_0").value = "";
		document.getElementById("txtdetailsize6_0").value = "";
		document.getElementById("txtdetailsize7_0").value = "";
		document.getElementById("txtdetailsize8_0").value = "";
		return;
	}
	//kode = 1;
	url = "getProduct.php";
    xmlhttp.open('get', url + '?kode='+kode+'&flag='+flagTransaksi, true);
    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
        {
        	//document.getElementById(elLookup).value = xmlhttp.responseText;
        	
        	str = xmlhttp.responseText;
        	if (str == "not found"){ //hati2 jangan sampai ada enter / spasi di codingan product_lookup.php, lihat line numbernya aja;				
				//document.getElementById("txtdetailproduct_code_0").value = "";
				document.getElementById("txtdetailproduct_name_0").value = "";
				document.getElementById("txtdetailqty_0").value = "";
				document.getElementById("txtdetailharga_0").value = "";
				document.getElementById("txtdetailsub_total_0").value = "";
				document.getElementById("txtdetaildisc_persen_0").value = "";
				document.getElementById("txtdetaildisc_amount_0").value = "";
				document.getElementById("txtdetailtotal_0").value = "";
				document.getElementById("txtdetailket_detail_0").value = "";
				
				document.getElementById("txtdetailsize1_0").value = "";
				document.getElementById("txtdetailsize2_0").value = "";
				document.getElementById("txtdetailsize3_0").value = "";
				document.getElementById("txtdetailsize4_0").value = "";
				document.getElementById("txtdetailsize5_0").value = "";
				document.getElementById("txtdetailsize6_0").value = "";
				document.getElementById("txtdetailsize7_0").value = "";
				document.getElementById("txtdetailsize8_0").value = "";
				
				//lookupWindow('product_lookup.php?tipe=' + +flagTransaksi, 'product_list')
				lookupWindow('product_lookup.php?tipe=' +flagTransaksi+ '&kode=' + kode, 'product_lookup');
        	}
        	else{
				arrStr = str.split("~");
				document.getElementById("txtdetailproduct_code_0").value = arrStr[0];
				document.getElementById("txtdetailproduct_name_0").value = arrStr[1];
				document.getElementById("txtdetailqty_0").value = "1";
				document.getElementById("txtdetailharga_0").value = formatCurrency3(arrStr[2]);
				document.getElementById("txtdetailsub_total_0").value = formatCurrency3(arrStr[2]);
				document.getElementById("txtdetaildisc_persen_0").value = "0";
				document.getElementById("txtdetaildisc_amount_0").value = "0";
				document.getElementById("txtdetailtotal_0").value = formatCurrency3(arrStr[2]);
				document.getElementById("txtdetailket_detail_0").value = "";
				
				document.getElementById("txtdetailsize1_0").value = arrStr[3];
				document.getElementById("txtdetailsize2_0").value = arrStr[4];
				document.getElementById("txtdetailsize3_0").value = arrStr[5];
				document.getElementById("txtdetailsize4_0").value = arrStr[6];
				document.getElementById("txtdetailsize5_0").value = arrStr[7];
				document.getElementById("txtdetailsize6_0").value = arrStr[8];
				document.getElementById("txtdetailsize7_0").value = arrStr[9];
				document.getElementById("txtdetailsize8_0").value = arrStr[10];											
        	}
        }
        return false;
    }
    xmlhttp.send(null);
}

function dinamis(combobox)
{
    var kode = combobox.value;
    if (!kode) {
		document.getElementById("txtCustKet").value = "";
		return;
	}
	//kode = 1;
    xmlhttp.open('get', 'getCustomer.php?kode='+kode, true);
    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
        {
             document.getElementById("txtCustKet").value = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}

function getLookup(elValue, elLookup, url)
{
    var kode = elValue.value;
    if (!kode) {
		document.getElementById(elLookup).value = "";
		return;
	}
	//kode = 1;
    xmlhttp.open('get', url + '?kode='+kode, true);
    xmlhttp.onreadystatechange = function() {
        if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200))
        {
             document.getElementById(elLookup).value = xmlhttp.responseText;
        }
        return false;
    }
    xmlhttp.send(null);
}
 function disableAllElement()
{
	for (i = 0; i < document.all.tags("INPUT").length; i++)
	{
		obj = document.all.tags("INPUT")[i];
		if (obj.name.substr(3,4) != "AUT_"){
			obj.disabled = true;}
	}
	
	for (i = 0; i < document.all.tags("SELECT").length; i++)
	{
		obj = document.all.tags("SELECT")[i];
		if (obj.name.substr(3,4) != "AUT_"){
			obj.disabled = true;}
	}
	
	for (i = 0; i < document.all.tags("TEXTAREA").length; i++)
	{
		obj = document.all.tags("TEXTAREA")[i];
		if (obj.name.substr(3,4) != "AUT_"){
			obj.readOnly = true;}
	}
}

//===format only 2 decimal 
function format2DecCcy( strNum ) {

	var intStartPos;

	strNum = Trim(strNum);
	if (strNum == '') return ''; // Not number		

	intStartPos = strNum.indexOf("."); // 2 decimal only

	if ((intStartPos != -1) && (strNum.length - (intStartPos  + 1 ) > 2)){
		return strNum.substr(0,intStartPos  + 3);
	}
	return strNum; // no decimal
}


//===Check to validate only 2 decimal 
function is2DecCcy( strNum ) {

	var intCounter=0 , intLoop, intStartPos;

	strNum = Trim(strNum);
	if (strNum == '') return false; // Not number
	if (strNum == '.') return false; // Not number

	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // One . only
		if (strNum.charAt(intLoop) == ".") intCounter++;
		if (intCounter > 1) return false;
	}


	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // 0-9, . only
		if (((strNum.charAt(intLoop) < "0") || (strNum.charAt(intLoop) > "9")) && 
				(strNum.charAt(intLoop) != ".")	)
			return false;
	}

	intStartPos = strNum.indexOf("."); // four decimal only
	if (intStartPos != -1){
		if ((strNum.length - (intStartPos  + 1 )) > 2)
			return false;
	}
	return true; // value is 0
}

//===Check to validate only 5 decimal 
function is5DecCcy( strNum ) {

	var intCounter=0 , intLoop, intStartPos;

	strNum = Trim(strNum);
	if (strNum == '') return false; // Not number
	if (strNum == '.') return false; // Not number

	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // One . only
		if (strNum.charAt(intLoop) == ".") intCounter++;
		if (intCounter > 1) return false;
	}


	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // 0-9, . only
		if (((strNum.charAt(intLoop) < "0") || (strNum.charAt(intLoop) > "9")) && 
				(strNum.charAt(intLoop) != ".")	)
			return false;
	}

	intStartPos = strNum.indexOf("."); // five decimal only
	if (intStartPos != -1){
		if ((strNum.length - (intStartPos  + 1 )) > 5)
			return false;
	}
	return true; // value is 0
}
//===Check to validate only 4 decimal 
function is4DecCcy( strNum ) {

	var intCounter=0 , intLoop, intStartPos;

	strNum = Trim(strNum);
	if (strNum == '') return false; // Not number
	if (strNum == '.') return false; // Not number

	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // One . only
		if (strNum.charAt(intLoop) == ".") intCounter++;
		if (intCounter > 1) return false;
	}


	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // 0-9, . only
		if (((strNum.charAt(intLoop) < "0") || (strNum.charAt(intLoop) > "9")) && 
				(strNum.charAt(intLoop) != ".")	)
			return false;
	}

	intStartPos = strNum.indexOf("."); // Four decimal only
	if (intStartPos != -1){
		if ((strNum.length - (intStartPos  + 1 )) > 4)
			return false;
	}
	return true; // value is 0
}

// eliminate the left and right spaces from the string.
function Trim(string) {
	
	var i;
	var intCount;
	
	
	//truncate the left spaces.
	// 1. get the number of spaces at left side of the string.
	// 2. get the new string without the left spaces.
	
	intCount = 0;
	for (i = 0; i < string.length; i++) 
		if ((string.charAt(i)) != " ") 
			break;
		else 
			intCount = intCount + 1;
		
	string = string.substring(intCount, string.length);
	
		
	
	//truncate the right spaces.
	// 1. use the string that has been truncated just now and get
	//	  the number of spaces on the right side of the string.
	// 2. get the final string and return.
	
	intCount = 0;
	for (i = string.length-1; i >= 0; i--) 
		if ((string.charAt(i)) != " ") 
			break;
		else 
			intCount = intCount + 1;
		
	
	string = string.substring(0, string.length-intCount);	
	return string;		
	
}

//  Returns true if strNum  is only number

function isNumber( strNum ) {

	var intCounter=0 , intLoop;

	strNum = Trim(strNum);

	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // 0-9 only
		if (((strNum.charAt(intLoop) < "0") || (strNum.charAt(intLoop) > "9") 
				))
			return false;
	}

	return true; // value is 0
}

//  Returns true if strNum  is alphabet

function isAlphabet( strNum ) {

	var intLoop, strUNum;
    
	strUNum= strNum.toUpperCase();
	for (intLoop = 0; intLoop < strUNum.length; intLoop++) { 
		if (((strUNum.charAt(intLoop) < "A") || (strUNum.charAt(intLoop) > "Z")) 
		      && (strUNum.charAt(intLoop) != " ") )
			return false;
	}
	return true;
}

function isAlphaNum( strNum ) {

	var intLoop, strUNum;
    
	strUNum= strNum.toUpperCase();
	for (intLoop = 0; intLoop < strUNum.length; intLoop++) { 
		if ((((strUNum.charAt(intLoop) < "A") || (strUNum.charAt(intLoop) > "Z")) &&
			 ((strUNum.charAt(intLoop) < "0") || (strUNum.charAt(intLoop) > "9")))
		      && (strUNum.charAt(intLoop) != " "))
			return false;
	}
	return true;
}

//  Returns true if strNum  is a number

function isCcy( strNum ) {

	var intCounter=0 , intLoop, intStartPos;

	strNum = Trim(strNum);
	if (strNum == '') return false; // Not number
	if (strNum == '.') return false; // Not number

	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // One . only
		if (strNum.charAt(intLoop) == ".") intCounter++;
		if (intCounter > 1) return false;
	}


	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // 0-9, . only
		if (((strNum.charAt(intLoop) < "0") || (strNum.charAt(intLoop) > "9")) && 
				(strNum.charAt(intLoop) != ".")	)
			return false;
	}

	intStartPos = strNum.indexOf("."); // four decimal only
	if (intStartPos != -1){
		if ((strNum.length - (intStartPos  + 1 )) > 4)
			return false;
	}
	return true; // value is 0
}

function isCcy1( strNum ) {

	var intCounter=0 , intLoop, intStartPos;

	//strNum = Trim(strNum);
	if (strNum == '') return false; // Not number
	if (strNum == '.') return false; // Not number

	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // One . only
		if (strNum.charAt(intLoop) == ".") intCounter++;
		if (intCounter > 1) return false;
	}


	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // 0-9, . only
		if (((strNum.charAt(intLoop) < "0") || (strNum.charAt(intLoop) > "9")) && 
				(strNum.charAt(intLoop) != ".")	)
			return false;
	}

	intStartPos = strNum.indexOf("."); // four decimal only
	if (intStartPos != -1){
		if ((strNum.length - (intStartPos  + 1 )) > 4)
			return false;
	}
	return true; // value is 0
}

function is6Ccy( strNum ) {

	var intCounter=0 , intLoop, intStartPos;

	strNum = Trim(strNum);
	if (strNum == '') return false; // Not number
	if (strNum == '.') return false; // Not number

	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // One . only
		if (strNum.charAt(intLoop) == ".") intCounter++;
		if (intCounter > 1) return false;
	}


	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // 0-9, . only
		if (((strNum.charAt(intLoop) < "0") || (strNum.charAt(intLoop) > "9")) && 
				(strNum.charAt(intLoop) != ".")	)
			return false;
	}

	intStartPos = strNum.indexOf("."); // six decimal only
	if (intStartPos != -1){
		if ((strNum.length - (intStartPos  + 1 )) > 6)
			return false;
	}
	return true; // value is 0
}

function isAnyUpper(strSource){
   var intRow;
   var blnValid;

   blnValid = false;

   for(intRow = 0; intRow < strSource.length; intRow++)
   {
      if ((strSource.charAt(intRow) >= "A") && 
	      (strSource.charAt(intRow) <= "Z"))
	  {
	     blnValid = true;
		 break;
	  }
   }

   return blnValid;
}

function isAnyLower(strSource){
   var intRow;
   var blnValid;

   blnValid = false;

   for(intRow = 0; intRow < strSource.length; intRow++)
   {
      if ((strSource.charAt(intRow) >= "a") && 
	      (strSource.charAt(intRow) <= "z"))
	  {
	     blnValid = true;
		 break;
	  }
   }

   return blnValid;
}

//  Returns true if strNum  is only valid phone numbers

function isPhone( strNum ) {

	var intCounter=0 , intLoop;

	strNum = Trim(strNum);
	if (strNum.length < 5) return false; // Not phone number
	if (strNum == '') return false; // Not phone number
	if (strNum == '.') return false; // Not phone number

	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // One "-" only
		if (strNum.charAt(intLoop) == "-") intCounter++;
		if (intCounter > 1) return false;
	}

	for (intLoop = 0; intLoop < strNum.length; intLoop++) { // 0-9, , -  only
		if ((((strNum.charAt(intLoop) < "0") || (strNum.charAt(intLoop) > "9")) && (strNum.charAt(intLoop) != "-") && (strNum.charAt(intLoop) != " ")))
			return false;
	}

	return true; // value is 0
}

function isAnyNumeric(strSource){
   var intRow;
   var blnValid;

   blnValid = false;

   for(intRow = 0; intRow < strSource.length; intRow++)
   {
      if ((strSource.charAt(intRow) >= "0") && 
	      (strSource.charAt(intRow) <= "9"))
	  {
	     blnValid = true;
		 break;
	  }
   }

   return blnValid;
}

// Only number key
function keyNum(eventObj, obj){
	var keyCode

	// Check For Browser Type
	if (document.all){ 
		keyCode = eventObj.keyCode
	}else{
		keyCode = eventObj.which
	}

	var str = obj.value

	if(keyCode == 46){ 
		if (str.indexOf(".") > 0){
			return false
		}
	}

	if((keyCode < 48 || keyCode > 58) && (keyCode != 46)){ // Allow only integers and decimal points
		return false
	}

	return true
}
function rmvComma(vsl){
	var i = 0; val = "";
	tmpArr = vsl.split(",");
	lenArr = tmpArr.length;
	if (lenArr > 0){
		while (i < lenArr) {
			val = val + tmpArr[i];
			i++;
		}
	}else{
		val = vsl;
	}
	return eval(val);
}


function formatCurrency(strValue)
{
    //var m = Math.pow(10, intDec);
 strValue = strValue.toString().replace(/\$|\,/g,'');
 dblValue = parseFloat(strValue);
 
 blnSign = (dblValue == (dblValue = Math.abs(dblValue)));
 dblValue = Math.floor(dblValue * 100 + 0.50000000001);
 intCents = dblValue % 100;
 strCents = intCents.toString();
 dblValue = Math.floor(dblValue / 100).toString();
 
 if(intCents<10)
  strCents = "0" + strCents;
 for (var i = 0; i < Math.floor((dblValue.length - (1 + i)) / 3); i++)
  dblValue = dblValue.substring(0, dblValue.length - (4 * i + 3)) + ',' +
  dblValue.substring(dblValue.length - (4 * i + 3));
 //return (((blnSign)?'':'-') + '$' + dblValue + '.' + strCents);
 //document.tst.formatted.value = (((blnSign)?'':'-') + dblValue + '.' + strCents);
 return (((blnSign)?'':'-') + dblValue + '.' + strCents);
}
function keyInNumber(){
 //only accept 0-9 
 if (event.keyCode >= 48 && event.keyCode <= 48 + 9)
	event.keyCode = event.keyCode;
 else
	event.keyCode = '';
}



function formatCurrency(num) {
//document.getElementById('txtHargaPasar' + jaminanId).value = document.frmInputInventory.txtUangSewa2.value;
num = num.toString().replace(/\Rp.|\,/g,'');
if(isNaN(num))
num = "0";
sign = (num == (num = Math.abs(num)));
num = Math.floor(num*100+0.50000000001);
cents = num%100;
num = Math.floor(num/100).toString();
if(cents<10)
cents = "0" + cents;
for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
num = num.substring(0,num.length-(4*i+3))+','+
num.substring(num.length-(4*i+3));

return (((sign)?'':'-') + num + '.' + cents);
}

function formatCurrency2(num) {
//document.getElementById('txtHargaPasar' + jaminanId).value = document.frmInputInventory.txtUangSewa2.value;
num = num.toString().replace(/\Rp.|\,/g,'');
if(isNaN(num))
num = "0";
sign = (num == (num = Math.abs(num)));
num = Math.floor(num*100+0.50000000001);
cents = num%100;
num = Math.floor(num/100).toString();
if(cents<10)
cents = "0" + cents;
for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
num = num.substring(0,num.length-(4*i+3))+','+
num.substring(num.length-(4*i+3));

return (((sign)?'':'-') + num + ',' + cents);
}

function formatCurrency3(num) {
//document.getElementById('txtHargaPasar' + jaminanId).value = document.frmInputInventory.txtUangSewa2.value;
num = num.toString().replace(/\Rp.|\,/g,'');
if(isNaN(num))
num = "0";
sign = (num == (num = Math.abs(num)));
num = Math.floor(num*100+0.50000000001);
cents = num%100;
num = Math.floor(num/100).toString();
if(cents<10)
cents = "0" + cents;
for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
num = num.substring(0,num.length-(4*i+3))+','+
num.substring(num.length-(4*i+3));

//return (((sign)?'':'-') + num + ',' + cents);
return (((sign)?'':'-') + num );
}

function formatBilangan(num) {
//document.getElementById('txtHargaPasar' + jaminanId).value = document.frmInputInventory.txtUangSewa2.value;
num = num.toString().replace(/\Rp.|\,/g,'');
return num ;
}

function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

function enterkey(evt) {
  var evt = (evt) ? evt : event
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode == 8) {
    //alert (charCode)
	return false;
  }
}


function cmdDate_onDelete(txtDate){
		txtDate.value = "";
	}
	
function cmdDate_onclick(txtDate){
		var nowDate = new Date;
		initCalendar (nowDate, txtDate, '8pt');
	}
