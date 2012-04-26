<?php
	// Username and password for authentication
	
	$username = 'rock';
	$password = 'roll';
	
	if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
		($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password)) {
		
		// The username and/or password are incorrect or haven't been set, so send headers
		
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate:Basic realm = "Guitar Wars"');
		exit('<h2>Guitar Wars</h2>Sorry, you must enter a valid username and password to access this page.');
		
	}
	
	?>