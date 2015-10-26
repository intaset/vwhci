<?php

$file = 'mostvisited.txt';


$homepage = file_get_contents('https://ijvwhcimostvisitedpapers.appspot.com/query?id=ahpzfmlqdndoY2ltb3N0dmlzaXRlZHBhcGVyc3IVCxIIQXBpUXVlcnkYgICAgICAgAoM');



$arr = str_split($homepage);

$counter = 0;

for ($i=2;$i<sizeof($arr);$i++){

	if ($arr[$i]=='/' and $arr[$i-1]=='"' and $arr[$i+1]!='"' and $counter != 5){

    	while ($arr[$i+1]!=','){

        	$arrLink[$i] = $arr[$i];

            if ($arr[$i] == 'l'){

            	$arrLink[$i] = $arrLink[$i].'"';

            }

            $i++;

		}
		$counter++;
    }	

}

$counter = 0;

for ($i=2;$i<sizeof($arr);$i++){

	if ($arr[$i]=='"' and $arr[$i-1]==' ' and $arr[$i-2]==',' and $arr[$i-3]=='"' and $arr[$i-4]=='l' and $counter != 5){

    	while ($arr[$i+1]!= ',' or $arr[$i]!= '"'){
			if($arr[$i+1]== '"'){
				$arrTitle[$i] = ' - ';
			}else{
				$arrTitle[$i] = $arr[$i+1];
			}

            $i++;

		}
		$counter++;

    }	

}



$allText = implode("",$arrTitle);
$allLinks = implode("",$arrLink);

$allTextExploded = explode(" - ",$allText);
$allLinksExploded = explode('"',$allLinks);

//connect to database to add all authors to the file
mysql_connect("localhost", "iaset_mostvisit", "iasetINC14") or die(mysql_error()); 

mysql_select_db("iaset_mostVisited") or die(mysql_error()); 

$result = mysql_query("SELECT * FROM mostVisited");

while($row = mysql_fetch_array($result)) {

	if ($row['journal'] == 'IJTAN'){
		if($allLinksExploded[0] == $row['link']){
			$authorInfo =  $authorInfo . $row['link'] . ' - ' . $row['authors'] . ' - ';
		}
	}
}

$result = mysql_query("SELECT * FROM mostVisited");

while($row = mysql_fetch_array($result)) {

	if ($row['journal'] == 'IJTAN'){
		if($allLinksExploded[1] == $row['link']){
			$authorInfo =  $authorInfo . $row['link'] . ' - ' . $row['authors'] . ' - ';
		}
	}
}

$result = mysql_query("SELECT * FROM mostVisited");

while($row = mysql_fetch_array($result)) {

	if ($row['journal'] == 'IJTAN'){
		if($allLinksExploded[2] == $row['link']){
			$authorInfo =  $authorInfo . $row['link'] . ' - ' . $row['authors'] . ' - ';
		}
	}
}

$result = mysql_query("SELECT * FROM mostVisited");

while($row = mysql_fetch_array($result)) {

	if ($row['journal'] == 'IJTAN'){
		if($allLinksExploded[3] == $row['link']){
			$authorInfo =  $authorInfo . $row['link'] . ' - ' . $row['authors'] . ' - ';
		}
	}
}

$result = mysql_query("SELECT * FROM mostVisited");

while($row = mysql_fetch_array($result)) {

	if ($row['journal'] == 'IJTAN'){
		if($allLinksExploded[4] == $row['link']){
			$authorInfo =  $authorInfo . $row['link'] . ' - ' . $row['authors'] . ' - ';
		}
	}
}

mysql_close();

// Open the file to get existing content
$current = file_get_contents($file);


$totaltext = $allText.$authorInfo;
file_put_contents($file, $totaltext);

?>