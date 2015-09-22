<?php
switch ($_POST["level-2-request"]) {
	// display member details
	case $_POST["level-2-request"] = "Member Details":
		echo '<h2 class="black-orange">Edit or delete member</h2>
		<p>Use this form to update user details</p><br>';
		include_once 'includes/admin/edit-member-lev2.php';
		break;
	// delete a movie (shows details first)
	case $_POST["level-2-request"] = "Movie Details":
		echo '<h2 class="black-orange">Delete a movie</h2>
		<p>Please confirm you have the correct movie, then choose "Delete Movie" to remove it permanently.</p><br>';
		include_once 'includes/admin/delete-movie-lev2.php';
		break;
	// edit movie details
	case $_POST["level-2-request"] = "Edit Movie":
		echo '<h2 class="black-orange">Edit a movie</h2>
		<p>Please confirm you have the correct movie, then choose "Edit Movie" to modify details.</p><br>';
		include_once 'includes/admin/edit-movie-lev2.php';
		break;
	// add new movie
	case $_POST["level-2-request"] = "Add Movie":
		echo '<h2 class="black-orange">Add a new movie</h2>';
		// validate data
		include_once 'includes/admin/validateMovieAdd.php';
		$validateResult = validateMovieAdd($_POST);
		if ($validateResult['succeeded']) {
			// process add movie
			include_once 'includes/admin/adds-movie-lev2.php';
			$queryResult = addMovie($_POST, 
				$validateResult['director studio genre']); // adds movie to database
			if($queryResult['succeeded']) {
             	// success message
             	var_dump($_SESSION);
             	echo '<p>The movie "' . $_POST['movie-title'] . '" has been successfully added to the system.</p>';
          	}
	        else {
                // failed message
                echo "<p class='error-text'>There was a database failure while adding the movie.<br>
                	Please contact the site administrator.<br>
                    Error message: " . $queryResult['error'] . "</p>";
            }
    	}
    	else {
    		echo '<p class="error-text">There was a validation error adding the new movie to the system.<br><br>
    		Error: '.$validateResult['error'].'</p>';
    	}
		break;
	default:
		echo "<p class='error-text'>An unknown error has occured.<br>
			Please contact the site administrator.</p>";
		break;
}
