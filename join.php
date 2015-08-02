<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<script src="js/validate.js"></script>
		<title>Form</title>
	</head>

	<body>
		<form name="join" action="http://infotech.scu.edu.au/cgi-bin/echo_form" method="post" onsubmit="return validateForm()">
			<!-- Name details -->
            <label for="surname">Surname</label>
			<input type="text" name="surname" id="surname" maxlength="50"><br>
            <label for="other-names">Other Names</label>
			<input type="text" name="other-names" id="other-names" maxlength="60"><br>

            <!-- Contact details -->
            <label>Preferred contact method</label><br>
			<input type="radio" name="contact-method" value="Mobile" id="mobile">
			<label for="mobile">Mobile</label><br>
			<input type="radio" name="contact-method" value="Daytime" id="daytime">
			<label for="daytime">Daytime</label><br>
			<input type="radio" name="contact-method" value="Email" id="email" checked>
			<label for="email">Email</label><br>

            <!-- Magazine subscription -->
            <input type="checkbox" name="magazine" value="subscribe" id="magazine" checked>
			<label for="magazine">Sign up to monthly magazine</label><br>

            <!-- Contact method details -->
            <label for="mobile-info">Mobile</label>
			<input type="text" name="mobile-info" id="mobile-info" maxlength="12"><br>
            <label for="daytime-info">Day Time</label>
			<input type="text" name="daytime-info" id="daytime-info" maxlength="13"><br>
            <label for="email-info">Email</label>
			<input type="text" name="email-info" id="email-info" maxlength="50"><br>

            <!-- Postal address details -->
            <label>Postal Address</label><br>
			<label for="street-address">Street Address</label>
			<input type="text" name="street-address" id="street-address" maxlength="50"><br>
			<label for="suburb-state">Suburb/State</label>
			<input type="text" name="suburb-state" id="suburb-state" maxlength="50"><br>
			<label for="postcode">Postcode</label>
			<input type="text" name="postcode" id="postcode" maxlength="4"><br>

            <!-- Login details -->
            <label for="username">Username</label>
			<input type="text" name="username" id="username" pattern=".{4,10}" maxlength="10"><br>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" maxlength="10"><br>
			<label for="retype-password">Re-type Password</label>
			<input type="password" name="retype-password" id="retype-password" maxlength="10"><br>

            <!-- Occupation -->
            <label>Occupation</label><br>
			<select name="occupation" id="occupation">
				<option value=""></option>
				<option value="Student">Student</option>
				<option value="I.T. Professional">I.T. Professional</option>
				<option value="Bartender">Bartender</option>
				<option value="Business Owner">Business Owner</option>
				<option value="Programmer">Programmer</option>
				<option value="Developer">Developer</option>
				<option value="Salesman">Salesman</option>
				<option value="Teacher">Teacher</option>
				<option value="Unemployed">Unemployed</option>
				<option value="Other">Other</option>
			</select><br>

            <!-- Form buttons & date stamp -->
            <input type="hidden" name="join-date">
			<input type="reset" value="Reset">
			<input type="submit" value="Submit">
		</form>
	</body>
</html>