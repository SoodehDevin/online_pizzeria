<?php


$ingredient = $_POST['name'];
$storage = $_POST['storage'];

//print_r($ingredient);
$doc = new DOMDocument;
$doc->load('../pizzeria.xml');

//$root = $doc->documentElement;
$xpath = new DOMXPath($doc);
$query = sprintf('/pizzeria/storage//ingredient[@in_storage = "%d"]',$storage);


foreach($xpath->query($query) as $ing) {
 	   	$ing->parentNode->removeChild($ing);	
	}

//print_r($_POST);
$doc->save('../pizzeria.xml');
?>

