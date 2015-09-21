<form name="get-actors" id ="shop-search" action="moviezone.php" method="get">
	<br><br>
	<label>Search movies by actor</label>
	<select name="actor" id="actor">
		<?php populateActorsDropdown() ?>
	</select><br><br>
	<div class="form-buttons">
		<input type="submit" name="query" value="Search Movies">
	</div>
</form>

<?php
// get actors from database and put in dropdown
function populateActorsDropdown() {
	include_once ("includes/connectDB.php");
	$db = getDBConnection(); // db connection
	// get actors from db
	$sql = "SELECT * FROM actor	ORDER BY actor_name";
	// populate dropdown
	foreach ($db->query($sql) as $row) {
		echo '<option value="'.$row["actor_name"].'">'.$row["actor_name"].'</option>';
	}
	$db = null;
}