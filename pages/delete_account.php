<?php
	session_start();
	require_once("./db_connection.php");

	mysqli_query($link, "DELETE FROM users WHERE id = {$_SESSION['id']}");

	// Unset all of the session variables
	unset($_SESSION["loggedin"]);
	unset($_SESSION["id"]);
	unset($_SESSION["username"]); 

	// Redirect to login page
	header("location: ./index.php?page=login_signup");
	exit;
?>