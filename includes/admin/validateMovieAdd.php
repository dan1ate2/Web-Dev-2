<?php
include_once ("includes/connectDB.php"); // database connection
// validates add new movie form
function validateMovieAdd($formData) {
	// return values
	$validateResult['succeeded'] = false;
    $validateResult['error'] = '';

	// put form data into 2 dimensional array
	$m = array(
		/*0*/array("Movie Title",$formData["movie-title"]),
		/*1*/array("Movie Tagline",$formData["movie-tagline"]),
		/*2*/array("Movie Plot",$formData["movie-plot"]),
		/*3*/array("Year",$formData["year"]),
		/*4*/array("Director",$formData["director"]),
		/*5*/array("or new Director",$formData["new-director"]),
		/*6*/array("Studio",$formData["studio"]),
		/*7*/array("or new Studio",$formData["new-studio"]),
		/*8*/array("Genre",$formData["genre"]),
		/*9*/array("or new Genre",$formData["new-genre"]),
		/*10*/array("Classification",$formData["classification"]),
		/*11*/array("or new Classification",$formData["new-classification"]),
		/*12*/array("First Star",$formData["star1"]),
		/*13*/array("or new First Star",$formData["n-star1"]),
		/*14*/array("Second Star",$formData["star2"]),
		/*15*/array("or new Second Star",$formData["n-star2"]),
		/*16*/array("Third Star",$formData["star3"]),
		/*17*/array("or new Third Star",$formData["n-star3"]),
		/*18*/array("First Co Star",$formData["co-star1"]),
		/*19*/array("or new First Co Star",$formData["n-co-star1"]),
		/*20*/array("Second Co Star",$formData["co-star2"]),
		/*21*/array("or new Second Co Star",$formData["n-co-star2"]),
		/*22*/array("Third Co Star",$formData["co-star3"]),
		/*23*/array("or new Third Co Star",$formData["n-co-star3"]),
		/*24*/array("Rental Period",$formData["rental-period"]),
		/*25*/array("Rental Price (DVD)",$formData["dvd-rental-price"]),
		/*26*/array("Purchase Price (DVD)",$formData["dvd-purchase-price"]),
		/*27*/array("Stock (DVD)",$formData["dvd-stock"]),
		/*28*/array("Currently Rented (DVD)",$formData["dvd-rented"]),
		/*29*/array("Rental Price (BluRay)",$formData["bluray-rental"]),
		/*30*/array("Purchase Price (BluRay)",$formData["bluray-purchase"]),
		/*31*/array("Stock (BluRay)",$formData["bluray-stock"]), //31
		/*32*/array("Currently Rented (BluRay)",$formData["bluray-rented"])
		);
	print_r($m); // debug array

	$error = false;
	$nextValidation = 0;
	// while no errors go through validation functions
	while (!$error && $nextValidation < 12) {
		$nextValidation++;
		switch ($nextValidation) {
			// check if movie exists (by title, tagline, plot)
			case 1:
				$validateResult['error'] = checkMovieExists($m[0][1], 
					$m[1][1], $m[2][1]);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// check if movie, tagline and plot fields are blank
			case 2:
			$fieldArrayNum = 0
				while (empty($validateResult['error']) && $fieldArrayNum < 3) {
					checkBlankField($m[$fieldArrayNum]);
					if (!empty($validateResult['error'])) {
						$error = true;
					}
					$fieldArrayNum++;
				}
				break;
			// validate year
			case 3:
				$validateResult['error'] = validateYear($m[3][1]);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate dropdown/new field pairs
			/* validates director, studio, genre, classification and
				1st/2nd/3rd star and co-star fields */
			case 4:
				$validateResult['error'] = validateDropdownAndNew($m[4], $m[5]);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate studio fields
			case 5:
				$validateResult['error'] = validateDropdownAndNew($m[6], $m[7]);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate genre fields
			case 6:
				$validateResult['error'] = validateDropdownAndNew($m[8], $m[9]);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate classification fields
			case 7:
				$validateResult['error'] = validateDropdownAndNew($m[10], $m[11]);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				// check if one field is chosen or other has data
				break;
			// validate dvd price fields
			case 8:
				$movie = "DVD";
				$validateResult['error'] = validateMoviePrice($m[25][1], $m[26][1], $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// // validate dvd stock fields
			case 9:
				$movie = "DVD";
				$validateResult['error'] = validateMovieStock($m[27][1], $m[28][1], $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate bluray price fields
			case 10:
				$movie = "BluRay";
				$validateResult['error'] = validateMoviePrice($m[29][1], $m[30][1], $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate bluray stock fields
			case 11:
				$movie = "BluRay";
				$validateResult['error'] = validateMovieStock($m[31][1], $m[32][1], $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// all good, passed validation
			case 12:
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
	// if rental and purchase prices numeric
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
	// if stock and rented quantity is numeric
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

// validate new or existing option field pair for a given option/input
// ie if no director chosen and no new director given, error
function validateDropdownAndNew($existingDropdown, $newData) {
	$error = '';
	// if an option selected
	if (!empty($existingDropdown[1]) xor !empty($newData[1])) {
		// if new field chosen
		if (!empty($newData[1])) {
			checkIfCharactersOnly($newData);
		}
	}
	// if both options, error
	else if (!empty($existingDropdown[1]) && !empty($newData[1])) {
		$error = 'Cannot have "'.$existingDropdown[0].'" dropdown option selected while 
			there is text added to the "'.$newData[0].'" field also.';
	}
	// else no option, error
	else {
		$error = 'No option selected for "'.$existingDropdown[0].'" and "'.$newData[0].'" fields.';
	}
	return $error;
}

// check if field is blank
function checkBlankField($fDataArray) {
	$error = '';
	if (empty($fDataArray[1])) {
		$error = $fDataArray[0].' field cannot be left empty. All fields are required.';
	}
	return $error;
}

// check field has only chars in it
function checkIfCharactersOnly($fDataArray) {
	$error = '';
	if (!ctype_alpha($fDataArray[1])) {
		$error = '"'.$fDataArray[0].'" field must have alphabetic characters only.';
	}
	return $error;
} // end checkIfCharactersOnly