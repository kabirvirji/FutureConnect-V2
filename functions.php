<?php

function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysql_real_escape_string($data);
    return $data;
}

function confirm_query($result_set) 
{
	if (!$result_set) {
		die("Database query failed.");
	}
}

function redirect_to($new_location) 
{
	header("Location: " . $new_location);
	exit;
}

function attempt_login($username, $password)
{
	// establish database connection
	global $connection;
	// make sure username is safe
	$safe_username = mysql_real_escape_string($username, $connection);
	// get username from database
	$query  = "SELECT * ";
	$query .= "FROM students ";
	$query .= "WHERE username = '{$safe_username}' ";
	$query .= "LIMIT 1";
	// query the database
	$result = mysql_db_query("FutureConnect", $query);
	// get specific row as assoc array
	$row = mysql_fetch_assoc($result);
	if (isset($row)) {
		// return if passwords are same
		return password_verify($password, $row["password"]);
	} else {
		return false;
	}
}

?>