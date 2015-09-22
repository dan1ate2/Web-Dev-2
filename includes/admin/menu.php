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
			include_once '/includes/admin/menu-process-lev1.php';
		}
		else if (isset($_POST["level-2-request"])) { // second level processing
			include_once '/includes/admin/menu-process-lev2.php';
		}
		else if (isset($_POST["level-3-request"])) { // third level processing
			include_once '/includes/admin/menu-process-lev3.php';
		}
		// welcome message (default/no post or form)
		else { 
			echo '<h2 class="black-orange">Welcome</h2>
				<p>Welcome to the admin area.<br>
				We recommend you have JavaScript enabled.<br><br>
				Please choose an option from the left menu.</p>';
		}
	}
?>