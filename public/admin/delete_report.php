<?php
require_once("../../resources/config.php");
if (isset($_GET['id'])) {
	$query = query("DELETE FROM reports WHERE report_id = " . escapeString($_GET['id']) . " ");
	confirm($query);
	setMessage("Report Deleted");
	redirect("/admin/index.php?reports");
} else {
	redirect("/admin/index.php?reports");
}
?>
