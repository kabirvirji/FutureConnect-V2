<?php
// create database connection
require_once("database_connection.php");
// require the helper functions one
require_once("functions.php");

$username_error = "";
$password_error = "";

if (isset($_POST['submit'])) {
	empty($_POST['username']) ? $username_error = "required field" : $username = test_input($_POST['username']);
	empty($_POST['password']) ? $password_error = "required field" : $password = mysql_real_escape_string($_POST['password']);


	if (!empty($username) && !empty($password)) {
		$sql_write = "INSERT INTO students (username, password)
			VALUES ('{$username}', '{$password}')";

		$result = mysql_db_query("FutureConnect", $sql_write);

		if ($result) {
			redirect_to("main_page.php");
		}
	}
}

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
	 	<span class="error">* <?php echo $username_error;?></span><br>
	 	password<br>
	  	<input type="password" name="password"><br><br>
	  	<span class="error">* <?php echo $password_error;?></span><br>
	  	<input type="submit" name="submit" value="submit">
	</form>

	<?php



	?>

<!-- HTML footer -->
<?php include("../first-cms/footer.php"); ?>

<?php
mysql_close($connection);
echo "<br>After you've clicked submit, you can login from the main page.";
?>