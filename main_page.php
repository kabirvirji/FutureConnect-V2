<?php 
include("../first-cms/session.php"); 
include("../first-cms/header.php");
?>

<h2> Welcome, <?php echo $_SESSION["username"]; ?> </h2>
	<title>Main Page</title>
		<a href="/first-cms/student_register.php">Student Register</a><br><br>
		<a href="/first-cms/mentor_register.php">Mentor Register</a><br><br>
		<a href="/first-cms/student_login.php">Student Login</a><br><br>
		<a href="/first-cms/mentor_login.php">Mentor Login</a><br><br>

<?php if($_SESSION["logged-in"]) : ?>
    <a href="search_pagr.php">Search for Mentors</a>
<?php endif; ?>


<?php include("../first-cms/footer.php") ?>
