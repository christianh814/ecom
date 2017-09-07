<?php
require_once("../../resources/config.php");
if (isset($_GET['id'])) {
	$query = query("DELETE FROM products WHERE product_id = " . escapeString($_GET['id']) . " ");
	confirm($query);
	setMessage("Product Deleted");
	redirect("/admin/index.php?products");
} else {
	redirect("/admin/index.php?products");
}
?>
