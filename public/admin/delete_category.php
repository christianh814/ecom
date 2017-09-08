<?php
require_once("../../resources/config.php");
if (isset($_GET['id'])) {
	$query = query("DELETE FROM categories WHERE cat_id = " . escapeString($_GET['id']) . " ");
	confirm($query);
	setMessage("Category Deleted");
	redirect("/admin/index.php?categories");
} else {
	redirect("/admin/index.php?categories");
}
?>
