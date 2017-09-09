<?php
require_once("../../resources/config.php");
if (isset($_GET['id'])) {
	$query = query("DELETE FROM slides WHERE slide_id = " . escapeString($_GET['id']) . " ");
	confirm($query);
	deleteSlideImage(escapeString($_GET['id']));
	setMessage("Slide Deleted");
	redirect("/admin/index.php?slides");
} else {
	redirect("/admin/index.php?slides");
}
?>
