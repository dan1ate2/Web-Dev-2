<form name="add-movie" id="add-movie" action="admin.php" method="post">
	<fieldset id="movie-details">
		<legend>Movie Details</legend>
		<label for="movie-title">Movie Title</label>
		<input type="text" name="movie-title" id="movie-title" title="Movie Title" maxlength="45"><br>
		<label for="movie-tagline" class="textarea-margin-label">Movie Tagline</label>
		<textarea name="movie-tagline" class="textarea-margin black-text" id="movie-tagline" title="Movie tagline" rows="6" cols="32" maxlength="128"></textarea>
		<label for="movie-plot" class="textarea-margin-label">Movie Plot</label>
		<textarea name="movie-plot" class="textarea-margin black-text" id="movie-plot" title="Movie plot" rows="6" cols="32" maxlength="256"></textarea>
		<label for="year">Year</label>
		<input type="text" name="year" id="year" title="Year" maxlength="4"><br><br>
		<label for="director">Director</label>
		<select name="director" id="director">
			<option value="" selected="selected"></option>
			<?php populateDirectorsDropdown() ?>
		</select><br>
		<label for="new-director">or new Director</label>
		<input type="text" name="new-director" id="new-director" title="New Director" maxlength="128"><br><br>
		<label for="studio">Studio</label>
		<select name="studio" id="studio">
			<option value="" selected="selected"></option>
			<?php populateStudioDropdown() ?>
		</select><br>
		<label for="new-studio">or new Studio</label>
		<input type="text" name="new-studio" id="new-studio" title="New Studio" maxlength="128"><br><br>
		<label for="genre">Genre</label>
		<select name="genre" id="genre">
			<option value="" selected="selected"></option>
			<?php populateGenreDropdown() ?>
		</select><br>
		<label for="new-genre">or new Genre</label>
		<input type="text" name="new-genre" id="new-genre" title="New Genre" maxlength="128"><br><br>
		<label for="classification">Classification</label>
		<select name="classification" id="classification">
			<option value="" selected="selected"></option>
			<?php populateClassificationDropdown() ?>
		</select><br>
		<label for="new-classification">or new Classification</label>
		<input type="text" name="new-classification" id="new-classification" title="New Classification" maxlength="128"><br><br>
		<fieldset id="actors">
			<legend>Movie Stars/Actors</legend>
			<label for="star1">First Star</label>
			<select name="star1" id="star1">
				<option value="" selected="selected"></option>
				<?php populateStarCoStarDropdown() ?>
			</select><br>
			<label for="n-star1">or new First Star</label>
			<input type="text" name="n-star1" id="n-star1" title="New Star 1"><br><br>
			<label for="star2">Second Star</label>
			<select name="star2" id="star2">
				<option value="" selected="selected"></option>
				<?php populateStarCoStarDropdown() ?>
			</select><br>
			<label for="n-star2">or new Second Star</label>
			<input type="text" name="n-star2" id="n-star2" title="New Star 2"><br><br>
			<label for="star3">Third Star</label>
			<select name="star3" id="star3">
				<option value="" selected="selected"></option>
				<?php populateStarCoStarDropdown() ?>
			</select><br>
			<label for="n-star3">or new Third Star</label>
			<input type="text" name="n-star3" id="n-star3" title="New Star 3"><br><br>
			<label for="co-star1">First Co Star</label>
			<select name="co-star1" id="co-star1">
				<option value="" selected="selected"></option>
				<?php populateStarCoStarDropdown() ?>
			</select><br>
			<label for="n-co-star1">or new First Co Star</label>
			<input type="text" name="n-co-star1" id="n-co-star1" title="New Co Star 1"><br><br>
			<label for="co-star2">Second Co Star</label>
			<select name="co-star2" id="co-star2">
				<option value="" selected="selected"></option>
				<?php populateStarCoStarDropdown() ?>
			</select><br>
			<label for="n-co-star2">or new Second Co Star</label>
			<input type="text" name="n-co-star2" id="n-co-star2" title="New Co Star 2"><br><br>
			<label for="co-star3">Third Co Star</label>
			<select name="co-star3" id="co-star3">
				<option value="" selected="selected"></option>
				<?php populateStarCoStarDropdown() ?>
			</select><br>
			<label for="n-co-star3">or new Third Co Star</label>
			<input type="text" name="n-co-star3" id="n-co-star3" title="New Co Star 3"><br><br>
		</fieldset>
	</fieldset>
	<!-- movie stock details (editable fields) -->
	<fieldset id="movie-stock">
		<legend>Stock Info</legend>
		<label for="rental-period">Rental Period</label>
		<select name="rental-period" id="rental-period">
			<option value="" selected="selected"></option>
			<?php populateRentalDropdown($movData) ?>
		</select><br>
		<fieldset id="DVD">
			<legend>DVD</legend>
			<label for="dvd-rental-price">Rental Price</label>
			<input type="text" name="dvd-rental-price" id="dvd-rental-price" title="DVD Rental Price"><br>
			<label for="dvd-purchase-price">Purchase Price</label>
			<input type="text" name="dvd-purchase-price" id="dvd-purchase-price" title="DVD Purchase Price"><br><br>
			<label for="dvd-stock">Stock</label>
			<input type="text" name="dvd-stock" id="dvd-stock" title="DVD Stock"><br>
			<label for="dvd-rented">Currently Rented</label>
			<input type="text" name="dvd-rented" id="dvd-rented" title="DVD Currently Rented"><br>
		</fieldset>
		<fieldset id="BluRay">
			<legend>BluRay</legend>
			<label for="bluray-rental">Rental Price</label>
			<input type="text" name="bluray-rental" id="bluray-rental" title="BluRay Rental Price"><br>
			<label for="bluray-purchase">Purchase Price</label>
			<input type="text" name="bluray-purchase" id="bluray-purchase" title="BluRay Purchase Price"><br><br>
			<label for="bluray-stock">Stock</label>
			<input type="text" name="bluray-stock" id="bluray-stock" title="BluRay Stock"><br>
			<label for="bluray-rented">Currently Rented</label>
			<input type="text" name="bluray-rented" id="bluray-rented" title="BluRay Currently Rented"><br>
		</fieldset>
	</fieldset>
	<fieldset id="image">
		<legend>Movie image thumbnail</legend>
		<label for="thumbpath">Image Name</label>
		<input type="text" name="thumbpath" id="thumbpath" title="Thumbpath" maxlength="40">
		<p class="error-text"><i>Temporary fix until upload feature added</i></p>
	</fieldset>

	<div class="form-buttons">
		<input type="submit" name="level-2-request" value="Add Movie">
	</div>
