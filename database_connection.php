<?php

define("DB_HOST", "");
define("DB_USER", "");
define("DB_PASSWORD", "");
define("DB_NAME", "");

$connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(mysql_errno()) {
	die("Database connection failed"); }

?>
