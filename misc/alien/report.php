<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Aliens Abducted Me - Report an Abduction</title>
</head>
<body>

<h2>Aliens Abducted Me - Report an Abduction</h2>

<?php

	$name = $_POST['firstname'] . ' ' . $_POST['lastname'];
	$first_name = $_POST['firstname'];
	$last_name = $_POST['lastname'];
	$when_it_happened = $_POST['whenithappened'];
	$how_long = $_POST['howlong'];
	$alien_description = $_POST['aliendescription'];
	$fang_spotted = $_POST['fangspotted'];
	$how_many = $_POST['howmany'];
	$what_they_did = $_POST['whattheydid'];
	$other = $_POST['other'];
	
	$dbc = mysqli_connect('internal-db.s60883.gridserver.com','db60883_dan','casey.610','db60883_alien')
	or die('Error connecting to MySQL server.');
	
	$query = "INSERT INTO aliens_abduction (first_name,last_name,when_it_happened,how_long," .
											"how_many,alien_description,what_they_did,fang_spotted," .
											"other,email)" .
	"VALUES ('$first_name','$last_name','$when_it_happened','$how_long','$how_many','$alien_description'," .
			"'$what_they_did','$fang_spotted','$other','$email')";
	
	$result = mysqli_query($dbc, $query)
	or die('Error querying database.');
	
	mysqli_close($dbc);
	
	
	echo 'Thanks for submitting the form.<br />';
	echo 'Your name is ' . $name . '.<br />';
	echo 'You were abducted ' . $when_it_happened;
	echo ' and were gone for ' . $how_long . '<br />';
	echo 'You saw ' . $how_many . ' aliens.<br />';
	echo 'They looked like: ' . $alien_description . ' and they ' . $what_they_did . '<br />';
	echo 'Was Fang there? ' . $fang_spotted . '<br />';
	echo '<br />';
	echo 'Other Info: ' . $other . '<br />';
	echo 'Your email address is ' . $email;
	
?>

</body>
</html>