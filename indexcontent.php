<div style="margin-top:15px;padding-bottom:30px;">
<div class="newrestaurants">
<div class="venuelogo"><img src="images/restaurant.png"></div><div class="newtitle">New Restaurants</div>

<?php
	// Connect to the database
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	
	// Select the latest (5) restaurants 
	$restaurantquery = "SELECT * FROM nl_venues,nl_category,nl_types,nl_neighborhood,nl_pricepoints WHERE (nl_venues.category = nl_category.category_id) AND (nl_venues.type = nl_types.type_id) AND (nl_venues.neighborhood = nl_neighborhood.neighborhood_id) AND (nl_venues.price_point = nl_pricepoints.pricepoint_id) AND (nl_venues.type = 2) ORDER BY nl_venues.venue_id DESC LIMIT 5 ";
	$restaurantdata = mysqli_query($dbc,$restaurantquery);
	
	while($row=mysqli_fetch_array($restaurantdata)) {
		?>
        <table style="float:left">
        <tr><td rowspan="3" width="150"><div style="width=:150px;border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;height:88px;background-image:url('images/<?php echo $row['picture']; ?>');background-repeat:no-repeat;"></div></td>
        <td rowspan="3" width="20"></td>
        <td width="240"><p class="text" style="font-weight:bold"><?php echo $row['venue_name'] . ' (' . $row['category'] .')'; ?></p></td></tr>
        <tr><td><p class="text"><?php echo $row['neighborhood_name'] . ' / ' . $row['address']; ?></p></td></tr>
        <tr><td style="vertical-align:top;"><p class="text" style="color:#0C3;vertical-align:top;"><?php echo $row['pricepoint']; ?></p></td><td align="right"><a href="addtonightlist.php?venue_id=<?php echo $row['venue_id']; ?>" title="Add to my Nightlist!"><img src="images/addtonl.png" /></a></tr>
        </table>
        <?php
	}
?>
</div>
<div class="newbars">
<div class="venuelogo"><img src="images/bar.png"></div><div class="newtitle" style="margin-left:0px">New Bars</div>

<?php
	// Connect to the database
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	
	// Select the latest (5) restaurants 
	$barquery = "SELECT * FROM nl_venues,nl_category,nl_types,nl_neighborhood,nl_pricepoints WHERE (nl_venues.category = nl_category.category_id) AND (nl_venues.type = nl_types.type_id) AND (nl_venues.neighborhood = nl_neighborhood.neighborhood_id) AND (nl_venues.price_point = nl_pricepoints.pricepoint_id) AND (nl_venues.type = 1) ORDER BY nl_venues.venue_id DESC LIMIT 5 ";
	$bardata = mysqli_query($dbc,$barquery);
	
	while($row=mysqli_fetch_array($bardata)) {
		?>
        <table style="float:left">
        <tr><td rowspan="3" width="150"><div style="width=:150px;border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;height:88px;background-image:url('images/<?php echo $row['picture']; ?>');background-repeat:no-repeat;"></div></td>
        <td rowspan="3" width="20"></td>
        <td width="240"><p class="text" style="font-weight:bold"><?php echo $row['venue_name'] . ' (' . $row['category'] .')'; ?></p></td></tr>
        <tr><td><p class="text"><?php echo $row['neighborhood_name'] . ' / ' . $row['address']; ?></p></td></tr>
        <tr><td style="vertical-align:top"><p class="text" style="color:#0C3;"><?php echo $row['pricepoint']; ?></p></td><td align="right"><a href="addtonightlist.php?venue_id=<?php echo $row['venue_id']; ?>" title="Add to my Nightlist!"><img src="images/addtonl.png" /></a></tr>
        </table>
        <?php
	}
?>

</div>
</div>

<?php mysqli_close($dbc); ?>