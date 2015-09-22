<?php
switch ($_POST["level-3-request"]) {
	
	// delete a member
	case $_POST["level-3-request"] = "Delete Member":
		include_once 'includes/admin/deletes-member-lev3.php';
		echo '<h2 class="black-orange">Edit or delete member</h2>';
		// process delete member request
		$queryResult = deleteMember($_POST["member-id"]); // deletes member
		if($queryResult['succeeded']) {
         	// success message
         	echo '<p>The member "' . $_POST['other-names'] . '" has been successfully deleted from the system.</p>';
      	}
        else {
            // failed message
            echo "<p class='error-text'>There was a database failure while deleting the member.<br> 
            	Please contact the site administrator.<br>
                Error message: " . $queryResult['error'] . "</p>";
        } // end else
		break;
	
	// update a member
	case $_POST["level-3-request"] = "Update Member":
		echo '<h2 class="black-orange">Edit or delete member</h2>';
		// validate data
		include_once 'includes/validateUser.php';
		if (validateUserForm($_POST)) {
			// process update member
			include_once 'includes/admin/updates-member-lev3.php';
			$queryResult = updateMember($_POST); // updates member
			if($queryResult['succeeded']) {
             	// success message
             	echo '<p>The member "' . $_POST['other-names'] . '" has been successfully updated in the system.</p>';
          	}
	        else {
                // failed message
                echo "<p class='error-text'>There was a database failure while updating the member.<br>
                	Please contact the site administrator.<br>
                    Error message: " . $queryResult['error'] . "</p>";
            }
    	}
    	else {
    		echo '<p class="error-text">An unexpected validation error has occured. The member "' . $_POST['other-names'] . '" has not been updated in the system.<br>
    			Please contact the system administrator.</p>';
    	}
		break;
	
	// delete a movie
	case $_POST["level-3-request"] = "Delete Movie":
		include_once 'includes/admin/deletes-movie-lev3.php';
		echo '<h2 class="black-orange">Delete a movie</h2>';
		// process delete movie request
		$queryResult = deleteMovie($_POST["movie-id"]); // deletes movie
		if($queryResult['succeeded']) {
         	// success message
         	echo '<p>The movie "' . $_POST["movie-title"] . '" has been successfully deleted from the system.</p>';
      	}
        else {
            // failed message
            echo "<p class='error-text'>There was a database failure while deleting the movie.<br> 
            	Please contact the site administrator.<br>
                Error message: " . $queryResult['error'] . "</p>";
        } // end else
		break;
	
	// edit movie
	case $_POST["level-3-request"] = "Edit Movie":
		echo '<h2 class="black-orange">Edit a movie</h2>';
		include_once 'includes/admin/validateMovieUpdate.php';
		// validate movie data
		$validateResult = validateMovieUpdate($_POST);
		if($validateResult['succeeded']) {
         	include_once 'includes/admin/edits-movie-lev3.php';
         	// edit movie in db
         	$queryResult = editMovie($_POST); 
         	if ($queryResult['succeeded']) {
             	// success message
             	echo '<p>The movie "' . $_POST["movie-title"] . '" has been successfully edited.</p>';
         	}
         	else {
         		echo '<p class="error-text">There was an error updating the movie "'.$_POST["movie-title"].'" in the database.
         			<br>Please contact the system administrator.</p>';
         	}
      	}
        else {
            // failed message
            echo '<p class="error-text">Movie not updated. There was an error updating the movie "'. $_POST["movie-title"] .'".<br><br>
            Error: ' . $validateResult['error'] . '</p>';
        } // end else
		break;
	
	default:
		echo '<p class="error-text">An unknown error has occurred, please contact the 
			system administrator.</p>';
		break;
}