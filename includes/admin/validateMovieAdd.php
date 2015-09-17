<?php
include_once ("includes/connectDB.php"); // database connection
// validates add new movie form
function validateMovieAdd($formData) {
	// return values
	$validateResult['succeeded'] = false;
    $validateResult['error'] = '';

	// put form data into 2 dimensional array
	// legend: form field name, form data, database field, database table??
	$m = array(
		/*0*/array("Movie Title",$formData["movie-title"],"title",),
		/*1*/array("Movie Tagline",$formData["movie-tagline"],"tagline"),
		/*2*/array("Movie Plot",$formData["movie-plot"],"plot"),
		/*3*/array("Year",$formData["year"],"year"),
		/*4*/array("Director",$formData["director"],"director_name"),
		/*5*/array("or new Director",$formData["new-director"],"director_name"),
		/*6*/array("Studio",$formData["studio"],"studio_name"),
		/*7*/array("or new Studio",$formData["new-studio"],"studio_name"),
		/*8*/array("Genre",$formData["genre"],"genre_name"),
		/*9*/array("or new Genre",$formData["new-genre"],"genre_name"),
		/*10*/array("Classification",$formData["classification"],"classification"),
		/*11*/array("or new Classification",$formData["new-classification"],"classification"),
		/*12*/array("First Star",$formData["star1"],""),
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
		/*31*/array("Stock (BluRay)",$formData["bluray-stock"]),
		/*32*/array("Currently Rented (BluRay)",$formData["bluray-rented"])
		);
	// print_r($m); // debug array

	$error = false;
	$nextValidation = 0;
	// while no errors go through validation functions
	while (!$error && $nextValidation < 8) {
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
			$fieldArrayNum = 0;
				while (empty($validateResult['error']) && $fieldArrayNum < 3) {
					$validateResult['error'] = checkBlankField($m[$fieldArrayNum]);
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
			// validate dropdown/new field pairs ie ('director' & 'or new Director')
			/* validates director, studio, genre, classification and
				1st/2nd/3rd star and co-star field pairs */
			case 4:
				$fieldPairs = array(
					array(4, 5), // director
					array(6, 7), // studio
					array(8, 9), // genre
					array(10, 11), // classification
					array(12, 13), // first star
					array(14, 15), // second star
					array(16, 17), // third star
					array(18, 19), // first co star
					array(20, 21), // second co star
					array(22, 23) // third co star
					);
				foreach($fieldPairs as $pair) {
					if (empty($validateResult['error'])) {
						$validateResult['error'] = validateDropdownAndNew($m[$pair[0]], $m[$pair[1]]);
					}
					else {
						$error = true;
						break;
					}
				}
				break;
			// validate rental period
			case 5:
				$validateResult['error'] = validateRentalPeriod($m[24][1]);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate dvd price and stock fields
			case 6:
				$movie = "DVD";
				// validate prices
				$validateResult['error'] = validateMoviePrice($m[25][1], $m[26][1], $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				// validate stock/rented
				if (!$error) {
					$validateResult['error'] = validateMovieStock($m[27][1], $m[28][1], $movie);
					if (!empty($validateResult['error'])) {
						$error = true;
					}
				}
				break;
			// validate bluray price and stock fields
			case 7:
				$movie = "BluRay";
				// validate prices
				$validateResult['error'] = validateMoviePrice($m[29][1], $m[30][1], $movie);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				// validate stock/rented
				if (!$error) {
					$validateResult['error'] = validateMovieStock($m[31][1], $m[32][1], $movie);
					if (!empty($validateResult['error'])) {
						$error = true;
					}
				}
				break;
			// all good, passed validation
			case 8:
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
		$error = 'Year field must be numeric and 4 digits only. Cannot be blank.';	
	}
	return $error;
} // end validateYear

// check if movie exists
function checkMovieExists($movieTitle, $movieTagline, $moviePlot) {
	$db = getDBConnection();
	$error = '';
	try {
		$checkExists = $db->prepare("SELECT 
			(SELECT COUNT(*) FROM movie WHERE title = :title)
			+
			(SELECT COUNT(*) FROM movie WHERE tagline = :tagline)
			+
			(SELECT COUNT(*) FROM movie WHERE plot = :plot) AS matches");
		// sanitize data
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
			Cannot have the same movie or details (title, tagline or plot) as another movie
			already in the system.';
	}
	return $error;
} // end checkMovieExists

// validate new or existing option field pair for a given option/input
// ie if no director chosen and no new director given, error
function validateDropdownAndNew($existingDropdownArr, $newDataArr) {
	$error = '';
	// if an option selected
	if (!empty($existingDropdownArr[1]) xor !empty($newDataArr[1])) {
		// if new field chosen
		if (!empty($newDataArr[1])) {
			if (checkIfDataExists($newDataArr)) {
				$error = '"'.$newDataArr[0].'" field must be unique, but matches another in the
					 system. Please use the dropdown and select the entry from there.';
			}
		}
	}
	// if both options, error
	else if (!empty($existingDropdownArr[1]) && !empty($newDataArr[1])) {
		$error = 'Cannot have "'.$existingDropdownArr[0].'" dropdown option selected while 
			there is text added to the "'.$newDataArr[0].'" field also.';
	}
	return $error;
} // end validateDropdownAndNew

// checks database for a match of the field data to prevent duplicates
function checkIfDataExists($fieldArr) {
	$db = getDBConnection();
	$error = false;
	// work out which field and table to query

	// database query
	try {
		// prepare query
		$checkExists = $db->prepare("SELECT COUNT(*) 
			FROM :databaseTable 
			WHERE :databaseField = :userInput 
			AS matches");
		// sanitize/bind data
	    $checkExists->bindParam(':userInput', $fieldArr[1], PDO::PARAM_STR);
	    $checkExists->bindParam(':', $, PDO::PARAM_STR);
	    $checkExists->bindParam(':', $, PDO::PARAM_STR);
		// execute query
		$checkExists->execute();
		// get results
		$result = $checkExists->fetchAll(PDO::FETCH_ASSOC);
		// print_r($result); // debug query
	} catch (PDOException $ex) {
    	echo "Error: " . $ex->getMessage() . "<br>";
	}
	// if match found then flag error
	if ($result[0]['matches'] > 0) {
		$error = true;
	}
	return $error;
}

// check if field is blank
function checkBlankField($fDataArr) {
	$error = '';
	if (empty($fDataArr[1])) {
		$error = $fDataArr[0].' field cannot be left empty.';
	}
	return $error;
} // end checkBlankField

// validate rental period dropdown
function validateRentalPeriod($period) {
	$error = '';
	if (empty($period)) {
		$error = 'You must select a rental period for the movie.';
	}
	return $error;
} // end validateRentalPeriod