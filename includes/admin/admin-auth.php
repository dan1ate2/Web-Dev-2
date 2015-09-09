<?php
// check if login authorised, then set variables
function authorisedAccess() {
	$loginStatus;
	$timeoutMinutes = 20;

	if (isset($_POST["admin-login"])) { // CHANGE THE PASSWORD METHOD TO DATABASE READ, MORE SECURE!!!!!!!!!!!!!!!!!!
		if (!empty($_POST["staff-name"]) && !empty($_POST["password"])) {
			if (validAdminPass($_POST["password"])) {
				session_regenerate_id();
				$_SESSION["StaffName"] = htmlentities($_POST["staff-name"]);
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
    else if (isset($_SESSION["StaffName"]) && isset($_SESSION["Password"])) {
    	if (validAdminPass($_SESSION["Password"])) {
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
	// else not a valid session
	else {
		$loginStatus = "new session";
	}
	return $loginStatus;
}

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