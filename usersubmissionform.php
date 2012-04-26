

    <?php echo $message; ?>
    
    <table>
    <tr><td rowspan="7" style="vertical-align:top" width="600"><p class="submitheader">Nightlist keeps track of restaurants and bars that your friends recommend to you.</p>
    <br />
    <p class="submitheader">It's a to-do list for your social life.</p>
    <div class="mobilelogo"><img src="images/smartphone.png" /></div><p class="submitheader2"><a href="mobile.php">Download the mobile app</a> to Nightlist on the go.</p>

    <form method="post" action="adduser.php">
    	<td colspan="2" align="right" width="400"><p class="h2">Sign Up - It's free!</p></td></tr>
        <tr><td align="right" width="150"><label for="firstname"><p class="text">First name:</p></label></td>
        <td align="left"><input type="text" name="firstname" value="" class="submissionfield" /></td></tr>
        <tr><td align="right"><label for="lastname"><p class="text">Last name:</p></label></td>
        <td align="left"><input type="text" name="lastname" value="" class="submissionfield" /></td></tr>
        <tr><td align="right"><label for="email"><p class="text">E-mail:</p></label></td>
        <td align="left"><input type="text" name="email" value="" class="submissionfield" /></td></tr>
        <tr><td align="right"><label for="confirmemail"><p class="text">Confirm E-mail:</p></label></td>
        <td align="left"><input type="text" name="confirmemail" value="" class="submissionfield" /></td></tr>
        <tr><td align="right"><label for="password"><p class="text">Password:</p></label></td>
        <td align="left"><input type="password" name="password" value="" class="submissionfield" /></td></tr>
        <tr><td align="right"><label for="confirmpassword"><p class="text">Confirm Password:</p></label></td>
        <td align="left"><input type="password" name="confirmpassword" value="" class="submissionfield" /></td></tr>

        <tr><td colspan="3" align="right"><input type="submit" value="Join" id="signup_submit" name="signup_submit" /></td></tr>
    </form>

    </table>
    
