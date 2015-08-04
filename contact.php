<!DOCTYPE html>
<html lang="en">
	<head>
		<title>DVD'sy - Contact</title>
		<meta charset="utf-8">
		<meta name="description" content="DVD'sy movie rentals - TechZone articles">
		<script src="js/validate.js"></script>
		<!-- Common 'head' content -->
		<?php include 'includes/head.php' ?>
		<!-- end of Common 'head' content -->
	</head>

	<body>
		<!-- Header & Navigation -->
		<?php include 'includes/header-nav.php' ?>
		<!-- end of Header & Navigation -->

		<div class="container">
			<h1 class="page-title">Contact</h1>
			<div class="left-box bg-opacity">
				<h2 class="orange">Our Location</h2>
				<p>Some text would go here, and this is what it would look like if there were a lot more text</p>
				<p>Some text would go here..</p>
			</div>
			<div class="right-box bg-opacity">
				<h2 class="black-orange">Contact Us</h2>
				<form name="contact-form" id="contact-form" action="http://infotech.scu.edu.au/cgi-bin/echo_form" method="post" onsubmit="return validateContactForm()">
					<p>Please fill out this form if you would like to get in touch with us.</p>
					<!-- Contact details -->
		            <label for="first-name">First Name</label>
					<input type="text" name="first-name" id="first-name" maxlength="50" title="Enter your name here"><br>
		            <label for="email">Email</label>
					<input type="text" name="email" id="email" maxlength="60" title="Enter your email address (must be valid)"><br>
					<label for="phone">Phone Number</label>
					<input type="text" name="phone" id="phone" maxlength="12" title="Enter your phone number(digits only)"><br>
					<label for="message">Message</label>
					<textarea style="margin-left:218px;" name="message" id="message" rows="10" cols="23"></textarea>

		            <!-- Form buttons & date stamp -->
					<div class="form-buttons">
						<input type="reset" value="Reset">
						<input type="submit" value="Submit">
					</div>
				</form>
			</div>
			<div class="clear"></div>
		</div>
		
		<!-- Footer -->
		<?php include 'includes/footer.php' ?>
		<!-- end of Footer -->
	</body>
</html>