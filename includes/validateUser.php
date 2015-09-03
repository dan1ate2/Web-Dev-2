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
	$flag = true; // false if error in field validation
	$nextValidation = 0;

	// loop through validation functions while no errors
	while ($flag) {
		$nextValidation++;
		switch ($nextValidation) {
			case 1:
				$flag = validateSurname($surname);
				break;
			case 2:
				$flag = validateOtherNames($otherNames);
				break;
			case 3:
				$flag = validateMobile($mobile, $chosenContact);
				break;
			case 4:
				$flag = validateDaytime($dayTime, $chosenContact);
				break;
			case 5:
				$flag = validateEmail($email);
				break;
			case 6:
				$flag = validateMagSubscription($streetAddress, $suburbState, $postcode);
				break;
			case 7:
				$flag = validateStreetAddress($streetAddress);
				break;
			case 8:
				$flag = validateSuburbState($suburbState)
				break;
			case 9:
				$flag = validatePostcode($postcode);
				break;
			case 10:
				$flag = validateUsername($username);
				break;
			case 11:
				$flag = validatePasswordFields($password, $retypePassword);
				break;
			case 12:
				$flag = validateOccupation($occupation);
				break;
			default:
				break;
		} // end switch
	} // end while
} // end validateUserForm()

function validateSurname($sname) {
	// validate surname
	// words with one single space between allowed
	// can have single spaces, " ' " or " - "
	$valid = true;
	if (!preg_match("/^[a-zA-Z\'\-]+( [a-zA-Z]+){0,5}$/", $sname)) {
		echo "Surname field is invalid<br>" .
		"Only words, single spaces, \" ' \" and \" - \" are allowed.<br><br>";
		$valid = false;
	}
	return $valid;
} // end validateSurname()

function validateOtherNames($oNames) {
	// validate otherNames
	// words with one single space between allowed
	// can have single spaces, " ' " or " - "
	$valid = true;
	if (!preg_match("/^[a-zA-Z\'\-']+( [a-zA-Z]+){0,6}$/", $oNames)) {
		echo "Other Names field is invalid<br>" .
		"Only words, single spaces, \" ' \" and \" - \" are allowed.<br><br>";
		$valid = false;
	}
	return $valid;
} // end validateOtherNames()

function validateMobile($mob, $cont) {
	// validate mobile
	// format '0(4 or 5)xx xxx xxx' eg '0412 345 678'
	$valid = true;
	if ($mob == "" && $cont == "Mobile") {
		echo "As your preferred contact method, a mobile number is required.<br><br>";
		$valid = false;
	}
	else if (!$mob == "") {
		if (!preg_match("/^0[4|5]\d{2}\s\d{3}\s\d{3}$/", $mob)) {
			echo "Mobile number is incorrectly formatted<br>" .
			    "Must start with 04 or 05<br>" .
	            "Format: '0xxx xxx xxx' (including spaces).<br><br>";
	            $valid = false;
		}
	}
	return $valid;
} // end validateMobile()

function validateDaytime($dTime, $cont) {
	// validate daytime phone
	// format '(xx) xxxxxxxx' (includes brackets)
	$valid = true;
	if ($dTime == "" && $cont == "Daytime") {
		echo "As your preferred contact method, a daytime number is required.<br><br>";
		$valid = false;
	}
	else if (!$dTime == "") {
		if (!preg_match("/^\(0[2|3|6|7|8|9]\)\s\d{8}$/", $dTime)) {
			echo "You have entered an invalid daytime number<br>" .
				"Start with 2 digit area code in brackets, a space, then 8 digits<br>" .
	            "Required format: '(0x) xxxxxxxx' (including spaces/brackets).<br><br>";
	            $valid = false;
		}
	}
	return $valid;
} // end validateDaytime()

function validateEmail($e) {
	// validate email
	$valid = true;
	if (!validEmail($e)) {
		echo "Email address not valid.<br><br>";
		$valid = false;
	}
	return $valid;
} // end validateEmail()

function validateMagSubscription($sAdd, $subState, $pCode) {
	// check for empty postal address fields if magazine option checked
	$valid = true;
	if (isset($_REQUEST['magazine'])) {
		if (!$sAdd) {
			echo "A street address is required to receive the monthly magazine.<br><br>";
			$valid = false;
		}
		else if (!$subState) {
			echo "A suburb and state are required to receive the monthly magazine.<br><br>";
			$valid = false;
		}
		else if (!$pCode) {
			echo "A postcode is required to receive the monthly magazine.<br><br>";
			$valid = false;
		}
	}
	return $valid;
} // end validateMagSubscription()

function validateStreetAddress($sAdd) {
	// validate street address
	// any character/word, followed by single whitespace and character/word
	// additional single whitespace and character/word optional
	$valid = true;
	if (!$sAdd == "") {
	    if (!preg_match("/^\S{1,}(\s\S{1,}){1,}$/", $sAdd)) {
	        echo "You have entered an invalid street address<br>" .
	        	"Minimal: character/s or word followed by single space and another character/word<br>" .
	        	"Acceptable examples:<br>" . 
	            "123 Anne Street<br>" .
	            "P.O. Box 123 Street<br>" .
	            "Unit 1-44 That Street<br>" .
	            "1/44 That Street<br><br>";
	            $valid = false;
	    }
	}
	return $valid;
} // end validateStreetAddress()

function validateSuburbState($subState) {
	// validate suburb/state
	// min 2 words with a space in between
	// last word has minimum 3 characters (state abv)
	$valid = true;
	if (!$subState == "") {
		if (!preg_match("/^(\w{3,}){1}(\s\w{3,}){1}(\s\w{3,})*$/", $subState)) {
			echo "You have entered an invalid suburb/state combination<br>" . 
	            "Example suburb/street: 'Brisbane QLD'.<br><br>";
	        $valid = false;
		}
	}
	return $valid;
} // end validateSuburbState()

function validatePostcode($pCode) {
	// validate postcode
	// 4 digits
	$valid = true;
	if (!$pCode == "") {
		if (!preg_match("/^(\d){4}$/", $pCode)) {
			echo "You have entered an invalid postcode.<br>" . 
	            "Should only contain 4 digits.<br><br>";
	        $valid = false;
		}
	}
	return $valid;
} // end validatePostcode()

function validateUsername($uName) {
	// validate username
	// 6-10 characters, no whitespace
	$valid = true;
	if (!$uName == "") {
		if (!preg_match("/^(\S){6,10}$/", $uName)) {
			echo "You have entered an invalid username<br>" . 
	            "Username must be between 6-10 characters only<br>" . 
	            "NO whitespace allowed.<br><br>";
	        $valid = false;
		}
	}
	else {
		echo "Username field cannot be left blank.<br><br>";
		$valid = false;
	}
	// CHECK IF USERNAME IS ALREADY IN THE DATABASE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	return $valid;
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
	        $valid = false;
		}
	}
	else {
		echo "The Password field cannot be left blank.<br><br>";
		$valid = false;
	}

	// validate second password field (re-type password)
	// must match first password field
	if ((!$rePass == "") && ($valid)) {
		if ($rePass != $pass) {
			echo "Passwords don't match, please try again.";
			$valid = false;
		}
	}
	else if (($rePass == "") && ($valid)) {
		echo "Please confirm password, both password fields must match.<br><br>";
		$valid = false;
	}
	return $valid;
} // end validatePasswordFields()

function validateOccupation($occ) {
		// validate occupation
	$valid = true;
	if ($occ == " ") {
		echo "Please choose your occupation.<br><br>";
		$valid = false;
	}
	return $valid;
} // end validateOccupation()