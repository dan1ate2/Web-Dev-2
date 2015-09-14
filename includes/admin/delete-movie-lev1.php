<form name="select-movie" id ="select-movie" action="admin.php" method="post">
	<label>Movie</label>
	<select name="movie-list" id="movie-list">
		<?php populateMovieDropdown() ?>
	</select><br><br>
	<div class="form-buttons">
		<input type="submit" name="level-2-request" value="Movie Details">
	</div>
</form>

<?php
	function populateMovieDropdown() {
		include_once ("includes/connectDB.php");
		$db = getDBConnection();
		$sql = "SELECT movie_id, title, year FROM movie order by title";
		
		foreach ($db->query($sql) as $row) {
			echo '<option value="'.$row["movie_id"].'">'.$row["title"].' - '.$row["year"].'</option>';
		}
		$db = null;
	}