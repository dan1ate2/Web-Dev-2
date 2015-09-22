<?php
// get random new release movie from database
function randomNewRelease() {
	include_once ("includes/connectDB.php");
	$db = getDBConnection(); // db connection
	// get movies from db
	$sql = "SELECT title, tagline, plot, thumbpath FROM movie 
	WHERE rental_period = 'Overnight'
	ORDER BY RAND() LIMIT 1";
	// query db for directors that match
	$stmt = $db->prepare($sql);
	$stmt->execute();
	// result
	$result = $stmt->fetchAll();
	// var_dump($result); // debug query
	$db = null; // close db connection
	printHtml($result); // print it
}

// print the html result of the query
function printHtml($movie) {
	echo '<h3 class="orange-text">'.$movie[0][0].'</h3>
		<a href="moviezone.php" target="_self"><img src="images/movies/'.$movie[0][3].'" alt="'.$movie[0][0].'" width="102" height="150" class="center-align"></a>
		<p><span class="orange-text"><i>'.$movie[0][1].'</i></span></p>
		<p>'.$movie[0][2].'</p>';
}