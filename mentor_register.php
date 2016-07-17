<?php
// create database connection
require_once("database_connection.php");
// require the helper functions one
require_once("functions.php");

$username_error = ""; 
$password_error = "";
$school_error = "";
$program_error = "";

if (isset($_POST['submit'])) {
	empty($_POST['username']) ? $username_error = "required field" : $username = test_input($_POST['username']);
	empty($_POST['password']) ? $password_error = "required field" : $password = $_POST['password'];
	empty($_POST['school']) ? $school_error = "required field" : $school = mysql_real_escape_string($_POST['school']);
	empty($_POST['program']) ? $program_error = "required field" : $program = mysql_real_escape_string($_POST['program']);

	


	if (!empty($username) && !empty($password)) {
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$sql_write = "INSERT INTO mentors (username, password, school, program)
			VALUES ('{$username}', '{$hashed_password}', '{$school}', '{$program}')";

		$result = mysql_db_query("FutureConnect", $sql_write);

		if ($result) {
			redirect_to("main_page.php");
		}
	}
}

?>

<!-- HTML header -->
<?php include("../first-cms/header.php"); ?>

	<title>Mentor Register</title>
	<p>Welcome to the Mentor Register page! You can register with a username and password below.</p>
	<!-- sending the filename as $_POST request -->
	<form action="mentor_register.php" method="post">
		<!-- name is key in $_POST array -->
	 	username<br>
	 	<input type="text" name="username"><br>
	 	<span class="error">* <?php echo $username_error;?></span><br>
	 	password<br>
	  	<input type="password" name="password"><br><br>
	  	<span class="error">* <?php echo $password_error;?></span><br>
	 	school<br>
	  	<input type="text" name="school"><br><br>
	  	<span class="error">* <?php echo $school_error;?></span><br>
	 	program<br>
	  	<input type="text" name="program"><br><br>
	  	<span class="error">* <?php echo $program_error;?></span><br>
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