<?php
require_once("../../resources/config.php");
if (isset($_GET['id'])) {
	$query = query("DELETE FROM users WHERE user_id = " . escapeString($_GET['id']) . " ");
	confirm($query);
	setMessage("User Deleted");
	redirect("/admin/index.php?users");
} else {
	redirect("/admin/index.php?users");
}
?>
