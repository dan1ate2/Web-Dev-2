<?php
// check the session for authorisation and timeout
function checkSession() {
	$loginStatus = '';
	$timeoutMinutes = 20; // minutes before timeout
	// check if user
	if (isset($_SESSION["Username"]) && isset($_SESSION["Password"])) {
    	if (validUserPass($_SESSION["Username"], $_SESSION["Password"])) {
			$inactivityMinutes = time() - $_SESSION["LastActive"];
			$inactivityMinutes /= 60;
			// check inactivity, log out if more than timeout minutes
			if ($inactivityMinutes > $timeoutMinutes) {
				session_unset();
				session_destroy();
				$loginStatus = "timed out";
			}
			else {
				$_SESSION["LastActive"] = time();
				$loginStatus = "member";
			}
    	}
    } // end if session[user]
    // else if admin
    else if (isset($_SESSION["StaffName"]) && isset($_SESSION["Password"])) {
    	if (validAdminPass($_SESSION["Password"])) {
			$inactivityMinutes = time() - $_SESSION["LastActive"];
			$inactivityMinutes /= 60;
			// check inactivity, log out if more than timeout minutes
			if ($inactivityMinutes > $timeoutMinutes) {
				session_unset();
				session_destroy();
				$loginStatus = "timed out";
			}
			else {
				$_SESSION["LastActive"] = time();
				$loginStatus = "admin";
			}
    	}
    } // end elseif session[admin]
    else {
    	$loginStatus = "none";
    }
    return $loginStatus;
} // end checkSession()

// check if username and password match in db
function validUserPass($user, $pass) {
	include_once ("includes/connectDB.php"); // database connection
	$db = getDBConnection(); // connect to db
	$valid = false; // not authorised until db check
	// query
	$sql= "SELECT * FROM member 
	WHERE username='$user' 
	AND password='$pass'";
	// query db for user/pass match
	$stmt = $db->prepare($sql);
	$stmt->execute();
	// result
	$result = $stmt->fetchAll();
	$total = count($result);
	// if valid result then authorised
	if ($total > 0) {
		$valid = true;
	}
	$db = null; // close db connection
	return $valid;
} // end validUserPass

// check admin password
function validAdminPass($pass) {
	$valid;
	if ($pass == "webdev2") {
		$valid = true;
	}
	else {
		$valid = false;
	}
	return $valid;
}