<?php
include_once ("connectDB.php"); // database connection

// adds new movie to database
function addMovie($formData, $directorStudioGenre) {
	// return values
    $queryResult['succeeded'] = false;
    $queryResult['error'] = '';
    // member_id for query
    
    // -- QUERY/UPDATE FOR DIRECTOR, STUDIO, GENRE TABLES --
	// figure out field type and if database entry exists already
	foreach ($directorStudioGenre as $fields) {
        $director_id = null; // auto increments in database
        $nameToInput = '';
        // identify table to update
        if ($fields[2] = 'director') {
            $nameToInput = $formData['new-director'];
        } 
        else if ($fields[2] = 'studio') {
            $nameToInput = $formData['new-studio'];
        } 
        else if ($fields[2] = 'genre') {
            $nameToInput = $formData['new-genre'];
        }
        // new entry (if no existing field found in database in earlier validation)
        if (!$fields[0]) {
            // create new entry
            $id = null; // auto increment in database
            $db = getDBConnection(); // database connection
            // set up query
            $insertNew = $db->prepare('INSERT into :table
		    	VALUES (:id, :name)');
            // sanitize data in PDO object
            $insertNew->bindParam(':id', intval($id), PDO::PARAM_INT);
            $insertNew->bindParam(':name', $nameToInput, PDO::PARAM_STR);
            $insertNew->bindParam(':table', $fields[2], PDO::PARAM_STR);
            // try insert director into database
            try {
                // insert movie using prepared query
                $queryResult['succeeded'] = $insertNew->execute();
            } catch (PDOException $e) {
                // error message if failed to add to database (print message)
                $queryResult['error'] = $e->getMessage();

            }
            $db = null; // close db connection
        
        // query database (get ID)

        } // end if
    } // end foreach

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
    $queryResult['succeeded'] = true; // TESTING ONLY!!!!!!!!!!!!!!!!!!!
    return $queryResult;
}