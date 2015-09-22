<?php
// add requested movie to session
function addMovieToRenting($movieId) {
	// add movie to renting array in session variables if logged in user
	$error = '';
	if (isset($_SESSION["StaffName"]) || isset($_SESSION["Username"])) {
		if (!isset($_SESSION["MovieRenting"])) {
			$_SESSION["MovieRenting"] = array($movieId);
		}
		else {
			if (!findDuplicates($movieId)) {
				$_SESSION["MovieRenting"][] = $movieId;
			}
			else {
				$_SESSION["AddRentalMovieError"] = '<p class="error-text">You have already added this movie to your rentals.</p>';
			}
		}
	} // end if
} // end addMovieToRenting()

// search for duplicates
function findDuplicates($Id) {
	$duplicate = false;
	foreach ($_SESSION["MovieRenting"] as $row) {
		$rowId = intval($row);
		$Id = intval($Id);
		if ($rowId == $Id) {
			$duplicate = true;
		}
	}
	return $duplicate;
} // findDuplicate()