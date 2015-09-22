<form name="get-classification" id ="shop-search" action="moviezone.php" method="get">
	<br><br>
	<label>Search movies by classification</label>
	<select name="classification" id="classification">
		<?php populateClassificationDropdown() ?>
	</select><br><br>
	<div class="form-buttons">
		<input type="submit" name="query" value="Search Movies">
	</div>
</form>

<?php
// get classification from database and put in dropdown
function populateClassificationDropdown() {
	include_once ("includes/connectDB.php");
	$db = getDBConnection();
	// get classification from db
	$sql = "SELECT classification FROM movie
	GROUP BY classification 
	ORDER BY classification";
	// populate dropdown
	foreach ($db->query($sql) as $row) {
		echo '<option value="'.$row["classification"].'">'.$row["classification"].'</option>';
	}
	$db = null;
}