<?php
// search for movies by chosen classification
function searchMoviesByClassification($classification) {
	include_once ("includes/connectDB.php");
	$db = getDBConnection(); // db connection
	// get movies from db
	$sql = "SELECT movie.*, genre.genre_name, 
	studio.studio_name, director.director_name
	FROM movie 
	INNER JOIN director ON movie.director_id = director.director_id 
	INNER JOIN genre ON movie.genre_id = genre.genre_id 
	INNER JOIN studio ON movie.studio_id = studio.studio_id 
	WHERE movie.classification = '$classification' 
	ORDER BY movie.title";
	// query db for classification match
	$stmt = $db->prepare($sql);
	$stmt->execute();
	// result
	$result = $stmt->fetchAll();
	// var_dump($result); // debug query
	// count matches, don't trigger print function if none found
	$matches = count($result);
	if (empty($matches)) {
		echo '<br><p class="error-text">No results for '.$genreName.' were found.</p><br>';
	}
	else {
		// print results
		printClassificationMovieResults($result);
	}
	$db = null; // close db connection
}

// print html blocks for each movie
function printClassificationMovieResults($queryArray) {
	$moviesToPrint = true;
	// check if a member or admin (for rent button)
	$loggedIn = false;
	if (isset($_SESSION["Username"]) || isset($_SESSION["StaffName"])) {
		$loggedIn = true;
	}
	$divColumn = 1;
	while ($moviesToPrint) {
		foreach ($queryArray as $movie) {
			switch ($divColumn) {
				case 1:
					echo '<div class="fw-box">
						<div class="one-third-box">';
						printHtml($movie, $loggedIn);
					echo '</div>';
					break;
				case 2:
					echo '<div class="one-third-box">';
					printHtml($movie, $loggedIn);
					echo '</div>';
					break;
				case 3:
					echo '<div class="one-third-box">';
					printHtml($movie, $loggedIn);
					echo '</div>
						</div>
						<div class="clear"></div>';
					break;
				default:
					break;
			}
			if ($divColumn >= 3) {
				$divColumn = 1;
			}
			else {
				$divColumn++;
			}
		} // end foreach
		$moviesToPrint = false;
	} // end while
	// check to see if any more html/closing tags needed
	if ($divColumn <= 3 && $divColumn != 1) {
		echo '</div>
			<div class="clear"></div>';
	}
} // end printMovieResultHTML()

// prints movie details in HTML
function printHtml($m, $rentButton) {
	$dvdAvail = intval($m[13]) - intval($m[14]); // dvd stock level - rented
	$blurayAvail = intval($m[17]) - intval($m[18]); // bluray stock level - rented
	
	// print details
	echo '<h3 class="orange-text">'.$m[1].'</h3>
		<img src="images/movies/'.$m[4].'" alt="'.$m[1].'" width="102" height="150" 
		class="center-align">';
	// add rent button if logged in user. attach movie id for queries
	if ($rentButton) {
		echo '<form name="movie-request" id ="shop-search" action="moviezone.php" 
			method="get">
			<div class="form-buttons">
			<input type="hidden" name="movie-id" value="'.$m[0].'">
			<input type="submit" name="movie-request" value="Rent Me">
			</div>
			</form>';
	}
	echo '<p class="l-align-txt"><span class="orange-text">Tagline: </span>'.$m[2].'</p>
		<p class="l-align-txt"><span class="orange-text">Plot: </span>'.$m[3].'</p>
		<p class="l-align-txt"><span class="orange-text">Year: </span>'.$m[10].'</p>
		<p class="l-align-txt"><span class="orange-text">Director: </span>'.$m[21].'</p>
		<p class="l-align-txt"><span class="orange-text">Studio: </span>'.$m[20].'</p>
		<p class="l-align-txt"><span class="orange-text">Genre: </span>'.$m[19].'</p>
		<p class="l-align-txt"><span class="orange-text">Classification: </span>'.$m[8].'</p>
		<p class="l-align-txt"><span class="orange-text">Rental Period: </span>'.$m[9].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD Rental Price: </span>$'.$m[11].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD Purchase Price: </span>$'.$m[12].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD\'s Available: </span>'.$dvdAvail.'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Rental Price: </span>$'.$m[15].'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Purchase Price: </span>$'.$m[16].'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Available: </span>'.$blurayAvail.'</p>';
} // end printHtml()