<?php
// Enable output buffering
ob_start();

// Enable Sessions
session_start();

// Define Directory Paths
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front" );
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back" );
defined("IMAGES_DIR") ? null : define("IMAGES_DIR", DS . "admin" . DS . "images" );

// Define Database config
defined("DB_HOST") ? null : define("DB_HOST", getenv("MYSQL_SERVICE_HOST"));
defined("DB_USER") ? null : define("DB_USER", getenv("MYSQL_USERNAME"));
defined("DB_PASS") ? null : define("DB_PASS", getenv("MYSQL_PASSWORD"));
defined("DB_NAME") ? null : define("DB_NAME", getenv("MYSQL_DATABASE"));

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Include all of what we need
require_once(__DIR__ . DS . "vendor/autoload.php");
require_once("functions.php");
?>
