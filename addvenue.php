<?php
	// Insert the page header
	$page_title = 'Admin Area';
	require_once('header.php');
	
	// Other required files
	require_once('appvars.php');
	require_once('connectvars.php');
	require_once('navigation.php');
	?>

	<div class="contentwindowclean"><p class="text">Welcome to the Admin area.  Add/remove venues and users.</p>
    
<?php

	// Connect to the database
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);	
	
	if(isset($_POST['submit'])) {
	
		//Grab all of the data from the form
		$name = $_POST['venue_name'];
		$type = $_POST['type'];
		$address = $_POST['address'];
		$neighborhood = $_POST['neighborhood'];
		$category = $_POST['category'];
		$price_point = $_POST['price_point'];
		$picture = mysqli_real_escape_string($dbc, trim($_FILES['picture']['name']));
        $picture_type = $_FILES['picture']['type'];
        $picture_size = $_FILES['picture']['size']; 

		
		// Make sure no fields are empty
		if(!empty($name) && !empty($type) && !empty($address) && !empty($neighborhood) && !empty($category) && !empty($price_point) && !empty($picture)) {
			 
			 if ((($picture_type == 'image/gif') || ($picture_type == 'image/jpeg') || ($picture_type == 'image/pjpeg') || ($picture_type == 'image/png'))
        	&& ($picture_size > 0) && ($picture_size <= NL_MAXFILESIZE)) {
        
				if ($_FILES['picture']['error'] == 0) {
          		// Move the file to the target upload folder
          		$target = NL_UPLOADPATH . $picture;
         		 if (move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
			
					// Ensure venue isn't already in database
					$query2 = "SELECT * FROM nl_venues WHERE venue_name = '$name'";
					$data2 = mysqli_query($dbc,$query2);
			
					if(mysqli_num_rows($data2) == 0) {
			
						// Insert the new venue into the database
						$query3 = "INSERT INTO nl_venues (venue_name,type,address,neighborhood,category,price_point,picture)" . 
						"VALUES ('$name','$type','$address','$neighborhood','$category','$price_point','$picture')";
						$data3 = mysqli_query($dbc,$query3);
				
						// Confirm success with the user
				
						echo '<p class="text">Venue ' . $name . ' successfully added.</p>';
						echo '<br />';
						echo '<p class="text"><a href="addvenue.php">Add another venue</a></p>';
				
						echo '</div>';
				
				
				
						// Close the connection and exit the script
						mysqli_close($dbc);
						exit();
					}
				 }
				}
			}
			
			else {
				
				// The resutarant is already added
				
				echo '<p class="error">That restaurant is already in the database.</p>';
			}
		
		// Try to delete the temporary screen shot image file
        @unlink($_FILES['screenshot']['tmp_name']);

		}
		
		
		else {
			
			// All the data wasn't entered
			
			echo '<p class="error">You must enter all of the data to add a venue.</p>';
			
		}
		
	}
	
	// Query the database to get all neighborhoods
	
	$neighborhoodquery = "SELECT neighborhood_id,neighborhood_name FROM nl_neighborhood";
	$neighborhoodresult = mysqli_query($dbc,$neighborhoodquery);
	
	$typequery = "SELECT type_id,type FROM nl_types";
	$typeresult = mysqli_query($dbc,$typequery);
	
	$categoryquery = "SELECT category_id,category FROM nl_category";
	$categoryresult = mysqli_query($dbc,$categoryquery);
	
	// Display the venue add form
	
	?>
	
    <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
    <fieldset style="margin-top:15px;">
    
    <legend class="text">Add a Venue</legend>
    <table>
    	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo NL_MAXFILESIZE; ?>" />
    	<tr><td><label for="name" class="text">Venue Name</label></td>
        <td><input type="text" name="venue_name" class="submissionfield" /></td></tr>
        <tr><td><label for="type" class="text">Venue Type</label></td>
    	<td><select name="type" class="submissiondropdown">
        <?php
        	while($row = mysqli_fetch_array($typeresult)) {
				echo '<option value="'.$row['type_id'].'">'.$row['type'].'</option>';
			}
		?>
        </select></td></tr>
        <tr><td><label for="address" class="text">Address</label></td>
        <td><input type="text" name="address" class="submissionfield" style="width:500px;" /></td></tr>
        <tr><td><label for="neighborhood" class="text">Neighborhood</label></td>
        <td><select name="neighborhood" class="submissiondropdown" style="width:200px;">
        <?php
			while($row = mysqli_fetch_array($neighborhoodresult)) {
				echo '<option value="'.$row['neighborhood_id'].'">'.$row['neighborhood_name'].'</option>';
			}
        ?>
        </select></td></tr>
        <tr><td><label for="Category" class="text">Category</label></td>
        <td><select name="category" class="submissiondropdown" style="width:200px;">
        <?php
			while($row = mysqli_fetch_array($categoryresult)) {
				echo '<option value="'.$row['category_id'].'">'.$row['category'].'</option>';
			}
		?>
        </select></td></tr>
        <tr><td><label for="pricepoint" class="text">Price Point</label></td>
        <td><select name="price_point" class="submissiondropdown">
        <option value="1">$</option>
        <option value="2">$$</option>
        <option value="3">$$$</option>
        <option value="4">$$$$</option>
        <option value="5">$$$$$</option>
        </select></td></td>
        <tr><td><label for="picture" class="text">Picture</label></td>
    	<td><input type="file" id="picture" name="picture" /></td></tr>
        <tr><td><input type="submit" name="submit" value="Submit" id="signup_submit" style="margin-left:-1px;margin-top:10px;"/></td></tr>
        
	</form>
	</table>
    </fieldset>
    
    <fieldset style="margin-top:20px;margin-bottom:20px;align:center">
    <legend class="text">Remove Venue</legend>
    
    <?php
	
	// Select all venues 
	$restaurantquery = "SELECT * FROM nl_venues,nl_category,nl_types,nl_neighborhood,nl_pricepoints WHERE (nl_venues.category = nl_category.category_id) AND (nl_venues.type = nl_types.type_id) AND (nl_venues.neighborhood = nl_neighborhood.neighborhood_id) AND (nl_venues.price_point = nl_pricepoints.pricepoint_id) ORDER BY nl_venues.venue_name ASC";
	$restaurantdata = mysqli_query($dbc,$restaurantquery);

	while($row=mysqli_fetch_array($restaurantdata)) {
		?>
        <table style="float:left">
        <tr><td rowspan="3" width="150"><div style="width=:150px;border-radius:5px;-webkit-border-radius:5px;-moz-border-radius:5px;height:88px;background-image:url('images/<?php echo $row['picture']; ?>');background-repeat:no-repeat;"></div></td>
        <td rowspan="3" width="20"></td>
        <td width="275"><p class="text" style="font-weight:bold"><?php echo $row['venue_name'] . ' (' . $row['category'] .')'; ?></p></td></tr>
        <tr><td><p class="text"><?php echo $row['neighborhood_name'] . ' / ' . $row['address']; ?></p></td></tr>
        <tr><td style="vertical-align:top;"><p class="text" style="color:#0C3;vertical-align:top;"><?php echo $row['pricepoint']; ?></p></td><td align="right"><a href="dbremove.php?id=<?php echo $row['venue_id']; ?>" title="Remove from Database"><img src="images/remove.png" /></a></tr>
        </table>
        <?php
	}

?>

    
    </fieldset>
<?php
	
	mysqli_close($dbc);
	
?>
			
</div>
