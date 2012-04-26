<?php

	// Start the session
	require_once('startsession.php');

	// Insert the page header
	$page_title = 'Admin Area';
	require_once('header.php');
	
	// Insert other required files
	require_once('connectvars.php');
	require_once('appvars.php');
	require_once('navigation.php');
	
	$venueadd = $_GET['venue_id'];
	$sessionuser = $_SESSION['user_id'];
	
	// Only do this if the user is signed in
	if(isset($_SESSION['user_id'])) {
	
		// Connect to the database
		$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	
		// Add venue to user's nightlist
		$nightlistaddquery = "INSERT INTO nl_listadds (add_user_id,add_venue_id) VALUES ('$sessionuser','$venueadd')";
		mysqli_query($dbc,$nightlistaddquery);
	
		// Confirm success with the user
	
		echo '<div id="container">';
		echo '<p class="text" style="font-weight:bold">Venue successfully added.</p>';
		echo '<br />';
		echo '<p class="text"><a href="mynightlist.php">Go to my nightlist.</a></p>';
		echo '</div>';
		require_once('footer.php');
		mysqli_close($dbc);
		
	}
	
	else {
		
		// User isn't signed in
		echo '<div id="container">';
		echo '<p class="error">You must be signed in to add venues to your nightlist.</p>';
		require_once('usersubmissionform.php');
		require_once('indexcontent.php'); 
		echo '</div>';
		require_once('footer.php');
		
	}

?>
	