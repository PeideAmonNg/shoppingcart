<?php

 	$products = array(
		array("name" => "Sledgehammer", "price" => 125.75),
		array("name" => "Axe", "price" => 190.50),
		array("name" => "Bandsaw", "price" => 562.13),
		array("name" => "Chisel", "price" => 12.9),
		array("name" => "Hacksaw", "price" => 18.45)
	);

	function getProduct($name){
		global $products;
		foreach($products as $key => $value){
			if($value["name"] == $name){
				 return $value;
			}
		}

		return NULL;
	}
	
?>