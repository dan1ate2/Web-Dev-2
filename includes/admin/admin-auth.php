<?php
// check if login authorised, then set variables
function authorisedAccess() {
	$loginStatus;
	$timeoutMinutes = 1;

	if (isset($_POST["admin-login"])) { // CHANGE THE PASSWORD METHOD TO DATABASE READ, MORE SECURE!!!!!!!!!!!!!!!!!!
		if (!empty($_POST["staff-name"]) && !empty($_POST["password"])) {
			if (validPass($_POST["password"])) {
				session_regenerate_id();
				$_SESSION["Name"] = htmlentities($_POST["staff-name"]);
				$_SESSION["Password"] = htmlentities($_POST["password"]);
				$_SESSION["LastActive"] = time();
				$loginStatus = "ok";
			}
			else {
				$loginStatus = "incorrect password";
			}
		}
		else {
			$loginStatus = "empty found";
		}
	}
	// else if a valid session exists
//	else if (validPass($_SESSION["Password"])) {
//		if (($_SESSION["LastActive"] - time()) / 60 > $timeoutMinutes) {
//			session_unset();
//			session_destroy();
//			$loginStatus = "timed out";
//		}
//		else {
//			$_SESSION["LastActive"] = time();
//			$loginStatus = "ok";
//		}
//	}
    else if (isset($_SESSION["Name"]) && isset($_SESSION["Password"])) {
    	$loginStatus = "timed out";
    }
	// else not a valid session
	else {
		$loginStatus = "new session";
	}
	return $loginStatus;
}

function validPass($pass) {
	$valid;
	if ($pass == "webdev2") {
		$valid = true;
	}
	else {
		$valid = false;
	}
	return $valid;
}