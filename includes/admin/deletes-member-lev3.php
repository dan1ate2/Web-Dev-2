<?php
include_once ("includes/connectDB.php"); // database connection

function deleteMember($memberId) {
    //Return value
    $queryResult['succeeded'] = false;
    $queryResult['error'] = '';
    
    $db = getDBConnection();
    $sqlDeleteUser = $db->prepare("DELETE FROM `member` WHERE `member_id` = :ID");

    // sanitize/bind variables
    // must use intval() or treated as string and adds surrounding hyphens
    $sqlDeleteUser->bindValue(':ID', intval($memberId), PDO::PARAM_INT);

    // try delete user from database
    try {
        // delete user using prepared query
        $queryResult['succeeded'] = $sqlDeleteUser->execute();
    }catch (PDOException $e) {
        // error message if failed to delete from database (print message)
        $queryResult['error'] = $e->getMessage();
    }

    $db = null; // close database connection
    return $queryResult;
}