<?php 
// prints current cart count from session data
function printCurrentCartSummary() {
	// count number of movies in session array ($_SESSION["MovieRenting"])
	if (isset($_SESSION["MovieRenting"])) {
		$movieCount = count($_SESSION["MovieRenting"]);
		// display message (plural if more than 1)
		if ($movieCount < 2) {
			$errorMessage = checkDuplicateError();
			if (!empty($errorMessage)) {
				echo $errorMessage;
			}
			echo '<p>'.$movieCount.' movie selected.</p>';
		}
		else {
			$errorMessage = checkDuplicateError();
			if (!empty($errorMessage)) {
				echo $errorMessage;
			}
			echo '<p>'.$movieCount.' movies selected.</p>';
		}
		// var_dump($_SESSION["MovieRenting"]); // debug array
	}
}

// check for duplicate error
function checkDuplicateError() {
	$error = '';
	// if duplicate found when adding movie, print error
	if (isset($_SESSION["AddRentalMovieError"])) {
		$error = $_SESSION["AddRentalMovieError"];
		unset($_SESSION["AddRentalMovieError"]); // no longer needed, destroy it
	}
	return $error;
}