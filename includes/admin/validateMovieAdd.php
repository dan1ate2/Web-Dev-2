<?php
include_once ("includes/connectDB.php"); // database connection
// validates add new movie form
function validateMovieAdd($formData) {
	// return values
	$validateResult['succeeded'] = false;
    $validateResult['error'] = '';

    // add movie form variables..variables..variables..
 //    $movieTitle = $formData["movie-title"];
 //    $movieTagline = $formData["movie-tagline"];
 //    $moviePlot = $formData["movie-plot"];
 //    $year = $formData["year"];
 //    $director = $formData["director"];
 //    $newDirector = $formData["new-director"];
 //    $studio = $formData["studio"];
 //    $newStudio = $formData["new-studio"];
 //    $genre = $formData["genre"];
 //    $newGenre = $formData["new-genre"];
 //    $classification = $formData["classification"];
 //    $newClassification = $formData["new-classification"];
 //    $star1 = $formData["star1"];
 //    $nStar1 = $formData["n-star1"];
 //    $star2 = $formData["star2"];
 //    $nStar2 = $formData["n-star2"];
 //    $star3 = $formData["star3"];
 //    $nStar3 = $formData["n-star3"];
 //    $coStar1 = $formData["co-star1"];
 //    $nCoStar1 = $formData["n-co-star1"];
 //    $coStar2 = $formData["co-star2"];
 //    $nCoStar2 = $formData["n-co-star2"];
 //    $coStar3 = $formData["co-star3"];
 //    $nCoStar3 = $formData["n-co-star3"];
 //    $rentalPeriod = $formData["rental-period"];
	// $dvdRental = $formData["dvd-rental-price"];
	// $dvdPurchase = $formData["dvd-purchase-price"];
	// $dvdStock = $formData["dvd-stock"];
	// $dvdRented = $formData["dvd-rented"];
	// $blurayRental = $formData["bluray-rental"];
	// $blurayPurchase = $formData["bluray-purchase"];
	// $blurayStock = $formData["bluray-stock"];
	// $blurayRented = $formData["bluray-rented"];

	// put form data into 2 dimensional array
	$m = array(
		/*0*/array("Movie Title"=>"Movie Title",$formData["movie-title"]),
		/*1*/array("Movie Tagline"=>"Movie Tagline",$formData["movie-tagline"]),
		/*2*/array("Movie Plot"=>"Movie Plot",$formData["movie-plot"]),
		/*3*/array("Year"=>"Year",$formData["year"]),
		/*4*/array("Director"=>"Director",$formData["director"]),
		/*5*/array("or new Director"=>"or new Director",$formData["new-director"]),
		/*6*/array("Studio"=>"Studio",$formData["studio"]),
		/*7*/array("or new Studio"=>"or new Studio",$formData["new-studio"]),
		/*8*/array("Genre"=>"Genre",$formData["genre"]),
		/*9*/array("or new Genre"=>"or new Genre",$formData["new-genre"]),
		/*10*/array("Classification"=>"Classification",$formData["classification"]),
		/*11*/array("or new Classification"=>"or new Classification",$formData["new-classification"]),
		/*12*/array("First Star"=>"First Star",$formData["star1"]),
		/*13*/array("or new First Star"=>"or new First Star",$formData["n-star1"]),
		/*14*/array("Second Star"=>"Second Star",$formData["star2"]),
		/*15*/array("or new Second Star"=>"or new Second Star",$formData["n-star2"]),
		/*16*/array("Third Star"=>"Third Star",$formData["star3"]),
		/*17*/array("or new Third Star"=>"or new Third Star",$formData["n-star3"]),
		/*18*/array("First Co Star"=>"First Co Star",$formData["co-star1"]),
		/*19*/array("or new First Co Star"=>"or new First Co Star",$formData["n-co-star1"]),
		/*20*/array("Second Co Star"=>"Second Co Star",$formData["co-star2"]),
		/*21*/array("or new Second Co Star"=>"or new Second Co Star",$formData["n-co-star2"]),
		/*22*/array("Third Co Star"=>"Third Co Star",$formData["co-star3"]),
		/*23*/array("or new Third Co Star"=>"or new Third Co Star",$formData["n-co-star3"]),
		/*24*/array("Rental Period"=>"Rental Period",$formData["rental-period"]),
		/*25*/array("Rental Price (DVD)"=>"Rental Price (DVD)",$formData["dvd-rental-price"]),
		/*26*/array("Purchase Price (DVD)"=>"Purchase Price (DVD)",$formData["dvd-purchase-price"]),
		/*27*/array("Stock (DVD)"=>"Stock (DVD)",$formData["dvd-stock"]),
		/*28*/array("Currently Rented (DVD)"=>"Currently Rented (DVD)",$formData["dvd-rented"]),
		/*29*/array("Rental Price (BluRay)"=>"Rental Price (BluRay)",$formData["bluray-rental"]),
		/*30*/array("Purchase Price (BluRay)"=>"Purchase Price (BluRay)",$formData["bluray-purchase"]),
		/*31*/array("Stock (BluRay)"=>"Stock (BluRay)",$formData["bluray-stock"]), //31
		/*32*/array("Currently Rented (BluRay)"=>"Currently Rented (BluRay)",$formData["bluray-rented"])
		);
	print_r($m); // debug array

	$error = false;
	$nextValidation = 0;
	// while no errors go through validation functions
	while (!$error && $nextValidation < 3) {
		$nextValidation++;
		switch ($nextValidation) {
			// check if movie exists (by title, tagline, plot)
			case 1:
				$validateResult['error'] = checkMovieExists($m[0][0], 
					$m[1][0], $m[2][0]);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate year
			case 2:
				$validateResult['error'] = validateYear($m[3][0]);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				break;
			// validate director fields
			case 3:
				$validateResult['error'] = validateNewOrExistingOption($m[4], $m[5]);
				if (!empty($validateResult['error'])) {
					$error = true;
				}
				// check if one field is chosen or other has data
				break;
			// // validate studio fields
			// case 4:
			// 	$validateResult['error'] = checkIfCharactersOnly($m[7]);
			// 	if (!empty($validateResult['error'])) {
			// 		$error = true;
			// 	}
			// 	// check if one field is chosen or other has data
			// 	break;
			// // validate genre fields
			// case 5:
			// 	$validateResult['error'] = checkIfCharactersOnly($m[9]);
			// 	if (!empty($validateResult['error'])) {
			// 		$error = true;
			// 	}
			// 	// check if one field is chosen or other has data
			// 	break;
			// // validate dvd price fields
			// case 6:
			// 	$movie = "DVD";
			// 	$validateResult['error'] = validateMoviePrice($m[25]['Rental Price (DVD)'][0], $m[0]['Purchase Price'][0], $movie);
			// 	if (!empty($validateResult['error'])) {
			// 		$error = true;
			// 	}
			// 	break;
			// // validate bluray price fields
			// case 7:
			// 	$movie = "BluRay";
			// 	$validateResult['error'] = validateMoviePrice($m[29]['Rental Price (BluRay)'][0], $m[30]['Purchase Price (BluRay)'][0], $movie);
			// 	if (!empty($validateResult['error'])) {
			// 		$error = true;
			// 	}
			// 	break;
			// // validate dvd stock fields
			// case 8:
			// 	$movie = "DVD";
			// 	$validateResult['error'] = validateMovieStock($m[27]['Stock (DVD)'][0], $m[28]['Currently Rented (DVD)'][0], $movie);
			// 	if (!empty($validateResult['error'])) {
			// 		$error = true;
			// 	}
			// 	break;
			// // validate bluray stock fields
			// case 9:
			// 	$movie = "BluRay";
			// 	$validateResult['error'] = validateMovieStock($m[31]['Stock (BluRay)'][0], $m[32]['Currently Rented (BluRay)'][0], $movie);
			// 	if (!empty($validateResult['error'])) {
			// 		$error = true;
			// 	}
			// 	break;
			// all good, passed validation
			case 3:
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
function validateNewOrExistingOption($existingArray, $newArray) {
	$error = '';
	$tempExistingArray = array_values($existingArray); // reset array indexes REMOVE IF NOT USING ASSOCIATIVE ARRAY!!!
	$tempNewArray = array_values($newArray); // reset array indexes REMOVE IF NOT USING ASSOCIATIVE ARRAY!!!
	// if an option selected
	if (!empty($tempExistingArray[1]) || !empty($tempNewArray[1])) {
		// if both options, error
		// else if exist chosen
		// else new chosen	
	}
	// else no option, error
	else {
		$error = 'No option selected for "'.$tempExistingArray[0].'" and "'.$tempNewArray[0].'" fields.';
	}
	return $error;
}









// check if field is blank
function checkBlankField($fDataArray) {
	$error = '';
	if (empty($field)) {
		$error = $fName.' field cannot be left empty. All fields are required.';
	}
	return $error;
}

// check field has only chars in it
function checkIfCharactersOnly($fDataArray) {
	$error = '';
	$fData = array_values($fData); // reset array indexes REMOVE IF NOT USING ASSOCIATIVE ARRAY!!!
	print_r($fData);

	if (!ctype_alpha($fData[1])) {
		$error = '"'.$fData[0].'" field must have alphabetic characters only.';
	}
	return $error;
} // end checkIfCharactersOnly