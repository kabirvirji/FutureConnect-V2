<?php include("../first-cms/header.php");
//include("session.php"); ?>

<h2> Welcome, <?// php $_SESSION["username"]; ?> </h2>
	<title>Main Page</title>
		<a href="/first-cms/student_register.php">Student Register</a><br><br>
		<a href="/first-cms/mentor_register.php">Mentor Register</a><br><br>
		<a href="/first-cms/student_login.php">Student Login</a><br><br>
		<a href="/first-cms/mentor_login.php">Mentor Login</a><br><br>
<?php include("../first-cms/footer.php") ?>

