<div id="navbar">
	<div id="navcontainer">


<table width="1000" cellpadding="0" cellspacing="0">
	<tr>
		<td width="344">
        
        <a href="index.php"><img style="logo" src="images/manbox_logo.png"></a>
        
        </td>
        
        <td width="656">
			<?php

			if (isset($_SESSION['email'])) {
    			echo 'Account'; 
    		}
  	
    		else {
				echo "<ul class='navlinks'>
        			<li><a href='#'><h2>SIGN UP</h2></a></li>
					<li><a href='#'>HOW IT WORKS</a></li>
					<li><a href='#'>LOG IN</a></li>
        		</ul>";
			} ?>
            </td>
            
            </tr>
            
            </table>
	</div>
</div> 
<!--<div id="navstrip"></div>-->

