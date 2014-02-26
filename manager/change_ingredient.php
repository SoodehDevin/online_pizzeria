<?php


$ingredient = $_POST['name'];
$storage = $_POST['storage'];

print_r($ingredient);
$doc = new DOMDocument;
$doc->load('../pizzeria.xml');

//$root = $doc->documentElement;
$xpath = new DOMXPath($doc);
$query = sprintf('/pizzeria/storage//ingredient[@name = "%s"]',$ingredient);




foreach($xpath->query($query) as $ingr) {
 	   	
 	   	$ingr -> setAttribute("in_storage", $storage);
 	  
	}	



print_r($_POST);
$doc->save('../pizzeria.xml');
?>