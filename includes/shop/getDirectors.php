<form name="get-director" id ="shop-search" action="moviezone.php" method="get">
	<br><br>
	<label>Search movies by director</label>
	<select name="director" id="director">
		<?php populateDirectorDropdown() ?>
	</select><br><br>
	<div class="form-buttons">
		<input type="submit" name="query" value="Search Movies">
	</div>
</form>

<?php
// get directors from database and put in dropdown
function populateDirectorDropdown() {
	include_once ("includes/connectDB.php");
	$db = getDBConnection();
	// get directors from db
	$sql = "SELECT director_id, director_name FROM director order by director_name";
	// populate dropdown
	foreach ($db->query($sql) as $row) {
		echo '<option value="'.$row["director_name"].'">'.$row["director_name"].'</option>';
	}
	$db = null;
}