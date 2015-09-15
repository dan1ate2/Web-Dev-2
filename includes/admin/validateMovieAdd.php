<?php
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
	while (!$error && $nextValidation < 9) {
		$nextValidation++;
		switch ($nextValidation) {
			// check if movie exists
			case 1:

				break;
			// validate director field
			case 2:
				$id = "or new Director";
				checkIfCharactersOnly($newDirector, $id);
				break;
			// validate studio field
			case 3:
				$id = "or new Studio";
				checkIfCharactersOnly($newStudio, $id);
				break;
			// validate genre field
			case 4:
				$id = "or new Genre";
				checkIfCharactersOnly($newGenre, $id);
				break;
			// validate dvd price fields
			case 5:
				$movie = "DVD";
				$validateResult['error'] = validateMoviePrice($dvdRental, $dvdPurchase, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate bluray price fields
			case 6:
				$movie = "BluRay";
				$validateResult['error'] = validateMoviePrice($blurayRental, $blurayPurchase, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate dvd stock fields
			case 7:
				$movie = "DVD";
				$validateResult['error'] = validateMovieStock($dvdStock, $dvdRented, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate bluray stock fields
			case 8:
				$movie = "BluRay";
				$validateResult['error'] = validateMovieStock($blurayStock, $blurayRented, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// all good, passed validation
			case 9:
				$validateResult['succeeded'] = true;
				break;
			default:
				$validateResult['error'] = 'An unexpected validation error has occured. 
				Please contact the system administrator.';
				break;
		} // end switch
	} // end while
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

// director validation (chars)
function checkIfCharactersOnly($fData, $fName) {
	$error = '';
	if (!ctype_alpha($fData)) {
		$error = '"'.$fName.'" field must have alphabetic characters only.';
	}
	return $error;
} // end checkIfCharactersOnly