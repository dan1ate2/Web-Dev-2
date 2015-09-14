<?php
include_once ("includes/connectDB.php"); // database connection

function editMovie($formData) {
    //Return value
    $queryResult['succeeded'] = false;
    $queryResult['error'] = '';

    $movieId = $formData['movie-id'];
	$dvdRental = $formData["dvd-rental-price"];
	$dvdPurchase = $formData["dvd-purchase-price"];
	$dvdStock = $formData["dvd-stock"];
	$dvdRented = $formData["dvd-rented"];
	$blurayRental = $formData["bluray-rental"];
	$blurayPurchase = $formData["bluray-purchase"];
	$blurayStock = $formData["bluray-stock"];
	$blurayRented = $formData["bluray-rented"];

    $db = getDBConnection(); // database connection
    // sql query
    $sqlDeleteMovie = $db->prepare("UPDATE movie 
    	SET DVD_rental_price = :dvdRental, 
    	DVD_purchase_price = :dvdPurchase, 
    	numDVD = :dvdStock, 
    	numDVDout = :dvdRented, 
    	BluRay_rental_price = :blurayRental, 
    	BluRay_purchase_price = :blurayPurchase, 
    	numBluRay = :blurayStock, 
    	numBluRayOut = :blurayRented 
    	WHERE movie_id = :ID");
    
    // sanitize/bind variables
    $sqlDeleteMovie->bindValue(':ID', intval($movieId), PDO::PARAM_INT);
    $sqlDeleteMovie->bindValue(':dvdRental', $dvdRental, PDO::PARAM_STR);
    $sqlDeleteMovie->bindValue(':dvdPurchase', $dvdPurchase, PDO::PARAM_STR);
    $sqlDeleteMovie->bindValue(':dvdStock', intval($dvdStock), PDO::PARAM_INT);
    $sqlDeleteMovie->bindValue(':dvdRented', intval($dvdRented), PDO::PARAM_INT);
    $sqlDeleteMovie->bindValue(':blurayRental', $blurayRental, PDO::PARAM_STR);
    $sqlDeleteMovie->bindValue(':blurayPurchase', $blurayPurchase, PDO::PARAM_STR);
    $sqlDeleteMovie->bindValue(':blurayStock', intval($blurayStock), PDO::PARAM_INT);
    $sqlDeleteMovie->bindValue(':blurayRented', intval($blurayRented), PDO::PARAM_INT);

    // try update in database
    try {
        $queryResult['succeeded'] = $sqlDeleteMovie->execute();
    }catch (PDOException $e) {
        // error message if failed
        $queryResult['error'] = $e->getMessage();
    }

    $db = null; // close database connection
    return $queryResult;
}