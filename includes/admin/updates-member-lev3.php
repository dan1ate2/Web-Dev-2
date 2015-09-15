<?php
include_once ("includes/connectDB.php"); // database connection

function updateMember($formData) {
	//Return values
    $queryResult['succeeded'] = false;
    $queryResult['error'] = '';
    
    $memberId = $formData["member-id"];
	$surname = $formData["surname"];
	$otherNames = $formData["other-names"];
	$chosenContact = $formData["contact-method"];
	$mobile = $formData["mobile-info"];
	$dayTime = $formData["daytime-info"];
	$email = $formData["email-info"];
	$streetAddress = $formData["street-address"];
	$suburbState = $formData["suburb-state"];
	$username = $formData["username"];
	$password = $formData["password"];
	$retypePassword = $formData["retype-password"];
	$occupation = $formData["occupation"];
    $joindate = date("Y-m-d"); // server date (yyyy-mm-dd)
    	// set postcode (avoids 0 in database if none given)
	if (!empty($formData["postcode"])) {
		$postcode = $formData["postcode"];
	}
	else {
		$postcode = null;
	}
    	// set magazine subscription choice
    if(!isset($formData["magazine"])) { // no subscription
       $magazine = 0; // 0 = false in database
   }
    else { // yes subscription
       $magazine = 1; // 1 = true in database
   }

   	// database connection
    $db = getDBConnection();
    
    // set up query
    $updateUser = $db->prepare('UPDATE member 
    	SET surname=:surname, other_name=:other_name, contact_method=:contact_method, email=:email, mobile=:mobile, landline=:landline, magazine=:magazine, street=:street, suburb=:suburb, postcode=:postcode, password=:password, occupation=:occupation 
    	WHERE member_id = :ID');
    
    // sanitize data in PDO object
    $updateUser->bindValue(':ID', intval($memberId), PDO::PARAM_INT);
    $updateUser->bindParam(':surname', $surname, PDO::PARAM_STR);
    $updateUser->bindParam(':other_name', $otherNames, PDO::PARAM_STR);
    $updateUser->bindParam(':contact_method', $chosenContact, PDO::PARAM_STR);
    $updateUser->bindParam(':email', $email, PDO::PARAM_STR);
    $updateUser->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $updateUser->bindParam(':landline', $dayTime, PDO::PARAM_STR);
    $updateUser->bindParam(':magazine', $magazine, PDO::PARAM_INT);
    $updateUser->bindParam(':street', $streetAddress, PDO::PARAM_STR);
    $updateUser->bindParam(':suburb', $suburbState, PDO::PARAM_STR);
    $updateUser->bindParam(':postcode', $postcode, PDO::PARAM_INT);
    $updateUser->bindParam(':password', $password, PDO::PARAM_STR);
    $updateUser->bindParam(':occupation', $occupation, PDO::PARAM_STR);

    // try insert user into database
    try {
        // insert user using prepared query
        $queryResult['succeeded'] = $updateUser->execute();
    }catch (PDOException $e) {
        // error message if failed to add to database (print message)
        $queryResult['error'] = $e->getMessage();
    }

    $db = null; // close database connection
    return $queryResult;
}