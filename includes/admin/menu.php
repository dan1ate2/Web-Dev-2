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
				case $_POST["admin-menu"] = "Add a movie":
					echo '<h2 class="black-orange">Add a new movie</h2>
					<p>Enter a new movie option chosen</p>';
					break;
				case $_POST["admin-menu"] = "Delete a movie":
					echo '<h2 class="black-orange">Delete a movie</h2>
					<p>Delete a movie option chosen</p>';
					break;
				case $_POST["admin-menu"] = "Edit a movie":
					echo '<h2 class="black-orange">Edit a movie</h2>
					<p>Edit movie option chosen</p>';
					break;
				case $_POST["admin-menu"] = "Edit or delete member":
					echo '<h2 class="black-orange">Edit or delete member</h2>
					<p>Please select a member from the dropdown and click "Member Details" to view and either edit or update the member.</p><br>';
					include 'includes/admin/edit-member-lev1.php';
					break;
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
				case $_POST["level-2-request"] = "Member Details":
					echo '<h2 class="black-orange">Edit or delete member</h2>
					<p>Use this form to update user details</p><br>';
					include 'includes/admin/edit-member-lev2.php';
					break;
				default:
					echo "An unknown error has occured";
					break;
			}
		}
		else if (isset($_POST["level-3-request"])) { // third level processing
			switch ($_POST["level-3-request"]) {
					case $_POST["level-3-request"] = "Delete Member":
					include_once 'includes/admin/deletes-member.php';
					echo '<h2 class="black-orange">Edit or delete member</h2>';

					// process delete member request
					$queryResult = deleteMember($_POST["member-id"]); // deletes member
					if($queryResult['succeeded']) {
                     	//Success message
                     	echo "<p>The member " . $_POST['other-names'] .
                     		" has been successfully removed from the system.</p>";
                  	}
			        else {
	                    //Failure message
	                    echo "<p>There was a database failure while deleting the member. 
	                    	Please contact the site administrator.<br>
	                        Error message: " . $queryResult['error'] . "<br></p>";
                    } // end else
					break;
				case $_POST["level-3-request"] = "Update Member":
					echo '<h2 class="black-orange">Edit or delete member</h2>
					<p>Updates a member..</p>';
					break;
				default:
					echo 'Unknown error has occurred';
					break;
			}
		}
		else { // default
			echo '<h2 class="black-orange">Welcome</h2>
				<p>Welcome to the admin area.<br>
				Please choose an option from the left menu.</p>';
		}
	}
?>