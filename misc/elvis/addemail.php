<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>E-mail Subscribe PHP</title>
</head>

<body>

<?php
	$dbc = mysqli_connect('internal-db.s60883.gridserver.com','db60883_dan','casey.610','db60883_elvis')
	or die('Error Connecting to Database.');
	
	$first_name = $_POST['firstname'];
	$last_name = $_POST['lastname'];
	$email = $_POST['email'];
	
	$query = "INSERT INTO email_list (first_name,last_name,email)" .
	"VALUES ('$first_name','$last_name','$email')";
	
	mysqli_query($dbc,$query)
	or die('Error Querying Database.');
	
	echo('Thank you for subscribing.');
	
	mysqli_close($dbc);
	
?>

</body>
</html>