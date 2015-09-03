<!-- VALIDATION FOR FORM DATA -->
<?php
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

// validate surname
// words with one single space between allowed
// can have single spaces, " ' " or " - "
if (!preg_match("/^[a-zA-Z\'\-]+( [a-zA-Z]+){0,5}$/", $surname)) {
	echo "Surname field is invalid<br>" .
	"Only words, single spaces, \" ' \" and \" - \" are allowed.<br><br>";
}

// validate otherNames
// words with one single space between allowed
// can have single spaces, " ' " or " - "
if (!preg_match("/^[a-zA-Z\'\-']+( [a-zA-Z]+){0,6}$/", $otherNames)) {
	echo "Other Names field is invalid<br>" .
	"Only words, single spaces, \" ' \" and \" - \" are allowed.<br><br>";
}

// validate mobile
// format '0(4 or 5)xx xxx xxx' eg '0412 345 678'
if ($mobile == "" && $chosenContact == "Mobile") {
	echo "As your preferred contact method, a mobile number is required.<br><br>";
}
else if (!$mobile == "") {
	if (!preg_match("/^0[4|5]\d{2}\s\d{3}\s\d{3}$/", $mobile)) {
		echo "Mobile number is incorrectly formatted<br>" .
		    "Must start with 04 or 05<br>" .
            "Format: '0xxx xxx xxx' (including spaces).<br><br>";
	}
}

// validate daytime phone
// format '(xx) xxxxxxxx' (includes brackets)
if ($dayTime == "" && $chosenContact == "Daytime") {
	echo "As your preferred contact method, a daytime number is required.<br><br>";
}
else if (!$dayTime == "") {
	if (!preg_match("/^\(0[2|3|6|7|8|9]\)\s\d{8}$/", $dayTime)) {
		echo "You have entered an invalid daytime number<br>" .
			"Start with 2 digit area code in brackets, a space, then 8 digits<br>" .
            "Required format: '(0x) xxxxxxxx' (including spaces/brackets).<br><br>";
	}
}

// validate email
include ("validEmail.php"); // email validation function
if (!validEmail($email)) {
	echo "Email address not valid.<br><br>";
}

// check for empty postal address fields if magazine option checked
if (isset($_REQUEST['magazine'])) {
	if (!$streetAddress) {
		echo "A street address is required to receive the monthly magazine.<br><br>";
	}
	else if (!$suburbState) {
		echo "A suburb and state are required to receive the monthly magazine.<br><br>";
	}
	else if (!$postcode) {
		echo "A postcode is required to receive the monthly magazine.<br><br>";
	}
}

// validate street address
// any character/word, followed by single whitespace and character/word
// additional single whitespace and character/word optional
if (!$streetAddress == "") {
    if (!preg_match("/^\S{1,}(\s\S{1,}){1,}$/", $streetAddress)) {
        echo "You have entered an invalid street address<br>" .
        	"Minimal: character/s or word followed by single space and another character/word<br>" .
        	"Acceptable examples:<br>" . 
            "123 Anne Street<br>" .
            "P.O. Box 123 Street<br>" .
            "Unit 1-44 That Street<br>" .
            "1/44 That Street<br><br>";
    }
}

// validate suburb/state
// min 2 words with a space in between
// last word has minimum 3 characters (state abv)
if (!$suburbState == "") {
	if (!preg_match("/^(\w{3,}){1}(\s\w{3,}){1}(\s\w{3,})*$/", $suburbState)) {
		echo "You have entered an invalid suburb/state combination<br>" . 
            "Example suburb/street: 'Brisbane QLD'.<br><br>";
	}
}

// validate postcode
// 4 digits
if (!$postcode == "") {
	if (!preg_match("/^(\d){4}$/", $postcode)) {
		echo "You have entered an invalid postcode.<br>" . 
            "Should only contain 4 digits.<br><br>";
	}
}

// validate username
// 6-10 characters, no whitespace
if (!$username == "") {
	if (!preg_match("/^(\S){6,10}$/", $username)) {
		echo "You have entered an invalid username<br>" . 
            "Username must be between 6-10 characters only<br>" . 
            "NO whitespace allowed.<br><br>";
	}
}
else {
	echo "Username field cannot be left blank.<br><br>";
}

// validate first password field
// must be 4-10 characters
// must have 1 uppercase, 1 lowercase, 1 digit, 1 special character
// no whitespace
if (!$password == "") {
	if (!preg_match("/^(?!.*\\s)(?=.*[\W_])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,10}$/", $password)) {
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
if (!$retypePassword == "") {
	if ($retypePassword != $password) {
		echo "Passwords don't match, please try again.";
	}
}
else {
	echo "Please confirm password, both password fields must match.<br><br>";
}

// validate occupation
if ($occupation == " ") {
	echo "Please choose your occupation.<br><br>";
}

?>