<html>
<head>
	<title>Products</title>
</head>
<body>
	<a href="cart.php">Go to Cart</a>
	<h1>Products</h1>
	
		<table>
			<tr>
				<th>Name</th>
				<th>Price</th>
			</tr>

			<?php
				include "products.php";

				foreach($products as &$value){ 	
					echo "<tr>";
					$name = $value["name"];
					echo '<td>'. $name . '</td>';
					echo '<td>$'. sprintf('%0.2f', $value["price"]) . '</td>';
					echo "<form action='cart.php' method='post'><td><input name='_method' type='hidden' value='post'/><input name='_product' type='hidden' value='{$name}'/><input type='submit' value='add'></td></form>";
					echo "</tr>";
				}

			?>
		</table>
	</form>
</body>
</html>