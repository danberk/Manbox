<?php
	
	// Start the session
	
	require_once('startsession.php');
	
	// Insert the page header
	
	$page_header = 'Log In';
	
  	require_once('appvars.php');
 	require_once('connectvars.php');
	
	// Clear the error message
	$error_msg = "";
	
	if(!isset($_SESSION['user_id'])) {
		
		if(isset($_POST['submit'])) {
			
			// Connect to the database
	
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
			or die('Error Connecting to Database.');
	
			// Grab the entered username and password data
		
			$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
			$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
			
			if (!empty($user_username) && !empty($user_password)) {
			
				// Look up username and password in the database
	
				$query = "SELECT user_id, username FROM mismatch_user WHERE username = '$user_username' AND " .
				 "password = SHA('$user_password')";
	
				$data = mysqli_query($dbc, $query);
		
				if(mysqli_num_rows($data) == 1) {
		
					// The log-in is OK so set the user ID and username SESSIONs
		
					$row = mysqli_fetch_array($data);
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['username'] = $row['username'];
					setcookie('user_id',$row['user_id'],time() + (60 * 60 * 24 * 30)); // Cookie expires in 30 days
					setcookie('username',$row['username'],time() + (60 * 60 * 24 * 30)); // Cookie expires in 30 days
					
					$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
					header('Location: ' . $home_url);
			
				}
	
				else {
		
					// The username/password combination was incorrect, so set an error message
					$error_msg = 'Sorry, you must enter a valid username and password to log in.';
		
				}
			}
	
			else {
		
				// The username/password weren't entered, so set an error message
		
				$error_msg = 'Sorry, you must enter all login info to log in.';
		
			}
		}
	}
	
?>

    
    <?php
		
		// If the SESSION is empty, show any error message and the log-in form; otherwise confirm the login
		
		if(empty($_SESSION['user_id'])) {
			
			echo '<p class="error">' . $error_msg . '</p>';
			
		?>
        
        <?php
		
        require_once('header.php');
		
		?>
        
        <form method="post" action"<?php echo $_SERVER['PHP_SELF']; ?>">
        	<fieldset>
        		<legend>Log In</legend>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php if(!empty($user_username)) echo $user_username; ?>" /><br />
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"  />
            </fieldset>
            <input type="submit" value="Log In" name="submit"  />
        </form>
        
    <?php
		
		}
		
		else {

			// Confirm successful log-in
	
			echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
			
		}
	
?>

<?php

	require_once('footer.php');
	
?>