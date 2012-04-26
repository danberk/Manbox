<?php

	// Insert the page header
	$page_title = 'Admin Area';
	require_once('header.php');
	
	// Insert other required files
	require_once('connectvars.php');
	require_once('appvars.php');
	require_once('navigation.php');
	
	$remove = $_GET['add_id'];
	
	// Connect to the database
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	
	$removequery = "DELETE FROM nl_listadds WHERE add_id = '$remove' LIMIT 1";
	mysqli_query($dbc,$removequery);
	
	// Confirm success with user
	
	echo '<div class="contentwindowclean">';
	echo '<p class="text" style="font-weight:bold">Venue successfully removed.</p>';
	echo '<br />';
	echo '<p class="text"><a href="mynightlist.php">Return to my nightlist.</a></p>';
	echo '</div>';
	
	require_once('footer.php');
	
	mysqli_close($dbc);


?>