</form>

<?php
// populates the directors dropdown
function populateDirectorsDropdown() {
	include_once ("includes/connectDB.php");
	$db = getDBConnection();
	$sql = "SELECT director_id, director_name FROM director order by director_name";
	
	foreach ($db->query($sql) as $row) {
		echo '<option value="'.$row["director_id"].'">'.$row["director_name"].'</option>';
	}
	$db = null;
}

// populates the studio dropdown
function populateStudioDropdown() {
	include_once ("includes/connectDB.php");
	$db = getDBConnection();
	$sql = "SELECT studio_id, studio_name FROM studio order by studio_name";
	
	foreach ($db->query($sql) as $row) {
		echo '<option value="'.$row["studio_id"].'">'.$row["studio_name"].'</option>';
	}
	$db = null;
}

// populates genre dropdown
function populateGenreDropdown() {
	include_once ("includes/connectDB.php");
	$db = getDBConnection();
	$sql = "SELECT genre_id, genre_name FROM genre order by genre_name";
	
	foreach ($db->query($sql) as $row) {
		echo '<option value="'.$row["genre_id"].'">'.$row["genre_name"].'</option>';
	}
	$db = null;
}

// populates classification dropdown
function populateClassificationDropdown() {
	$classifications = array(G, PG, M, MA, R);
	
	foreach ($classifications as $c) {
		echo '<option value="'.$c.'">'.$c.'</option>';
	}
}

// populates star/co-star dropdowns
function populateStarCoStarDropdown() {
	include_once ("includes/connectDB.php");
	$db = getDBConnection();
	$sql = "SELECT actor_id, actor_name FROM actor order by actor_name";
	foreach ($db->query($sql) as $row) {
		echo '<option value="'.$row["actor_id"].'">'.$row["actor_name"].'</option>';
	}
	$db = null;
}

// get rental options from queried data and populate dropdown
function populateRentalDropdown($mData) {
	if ($mData[0]['rental_period'] != "Weekly") {
		echo '<option value="Weekly">Weekly</option>';
	}
	if ($mData[0]['rental_period'] != "3 Day") {
		echo '<option value="3 Day">3 Day</option>';
	}
	if ($mData[0]['rental_period'] != "Overnight") {
		echo '<option value="Overnight">Overnight</option>';
	}
}