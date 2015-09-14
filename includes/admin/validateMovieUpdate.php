<?php
// validates update movie form
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