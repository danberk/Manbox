<?php
	session_start();

	// Insert the page header
	$page_title = 'Sign Up';
	require_once('header.php');

	// Insert App Variables
	require_once('appvars.php');
	require_once('connectvars.php');
  
	// Set update message to blank
	$message = '';

	// Connect to the database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	if (isset($_POST['signup_submit'])) {
    	
		// Grab the profile data from the POST
    	$first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
    	$last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
    	$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
		$email_confirm = mysqli_real_escape_string($dbc, trim($_POST['confirmemail']));
		$password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		$password_confirm = mysqli_real_escape_string($dbc, trim($_POST['confirmpassword']));
		

    	if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($email_confirm) && !empty($password) && !empty($password_confirm) && ($email == $email_confirm) && ($password == $password_confirm)) {
      			
				// Make sure someone isn't already registered using this email
				$query = "SELECT * FROM nl_users WHERE email = '$email'";
				$data = mysqli_query($dbc, $query);
								
				if (mysqli_num_rows($data) == 0) {
        			
					// The username is unique, so insert the data into the database
        			$query = "INSERT INTO nl_users (first_name, last_name, email, password, join_date) VALUES ('$first_name', '$last_name','$email',SHA('$password'), NOW())";
        			mysqli_query($dbc, $query);

					
					// Log in the new user
					
					$query2 = "SELECT * FROM nl_users WHERE email = '$email'";
					$data2 = mysqli_query($dbc, $query2);
					
					if (mysqli_num_rows($data2) == 1) {
						
						$row = mysqli_fetch_array($data2);
						$_SESSION['user_id'] = $row['user_id'];
						$_SESSION['email'] = $email;
						$_SESSION['first_name'] = $first_name;
						$_SESSION['last_name'] = $last_name;

					}
					
					// Confirm success with the user
        			$message = '<p class="welcome">Welcome to Nightlist, ' . $_SESSION['first_name'] . '.</p>';					

					// Insert navigation
					require_once('navigation.php');
					echo '<div class="container">';
        			echo $message;
					require_once('newuser.php');
					echo '</div>';
					require_once('footer.php');
					
					mysqli_close($dbc);
        			exit();
      			}
				
				else {
        			
					// An account already exists for this username, so display an error message
        			$message = '<p class="error">An account already exists for this username. Please use a different address.</p>';
        			$username = "";
      			}
    		}
    		
			else {
      			
				$message = '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
    		}
  		}

 		mysqli_close($dbc);

	// Display the navigation
	require_once('navigation.php');
	
	echo '<div id="container">';
	
	// Display user submission form
	require_once('usersubmissionform.php');  
	require_once('indexcontent.php'); 	
	echo '</div>';
	// Insert the page footer
	require_once('footer.php');


?>
