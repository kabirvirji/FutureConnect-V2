<?php  //create database connection

//defining as constants because they do not varry
define("DB_HOST", "");
define("DB_USER", "");
define("DB_PASSWORD", "");
define("DB_NAME", "FutureConnect");

$connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


if(mysql_errno()) {  // if database connection fails
	die("Database connection failed"); }  //ugly error for now

?>

<!DOCTYPE html>

<html lang='en'>
	<head>
		<title>Student Register</title>
	</head>
	<body>
	<p>Welcome to the Student Register page! You can register with a username and password below.</p>

	<!-- sending the filename as $_POST request -->
	<form action="student_register.php" method="post">
		<!-- name is key in $_POST array -->
	 	username<br>
	 	<input type="text" name="username"><br>
	 	password<br>
	  	<input type="password" name="password"><br><br>
	  	<input type="submit" name="submit" value="submit">
	</form>

	<?php


		if (isset($_POST['submit'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$username = mysql_real_escape_string($username);
			$password = mysql_real_escape_string($password);
		

		// query and write
		$sql_write = "INSERT INTO students (username, password)
				VALUES ('{$username}', '{$password}')";

		$result = mysql_db_query("FutureConnect", $sql_write);



		if (!$result) {
			echo "Database Query Failed";
		}

}
	?>

	</body>
</html>

<?php
mysql_close($connection);
echo "<br>After you've clicked submit, go back to the main page and login.";
?>