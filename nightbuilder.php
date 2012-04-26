<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'What are you doing tonight?';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Show the navigation menu
  require_once('navigation.php');
?>

<div id="container">
<p class="welcome" style="margin-top:10px">Welcome, <?php echo $_SESSION['first_name']; ?>.</p>
<br />
<p class="h2">This is the Nightbuilder.</p>
<br />
<p class="text">Haven't built this yet.  Check back next week.</p>
</div>

<?php

	require_once('footer.php');
	
	?>
