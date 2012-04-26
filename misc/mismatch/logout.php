<?php

	session_start();
	
	// If the user is logged in, destroy the session to log them out
	
	if(isset($_SESSION['user_id'])) {
				
		$_SESSION = array(); // Set $_SESSION to a blank array to destroy variables therein
		
		if(isset($_COOKIE[session_name()])) {
			
			setcookie('session_name','',time()-3600);
			
		}
		
		session_destroy();
	}
	
	setcookie('user_id','',time()-3600);
	setcookie('username','',time()-3600);
	
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
	
	header('Location: ' . $home_url);
	
?>