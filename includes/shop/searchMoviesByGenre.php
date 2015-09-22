<?php
// search for movies by chosen genre
function searchMoviesByGenre($genreName) {
	include_once ("includes/connectDB.php");
	$db = getDBConnection(); // db connection
	// get movies from db
	$sql = "SELECT genre.*, director.director_name, 
	studio.studio_name, movie.* 
	FROM genre 
	INNER JOIN movie ON genre.genre_id = movie.genre_id 
	INNER JOIN director ON movie.director_id = director.director_id 
	INNER JOIN studio ON movie.studio_id = studio.studio_id 
	WHERE genre.genre_name = '$genreName' 
	ORDER BY movie.title";
	// query db for directors that match
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
		printGenreMovieResults($result);
	}
	$db = null; // close db connection
}

// print html blocks for each movie
function printGenreMovieResults($queryArray) {
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
	$dvdAvail = intval($m[17]) - intval($m[18]); // dvd stock level - rented
	$blurayAvail = intval($m[21]) - intval($m[22]); // bluray stock level - rented
	
	// print details
	echo '<h3 class="orange-text">'.$m[5].'</h3>
		<img src="images/movies/'.$m[8].'" alt="'.$m[5].'" width="102" height="150" 
		class="center-align">';
	// add rent button if logged in user. attach movie id for queries
	if ($rentButton) {
		echo '<form name="movie-request" id ="shop-search" action="moviezone.php" 
			method="get">
			<div class="form-buttons">
			<input type="hidden" name="movie-id" value="'.$m[4].'">
			<input type="submit" name="movie-request" value="Rent Me">
			</div>
			</form>';
	}
	echo '<p class="l-align-txt"><span class="orange-text">Tagline: </span>'.$m[6].'</p>
		<p class="l-align-txt"><span class="orange-text">Plot: </span>'.$m[7].'</p>
		<p class="l-align-txt"><span class="orange-text">Year: </span>'.$m[14].'</p>
		<p class="l-align-txt"><span class="orange-text">Director: </span>'.$m[2].'</p>
		<p class="l-align-txt"><span class="orange-text">Studio: </span>'.$m[3].'</p>
		<p class="l-align-txt"><span class="orange-text">Genre: </span>'.$m[1].'</p>
		<p class="l-align-txt"><span class="orange-text">Classification: </span>'.$m[12].'</p>
		<p class="l-align-txt"><span class="orange-text">Rental Period: </span>'.$m[13].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD Rental Price: </span>$'.$m[15].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD Purchase Price: </span>$'.$m[16].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD\'s Available: </span>'.$dvdAvail.'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Rental Price: </span>$'.$m[19].'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Purchase Price: </span>$'.$m[20].'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Available: </span>'.$blurayAvail.'</p>';
} // end printHtml()