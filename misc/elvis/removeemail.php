<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Make Me Elvis - Remove Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
  <img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
  <p>Enter an email address to remove.</p>

<?php 
	
	$email = $_POST['email'];
	
	$dbc = mysqli_connect('internal-db.s60883.gridserver.com','db60883_dan','casey.610','db60883_elvis')
	or die('Error Connecting to Database.');
	
	//Delete the customers if checkboxes are activated
	
	if(isset($_POST['submit'])){
		foreach($_POST['todelete'] as $delete_id) {
			$delete_query = "DELETE FROM email_list WHERE id = $delete_id";
			mysqli_query($dbc,$delete_query)
			or die('Error Querying Database.');
		}
		
		echo 'Customer(s) Removed.<br />';
	}
	
	//Display the checkboxes that indicate what customers are being deleted
			
	$query = "SELECT * FROM email_list";
	$result = mysqli_query($dbc,$query)
	or die('Error Querying Database.');
	
	?>
    
	<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
    
    <?php
	
	while($row = mysqli_fetch_array($result)) {
		echo '<input type="checkbox" value="' . $row['id'] . '" name = "todelete[]" />';
		echo $row['first_name'];
		echo ' ' . $row['last_name'] . ": ";
		echo ' ' . $row['email'];
		echo '<br />';
	}
		
	mysqli_close($dbc);
	
?>

<input type="submit" name="submit" value="Remove" />
</form>

</body>
</html>