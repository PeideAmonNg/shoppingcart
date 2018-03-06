<html>
<head>
<title>Cart</title>
</head>
<body>
	<a href="main.php">Go to Products</a>
	<h1>Shopping Cart</h1>
	<form action='' method='post'>
		<input name='_method' type='hidden' value='clearCart'/>
		<input type='submit' value='clear cart'>
	</form>

	<?php 
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		session_start();	

		include "products.php";

		class ShoppingCart{
			// Mapping of product name to quantity
		    private $items = [];

		    public function add($key){
		    	$product = getProduct($key);
		    	if($product){
			    	if(isset($this->items[$key])){
			    		$this->items[$key] = $this->items[$key] + 1;
			    	}else{
			    		$this->items[$key] = 1;
			    	}		        
			    }
		    }

		    public function remove($name){
		        foreach($this->items as $key => $val){
			        if($key == $name){
			            unset($this->items[$key]);
			        } 			    
				}
		    }

		    public function removeAll(){
		        $this->items = [];
		    }

		    public function getItems(){
				return $this->items;
		    }
		}

		// Session management
		$cart; 
		if (isset($_SESSION['cart'])){
			$cart = $_SESSION['cart'];			
		}else{
			$cart = new ShoppingCart();	
			$_SESSION['cart'] = $cart;
		}
		
		// Process user request
	 	foreach($_POST as $key => $value){
	 		if($key == "_method" && $value == "post"){
	 			$cart->add($_POST["_product"]);	
	 		}else if($key == "_method" && $value == "delete"){
	 			$cart->remove($_POST["_product"]);
	 		}else if($key == "_method" && $value == "clearCart"){
				if(isset($_SESSION["cart"])){
					$_SESSION["cart"]->removeAll();
				}
			}
		}
	

		echo "<table>";
		echo "<tr><th>Name</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";
		$overall = 0.0;
		foreach($cart->getItems() as $key => $qty){
			$product = getProduct($key);
			echo "<tr>";
			echo "<td>" . $product["name"] ."</td>";
			echo "<td>$" . sprintf('%0.2f', $product["price"]) ."</td>";
			echo "<td>" . $qty ."</td>";
			echo "<td>$" . sprintf('%0.2f', $product["price"] * $qty) ."</td>";
			echo "<td><form action='' method='post'><input name='_method' type='hidden' value='delete'/><input name='_product' type='hidden' value='{$product["name"]}'/><input type='submit' value='remove'></form></td>";
			echo "</tr>";
			$overall += ($product["price"] * $qty);
			$overall = sprintf('%0.2f', $overall);
		}
		echo "<tr><td></td><td></td><th style='border-top: 1px solid black;'>Overall</th><td style='border-top: 1px solid black;'>\${$overall}</td></tr>";
		echo "</table>";		
	?> 
</body>
</html>