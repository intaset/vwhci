var xmlhttp;
function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function mostVisitedExt()
{
loadXMLDoc('mostvisitedExt.txt',function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var txt=xmlhttp.responseText;
    
    
    var res = txt.split('"');

var one = res[0].split(" - ");
var two = res[1].split(" - ");
var three = res[2].split(" - ");
var four = res[3].split(" - ");
var five = res[4].split(" - ");

var authorsOne = res[5];
var authorsTwo = res[7];
var authorsThree = res[9];
var authorsFour = res[11];
var authorsFive = res[13];


document.getElementById("mostVisitedExt").innerHTML =
"<ul class='jrecent'><a href="+res[4]+" class='body-link'>"+one[0]+"</a><p class='body'>" + 
authorsOne + "</p></ul>" + 
"<ul class='jrecent'><a href="+res[6]+" class='body-link'>"+two[0]+"</a><p class='body'>" +  
authorsTwo + "</p></ul>" + 
"<ul class='jrecent'><a href="+res[8]+" class='body-link'>"+three[0]+"</a><p class='body'>" + 
authorsThree + "</p></ul>" +
"<ul class='jrecent'><a href="+res[10]+" class='body-link'>"+four[0]+"</a><p class='body'>" + 
authorsFour + "</p></ul>" +
"<ul class='jrecent'><a href="+res[12]+" class='body-link'>"+five[0]+"</a><p class='body'>" + 
authorsFive + "</p></ul>";

    }
  });
}