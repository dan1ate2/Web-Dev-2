<!-- VALIDATION FOR FORM DATA -->
<?php

	include ("validEmail.php"); // email validation function

	// | | | | | | | | | | | | | | | | | -- TEST AREA -- | | | | | | | | | | | | | | | | |

	include ("connectDB.php"); // database connection
	// getDBConnection();

	// | | | | | | | | | | | | | | | -- END OF TEST AREA -- | | | | | | | | | | | | | | |

function validateUserForm($formData) {
	// SET VARIABLES FROM $FORMDATA INSTEAD OF USING REQUEST!??????????????????????? --------------
	$surname = $formData["surname"];
	$otherNames = $formData["other-names"];
	$chosenContact = $formData["contact-method"];
	$mobile = $formData["mobile-info"];
	$dayTime = $formData["daytime-info"];
	$email = $formData["email-info"];
	$streetAddress = $formData["street-address"];
	$suburbState = $formData["suburb-state"];
	$postcode = $formData["postcode"];
	$username = $formData["username"];
	$password = $formData["password"];
	$retypePassword = $formData["retype-password"];
	$occupation = $formData["occupation"];
	$_POST["join-date"] = date("Y-m-d"); // set join date in hidden field for database (yyyy-mm-dd)
	$flag = true; // false if error in any validation field
	$nextValidation = 0; // for iterating through validation functions

	// set magazine subscription variable/s
	if (isset($_POST["magazine"])) { // if mag checkbox checked
		$magSubscription = $_REQUEST["magazine"];
	}
	else { // if mag checkbox not checked
		$magSubscription = 0; // set variable
		$_POST["magazine"] = 0; // set form element to 0 (false) for database. TEST THIS !!!!! -------
	}

	// loop through validation functions while no errors
	while ($flag && $nextValidation < 13) {
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
				$flag = validateMagSubscription($magSubscription, $streetAddress, $suburbState, $postcode);
				break;
			case 7:
				$flag = validateStreetAddress($streetAddress);
				break;
			case 8:
				$flag = validateSuburbState($suburbState);
				break;
			case 9:
				$flag = validatePostcode($postcode);
				break;
			case 10:
				$flag = validateUsername($username);
				break;
			case 11:
				$flag = checkUsernameExists($username);
				break;
			case 12:
				$flag = validatePasswordFields($password, $retypePassword);
				break;
			case 13:
				$flag = validateOccupation($occupation);
				break;
			default:
				break;
		} // end switch
	} // end while
	return $flag;
} // end validateUserForm()

function validateSurname($sname) {
	// validate surname
	// words with one single space between allowed
	// can have single spaces, " ' " or " - "
	$valid = true;
	if (!preg_match("/^[a-zA-Z\'\-]+( [a-zA-Z]+){0,5}$/", $sname)) {
		echo "<p>Surname field is invalid<br>" .
			"Only words, single spaces, \" ' \" and \" - \" are allowed.<br><br>" .
			"Please go back and try again.<br></p>";
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
		echo "<p>Other Names field is invalid<br>" .
			"Only words, single spaces, \" ' \" and \" - \" are allowed.<br><br>" .
			"Please go back and try again.<br></p>";
		$valid = false;
	}
	return $valid;
} // end validateOtherNames()

