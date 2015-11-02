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
function mostVisited()
{
loadXMLDoc('mostvisited.txt',function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var txt=xmlhttp.responseText;
    
    
    var res = txt.split('*&^');

/*var one = res[0].split(" - ");
var two = res[1].split(" - ");
var three = res[2].split(" - ");
var four = res[3].split(" - ");
var five = res[4].split(" - ");

var authorsOne = res[6];
var authorsTwo = res[8];
var authorsThree = res[10];
var authorsFour = res[12];
var authorsFive = res[14];
*/

document.getElementById("mostVisited").innerHTML =
"<a href=http://vwhci.avestia.com"+res[5]+" class='body-link' target='_blank'>"+res[0]+"</a><p class='body'>" + 
res[6] + "</p>" + 
"<a href=http://vwhci.avestia.com"+res[7]+" class='body-link'  target='_blank'>"+res[1]+"</a><p class='body'>" +  
res[8] + "</p>" + 
"<a href=http://vwhci.avestia.com"+res[9]+" class='body-link'  target='_blank'>"+res[2]+"</a><p class='body'>" + 
res[10] + "</p>" + 
"<a href=http://vwhci.avestia.com"+res[11]+" class='body-link'  target='_blank'>"+res[3]+"</a><p class='body'>" + 
res[12] + "</p>" + 
"<a href=http://vwhci.avestia.com"+res[13]+" class='body-link'  target='_blank'>"+res[4]+"</a><p class='body'>" + 
res[14] + "</p>";

    }
  });
}