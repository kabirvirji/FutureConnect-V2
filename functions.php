<?php

error_reporting(-1);

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


function find_student_by_username($username) 
{
	global $connection;

	$safe_username = mysql_real_escape_string($username, $connection);

	$query  = "SELECT * ";
	$query .= "FROM students ";
	$query .= "WHERE username = '{$safe_username}' ";
	$query .= "LIMIT 1";
	
	$username_set = mysql_db_query("FutureConnect", $query);

	confirm_query($username_set);
	echo "username_set is " . $username_set . "<br>";
	// username_set is a Resource id #
	print_r(mysql_fetch_assoc($username_set));

	if ($username_set) {
		return mysql_fetch_assoc($username_set);
		// Array ( [id] => 51 [username] => test [password] => $2y$10$ZTk5ZDQ1OWE0MmI5ZDc3Z.wAnQRD.Ij49LjdlkNAZPwBAFUKyXXz2 )
	}
	else {
		return null;
	}
}

function password_encrypt($password)
{

	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	$salt_length = 22; 	// Blowfish salts should be 22-characters or more
	$salt = generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($password, $format_and_salt);
	return $hash;

}

function generate_salt($length) 
{
  // Not 100% unique, not 100% random, but good enough for a salt
  // MD5 returns 32 characters
  $unique_random_string = md5(uniqid(mt_rand(), true));

  // Valid characters for a salt are [a-zA-Z0-9./]
  $base64_string = base64_encode($unique_random_string);

  // But not '+' which is valid in base64 encoding
  $modified_base64_string = str_replace('+', '.', $base64_string);

  // Truncate string to the correct length
  $salt = substr($modified_base64_string, 0, $length);

  return $salt;
}


// This is the function that is evaluating to false
function password_check($password, $existing_hash) 
{
	// existing hash contains format and salt at start
	// existing hash is being called like: $student["password"]
	$hash = crypt($password, $existing_hash);
	echo $hash;
	// $hash is different from $password

	return password_encrypt($password) === $existing_hash;
	//return $password == $hash;

}

function attempt_login($username, $password) 
{
	$student = find_student_by_username($username);
	// returns $username as Resouce id # because it is a row
	
	echo "Student is: " . $student . "<br>";
	
	if ($student) {

		// found student, now check password

		echo "student password: " . $student["password"] . "<br>";
		
		echo "<br>" . !password_check($password, $student["password"]) . "<br>";
		
		print_r($student["password"]);
		
		if (password_check($password, $student["password"])) {
			// password matches
			echo "We did it!";
			return $student;
		} else {
			// password does not match
			return false;
		}
	} else {
		// student not found
		return false;
	}
}


// My own function, maybe can will help. Not doing anything rn
function find_student_password($username)
{

	$query = "SELECT password FROM students where username = '$username' LIMIT 1";
	$result = mysql_db_query("FutureConnect", $query);

	while ($row = mysql_fetch_array($result)) {
		$password = $row['password'];
	}

	return $password;

}

?>