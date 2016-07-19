<?php
// create database connection
require_once("database_connection.php");
// require the helper functions
require_once("functions.php");

$username_error = ""; 
$password_error = "";
$school_error = "";
$program_error = "";
$email_error = "";

if (isset($_POST['submit'])) {

	!empty($_POST["username"]) ? $username = mysql_real_escape_string($_POST["username"]) : $username_error = "required field"; 
	!empty($_POST["password"]) ? $password = $_POST["password"] : $password_error = "required field"; 
	!empty($_POST["school"]) ? $school = mysql_real_escape_string($_POST["school"]) : $school_error = "required field"; 
	!empty($_POST["program"]) ? $program = mysql_real_escape_string($_POST["program"]) : $program_error = "required field"; 
	!empty($_POST["email"]) ? $email = mysql_real_escape_string($_POST["email"]) : $email_error = "required field"; 

if ($username_error === "" && $password_error === "" && $school_error === "" && $program_error === "" && $email_error === "") {


	if (!empty($username) && !empty($email)) { 
		// check to see if that username exists
		$query_username  = "SELECT * ";
		$query_username .= "FROM mentors ";
		$query_username .= "WHERE username = '{$username}' ";
		$existing_username = mysql_db_query("FutureConnect", $query_username);
		$row_username = mysql_fetch_assoc($existing_username);
		
		$query_email  = "SELECT * ";
		$query_email .= "FROM mentors ";
		$query_email .= "WHERE username = '{$email}' ";
		$existing_password = mysql_db_query("FutureConnect", $query_email);
		$row_password = mysql_fetch_assoc($existing_password);
		
		if ($row_username["username"] === $username || $row_password["email"] === $email) {  // the username or email already exists
			$username = "";
			$username_error = "That username already exists.";
		} else {

				// everything exists
				if (!empty($username) && !empty($password) && !empty($school) && !empty($program) && !empty($email)) {

					$hashed_password = password_hash($password, PASSWORD_DEFAULT);
					$sql_write = "INSERT INTO mentors (username, password, school, program, email)
					VALUES ('{$username}', '{$hashed_password}', '{$school}', '{$program}', '{$email}')";

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
	 	email<br>
	 	<input type="text" name="username"><br>
	 	<span class="error">* <?php echo $email_error;?></span><br>
	  	<input type="submit" name="submit" value="submit">
	</form>

<!-- HTML footer -->
<?php include("../first-cms/footer.php"); ?>

<?php
mysql_close($connection);
echo "<br>After you've clicked submit, you can login from the main page.";
?>