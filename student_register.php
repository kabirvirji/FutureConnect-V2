<?php
// create database connection
require_once("database_connection.php");
// require the helper functions one
require_once("functions.php");
?>

<!-- HTML header -->
<?php include("../first-cms/header.php"); ?>

	<title>Student Register</title>
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

<!-- HTML footer -->
<?php include("../first-cms/footer.php"); ?>

<?php
mysql_close($connection);
echo "<br>After you've clicked submit, go back to the main page and login.";
?>