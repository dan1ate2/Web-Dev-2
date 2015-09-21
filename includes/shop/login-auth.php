<?php
// function for authorise a user login
function memberAccess() {
	$loginStatus = '';
	$timeoutMinutes = 20;
	// if valid member login create new session
	if (isset($_POST["user-login"])) {
		if (!empty($_POST["username"]) && !empty($_POST["password"])) {
			if (validUserPass($_POST["username"], $_POST["password"])) {
				session_regenerate_id();
				$_SESSION["Username"] = htmlentities($_POST["username"]);
				$_SESSION["Password"] = htmlentities($_POST["password"]);
				$_SESSION["LastActive"] = time();
				$loginStatus = "ok";
			}
			else {
				$loginStatus = "incorrect login";
			}
		}
		else {
			$loginStatus = "empty found";
		}
	}
	// else if a valid member session exists
    else if (isset($_SESSION["Username"]) && isset($_SESSION["Password"])) {
    	if (validUserPass($_SESSION["Username"], $_SESSION["Password"])) {
			$inactivityMinutes = time() - $_SESSION["LastActive"];
			$inactivityMinutes /= 60;
			
			if ($inactivityMinutes > $timeoutMinutes) {
				session_unset();
				session_destroy();
				$loginStatus = "timed out";
			}
			else {
				$_SESSION["LastActive"] = time();
				$loginStatus = "ok";
			}
    	}
    }
    // else if admin already logged in
    else if (isset($_SESSION["StaffName"])) {
    	$loginStatus = "admin logged in";
    }
	// else not a valid session
	else {
		$loginStatus = "new session";
	}
	return $loginStatus;
} // end memberAccess

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