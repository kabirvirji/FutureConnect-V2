<?php

	session_start();

	$_SESSION["username"] = "";
	$_SESSION["student-register-message"] = true;
	$_SESSION["mentor-registermessage"] = true;
	
	function message() 
	{
		if (isset($_SESSION["message"])) {
			$output = "<div class=\"message\">";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
	}
	
?>