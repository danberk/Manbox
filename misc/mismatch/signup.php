<?php
	
	// Insert the page header
	
	$page_header = 'Where opposites attract!';
	require_once('header.php');
	
  	require_once('appvars.php');
 	require_once('connectvars.php');
	
	// Show the navigation menu
	
	require_once('navmenu.php');


	require_once('appvars.php');
	require_once('connectvars.php');
	
	// Connect to the database
	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
	or die('Error Connecting to Database.');
	
	
	if(isset($_POST['submit'])) {
	// Grab data from sign up form
	
	$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
	$password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
	$password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
	
	if(!empty($username) && !empty($password1) && !empty($password2) &&
		($password1 == $password2)) {
		
		// See if anybody else has same username
		
		$query = "SELECT * FROM mismatch_user WHERE username = '$username'";
		
		$data = mysqli_query($dbc, $query)
		or die('Error Querying Database');
		
		if (mysqli_num_rows($data) == 0) {
			
			// The username is unique, so add it to database
			
			$query = "INSERT INTO mismatch_user (username, password, join_date) " .
			"VALUES ('$username',SHA('$password1'),NOW())";
			
			mysqli_query($dbc, $query)
			or die('Error Quering Database');
			
			// Confirm success with user
			
			echo '<p>Your new account has been successfuly created.  You\'re now ready to log in and ' .
			'<a href="editprofile.php">edit your profile</a>.</p>';
			
			mysqli_close($dbc);
			exit();
		}
		
		else {
		
			// Someone else has used the same username, so display an error message.
		
			echo '<p class="error">Someone else has already taken that username.  Please select a different username.</p>';
		
			$username = '';
		
		}
		
	}
	
	else {
		
		// They left some info out
		
		echo '<p class="error">Please enter all of the necessary information for sign-up, including desired password twice.</p>';
		
		}
	}
	
	mysqli_close($dbc);
	
?>

<p>Please enter your username and desired password to sign up to Mismatch.</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>
<legend>Registration Info</legend>
<label for="username">Username:</label>
<input type="text" name="username" value="<?php if(!empty($username)) echo $username; ?>"/><br />
<label for="password1">Password:</label>
<input type="password" id="password1" name="password1" /><br />
<label for="password2">Password (retype):</label>
<input type="password" id="password2" name="password2" /><br />
</fieldset>
<input type="submit" value="Sign Up" name="submit" />
</form>

</body>
</html>
	
	