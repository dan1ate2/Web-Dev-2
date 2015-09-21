<?php 
// populate movies from database
function populateMovies($movieCriteria) {
	switch ($movieCriteria) {
		case "new release":
			// gets new release movies and prints them
			getNewRelease();
			break;
		default:
			break;
	}
} // end populateMovies()

// prints new release movies from db
function getNewRelease() {
	include_once ("includes/connectDB.php"); // database connection
	$db = getDBConnection(); // connect to db
	// query
	$sql= "SELECT movie.*, director.director_name, studio.studio_name, genre.genre_name  
	FROM movie 
	INNER JOIN director ON movie.director_id = director.director_id 
	INNER JOIN studio ON movie.studio_id = studio.studio_id  
	INNER JOIN genre ON movie.genre_id = genre.genre_id 
	WHERE rental_period='Overnight'";
	// query db for user/pass match
	$stmt = $db->prepare($sql);
	$stmt->execute();
	// result
	$result = $stmt->fetchAll();
	// var_dump($result); // debug query
	// print results
	printMovieResultsHTML($result);
	$db = null; // close db connection
} // end getNewRelease()

// print html blocks for each movie
function printMovieResultsHTML($queryArray) {
	$moviesToPrint = true;
	$divColumn = 1;
	while ($moviesToPrint) {
		foreach ($queryArray as $movie) {
			switch ($divColumn) {
				case 1:
					echo '<div class="fw-box">
						<div class="one-third-box">';
						printMovieDetails($movie);
					echo '</div>';
					break;
				case 2:
					echo '<div class="one-third-box">';
					printMovieDetails($movie);
					echo '</div>';
					break;
				case 3:
					echo '<div class="one-third-box">';
					printMovieDetails($movie);
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
function printMovieDetails($m) {
	$dvdAvail = intval($m[13]) - intval($m[14]);
	$blurayAvail = intval($m[17]) - intval($m[18]);
	echo '<h3 class="orange-text">'.$m[1].'</h3>
		<img src="images/movies/'.$m[4].'" alt="'.$m[1].'" width="102" height="150" 
		class="center-align">
		<p class="l-align-txt"><span class="orange-text">Tagline: </span>'.$m[2].'</p>
		<p class="l-align-txt"><span class="orange-text">Plot: </span>'.$m[3].'</p>
		<p class="l-align-txt"><span class="orange-text">Year: </span>'.$m[10].'</p>
		<p class="l-align-txt"><span class="orange-text">Director: </span>'.$m[19].'</p>
		<p class="l-align-txt"><span class="orange-text">Studio: </span>'.$m[20].'</p>
		<p class="l-align-txt"><span class="orange-text">Genre: </span>'.$m[21].'</p>
		<p class="l-align-txt"><span class="orange-text">Classification: </span>'.$m[8].'</p>
		<p class="l-align-txt"><span class="orange-text">Rental Period: </span>'.$m[9].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD Rental Price: </span>$'.$m[11].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD Purchase Price: </span>$'.$m[12].'</p>
		<p class="l-align-txt"><span class="orange-text">DVD\'s Available: </span>'.$dvdAvail.'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Rental Price: </span>$'.$m[15].'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Purchase Price: </span>$'.$m[16].'</p>
		<p class="l-align-txt"><span class="orange-text">BluRay\'s Available: </span>'.$blurayAvail.'</p>';
}