<?php 
	$movData = getMovieData($_POST["movie-list"]);
?>
<form name="show-movie-details" id ="show-movie-details" action="admin.php" method="post">
	<!-- movie summary details -->
	<fieldset id="movie-info">
		<legend>Movie Info</legend>
		<label for="movie-id">Movie ID</label>
		<input type="text" name="movie-id" id="movie-id" title="Movie ID" value="<?php echo $movData[0]['movie_id'] ?>" class="grey-text" readonly><br>
		<label for="movie-title">Movie Title</label>
		<input type="text" name="movie-title" id="movie-title" title="Movie title" value="<?php echo $movData[0]['title'] ?>" class="grey-text" readonly><br>
		<label for="movie-tagline" class="textarea-margin-label">Movie Tagline</label>
		<textarea name="movie-tagline" class="textarea-margin" id="movie-tagline" title="Movie tagline" rows="6" cols="39" readonly><?php echo $movData[0]['tagline'] ?></textarea>
		<label for="movie-plot" class="textarea-margin-label">Movie Plot</label>
		<div class="grey-text">
		<textarea name="movie-plot" class="textarea-margin" id="movie-plot" title="Movie plot" rows="6" cols="39" readonly><?php echo $movData[0]['plot'] ?></textarea>
	</div>
		<label for="year">Year</label>
		<input type="text" name="year" id="year" title="Year" value="<?php echo $movData[0]['year'] ?>" class="grey-text" readonly><br>
		<label for="genre">Genre</label>
		<input type="text" name="genre" id="genre" title="Genre" value="<?php echo $movData[0]['genre'] ?>" class="grey-text" readonly><br><br>
	</fieldset><br>

	<!-- movie stock details (editable fields) -->
	<fieldset id="movie-stock">
		<legend>Stock Info</legend>
		<label for="rental-period">Rental Period</label>
		<select name="rental period" id="rental-period">
		<?php populateRentalDropdown($movData) ?>
		</select><br>
		<fieldset id="DVD">
			<legend>DVD</legend>
			<label for="dvd-rental-price">Rental Price</label>
			<input type="text" name="dvd-rental-price" id="dvd-rental-price" title="DVD Rental Price" value="<?php echo $movData[0]['DVD_rental_price'] ?>"><br>
			<label for="dvd-purchase-price">Purchase Price</label>
			<input type="text" name="dvd-purchase-price" id="dvd-purchase-price" title="DVD Purchase Price" value="<?php echo $movData[0]['DVD_purchase_price'] ?>"><br>
			<label for="dvd-stock">Stock</label>
			<input type="text" name="dvd-stock" id="dvd-stock" title="DVD Stock" value="<?php echo $movData[0]['numDVD'] ?>"><br>
			<label for="dvd-rented">Currently Rented</label>
			<input type="text" name="dvd-rented" id="dvd-rented" title="DVD Currently Rented" value="<?php echo $movData[0]['numDVDout'] ?>"><br>
			<label for="dvd-in-store">In Store</label>
			<input type="text" name="dvd-in-store" id="dvd-in-store" title="DVD In Store" value="<?php calculateInStoreStock($movData[0]['numDVD'], $movData[0]['numDVDout']) ?>" class="grey-text" readonly><br>
		</fieldset>
		<fieldset id="BluRay">
			<legend>BluRay</legend>
			<label for="bluray-rental">Rental Price</label>
			<input type="text" name="bluray-rental" id="bluray-rental" title="BluRay Rental Price" value="<?php echo $movData[0]['BluRay_rental_price'] ?>"><br>
			<label for="bluray-purchase">Purchase Price</label>
			<input type="text" name="bluray-purchase" id="bluray-purchase" title="BluRay Purchase Price" value="<?php echo $movData[0]['BluRay_purchase_price'] ?>"><br>
			<label for="bluray-stock">Stock</label>
			<input type="text" name="bluray-stock" id="bluray-stock" title="BluRay Stock" value="<?php echo $movData[0]['numBluRay'] ?>"><br>
			<label for="bluray-rented">Currently Rented</label>
			<input type="text" name="bluray-rented" id="bluray-rented" title="BluRay Currently Rented" value="<?php echo $movData[0]['numBluRayOut'] ?>"><br>
			<label for="bluray-in-store">In Store</label>
			<input type="text" name="bluray-in-store" id="bluray-in-store" title="BluRay In Store" value="<?php calculateInStoreStock($movData[0]['numBluRay'], $movData[0]['numBluRayOut']) ?>" class="grey-text" readonly><br>
		</fieldset>
	</fieldset>
	
	<!-- submit -->
	<div class="form-buttons">
		<input type="submit" name="level-3-request" value="Edit Movie">
	</div>
</form>

<?php
// get movie data from database
function getMovieData($movie) {
	include_once ("includes/connectDB.php");
	$db = getDBConnection();
	$movData;
	try {
		$sql = $db->prepare("SELECT * FROM movie_detail_view WHERE movie_id = :movie");
		$sql->bindValue(':movie', intval($movie), PDO::PARAM_INT); // sanitizes data
		$sql->execute();
		$movData = $sql->fetchAll(PDO::FETCH_ASSOC);
		// print_r($movData); // debug query
	} catch (PDOException $ex) {
    	echo "Error: " . $ex->getMessage() . "<br>";
	}
	return $movData;
}

// get rental options from queried data and populate dropdown
function populateRentalDropdown($mData) {
	echo '<option value="'.$mData[0]['rental_period'].'" selected="selected">'.$mData[0]['rental_period'].'</option>'; // currently selected option
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

// calculate number of stock in store and print
function calculateInStoreStock($stock, $borrowed) {
	$inStore = $stock - $borrowed;
	echo $inStore;
}