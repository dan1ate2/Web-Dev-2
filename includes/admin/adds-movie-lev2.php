<?php
include_once ("includes/connectDB.php"); // database connection

// adds new movie to database
function addMovie($formData, $directorStudioGenre) {
	// return values
    $queryResult['succeeded'] = false;
    $queryResult['error'] = '';
    
    // -- QUERY/UPDATE FOR DIRECTOR, STUDIO, GENRE TABLES --
	// figure out field type and if database entry exists already
    $loopCount = 0;
	foreach ($directorStudioGenre as $fields) {
        // try insert into database if new field
        try {
            $loopCount++;
            $_SESSION['loopCount'][] = $loopCount;
            $_SESSION['loops'][] = $fields;
            $db = getDBConnection(); // database connection
            $newID = null; // auto increment in database
            $newNameInput = ''; // field input
            $table = $fields[1]; // table to query/update
            // identify table to update and find data to update with
            if ($table == 'director') {
                $newNameInput = $formData['new-director'];
            } 
            else if ($table == 'studio') {
                $newNameInput = $formData['new-studio'];
            } 
            else if ($table == 'genre') {
                $newNameInput = $formData['new-genre'];
            }
            $_SESSION['beforeFirstSwitch'][] = $table;
            $_SESSION['beforeFirstSwitch'][] = $newNameInput;
            // new entry (false if existing field already exists in db)
            if ($fields[0] && !empty($newNameInput)) {
                // set up query
                switch ($table) {
                    case 'director':
                        $insertNew = $db->prepare('INSERT into director 
                            VALUES (:id, :newNameInput)');
                        break;
                    case 'studio':
                        $insertNew = $db->prepare('INSERT into studio 
                            VALUES (:id, :newNameInput)');
                        break;
                    case 'genre':
                        $insertNew = $db->prepare('INSERT into genre 
                            VALUES (:id, :newNameInput)');
                        break;
                    default:
                        break;
                }
                // sanitize data in PDO object
                $insertNew->bindParam(':id', $newID, PDO::PARAM_STR);
                $insertNew->bindParam(':newNameInput', $newNameInput, PDO::PARAM_STR);
                // insert using prepared query
                $queryResult['succeeded'] = $insertNew->execute();
                $_SESSION['firstQuery'][] = $insertNew;
            } // end if
        } // end try
        catch (PDOException $e) {
            // error message if failed to add to database (print message)
            $queryResult['error'] = $e->getMessage();
        }
        // query database (get ID) if no previous error
        if ($queryResult['error'] == '') {
            // try query database
            try {
                // set up query
                switch ($table) {
                    case 'director':
                        $queryId = $db->prepare('SELECT director_id 
                            FROM director 
                            WHERE director_name = :name');
                        break;
                    case 'studio':
                        $queryId = $db->prepare('SELECT studio_id 
                            FROM studio 
                            WHERE studio_name = :name');
                        break;
                    case 'genre':
                        $queryId = $db->prepare('SELECT genre_id 
                            FROM genre 
                            WHERE genre_name = :name');
                        break;
                    default:
                        break;
                }
                // sanitize data in PDO object
                $queryId->bindParam(':name', $newNameInput, PDO::PARAM_STR);
                $queryResult['succeeded'] = $queryId->execute();
                // get results
                $tableID = $queryId->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['table'][] = $tableID; // testing !!!!!!
                $_SESSION['secondQuery'][] = $queryId;
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