<?php 
	$memberData = getMemberData($_POST["member-list"]);
?>
<form name="edit-member" id="edit-member" action="admin.php" method="post" onsubmit="return validateJoinForm()">
	<!-- Name details -->
    <label for="surname">Surname</label>
	<input type="text" name="surname" id="surname" maxlength="50" title="Member surname" value="<?php echo $memberData[0]['surname'] ?>"><br>
    <label for="other-names">Other Names</label>
	<input type="text" name="other-names" id="other-names" maxlength="60" value="<?php echo $memberData[0]['other_name'] ?>"><br><br>

    <!-- Contact method details -->
    <label>Preferred contact method</label><br>
	<input type="radio" name="contact-method" value="mobile" id="mobile" <?php $checked = ($memberData[0]['contact_method'] == "mobile" ? "checked" : ""); echo $checked; ?>>
	<label for="mobile">Mobile</label><br>
	<input type="radio" name="contact-method" value="daytime" id="daytime" <?php $checked = ($memberData[0]['contact_method'] == "landline" ? "checked" : ""); echo $checked; ?>>
	<label for="daytime">Daytime</label><br>
	<a href="#" class="tip">Help?
	    <span>
	        Preferred contact method.
	    </span>
	</a>
	<input type="radio" name="contact-method" value="email" id="email" <?php $checked = ($memberData[0]['contact_method'] == "email" ? "checked" : ""); echo $checked; ?>>
	<label for="email">Email</label><br><br>

    <!-- Magazine subscription -->
    <!-- <input type="hidden" name="magazine" value="1" id="magazine"> -->
    <input type="checkbox" name="magazine" value="" id="magazine" <?php $checked = ($memberData[0]['magazine'] == 1 ? "checked" : ""); echo $checked; ?>>
	<label for="magazine">Sign up to monthly magazine</label><br><br>

    <!-- Contact details -->
    <label for="mobile-info">Mobile</label>
	<input type="text" name="mobile-info" id="mobile-info" maxlength="12" value="<?php echo $memberData[0]['mobile'] ?>"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter mobile number here.<br>
	        Must start with 0(4 or 5).<br>
	        Format: '0xxx xxx xxx' (including spaces).
	    </span>
	</a>
    <label for="daytime-info">Day Time</label>
	<input type="text" name="daytime-info" id="daytime-info" maxlength="13" value="<?php echo $memberData[0]['landline'] ?>"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter day time/landline phone number here.<br>
	        Format: '(0x) xxxxxxxx' (including spaces and brackets).
	    </span>
	</a>
    <label for="email-info">Email</label>
	<input type="text" name="email-info" id="email-info" maxlength="50" value="<?php echo $memberData[0]['email'] ?>"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter email address here.<br>
	        Must have '@' and '.' to be valid.
	    </span>
	</a>
	<br>

    <!-- Postal address details -->
	<label for="street-address">Street Address</label>
	<input type="text" name="street-address" id="street-address" maxlength="50" value="<?php echo $memberData[0]['street'] ?>"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter street address.<br>
	        Example address: '123 Anne Street'.
	    </span>
	</a>
	<label for="suburb-state">Suburb/State</label>
	<input type="text" name="suburb-state" id="suburb-state" maxlength="50" value="<?php echo $memberData[0]['suburb'] ?>"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter suburb and state here.<br>
	        Words must be separated by single space.<br>
	        State can be abbreviated.<br>
	        Example: 'Brisbane QLD'.
	    </span>
	</a>
	<label for="postcode">Postcode</label>
	<input type="text" name="postcode" id="postcode" maxlength="4" value="<?php echo $memberData[0]['postcode'] ?>"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Enter postcode here.<br>
	        Must be 4 digits, no spaces.<br>
	        E.g. 4000.
	    </span>
	</a>
	<br>

    <!-- Login details -->
    <label for="username">Username</label>
	<input type="text" name="username" id="username" pattern=".{4,10}" maxlength="10" class="grey-text" readonly value="<?php echo $memberData[0]['username'] ?>"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Username cannot be changed once created.
	    </span>
	</a>
	<label for="password">Password</label>
	<input type="password" name="password" id="password" maxlength="10" value="<?php echo $memberData[0]['password'] ?>"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Update password here.<br>
	        Password must contain:<br>
	        - one uppercase letter<br> 
			- one lowercase letter<br>
			- one number<br>
			- one special character<br>
			Must be between 4-10 characters, no whitespace.
	    </span>
	</a>
	<label for="retype-password">Re-type Password</label>
	<input type="password" name="retype-password" id="retype-password" maxlength="10" value="<?php echo $memberData[0]['password'] ?>"><br>
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
		<option value="Student" 
		<?php $checked = ($memberData[0]['occupation'] == "Student" ? "selected" : ""); 
		echo $checked; ?>>Student</option>
		<option value="I.T. Professional" 
		<?php $checked = ($memberData[0]['occupation'] == "I.T. Professional" ? "selected" : ""); 
		echo $checked; ?>>I.T. Professional</option>
		<option value="Bartender" 
		<?php $checked = ($memberData[0]['occupation'] == "Bartender" ? "selected" : ""); 
		echo $checked; ?>>Bartender</option>
		<option value="Business Owner" 
		<?php $checked = ($memberData[0]['occupation'] == "Business Owner" ? "selected" : ""); 
		echo $checked; ?>>Business Owner</option>
		<option value="Programmer" 
		<?php $checked = ($memberData[0]['occupation'] == "Programmer" ? "selected" : ""); 
		echo $checked; ?>>Programmer</option>
		<option value="Developer" 
		<?php $checked = ($memberData[0]['occupation'] == "Developer" ? "selected" : ""); 
		echo $checked; ?>>Developer</option>
		<option value="Salesman" 
		<?php $checked = ($memberData[0]['occupation'] == "Salesman" ? "selected" : ""); 
		echo $checked; ?>>Salesman</option>
		<option value="Education" 
		<?php $checked = ($memberData[0]['occupation'] == "Education" ? "selected" : ""); 
		echo $checked; ?>>Education</option>
		<option value="Unemployed" 
		<?php $checked = ($memberData[0]['occupation'] == "Unemployed" ? "selected" : ""); 
		echo $checked; ?>>Unemployed</option>
		<option value="Other" 
		<?php $checked = ($memberData[0]['occupation'] == "Other" ? "selected" : ""); 
		echo $checked; ?>>Other</option>
	</select><br><br>

	<!-- Join Date -->
	<label for="join-date">Join Date</label>
	<input type="text" name="join-date" id="join-date" maxlength="50" class="grey-text" readonly value="<?php echo $memberData[0]['join_date'] ?>"><br>
	<a href="#" class="tip">Help?
	    <span>
	        The date this user signed up.<br>
	        Cannot be changed.
	    </span>
	</a>

	<!-- Member ID -->
	<label for="member_id">Member ID</label>
	<input type="text" name="member-id" id="member-id" class="grey-text" readonly value="<?php echo $memberData[0]['member_id'] ?>"><br>
	<a href="#" class="tip">Help?
	    <span>
	        Member ID is created automatically.<br>
	        Cannot be changed.
	    </span>
	</a>

    <!-- Form buttons -->
	<div class="form-buttons">
		<input type="submit" name="level-3-request" value="Update Member">
		<input type="submit" name="level-3-request" value="Delete Member">
	</div>
</form>

<?php
function getMemberData($member) {
	include_once ("includes/connectDB.php");
	$db = getDBConnection();
	$membData;
	try {
		$sql = $db->prepare("SELECT * FROM member WHERE member_id = :member");
		$sql->bindValue(':member', intval($member), PDO::PARAM_INT); // sanitizes data
		$sql->execute();
		$membData = $sql->fetchAll(PDO::FETCH_ASSOC);
		// print_r($membData); // TESTING ONLY, REMOVE WHEN DONE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	} catch (PDOException $ex) {
    	echo "Error: " . $ex->getMessage() . "<br>";
	}
	return $membData;
}