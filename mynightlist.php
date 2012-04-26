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
  
  $sessionuser = $_SESSION['user_id'];

?>

<div id="container">
<div class="mylist_leftbar">
<div class="mylist_leftbar_nav">
<p class="text">My Nightlist</p>
<p class="text">Visited Venues</p>
<p class="text">All Venues</p>
</div>
</div>
<div class="mylist_rightbar">
<p class="welcome" style="margin-top:10px">Welcome, <?php echo $_SESSION['first_name']; ?>.</p>
<br />
<p class="h2">This is your nightlist.</p>
<br />
<?php

	// Connect to the database
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	
	// Select all venues that a user has on their nightlist
	$nightlistquery = "SELECT * FROM nl_users,nl_listadds,nl_venues,nl_category,nl_pricepoints,nl_types,nl_neighborhood WHERE ('$sessionuser' = nl_listadds.add_user_id) AND (nl_users.user_id = nl_listadds.add_user_id) AND (nl_listadds.add_venue_id = nl_venues.venue_id) AND (nl_venues.category = nl_category.category_id) AND (nl_venues.type = nl_types.type_id) AND (nl_venues.neighborhood = nl_neighborhood.neighborhood_id) AND (nl_venues.price_point = nl_pricepoints.pricepoint_id) ORDER BY nl_venues.venue_name ASC";
	$nightlistdata = mysqli_query($dbc,$nightlistquery);
	
	while($row = mysqli_fetch_array($nightlistdata)) {
		// Display users nightlist
		
		?>
        <table style="float:left" class="nightlistentry" width="100%">
        <tr><td rowspan="3" width="150"><div style="width=:150px;border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;height:88px;background-image:url('images/<?php echo $row['picture']; ?>');background-repeat:no-repeat;"></div></td>
        <td rowspan="3" width="20"></td>
        <td><p class="text" style="font-weight:bold"><?php echo $row['venue_name'] . ' (' . $row['category'] .')'; ?></p></td></tr>
        <tr><td><p class="text"><?php echo $row['neighborhood_name'] . ' / ' . $row['address']; ?></p></td></tr>
        <tr><td style="vertical-align:top;"><p class="text" style="color:#0C3;vertical-align:top;"><?php echo $row['pricepoint']; ?></p></td><td align="right"><p class="text"><a href="nlremove.php?add_id=<?php echo $row['add_id'];?>" title="Remove from my Nightlist!">Remove from my nightlist<img src="images/remove.png" style="margin-left:10px;margin-top:10px;"/></a></p></tr>
        </table>
        <?php
	}
?>
</div>
</div>
<?php
  // Insert the page footer
  require_once('footer.php');
  mysqli_close($dbc);
?>
