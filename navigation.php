<div class="navbar">
  <div id="navcontainer">
<a href="index.php"><img style="logo" src="images/nightlist_logo.png"></a>

<?php

	if (isset($_SESSION['email'])) {
    	echo '<p class="navtext"><a href="mynightlist.php">My Nightlist</a> | ';
    	echo '<a href="nightbuilder.php">Nightbuilder</a> | </p>'; ?>
        
        <!-- Account Dropdown -->
		<div id="topnav" class="topnav" style="float:right"> 
  
		<a href="login" class="account"><span>Account</span></a> </div>
        
        	<fieldset id="account_menu">
            <div class="accountuser">
            <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>
            </div>
            <ul>
            <li>Account Settings</li>
            <li>Privacy</li>
            <li>Help</li>
            <li><a href="logout.php">Log Out</a></li>
            </ul>
			</fieldset>	
        
		</div>
        
  	
    <?php
    }
  	
    else {
    ?>
	<!-- Sign In Dropdown -->
	<div id="topnav" class="topnav" style="float:right"> 
  
	Have an account? <a href="login" class="signin"><span>Sign in</span></a> </div>
	<fieldset id="signin_menu">
		<form method="post" id="signin" action="login.php">
		<label for="email">E-mail</label>
		<input id="email" name="email" value="" title="email" tabindex="4" type="text">
		</p>
		<p>
		<label for="password">Password</label>
		<input id="password" name="password" value="" title="password" tabindex="5" type="password">
		</p>
		<p class="remember">
		<input id="signin_submit" name="signin_submit" value="Sign in" tabindex="6" type="submit">
		<input id="remember" name="remember_me" value="1" tabindex="7" type="checkbox">
        <label for="remember">Remember me</label>
		</p>
		<p class="forgot"> <a href="#" id="resend_password_link">Forgot your password?</a> </p>
		<p class="forgot-username"> <A id=forgot_username_link 
        title="If you remember your password, try logging in with your email" 
        href="#">Forgot your username?</A> </p>
		</form>
	</fieldset>
</div>

	<?php
    	echo '</p>';
  	}

?>

</div>

