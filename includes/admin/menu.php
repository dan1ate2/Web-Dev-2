<h1 class="page-title">Admin</h1>
<div class="left-box bg-opacity">
	<h2 class="orange">Menu</h2>
	<div class="form-buttons">
		<form name="admin-menu" id="admin-menu" action="admin.php" method="post">
			<input type="submit" name="admin-menu" value="Add a movie"><br>
			<input type="submit" name="admin-menu" value="Delete a movie"><br>
			<input type="submit" name="admin-menu" value="Edit a movie"><br>
			<input type="submit" name="admin-menu" value="Edit or delete member"><br>
			<input type="submit" name="admin-menu" value="Exit">
		</form>
	</div>
</div>
<div class="right-box bg-opacity">
	<?php menuOption() ?>
</div>

<?php
	function menuOption() {
		if (isset($_POST["admin-menu"])) { // first level processing
			switch ($_POST["admin-menu"]) {
				// add a movie
				case $_POST["admin-menu"] = "Add a movie":
					echo '<h2 class="black-orange">Add a new movie</h2>
					<p>Enter a new movie option chosen</p>';
					break;
				// delete a movie
				case $_POST["admin-menu"] = "Delete a movie":
					echo '<h2 class="black-orange">Delete a movie</h2>
					<p>Please choose a movie below and choose "Delete Movie" to remove it from the system.</p><br>';
					include_once 'includes/admin/delete-movie-lev1.php';
					break;
				// edit a movie
				case $_POST["admin-menu"] = "Edit a movie":
					echo '<h2 class="black-orange">Edit a movie</h2>
					<p>Edit movie option chosen</p>';
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
					<p>An unknown error has occured</p>';
					break;
			}
		}
		else if (isset($_POST["level-2-request"])) { // second level processing
			switch ($_POST["level-2-request"]) {
				// display member details
				case $_POST["level-2-request"] = "Member Details":
					echo '<h2 class="black-orange">Edit or delete member</h2>
					<p>Use this form to update user details</p><br>';
					include_once 'includes/admin/edit-member-lev2.php';
					break;
				case $_POST["level-2-request"] = "Delete Movie":
					include_once 'includes/admin/deletes-movie-lev2.php';
					echo '<h2 class="black-orange">Delete a movie</h2>';
					
					// process delete movie request
					$queryResult = deleteMovie($_POST["movie-list"]); // deletes movie
					if($queryResult['succeeded']) {
                     	// success message
                     	echo '<p>The movie "' . $_POST['movie-list'] . '" has been successfully deleted from the system.</p>';
                  	}
			        else {
	                    // failed message
	                    echo "<p>There was a database failure while deleting the member.<br> 
	                    	Please contact the site administrator.<br>
	                        Error message: " . $queryResult['error'] . "</p>";
                    } // end else
					break;

				default:
					echo "An unknown error has occured";
					break;
			}
		}
		else if (isset($_POST["level-3-request"])) { // third level processing
			switch ($_POST["level-3-request"]) {
				// delete a member
				case $_POST["level-3-request"] = "Delete Member":
					include_once 'includes/admin/deletes-member-lev3.php';
					echo '<h2 class="black-orange">Edit or delete member</h2>';
					// process delete member request
					$queryResult = deleteMember($_POST["movie-list"]); // deletes member
					if($queryResult['succeeded']) {
                     	// success message
                     	echo '<p>The member "' . $_POST['title'] . '" has been successfully deleted from the system.</p>';
                  	}
			        else {
	                    // failed message
	                    echo "<p>There was a database failure while deleting the member.<br> 
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
		                    echo "<p>There was a database failure while updating the member.<br>
		                    	Please contact the site administrator.<br>
		                        Error message: " . $queryResult['error'] . "</p>";
	                    } // end else
                	}
					break;
				default:
					echo 'Unknown error has occurred';
					break;
			}
		}
		else { // default
			echo '<h2 class="black-orange">Welcome</h2>
				<p>Welcome to the admin area.<br>
				We recommend you have JavaScript enabled.<br><br>
				Please choose an option from the left menu.</p>';
		}
	}
?>