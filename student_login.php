<?php
// // create database connection
// require_once("database_connection.php");
// // require the helper functions one
// require_once("functions.php");


// if (isset($_POST['submit'])) {
      
//       $username = mysqli_real_escape_string($_POST['username']);
//       $password = mysqli_real_escape_string($_POST['password']); 
      
//       $sql_write = "SELECT id FROM admin WHERE username = '$username' and passcode = '$password'";
//       $result = mysql_db_query("FutureConnect", $sql_write);
      
//       $row = mysqli_fetch_array($result, MYSQL_ASSOC);
//       $active = $row['active'];}
?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  if (!empty($username) && !empty($password)) {
    // Attempt Login

    $username = $_POST['username'];
    $password = $_POST['password'];
    $found_student = student_login($username, $password);

    if ($found_student) {
      // Success
      // Mark user as logged in
      redirect_to("search_page.php");
    } else {
      // Failure
      $_SESSION["message"] = "Login failed. Try again.";
    }
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>

<?php $layout_context = "admin"; ?>
<?php include("../first-cms/header.php"); ?>
<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
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
    <a href="manage_admins.php">Cancel</a>
  </div>
</div>

<?php include("../first-cms/footer.php"); ?>
