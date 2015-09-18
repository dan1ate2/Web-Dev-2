<?php
include_once ("connectDB.php"); // database connection

// adds new movie to database
function addMovie($formData, $directorStudioGenre) {
	//Return values
    $queryResult['succeeded'] = false;
    $queryResult['error'] = '';
    // $member_id = null; // auto increments in database

    // // database connection
    // $db = getDBConnection();
    
    // -- QUERY/UPDATE FOR DIRECTOR, STUDIO, GENRE TABLES --
    	// fieldInput = '';
    	// foreach ($directorStudioGenre as $field) {
    		// if doesn't exist/false (!$directorStudioGenre[$field][0])
    			// create new entry
    	// get id (for new movie table entry)
    		// query database: 
    		// if ($directorStudioGenre[$field][0] = 'Director') {
    			// $fieldInput = $formData['new-director']
			// }
    		// else if ($directorStudioGenre[$field][0] = 'Studio') {
    			// $fieldInput = $formData['new-studio']
			// }
        	// else if ($directorStudioGenre[$field][0] = 'Genre') {
    			// $fieldInput = $formData['new-genre']
			// }
    	// }

    // -- QUERY/UPDATE FOR MOVIE TABLE --
    // // set up query for movie table
    // $insertMovie = $db->prepare('INSERT into movie VALUES
    //                           (:member_id, :title, :tagline, :plot, :director_id, :studio_id, 
    //                           	:genre_id, :classification, :rental_period, :year, 
    //                           	:DVD_rental_price, :DVD_purchase_price, :numDVD, :numDVDout, 
    //                           	:BluRay_rental_price, :BluRay_purchase_price, :numBluRay, 
    //                           	:numBluRayOut)');
    // // sanitize data in PDO object
    // $insertMovie->bindParam(':member_id', $member_id, PDO::PARAM_STR);
    // $insertMovie->bindParam(':title', $formData[movie-title], PDO::PARAM_STR);
    // $insertMovie->bindParam(':tagline', $, PDO::PARAM_STR);
    // $insertMovie->bindParam(':plot', $, PDO::PARAM_STR);
    // $insertMovie->bindParam(':director_id', intval($), PDO::PARAM_INT);
    // $insertMovie->bindParam(':studio_id', intval($), PDO::PARAM_INT);
    // $insertMovie->bindParam(':genre_id', intval($), PDO::PARAM_INT);
    // $insertMovie->bindParam(':classification', $, PDO::PARAM_STR);
    // $insertMovie->bindParam(':rental_period', $, PDO::PARAM_STR);
    // $insertMovie->bindParam(':year', intval($), PDO::PARAM_INT);
    // $insertMovie->bindParam(':DVD_rental_price', floatval($), PDO::PARAM_INT);
    // $insertMovie->bindParam(':DVD_purchase_price', floatval($), PDO::PARAM_INT);
    // $insertMovie->bindParam(':numDVD', intval($), PDO::PARAM_INT);
    // $insertMovie->bindParam(':numDVDout', intval($), PDO::PARAM_INT);
    // $insertMovie->bindParam(':BluRay_rental_price', floatval($), PDO::PARAM_INT);
    // $insertMovie->bindParam(':BluRay_purchase_price', floatval($), PDO::PARAM_INT);
    // $insertMovie->bindParam(':numBluRay', intval($), PDO::PARAM_INT);
    // $insertMovie->bindParam(':numBluRayOut', intval($), PDO::PARAM_INT);
    // // add thumbpath !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    // // $insertMovie->bindParam(':', $, PDO::PARAM_STR);
    // // try insert user into database
    // try {
    //     // insert movie using prepared query
    //     $queryResult['succeeded'] = $insertMovie->execute();
    // }catch (PDOException $e) {
    //     // error message if failed to add to database (print message)
    //     $queryResult['error'] = $e->getMessage();
    // }

    // -- QUERY/UPDATE FOR MOVIE_ACTOR TABLE --

    // $db = null; // close database connection
    $queryResult['succeeded'] = false; // TESTING ONLY!!!!!!!!!!!!!!!!!!!
    return $queryResult;
}