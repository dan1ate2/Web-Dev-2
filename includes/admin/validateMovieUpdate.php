<?php
// validates update movie form fields
function validateMovieUpdate($formData) {
	// return values
	$validateResult['succeeded'] = false;
    $validateResult['error'] = '';

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
	while (!$error && $nextValidation < 5) {
		$nextValidation++;
		switch ($nextValidation) {
			// validate dvd prices
			case 1:
				$movie = "DVD";
				$validateResult['error'] = validateMoviePrice($dvdRental, $dvdPurchase, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate bluray prices
			case 2:
				$movie = "BluRay";
				$validateResult['error'] = validateMoviePrice($blurayRental, $blurayPurchase, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate dvd stock
			case 3:
				$movie = "DVD";
				$validateResult['error'] = validateMovieStock($dvdStock, $dvdRented, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate bluray stock
			case 4:
				$movie = "BluRay";
				$validateResult['error'] = validateMovieStock($blurayStock, $blurayRented, $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// all good, passed validation
			case 5:
				$validateResult['succeeded'] = true;
				break;
			default:
				$validateResult['error'] = 'An unexpected validation error has occured. 
				Please contact the system administrator.';
				break;
		} // end switch
	} // end while
	return $validateResult;
} // end validateMovieUpdate

// validates movie prices
function validateMoviePrice($rental, $purchase, $type) {
	$error = '';
	if (is_numeric($rental) && is_numeric($purchase)) {
		if (empty($rental) || $rental < 0) {
			$error = $type.' rental price cannot be empty, 0, or less than 0.';
		}
		if (empty($purchase) || $purchase < 0) {
			$error = $type.' purchase price cannot be empty, 0, or less than 0.';
		}
	}
	else {
		$error = $type.' rental price and purchase price must both be numeric.';
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
			$error = $type.' stock or rented quantity cannot be less than 0.';
		}
	}
	else {
		$error = $type.' stock and rented amounts must both be numeric.';
	}
	return $error;
} // end validateMovieStock