<?php
include_once ("includes/connectDB.php"); // database connection

// adds new movie to database
function addMovie($formData, $directorStudioGenre) {
	// return values
    $queryResult['succeeded'] = false;
    $queryResult['error'] = '';
    
    // -- QUERY/UPDATE FOR DIRECTOR, STUDIO, GENRE TABLES --
	// figure out field type and if database entry exists already
	foreach ($directorStudioGenre as $fields) {
        // try insert into database if new field
        try {
            $db = getDBConnection(); // database connection
            $newID = null; // auto increment in database
            $newNameInput = '';
            $newNameInput = $formData['new-director'];
            $column = $fields[1];
            $idColumn = $fields[3];
            // identify table to update
            if ($fields[2] = 'director') {
                $newNameInput = $formData['new-director'];
            } 
            else if ($fields[2] = 'studio') {
                $newNameInput = $formData['new-studio'];
            } 
            else if ($fields[2] = 'genre') {
                $newNameInput = $formData['new-genre'];
            }
            // new entry (false if existing field found in database in earlier validation)
            if (!$fields[0]) {
                // set up query
                $table = $fields[2];
                $insertNew = $db->prepare('INSERT into $table 
                    VALUES (:id, :newNameInput)');
                // sanitize data in PDO object
                $insertNew->bindParam(':id', $newID, PDO::PARAM_STR);
                $insertNew->bindParam(':newNameInput', $newNameInput, PDO::PARAM_STR);
                // insert movie using prepared query
                $queryResult['succeeded'] = $insertNew->execute();
                echo var_dump($queryResult);
                } // end if
            } // end try
            catch (PDOException $e) {
                // error message if failed to add to database (print message)
                $queryResult['error'] = $e->getMessage();
            }
        
        // query database (get ID) if no previous error
        if ($queryResult['error'] = '') {
            // try query database
            try {
                // set up query
                $queryNew = $db->prepare('SELECT $idColumn 
                    FROM $table 
                    WHERE $column = :name');
                // sanitize data in PDO object
                $queryNew->bindParam(':name', $newNameInput, PDO::PARAM_STR);
                $queryResult['succeeded'] = $queryNew->execute();
                // get results
                $queryID = $queryNew->fetchAll(PDO::FETCH_ASSOC);
                echo var_dump($queryID);
            } 
            catch (PDOException $e) {
                // error message if failed query (print message)
                $queryResult['error'] = $e->getMessage();
            }
        } // end if
        $db = null; // close db connection
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
    return $queryResult;
}