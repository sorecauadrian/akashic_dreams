<?php
	define('db_server', 'localhost');
	define('db_username', 'root');
	define('db_password', '');
	define('db_name', 'akashic_dreams');
	
	/* Attempt to connect to MySQL database */
	$link = mysqli_connect(db_server, db_username, db_password, db_name);
 
	// Check connection
	if($link === false){
    	die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>