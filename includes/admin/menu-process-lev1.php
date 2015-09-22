<?php
switch ($_POST["admin-menu"]) {
	// add a movie
	case $_POST["admin-menu"] = "Add a movie":
		echo '<h2 class="black-orange">Add a new movie</h2>
		<p>Enter a new movie to the system using the form below.</p>
		<p class="error-text">All fields (except stars and co-stars) are required !</p>';
		include_once 'includes/admin/add-movie-lev1.php';
		break;
	// delete a movie
	case $_POST["admin-menu"] = "Delete a movie":
		echo '<h2 class="black-orange">Delete a movie</h2>
		<p>Please choose a movie below and choose "Movie Details" to review the movie details before deletion.</p><br>';
		include_once 'includes/admin/delete-movie-lev1.php';
		break;
	// edit a movie
	case $_POST["admin-menu"] = "Edit a movie":
		echo '<h2 class="black-orange">Edit a movie</h2>
		<p>Please select a movie to edit from the dropdown.</p>';
		include_once 'includes/admin/edit-movie-lev1.php';
		break;
	// edit or delete member
	case $_POST["admin-menu"] = "Edit or delete member":
		echo '<h2 class="black-orange">Edit or delete member</h2>
		<p>Please select a member from the dropdown and click "Member Details" to view and either edit or update the member.</p><br>';
		include_once 'includes/admin/edit-member-lev1.php';
		break;
	// exit
	case $_POST["admin-menu"] = "Exit":
		header('Location: includes/logout.php');
		break;
	default:
		echo '<h2 class="black-orange">Error</h2>
		<p class="error-text">An unknown error has occured. 
		Please contact the site administrator.</p>';
		break;
}
