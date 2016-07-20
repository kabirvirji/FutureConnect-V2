<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "Hello666");
define("DB_NAME", "FutureConnect");

$connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(mysql_errno()) {
	die("Database connection failed"); }

?>