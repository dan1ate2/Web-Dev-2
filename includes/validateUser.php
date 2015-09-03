<!-- VALIDATION FOR FORM DATA -->
<?php

	include ("validEmail.php"); // email validation function

	// | | | | | | | | | | | | | | | | | -- TEST AREA -- | | | | | | | | | | | | | | | | |

	include ("connectDB.php"); // database connection
	// getDBConnection();

	// | | | | | | | | | | | | | | | -- END OF TEST AREA -- | | | | | | | | | | | | | | |

function validateUserForm() {
	$surname = $_REQUEST["surname"];
	$otherNames = $_REQUEST["other-names"];
	$chosenContact = $_REQUEST["contact-method"];
	$mobile = $_REQUEST["mobile-info"];
	$dayTime = $_REQUEST["daytime-info"];
	$email = $_REQUEST["email-info"];
	$streetAddress = $_REQUEST["street-address"];
	$suburbState = $_REQUEST["suburb-state"];
	$postcode = $_REQUEST["postcode"];
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	$retypePassword = $_REQUEST["retype-password"];
	$occupation = $_REQUEST["occupation"];
	$joinDate = date("Y-m-d"); // format: 2015-09-02

	validateSurname($surname);
	validateOtherNames($otherNames);
	validateMobile($mobile, $chosenContact);
	validateDaytime($dayTime, $chosenContact);
	validateEmail($email);
	validateMagSubscription($streetAddress, $suburbState, $postcode);
	validateStreetAddress($streetAddress);
	validateSuburbState($suburbState)
	validatePostcode($postcode);
	validateUsername($username);
	validatePasswordFields($password, $retypePassword);
	validateOccupation($occupation);
} // End validateUserForm()

function validateSurname($sname) {
	// validate surname
	// words with one single space between allowed
	// can have single spaces, " ' " or " - "
	if (!preg_match("/^[a-zA-Z\'\-]+( [a-zA-Z]+){0,5}$/", $sname)) {
		echo "Surname field is invalid<br>" .
		"Only words, single spaces, \" ' \" and \" - \" are allowed.<br><br>";
	}
} // end validateSurname()

function validateOtherNames($oNames) {
	// validate otherNames
	// words with one single space between allowed
	// can have single spaces, " ' " or " - "
	if (!preg_match("/^[a-zA-Z\'\-']+( [a-zA-Z]+){0,6}$/", $oNames)) {
		echo "Other Names field is invalid<br>" .
		"Only words, single spaces, \" ' \" and \" - \" are allowed.<br><br>";
	}
} // end validateOtherNames()

function validateMobile($mob, $cont) {
	// validate mobile
	// format '0(4 or 5)xx xxx xxx' eg '0412 345 678'
	if ($mob == "" && $cont == "Mobile") {
		echo "As your preferred contact method, a mobile number is required.<br><br>";
	}
	else if (!$mob == "") {
		if (!preg_match("/^0[4|5]\d{2}\s\d{3}\s\d{3}$/", $mob)) {
			echo "Mobile number is incorrectly formatted<br>" .
			    "Must start with 04 or 05<br>" .
	            "Format: '0xxx xxx xxx' (including spaces).<br><br>";
		}
	}
} // end validateMobile()

function validateDaytime($dTime, $cont) {
	// validate daytime phone
	// format '(xx) xxxxxxxx' (includes brackets)
	if ($dTime == "" && $cont == "Daytime") {
		echo "As your preferred contact method, a daytime number is required.<br><br>";
	}
	else if (!$dTime == "") {
		if (!preg_match("/^\(0[2|3|6|7|8|9]\)\s\d{8}$/", $dTime)) {
			echo "You have entered an invalid daytime number<br>" .
				"Start with 2 digit area code in brackets, a space, then 8 digits<br>" .
	            "Required format: '(0x) xxxxxxxx' (including spaces/brackets).<br><br>";
		}
	}
} // end validateDaytime()

