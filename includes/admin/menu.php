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
		if (isset($_POST["admin-menu"])) { // first level requests
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
					include 'includes/admin/edit-member.php';
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
		else if (isset($_POST["form-request"])) { // second level requests
			switch ($_POST["form-request"]) {
				case $_POST["form-request"] = "Member Details":
					echo '<h2 class="black-orange">Edit or delete member</h2>
					<p>Use this form to update user details</p><br>';
					include 'includes/admin/edit-member-lev2.php';
					break;
				default:
					echo "An unknown error has occured";
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