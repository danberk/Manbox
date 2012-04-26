<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>MakeMeElvis Send E-mail Form</title>
</head>

<body>

<img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
  <img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
  <p><strong>Private:</strong> For Elmer's use ONLY<br />
  Write and send an email to mailing list members.</p>
  
<?php

if(isset($_POST['submit'])){

	$from = 'elmer@makemeelvis.com';
	$subject = $_POST['subject'];
	$text = $_POST['elvismail'];
	$output_form = false;
	
	if((empty($subject)) && (empty($text))) {
		//Both subject and text are empty
		echo('You forgot the e-mail subject and body text. <br />');
		$output_form = true;
	}
	
	if((empty($subject)) && (!empty($text))) {
		//Only subject is empty
		echo('You forgot the e-mail subject.<br />');
		$output_form = true;

	}
	
	if((!empty($subject)) && (empty($text))) {
		//Only body text is empty
		echo('You forgot the body text.<br />');
		$output_form = true;

	}
	
	if((!empty($subject)) && (!empty($text))) {
	
	$dbc = mysqli_connect('internal-db.s60883.gridserver.com','db60883_dan','casey.610','db60883_elvis')
	or die('Error Connecting to Database.');
	
	$query = "SELECT * FROM email_list";
	
	$result = mysqli_query($dbc,$query)
	or die('Error Querying Database.');
	
	while($row=mysqli_fetch_array($result)) {
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		
		$msg = "Dear $first_name $last_name, \n $text";
		$to = $row['email'];
		
		mail($to, $subject,$msg, 'From:' . $from);
		
		echo 'Email sent to: ' . $to . '<br />';
		
	}
	
	mysqli_close($dbc);
	
	}
}
else {
	$output_form = true;
}
			  
	if($output_form) {
?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    	<label for="subject">Subject of email:</label><br />
    	<input id="subject" name="subject" type="text" size="30" value="<?php echo $subject; ?>" /><br />
    	<label for="elvismail">Body of email:</label><br />
    	<textarea id="elvismail" name="elvismail" rows="8" cols="40"><?php echo $text; ?></textarea><br />
    	<input type="submit" name="submit" value="Submit" />
  	</form>
<?php 
	}
?>

</body>
</html>