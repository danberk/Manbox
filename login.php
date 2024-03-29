<?php
  require_once('connectvars.php');

  // Start the session
  session_start();

// Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['signin_submit'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_email = mysqli_real_escape_string($dbc, trim($_POST['email']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_email) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT user_id, email, first_name, last_name FROM nl_users WHERE email = '$user_email' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);
		
        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['first_name'] = $row['first_name'];
		  $_SESSION['email'] = $row['email'];
		  $_SESSION['last_name'] = $row['last_name'];
          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('first_name', $row['first_name'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
		  setcookie('email', $row['email'], time() + (60 * 60 * 24 * 30));          		  
		  setcookie('last_name', $row['last_name'], time() + (60 * 60 * 24 * 30));
		  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/mynightlist.php';
          header('Location: ' . $home_url);
		  
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in.';
      }
    }
  }

  // Insert the page header
  $page_title = 'Log In';
  require_once('header.php');
  
  // Insert the navigation
  require_once('navigation.php');
    
  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['user_id'])) {
	
	echo '<div id="container">';
    echo '<p class="error">' . $error_msg . '</p>';

	
	// Display user submission form
	require_once('usersubmissionform.php');  
	require_once('indexcontent.php');
 	echo '</div>';
	require_once('footer.php');
  }

?>

