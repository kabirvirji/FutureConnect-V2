<?php
// create database connection
require_once("database_connection.php");
// require the helper functions
require_once("functions.php");

$username_error = ""; 
$password_error = "";
$school_error = "";
$program_error = "";

if (isset($_POST['submit'])) {

	$username = mysql_real_escape_string($_POST["username"]);
	$password = $_POST["password"];
	$school = mysql_real_escape_string($_POST["school"]);
	$program = mysql_real_escape_string($_POST["program"]);

	if (!empty($username)) { 
		// check to see if that username exists
		$query  = "SELECT * ";
		$query .= "FROM mentors ";
		$query .= "WHERE username = '{$username}' ";
		$existing_username = mysql_db_query("FutureConnect", $query);
		$row = mysql_fetch_assoc($existing_username);
		if ($row["username"] === $username) {  // the username already exists
			$username = "";
			$username_error = "That username already exists.";
		} else {

				// the username does not exist, do everything normally
				if (!empty($username) && !empty($password)) {

					$hashed_password = password_hash($password, PASSWORD_DEFAULT);
					$sql_write = "INSERT INTO mentors (username, password, school, program)
					VALUES ('{$username}', '{$hashed_password}', '{$school}', '{$program}')";

					$result = mysql_db_query("FutureConnect", $sql_write);

					if ($result) {
						redirect_to("main_page.php");
					} else {
						redirect_to("mentor_register.php");
					}
				}
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

<!-- HTML footer -->
<?php include("../first-cms/footer.php"); ?>

<?php
mysql_close($connection);
echo "<br>After you've clicked submit, you can login from the main page.";
?>