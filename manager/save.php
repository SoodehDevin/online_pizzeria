
<?php


$pizza = $_POST['pizza_name'];
//$id = $_POST['id'];

$doc = new DOMDocument;
$doc->load('../pizzeria.xml');

$root = $doc->documentElement;
$xpath = new DOMXPath($doc);
$query = sprintf('/pizzeria/menu/pizza[name = "%s"]/ingredient',$pizza);
$queryUpdate = sprintf('/pizzeria/menu/pizza[name = "%s"]',$pizza);

foreach($xpath->query($query) as $ing) {
 	   	$ing->parentNode->removeChild($ing);	
	}

for($i=1;$i<=20;$i++) {
	if($_POST[$i] != 0) 
	foreach($xpath->query($queryUpdate) as $pizza) {
 	   	$node = $doc-> createElement("ingredient");
 	   	$pizza-> appendChild($node);
 	   	$node -> setAttribute("id", $i);
 	   	$node -> setAttribute("units", $_POST[$i] );
	}		

}

$doc->save('../pizzeria.xml');
?>