function validateEmail($e) {
	// validate email
	if (!validEmail($e)) {
		echo "Email address not valid.<br><br>";
	}
} // end validateEmail()

function validateMagSubscription($sAdd, $subState, $pCode) {
	// check for empty postal address fields if magazine option checked
	if (isset($_REQUEST['magazine'])) {
		if (!$sAdd) {
			echo "A street address is required to receive the monthly magazine.<br><br>";
		}
		else if (!$subState) {
			echo "A suburb and state are required to receive the monthly magazine.<br><br>";
		}
		else if (!$pCode) {
			echo "A postcode is required to receive the monthly magazine.<br><br>";
		}
	}
} // end validateMagSubscription()

function validateStreetAddress($sAdd) {
	// validate street address
	// any character/word, followed by single whitespace and character/word
	// additional single whitespace and character/word optional
	if (!$sAdd == "") {
	    if (!preg_match("/^\S{1,}(\s\S{1,}){1,}$/", $sAdd)) {
	        echo "You have entered an invalid street address<br>" .
	        	"Minimal: character/s or word followed by single space and another character/word<br>" .
	        	"Acceptable examples:<br>" . 
	            "123 Anne Street<br>" .
	            "P.O. Box 123 Street<br>" .
	            "Unit 1-44 That Street<br>" .
	            "1/44 That Street<br><br>";
	    }
	}
} // end validateStreetAddress()

function validateSuburbState($subState) {
	// validate suburb/state
	// min 2 words with a space in between
	// last word has minimum 3 characters (state abv)
	if (!$subState == "") {
		if (!preg_match("/^(\w{3,}){1}(\s\w{3,}){1}(\s\w{3,})*$/", $subState)) {
			echo "You have entered an invalid suburb/state combination<br>" . 
	            "Example suburb/street: 'Brisbane QLD'.<br><br>";
		}
	}
} // end validateSuburbState()

function validatePostcode($pCode) {
	// validate postcode
	// 4 digits
	if (!$pCode == "") {
		if (!preg_match("/^(\d){4}$/", $pCode)) {
			echo "You have entered an invalid postcode.<br>" . 
	            "Should only contain 4 digits.<br><br>";
		}
	}
} // end validatePostcode()

function validateUsername($uName) {
	// validate username
	// 6-10 characters, no whitespace
	if (!$uName == "") {
		if (!preg_match("/^(\S){6,10}$/", $uName)) {
			echo "You have entered an invalid username<br>" . 
	            "Username must be between 6-10 characters only<br>" . 
	            "NO whitespace allowed.<br><br>";
		}
	}
	else {
		echo "Username field cannot be left blank.<br><br>";
	}
	// CHECK IF USERNAME IS ALREADY IN THE DATABASE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
} // end validateUsername()

	// validate both password fields
function validatePasswordFields($pass, $rePass) {
	// validate first password field
	// must be 4-10 characters
	// must have 1 uppercase, 1 lowercase, 1 digit, 1 special character
	// no whitespace
	if (!$pass == "") {
		if (!preg_match("/^(?!.*\\s)(?=.*[\W_])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,10}$/", $pass)) {
			echo "You have entered an invalid password<br>" . 
	            "Password must contain at least one uppercase letter,<br>" . 
	            "one lowercase letter, one number, and one special character.<br>" .
	            "Password must be between 4-10 characters, no whitespace allowed.<br><br>";
		}
	}
	else {
		echo "The Password field cannot be left blank.<br><br>";
	}

	// validate second password field (re-type password)
	// must match first password field
	if (!$rePass == "") {
		if ($rePass != $pass) {
			echo "Passwords don't match, please try again.";
		}
	}
	else {
		echo "Please confirm password, both password fields must match.<br><br>";
	}
} // end validatePasswordFields()

function validateOccupation($occ) {
		// validate occupation
	if ($occ == " ") {
		echo "Please choose your occupation.<br><br>";
	}
} // end validateOccupation()

?>