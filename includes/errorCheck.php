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
$joinDate;
$formattedDate;
$re;
/*
    var surname = document.forms["join"]["surname"].value;
    var otherNames = document.forms["join"]["other-names"].value;
    var chosenContact; // preferred contact option
    var mobile = document.forms["join"]["mobile-info"].value;
    var dayTime = document.forms["join"]["daytime-info"].value;
    var email = document.forms["join"]["email-info"].value;
    var streetAddress = document.forms["join"]["street-address"].value;
    var suburbState = document.forms["join"]["suburb-state"].value;
    var postcode = document.forms["join"]["postcode"].value;
    var username = document.forms["join"]["username"].value;
    var password = document.forms["join"]["password"].value;
    var retypePassword = document.forms["join"]["retype-password"].value;
    var occupation = document.forms["join"]["occupation"].value;
    var joinDate = new Date(); // date stamp object
    var formattedDate; // the date stamp formatted
    var re; // regular expression
    */

// validate email address
// include ("validEmail.inc");

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

?>