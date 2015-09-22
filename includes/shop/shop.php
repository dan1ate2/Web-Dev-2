<h1 class="page-title">MovieZone</h1>
<?php include_once 'includes/shop/shopMenu.inc'; ?>
<div class="fw-box bg-opacity">
	<?php 
	// process level 1 options
	if (isset($_GET['search'])) {
		$option = $_GET['search'];
		switch ($option) {
			case "New Releases":
				echo '<h2 class="orange">New Releases</h2>';
				include 'includes/shop/populateMovies.php';
				populateMovies("New Releases");
				break;
			case "Show All Movies":
				echo '<h2 class="orange">Show All Movies</h2>';
				include 'includes/shop/populateMovies.php';
				populateMovies("Show All Movies");
				break;
			case "Search by Actor":
				echo '<h2 class="orange">Search by Actor</h2>';
				include 'includes/shop/getActors.php';
				break;
			case "Search by Director":
				echo '<h2 class="orange">Search by Director</h2>';
				include 'includes/shop/getDirectors.php';
				break;
			case "Search by Genre":
				echo '<h2 class="orange">Search by Genre</h2>';
				include 'includes/shop/getGenre.php';
				break;
			case "Search by Classification":
				echo '<h2 class="orange">Search by Classification</h2>';
				include 'includes/shop/getClassification.php';
				break;
			default:
				echo '<h2 class="orange">New Releases</h2>';
				include 'includes/shop/populateMovies.php';
				populateMovies("New Releases");
				break;
		} // end switch
	} // end if
	// process level 2 options
	else if (isset($_GET['query'])) {
		$searchQuery;
		$searchOption;
		if (isset($_GET['actor'])) {
			$searchQuery = $_GET['actor'];
			$searchOption = "actor";
		}
		else if (isset($_GET['genre'])) {
			$searchQuery = $_GET['genre'];
			$searchOption = "genre";
		}
		else if (isset($_GET['director'])) {
			$searchQuery = $_GET['director'];
			$searchOption = "director";
		}
		else if (isset($_GET['classification'])) {
			$searchQuery = $_GET['classification'];
			$searchOption = "classification";
		}
		// initiate functions
		switch ($searchOption) {
			case "actor":
				echo '<h2 class="orange">Movies by Actor: '.$searchQuery.'</h2>';
				include 'includes/shop/searchMoviesByActor.php';
				searchMoviesByActor($searchQuery);
				break;
			case "genre":
				echo '<h2 class="orange">Movies by Genre: '.$searchQuery.'</h2>';
				include 'includes/shop/searchMoviesByGenre.php';
				searchMoviesByGenre($searchQuery);
				break;
			case "director":
				echo '<h2 class="orange">Movies by Director: '.$searchQuery.'</h2>';
				include 'includes/shop/searchMoviesByDirector.php';
				searchMoviesByDirector($searchQuery);
				break;
			case "classification":
				echo '<h2 class="orange">Movies by Classification: '.$searchQuery.'</h2>';
				include 'includes/shop/searchMoviesByClassification.php';
				searchMoviesByClassification($searchQuery);
				break;
			default:
				break;
		}
	}
	// process level 3 request
	else if (isset($_GET['movie-request'])) {
		include_once 'includes/shop/addMovieToRenting.php';
		// put movie-id and any error into session variables
		addMovieToRenting($_GET['movie-id']);
		header('Location: ' . $_SERVER['HTTP_REFERER']); // reload last page
	}
	else {
		echo '<h2 class="orange">New Releases</h2>';
			include 'includes/shop/populateMovies.php';
			populateMovies("New Releases");
	}
	?>
</div>