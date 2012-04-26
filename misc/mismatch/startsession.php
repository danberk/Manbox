<?php

	session_start();
	
	// If the session vars aren't set, try using a cookie to set them
	
	if(!isset($_SESSION['user_id'])) {
		if(isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
			
			// Set the session vars to the cookie vars
			
			$_SESSION['user_id'] = $_COOKIE['user_id'];
			$_SESSION['username'] = $_COOKIE['username'];
			
		}
		
	}
	
?>