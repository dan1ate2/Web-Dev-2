<?php
// search for movies by chosen actor
function searchMoviesByGenre($genreName) {
	include_once ("includes/connectDB.php");
	$db = getDBConnection(); // db connection
	// get actors from db
	$sql = "SELECT genre.*, director.director_name, 
	studio.studio_name, movie.* 
	FROM genre 
	INNER JOIN movie ON genre.genre_id = movie.genre_id 
	INNER JOIN director ON movie.director_id = director.director_id 
	INNER JOIN studio ON movie.studio_id = studio.studio_id 
	WHERE genre.genre_name = '$genreName' 
	ORDER BY movie.title";
	// query db for user/pass match
	$stmt = $db->prepare($sql);
	$stmt->execute();
	// result
	$result = $stmt->fetchAll();
	var_dump($result); // debug query
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
	$divColumn = 1;
	while ($moviesToPrint) {
		foreach ($queryArray as $movie) {
			switch ($divColumn) {
				case 1:
					echo '<div class="fw-box">
						<div class="one-third-box">';
						printGenreHtml($movie);
					echo '</div>';
					break;
				case 2:
					echo '<div class="one-third-box">';
					printGenreHtml($movie);
					echo '</div>';
					break;
				case 3:
					echo '<div class="one-third-box">';
					printGenreHtml($movie);
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
function printGenreHtml($m) {
	$dvdAvail = intval($m[18]) - intval($m[19]); // dvd stock level - rented
	$blurayAvail = intval($m[22]) - intval($m[23]); // bluray stock level - rented
	
	// print details
	echo '<h3 class="orange-text">'.$m[6].'</h3>
		<img src="images/movies/'.$m[9].'" alt="'.$m[6].'" width="102" height="150" 
		class="center-align">
		<p class="l-align-txt"><span class="orange-text">Tagline: </span>'.$m[7].'</p>
		<p class="l-align-txt"><span class="orange-text">Plot: </span>'.$m[8].'</p>
		<p class="l-align-txt"><span class="orange-text">Year: </span>'.$m[15].'</p>
		<p class="l-align-txt"><span class="orange-text">Director: </span>'.$m[2].'</p>
		<p class="l-align-txt"><span class="orange-text">Studio: </span>'.$m[3].'</p>
		<p class="l-align-txt"><span class="orange-text">Genre: </span>'.$m[4].'</p>
		<p class="l-align-txt"><span class="orange-text">Classification: </span>'.$m[13].'</p>
		<p class="l-align-txt"><span class="orange-text">Rental Period: </span>'.$m[14].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD Rental Price: </span>$'.$m[16].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD Purchase Price: </span>$'.$m[17].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD\'s Available: </span>'.$dvdAvail.'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Rental Price: </span>$'.$m[20].'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Purchase Price: </span>$'.$m[21].'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Available: </span>'.$blurayAvail.'</p>';
} // end printGenreHtml()