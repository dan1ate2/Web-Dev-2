<?php 
	$movData = getMovieData($_POST["movie-list"]);
?>
<form name="show-movie-details" id ="show-movie-details" action="admin.php" method="post">
	<label for="movie-id">Movie ID</label>
	<input type="text" name="movie-id" id="movie-id" title="Movie ID" value="<?php echo $movData[0]['movie_id'] ?>" readonly><br>
	<label for="movie-title">Movie Title</label>
	<input type="text" name="movie-title" id="movie-title" title="Movie title" value="<?php echo $movData[0]['title'] ?>" readonly><br>
	<label for="movie-tagline" class="textarea-margin">Movie Tagline</label>
	<textarea name="movie-tagline" class="textarea-margin" id="movie-tagline" title="Movie tagline" rows="6" cols="39" readonly><?php echo $movData[0]['tagline'] ?></textarea>
	<label for="movie-plot" class="textarea-margin">Movie Plot</label>
	<textarea name="movie-plot" class="textarea-margin" id="movie-plot" title="Movie plot" rows="6" cols="39" readonly><?php echo $movData[0]['plot'] ?></textarea>
	<label for="year">Year</label>
	<input type="text" name="year" id="year" title="Year" value="<?php echo $movData[0]['year'] ?>" readonly><br>
	<label for="genre">Genre</label>
	<input type="text" name="genre" id="genre" title="Genre" value="<?php echo $movData[0]['genre'] ?>" readonly><br>
	
	<div class="form-buttons">
		<input type="submit" name="level-3-request" value="Edit Movie">
	</div>
</form>

<?php
function getMovieData($movie) {
	include_once ("includes/connectDB.php");
	$db = getDBConnection();
	$movData;
	try {
		// $sql = $db->prepare("SELECT m.movie_id, 
		// 	m.title, 
		// 	m.tagline, 
		// 	m.plot, 
		// 	m.year,
		// 	g.genre_name 
		// 	FROM movie m 
		// 	INNER JOIN genre g ON m.genre_id = g.genre_id 
		// 	WHERE m.movie_id = :movie");
		$sql = $db->prepare("SELECT * FROM movie_detail_view");
		$sql->bindValue(':movie', intval($movie), PDO::PARAM_INT); // sanitizes data
		$sql->execute();
		$movData = $sql->fetchAll(PDO::FETCH_ASSOC);
		// print_r($movData); // TESTING ONLY, REMOVE WHEN DONE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	} catch (PDOException $ex) {
    	echo "Error: " . $ex->getMessage() . "<br>";
	}
	return $movData;
}