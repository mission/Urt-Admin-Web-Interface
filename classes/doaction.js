// JavaScript Document
var xmlhttp;

function showUser2(str)
{
xmlhttp=GetXmlHttpObject2();
if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="classes/action.php";
url=url+"?do="+str;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged2;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}

function stateChanged2()
{
if (xmlhttp.readyState==4)
{
document.getElementById("txtHint2").innerHTML=xmlhttp.responseText;
}
}

function GetXmlHttpObject2()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}