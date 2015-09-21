<form name="get-genre" id ="shop-search" action="moviezone.php" method="get">
	<br><br>
	<label>Search movies by genre</label>
	<select name="genre" id="genre">
		<?php populateGenreDropdown() ?>
	</select><br><br>
	<div class="form-buttons">
		<input type="submit" name="query" value="Search Movies">
	</div>
</form>

<?php
// get genres from database and put in dropdown
function populateGenreDropdown() {
	include_once ("includes/connectDB.php");
	$db = getDBConnection(); // db connection
	// get actors from db
	$sql = "SELECT * FROM genre	ORDER BY genre_name";
	// populate dropdown
	foreach ($db->query($sql) as $row) {
		echo '<option value="'.$row["genre_name"].'">'.$row["genre_name"].'</option>';
	}
	$db = null;
}