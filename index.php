<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Stay clean, stay classy';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Show the navigation menu
  require_once('navigation.php');
?>

<div id="container">
	<?php
	require_once('indexcontent.php');
	?>
</div>