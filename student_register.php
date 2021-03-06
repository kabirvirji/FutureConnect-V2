<?php
// create database connection
require_once("database_connection.php");
// require the helper functions
require_once("functions.php");

$username_error = ""; 
$password_error = "";

// if post request
if (isset($_POST['submit'])) {

	// if field exists, set variable. if not, set error
	!empty($_POST["username"]) ? $username = mysql_real_escape_string($_POST["username"]) : $username_error = "required field"; 
	!empty($_POST["password"]) ? $password = $_POST["password"] : $password_error = "required field"; 

	if (!empty($username) && !empty($password)) { 

		// check to see if that username exists
		$query  = "SELECT * ";
		$query .= "FROM students ";
		$query .= "WHERE username = '{$username}' ";
		$existing_username = mysql_db_query("FutureConnect", $query);
		$row = mysql_fetch_assoc($existing_username);
		
		// if the username already exists
		if ($row["username"] === $username) {  
			$username = "";
			$username_error = "That username already exists.";

		} else {

				// the username does not exist, do everything normally
				if (!empty($username) && !empty($password)) {

					// insert information in database
					$hashed_password = password_hash($password, PASSWORD_DEFAULT);
					$sql_write = "INSERT INTO students (username, password)
					VALUES ('{$username}', '{$hashed_password}')";

					$result = mysql_db_query("FutureConnect", $sql_write);

					if ($result) {
						$_SESSION["student-register-message"] = false;
						redirect_to("main_page.php");
					} else {
						redirect_to("student_register.php");
					}
				}
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

<!-- HTML footer -->
<?php include("../first-cms/footer.php"); ?>

<?php
mysql_close($connection);
echo "<br>After you've clicked submit, you can login from the main page.";
?>