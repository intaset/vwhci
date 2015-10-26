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
    
    
    var res = txt.split(' - ');

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
"<a href=http://"+res[0]+".avestia.com"+res[10]+" class='body-link' target='_blank'>"+res[1]+"</a><p class='body'>" + 
res[11] + "</p>" + 
"<a href=http://"+res[2]+".avestia.com"+res[12]+" class='body-link'  target='_blank'>"+res[3]+"</a><p class='body'>" +  
res[13] + "</p>" + 
"<a href=http://"+res[4]+".avestia.com"+res[14]+" class='body-link'  target='_blank'>"+res[5]+"</a><p class='body'>" + 
res[15] + "</p>" + 
"<a href=http://"+res[6]+".avestia.com"+res[16]+" class='body-link'  target='_blank'>"+res[7]+"</a><p class='body'>" + 
res[17] + "</p>" + 
"<a href=http://"+res[8]+".avestia.com"+res[18]+" class='body-link'  target='_blank'>"+res[9]+"</a><p class='body'>" + 
res[19] + "</p>";

    }
  });
}