<?php
	session_start();
 
	// Unset all of the session variables
	unset($_SESSION["loggedin"]);
	unset($_SESSION["id"]);
	unset($_SESSION["username"]); 
 
	// Redirect to login page
	header("location: ./index.php?page=login_signup");
	exit;
?>