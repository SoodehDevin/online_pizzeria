<?php


$ingredient = $_POST['ing_name'];
$storage = $_POST['ing_storage'];

print_r($ingredient);
$doc = new DOMDocument;
$doc->load('../pizzeria.xml');

//$root = $doc->documentElement;
$xpath = new DOMXPath($doc);
$query = '/pizzeria/storage';


$id = rand(21, 100);

foreach($xpath->query($query) as $stor) {
 	   	
			$node = $doc-> createElement("ingredient");
			$stor -> appendChild($node);
			$node -> setAttribute("id", $id);
 	   	$node -> setAttribute("name", $ingredient );
 	   	$node -> setAttribute("in_storage", $storage );	   	
 	   	
	}	



print_r($_POST);
$doc->save('../pizzeria.xml');
?>