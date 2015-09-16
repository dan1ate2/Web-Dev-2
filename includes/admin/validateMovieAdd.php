<?php
include_once ("includes/connectDB.php"); // database connection
// validates add new movie form
function validateMovieAdd($formData) {
	// return values
	$validateResult['succeeded'] = false;
    $validateResult['error'] = '';

    // add movie form variables..variables..variables..
    $movieTitle = $formData["movie-title"];
    $movieTagline = $formData["movie-tagline"];
    $moviePlot = $formData["movie-plot"];
    $year = $formData["year"];
    $director = $formData["director"];
    $newDirector = $formData["new-director"];
    $studio = $formData["studio"];
    $newStudio = $formData["new-studio"];
    $genre = $formData["genre"];
    $newGenre = $formData["new-genre"];
    $classification = $formData["classification"];
    $newClassification = $formData["new-classification"];
    $star1 = $formData["star1"];
    $nStar1 = $formData["n-star1"];
    $star2 = $formData["star2"];
    $nStar2 = $formData["n-star2"];
    $star3 = $formData["star3"];
    $nStar3 = $formData["n-star3"];
    $coStar1 = $formData["co-star1"];
    $nCoStar1 = $formData["n-co-star1"];
    $coStar2 = $formData["co-star2"];
    $nCoStar2 = $formData["n-co-star2"];
    $coStar3 = $formData["co-star3"];
    $nCoStar3 = $formData["n-co-star3"];
    $rentalPeriod = $formData["rental-period"];
	$dvdRental = $formData["dvd-rental-price"];
	$dvdPurchase = $formData["dvd-purchase-price"];
	$dvdStock = $formData["dvd-stock"];
	$dvdRented = $formData["dvd-rented"];
	$blurayRental = $formData["bluray-rental"];
	$blurayPurchase = $formData["bluray-purchase"];
	$blurayStock = $formData["bluray-stock"];
	$blurayRented = $formData["bluray-rented"];

	$error = false;
	$nextValidation = 0;
	// while no errors go through validation functions
	while (!$error && $nextValidation < 10) {
		$nextValidation++;
		switch ($nextValidation) {
			// check if movie exists
			case 1:
				$validateResult['error'] = checkMovieExists($movieTitle, 
					$movieTagline, $moviePlot);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate year
			case 2:
				$validateResult['error'] = validateYear($year);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
			// validate director field
			case 3:
				$id = "or new Director";
				$validateResult['error'] = checkIfCharactersOnly($newDirector, $id);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate studio field
			case 4:
				$id = "or new Studio";
				$validateResult['error'] = checkIfCharactersOnly($newStudio, $id);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate genre field
			case 5:
				$id = "or new Genre";
				$validateResult['error'] = checkIfCharactersOnly($newGenre, $id);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate dvd price fields
			case 6:
				$movie = "DVD";
				$validateResult['error'] = validateMoviePrice($dvdRental, $dvdPurchase, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate bluray price fields
			case 7:
				$movie = "BluRay";
				$validateResult['error'] = validateMoviePrice($blurayRental, $blurayPurchase, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate dvd stock fields
			case 8:
				$movie = "DVD";
				$validateResult['error'] = validateMovieStock($dvdStock, $dvdRented, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate bluray stock fields
			case 9:
				$movie = "BluRay";
				$validateResult['error'] = validateMovieStock($blurayStock, $blurayRented, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// all good, passed validation
			case 10:
				$validateResult['succeeded'] = true;
				break;
			default:
				$validateResult['error'] = 'An unexpected validation error has occured. 
				Please contact the system administrator.';
				break;
		} // end switch
	} // end while
	return $validateResult;
} // end validateMovieAdd

// validates movie prices
function validateMoviePrice($rental, $purchase, $type) {
	$error = '';
	if (is_numeric($rental) && is_numeric($purchase)) {
		if (empty($rental) || $rental < 0) {
			$error = $type.' rental price cannot be empty, 0, or less than 0.';
		}
		else if (empty($purchase) || $purchase < 0) {
			$error = $type.' purchase price cannot be empty, 0, or less than 0.';
		}
		// if rental or purchase price doesn't match number format xx.xx
		else if ((!preg_match("/^[0-9]{1,2}(\.{1}[0-9]{1,2})?$/", $rental)) || 
			(!preg_match("/^[0-9]{1,2}(\.{1}[0-9]{1,2})?$/", $purchase))) {
			$error = $type.' rental and purchase price must both be in 2 digit format or 4 digit format with decimal seperating. E.g. "24" or "20.95"';
		}
	}
	else {
		$error = $type.' rental price and purchase price are required and must both be numeric.';
	}
	return $error;
} // end validateMoviePrice

// validates stock amount
function validateMovieStock($stock, $rented, $type) {
	$error = '';
	if (is_numeric($stock) && is_numeric($rented)) {
		if ($rented > $stock) {
			$error = $type.' rented quantity cannot be more than the stock quantity.';
		}
		else if ($stock < 0 || $rented < 0) {
			$error = $type.' stock and rented quantity cannot be less than 0.';
		}
		// if stock or rented quantity doesn't match 3 digits or less
		else if ((!preg_match("/^[0-9]{1,3}$/", $stock)) || 
			(!preg_match("/^[0-9]{1,3}$/", $rented))) { 
			$error = $type.' stock and rented quantity must be no more than 3 digits.';
		}
	}
	else {
		$error = $type.' stock and rented amounts must both be numeric.';
	}
	return $error;
} // end validateMovieStock

// check field has only chars in it
function checkIfCharactersOnly($fData, $fName) {
	$error = '';
	if (!ctype_alpha($fData)) {
		$error = '"'.$fName.'" field must have alphabetic characters only.';
	}
	return $error;
} // end checkIfCharactersOnly

// check if field is blank
function checkBlankField($fData, $fName) {
	$error = '';
	if (empty($field)) {
		$error = $fName.' field cannot be left empty. All fields are required.';
	}
	return $error;
}

// validates year field
function validateYear($y) {
	$error = '';
	if (!preg_match("/^(\d){4}$/", $y)) {
		$error = 'Year must be numeric and 4 digits only. Cannot be blank.';	
	}
	return $error;
}

// check if movie exists
function checkMovieExists($movieTitle, $movieTagline, $moviePlot) {
	include_once ("includes/connectDB.php");
	$db = getDBConnection();
	$error = '';
	try {
		$checkExists = $db->prepare("SELECT 
			(SELECT COUNT(*) FROM movie WHERE title = :title)
			+
			(SELECT COUNT(*) FROM movie WHERE tagline = :tagline)
			+
			(SELECT COUNT(*) FROM movie WHERE plot = :plot) AS matches");

	    $checkExists->bindParam(':title', $movieTitle, PDO::PARAM_STR);
	    $checkExists->bindParam(':tagline', $movieTagline, PDO::PARAM_STR);
	    $checkExists->bindParam(':plot', $moviePlot, PDO::PARAM_STR);
		$checkExists->execute();
		$result = $checkExists->fetchAll(PDO::FETCH_ASSOC);
		// print_r($result); // debug query
	} catch (PDOException $ex) {
    	echo "Error: " . $ex->getMessage() . "<br>";
	}
	// if matches are found then set error
	if ($result[0]['matches'] > 0) {
		$error = 'A match was found for the movie details you have entered. 
		Cannot have the same movie or details (title, tagline or plot) as another movie already in the system.';
	}
	return $error;
}