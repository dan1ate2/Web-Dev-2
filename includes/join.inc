<h2 class="orange">Join DVD'sy And Rent DVD's!</h2>
<p>Join our club today and receive the monthly newsletter and the ability to rent out our movies online!</p><br>

<!-- onsubmit="return validateJoinForm()" -->
<!-- action="http://infotech.scu.edu.au/cgi-bin/echo_form" -->
<!-- action="join.php" -->
<form name="join" action="join.php" method="post" onsubmit="return validateJoinForm()">
	<!-- Name details -->
    <label for="surname">Surname</label>
	<input type="text" name="surname" id="surname" maxlength="50" title="Enter a surname here"><br>
    <label for="other-names">Other Names</label>
	<input type="text" name="other-names" id="other-names" maxlength="60"><br><br>

    <!-- Contact method details -->
    <label>Preferred contact method</label><br>
	<input type="radio" name="contact-method" value="mobile" id="mobile">
	<label for="mobile">Mobile</label><br>
	<input type="radio" name="contact-method" value="daytime" id="daytime">
	<label for="daytime">Daytime</label><br>
	<a href="#" class="tip">Help?
	    <span>
	        How would you like us to contact you?<br>
	        Please choose preferred method.
	    </span>
	</a>
	<input type="radio" name="contact-method" value="email" id="email" checked>
	<label for="email">Email</label><br><br>

    <!-- Magazine subscription -->
    <!-- <input type="hidden" name="magazine" value="1" id="magazine"> -->
    <input type="checkbox" name="magazine" value="" id="magazine" checked>
	<label for="magazine">Sign up to monthly magazine</label><br><br>

    <!-- Contact details -->
    <label for="mobile-info">Mobile</label>
	<input type="text" name="mobile-info" id="mobile-info" maxlength="12"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter your mobile number here.<br>
	        Must start with 0(4 or 5).<br>
	        Format: '0xxx xxx xxx' (including spaces).
	    </span>
	</a>
    <label for="daytime-info">Day Time</label>
	<input type="text" name="daytime-info" id="daytime-info" maxlength="13"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter your day time/landline phone number here.<br>
	        Format: '(0x) xxxxxxxx' (including spaces and brackets).
	    </span>
	</a>
    <label for="email-info">Email</label>
	<input type="text" name="email-info" id="email-info" maxlength="50"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter your email address here.<br>
	        Must have '@' and '.' to be valid.
	    </span>
	</a>
	<br>

    <!-- Postal address details -->
	<label for="street-address">Street Address</label>
	<input type="text" name="street-address" id="street-address" maxlength="50"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter your street address.<br>
	        Example address: '123 Anne Street'.
	    </span>
	</a>
	<label for="suburb-state">Suburb/State</label>
	<input type="text" name="suburb-state" id="suburb-state" maxlength="50"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter your suburb and state here.<br>
	        Words must be separated by single space.<br>
	        State can be abbreviated.<br>
	        Example: 'Brisbane QLD'.
	    </span>
	</a>
	<label for="postcode">Postcode</label>
	<input type="text" name="postcode" id="postcode" maxlength="4"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter your postcode here.<br>
	        Must be 4 digits, no spaces.<br>
	        E.g. 4000.
	    </span>
	</a>
	<br>

    <!-- Login details -->
    <label for="username">Username</label>
	<input type="text" name="username" id="username" pattern=".{4,10}" maxlength="10"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter your username here.<br>
	        Username must be between 6-10 characters only.<br>
	        NO whitespace allowed.
	    </span>
	</a>
	<label for="password">Password</label>
	<input type="password" name="password" id="password" maxlength="10"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter your password here.<br>
	        Password must contain:<br>
	        - one uppercase letter<br> 
			- one lowercase letter<br>
			- one number<br>
			- one special character<br>
			Must be between 4-10 characters, no whitespace.
	    </span>
	</a>
	<label for="retype-password">Re-type Password</label>
	<input type="password" name="retype-password" id="retype-password" maxlength="10"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Retype your password.<br>
	        Must match password above, neither can be empty.
	    </span>
	</a><br>

    <!-- Occupation -->
    <label>Occupation</label>
	<select name="occupation" id="occupation">
		<option value=" " label=" "></option>
		<option value="Student">Student</option>
		<option value="I.T. Professional">I.T. Professional</option>
		<option value="Bartender">Bartender</option>
		<option value="Business Owner">Business Owner</option>
		<option value="Programmer">Programmer</option>
		<option value="Developer">Developer</option>
		<option value="Salesman">Salesman</option>
		<option value="Education">Education</option>
		<option value="Unemployed">Unemployed</option>
		<option value="Other">Other</option>
	</select><br>

    <!-- Form buttons -->
	<div class="form-buttons">
		<input type="reset" value="Reset">
		<input type="submit" value="Submit">
	</div>
</form>