function validateMobile($mob, $cont) {
	// validate mobile
	// format '0(4 or 5)xx xxx xxx' eg '0412 345 678'
	$valid = true;
	if ($mob == "" && $cont == "Mobile") {
		echo "<p>As your preferred contact method, a mobile number is required.<br><br>" .
			"Please go back and try again.<br></p>";
		$valid = false;
	}
	else if (!$mob == "") {
		if (!preg_match("/^0[4|5]\d{2}\s\d{3}\s\d{3}$/", $mob)) {
			echo "<p>Mobile number is incorrectly formatted<br>" .
			    "Must start with 04 or 05<br>" .
	            "Format: '0xxx xxx xxx' (including spaces).<br><br>" .
	            "Please go back and try again.<br></p>";
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
		echo "<p>As your preferred contact method, a daytime number is required.<br><br>" .
			"Please go back and try again.<br></p>";
		$valid = false;
	}
	else if (!$dTime == "") {
		if (!preg_match("/^\(0[2|3|6|7|8|9]\)\s\d{8}$/", $dTime)) {
			echo "<p>You have entered an invalid daytime number<br>" .
				"Start with 2 digit area code in brackets, a space, then 8 digits<br>" .
	            "Required format: '(0x) xxxxxxxx' (including spaces/brackets).<br><br>" .
	            "Please go back and try again.<br></p>";
	        $valid = false;
		}
	}
	return $valid;
} // end validateDaytime()

function validateEmail($e) {
	// validate email
	$valid = true;
	if (!validEmail($e)) {
		echo "<p>Email address not valid.<br><br>" .
			"Please go back and try again.<br></p>";
		$valid = false;
	}
	return $valid;
} // end validateEmail()

function validateMagSubscription($mag, $sAdd, $subState, $pCode) {
	// check for empty postal address fields if magazine option checked
	$valid = true;
	if ($mag == 1) { // if yes/checked mag subscription
		if (!$sAdd) {
			echo "<p>A street address is required to receive the monthly magazine.<br><br>" .
				"Please go back and try again.<br></p>";
			$valid = false;
		}
		else if (!$subState) {
			echo "<p>A suburb and state are required to receive the monthly magazine.<br><br>" .
				"Please go back and try again.<br></p>";
			$valid = false;
		}
		else if (!$pCode) {
			echo "<p>A postcode is required to receive the monthly magazine.<br><br>" .
				"Please go back and try again.<br></p>";
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
	        echo "<p>You have entered an invalid street address<br>" .
	        	"Minimal: character/s or word followed by single space and another character/word<br><br>" .
	        	"Acceptable examples:<br>" . 
	            "123 Anne Street<br>" .
	            "P.O. Box 123 Street<br>" .
	            "Unit 1-44 That Street<br>" .
	            "1/44 That Street<br><br><br>" .
	            "Please go back and try again.<br></p>";
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
			echo "<p>You have entered an invalid suburb/state combination<br>" . 
	            "Example suburb/street: 'Brisbane QLD'.<br><br>" .
	            "Please go back and try again.<br></p>";
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
			echo "<p>You have entered an invalid postcode.<br>" . 
	            "Should only contain 4 digits.<br><br>" .
	            "Please go back and try again.<br></p>";
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
			echo "<p>You have entered an invalid username<br>" . 
	            "Username must be between 6-10 characters only<br>" . 
	            "NO whitespace allowed.<br><br>" .
	            "Please go back and try again.<br></p>";
	        $valid = false;
		}
	}
	else {
		echo "<p>Username field cannot be left blank.<br><br>" .
			"Please go back and try again.<br></p>";
		$valid = false;
	}
	return $valid;
} // end validateUsername()

// check if username exists in database
function checkUsernameExists($uName) {
	$uniqueUsername = true;
	$db = getDBConnection();
	$members = $db->query("SELECT username FROM member");

	//Check each username in database
    foreach ($members as $m){
      // if username already in database, exit search
      if($uName == $m['username']) {
         $uniqueUsername = false;
         echo "<p>The username '" . $uName . "' already exists.<br><br>" .
         "Please choose a different username.<br></p>";
         break; // exit
        }
    }
    $db = null; // close db connection
    return $uniqueUsername;
} // end checkUsernameExists()

// validate both password fields
function validatePasswordFields($pass, $rePass) {
	// validate first password field
	// must be 4-10 characters
	// must have 1 uppercase, 1 lowercase, 1 digit, 1 special character
	// no whitespace
	$valid = true;
	if (!$pass == "") {
		if (!preg_match("/^(?!.*\\s)(?=.*[\W_])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,10}$/", $pass)) {
			echo "<p>You have entered an invalid password<br>" . 
	            "Password must contain at least one uppercase letter,<br>" . 
	            "one lowercase letter, one number, and one special character.<br>" .
	            "Password must be between 4-10 characters, no whitespace allowed.<br><br>" .
	            "Please go back and try again.<br></p>";
	        $valid = false;
		}
	}
	else {
		echo "<p>The Password field cannot be left blank.<br><br>" .
			"Please go back and try again.<br></p>";
		$valid = false;
	}

	// validate second password field (re-type password)
	// must match first password field
	if ((!$rePass == "") && ($valid)) {
		if ($rePass != $pass) {
			echo "<p>Passwords don't match, please go back and try again.<br></p>";
			$valid = false;
		}
	}
	else if (($rePass == "") && ($valid)) {
		echo "<p>Please confirm password, both password fields must match.<br><br>" .
			"Please go back and try again.<br></p>";
		$valid = false;
	}
	return $valid;
} // end validatePasswordFields()

function validateOccupation($occ) {
	// validate occupation
	$valid = true;
	if ($occ == " ") {
		echo "<p>You must choose an occupation.<br><br>" .
			"Please go back and try again.<br></p>";
		$valid = false;
	}
	return $valid;
} // end validateOccupation()