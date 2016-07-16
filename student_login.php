<?php require_once("session.php"); ?>
<?php require_once("database_connection.php"); ?>
<?php require_once("functions.php"); ?>

<?php

if (isset($_POST['submit'])) {
  // Process the form

	// Attempt Login
	
	$username = $_POST['username'];
	$hashed_password = password_encrypt($_POST['password']);
	$found_student = attempt_login($username, $hashed_password);

    if ($found_student) {

	    // Mark user as logged in
	    //$_SESSION["student_id"] = $found_student["id"];
	    //$_SESSION["username"] = $found_admin["username"];
	    
	    //redirect_to("main_page.php"); // Will be search page later FIX REDIRECT FUNCTION

    	echo "You did it! You're logged in!";

    } else {
    	// Failure
    	//$_SESSION["message"] = "Login failed. Try again.";
      echo "Login failed. Try again.<br>";
    }
  }
//}
   else {

} // end: if (isset($_POST['submit']))

?>

<?php include("../first-cms/header.php"); ?>
<title>Student Login</title>
<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <h2>Login</h2>
    <form action="student_login.php" method="post">
      <p>Username:
        <input type="text" name="username" value="" />
      </p>
      <p>Password:
        <input type="password" name="password" value="" />
      </p>
      <input type="submit" name="submit" value="Submit" />
    </form>
    <br />
    <a href="/first-cms/main_page.php">Cancel</a>
  </div>
</div>

<?php include("../first-cms/footer.php"); 
?>
