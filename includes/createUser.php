<?php
include_once ("connectDB.php"); // database connection

function createUser($formData){
    //Return value
    $queryResult['succeeded'] = false;
    $queryResult['error'] = '';
    
    $member_id = null; // database will auto increment, must be null for this 
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
	if (!empty($formData["postcode"]) && !$formData["postcode"] == 0) {
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
    $insertUser = $db->prepare('INSERT into member VALUES
                              (:member_id, :surname, :other_name, :contact_method,
                               :email, :mobile, :landline, :magazine, :street,
                               :suburb, :postcode, :username, :password,
                               :occupation, :join_date)');
    
    // sanitize data in PDO object
    $insertUser->bindParam(':member_id', $member_id, PDO::PARAM_STR);
    $insertUser->bindParam(':surname', $surname, PDO::PARAM_STR);
    $insertUser->bindParam(':other_name', $otherNames, PDO::PARAM_STR);
    $insertUser->bindParam(':contact_method', $chosenContact, PDO::PARAM_STR);
    $insertUser->bindParam(':email', $email, PDO::PARAM_STR);
    $insertUser->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $insertUser->bindParam(':landline', $dayTime, PDO::PARAM_STR);
    $insertUser->bindParam(':magazine', $magazine, PDO::PARAM_INT);
    $insertUser->bindParam(':street', $streetAddress, PDO::PARAM_STR);
    $insertUser->bindParam(':suburb', $suburbState, PDO::PARAM_STR);
    $insertUser->bindParam(':postcode', $postcode, PDO::PARAM_INT);
    $insertUser->bindParam(':username', $username, PDO::PARAM_STR);
    $insertUser->bindParam(':password', $password, PDO::PARAM_STR);
    $insertUser->bindParam(':occupation', $occupation, PDO::PARAM_STR);
    $insertUser->bindParam(':join_date', $joindate, PDO::PARAM_STR);

    // try insert user into database
    try {
        // insert user using prepared query
        $queryResult['succeeded'] = $insertUser->execute();
    }catch (PDOException $e) {
        // error message if failed to add to database (print message)
        $queryResult['error'] = $e->getMessage();
    }

    $db = null; // close database connection
    return $queryResult;
} // end createUser()