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
		redirect("checkout.php");
	} else {
		redirect("checkout.php");
	}
}

// When someone deletes something from the cart
if (isset($_GET['delete'])) {
	$_SESSION['product_' . $_GET['delete']] = '0';
	redirect("checkout.php");
}

?>                                     
