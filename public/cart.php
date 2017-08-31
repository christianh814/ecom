<?php
require_once("../resources/config.php");

// When someone adds something to the cart
if (isset($_GET['add'])) {
	$query = query("SELECT * FROM products WHERE product_id = " . escapeString($_GET['add']) . " ");
	confirm($query);

	while ($row = fetchArray($query)) {
		if ($row['product_qty'] != $_SESSION['product_' . $_GET['add']]) {
			$_SESSION['product_' . $_GET['add']] += 1;
			redirect("checkout.php");
		} else {
			setMessage("Cannot order more than " . $row['product_qty'] . " of " . $row['product_title']);
			redirect("checkout.php");
		}
	}
}

// When someone removes something from the cart
if (isset($_GET['remove'])) {
	// If it's more than 0, don't do math
	if ($_SESSION['product_' . $_GET['remove']] <= 0) {
		redirect("checkout.php");
	} else {
		$_SESSION['product_' . $_GET['remove']] --;
	}
	// If it's less than 1 it's already 0
	if ($_SESSION['product_' . $_GET['remove']] < 1) {
		unset($_SESSION['item_total']);
		unset($_SESSION['item_qty']);
		redirect("checkout.php");
	} else {
		redirect("checkout.php");
	}
}

// When someone deletes something from the cart
if (isset($_GET['delete'])) {
	$_SESSION['product_' . $_GET['delete']] = '0';
	unset($_SESSION['item_total']);
	unset($_SESSION['item_qty']);
	redirect("checkout.php");
}

function cart() {
	$total = 0;
	$item_qty = 0;
	foreach ($_SESSION as $name => $value) {
		if ($value > 0) {
			if (substr($name, 0, 8) == "product_") {
				//$length = strlen($name - 8);
				//$id = substr($name, 8, $length);
				$id = str_replace("product_", "", $name);
				$query = query("SELECT * FROM products WHERE product_id = " . escapeString($id) . " ");
				confirm($query);
				while ($row = fetchArray($query)) {
				$sub = $row['product_price'] * $value;
				$item_qty += $value;
				$product = <<<EOT
				<tr>
					<td>{$row['product_title']}</td>
					<td>&#36;{$row['product_price']}</td>
					<td>{$value}</td>
					<td>&#36;{$sub}</td>
					<td>
						<a class="btn btn-warning" href="cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a>
						<a class="btn btn-success" href="cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>
						<a class="btn btn-danger"  href="cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></a>
					</td>
				<tr>
	
EOT;
				echo $product;
				$_SESSION['item_total'] = $total += $sub;
				$_SESSION['item_qty'] = $item_qty;
				} //end while
			} // end substr if
		}// end value if
	}// end foreach
}//end function

?>                                     
