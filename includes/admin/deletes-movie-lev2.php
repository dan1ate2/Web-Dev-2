<?php
include_once ("includes/connectDB.php"); // database connection

function deleteMovie($movieId) {
    //Return value
    $queryResult['succeeded'] = false;
    $queryResult['error'] = '';
    
    $db = getDBConnection();
    $sqlDeleteMovie = $db->prepare("DELETE FROM `movie` WHERE `movie_id` = :ID");

    // sanitize/bind variable
    $sqlDeleteMovie->bindParam(':ID', $movieId, PDO::PARAM_STR);

    // try delete movie from database
    try {
        // delete movie using prepared query
        $queryResult['succeeded'] = $sqlDeleteMovie->execute();
    }catch (PDOException $e) {
        // error message if failed to delete from database (print message)
        $queryResult['error'] = $e->getMessage();
    }

    $db = null; // close database connection
    return $queryResult;
}