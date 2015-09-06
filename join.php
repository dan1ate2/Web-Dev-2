<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Form</title>
		<meta charset="utf-8">
		<meta name="description" content="Join DVD'sy movie rentals">
		<script src="js/validate.js"></script>
		<!-- Common 'head' content -->
		<?php include 'includes/head.php' ?>
		<!-- end of Common 'head' content -->
	</head>

	<body>
		<!-- Header & Navigation -->
		<?php include 'includes/header-nav.php' ?>
		<!-- end of Header & Navigation -->
		
		<div class="container">
			<h1 class="page-title">Join</h1>
			<div class="fw-box bg-opacity">
				<?php
					// if post method, process form
					if($_SERVER['REQUEST_METHOD'] == 'POST') { 
						echo '<h2 class="orange">Join Form Status</h2>';
						include_once 'includes/validateUser.php';
						
						// validate form
						if (validateUserForm($_POST)) {
							echo "<p>Successfully validated form<br></p>";
				            include_once 'includes/createUser.php';
	                    	$queryResult = createUser($_POST); // add time to this    
	                    	//See if the creation worked.
	                    	if($queryResult['succeeded']) {
		                     	//Success message
		                     	echo "<p>Congratulations " . $_POST['other-names'] .
		                     		" you have successfully signed up at DVD'sy and can now 
		                     		book movies!<br></p>";
                  			}
			                else {
			                    //Failure message
			                    echo "<p>There was a database failure while creating your user account. 
			                    	Please contact the site administrator.<br>
			                        Error message: " . $queryResult['error'] . "<br></p>";
                    		} // end else
                		} // end 'if (validateUserForm($_POST))'
					} // end 'if ($$_SERVER..
					else { // display form
						include 'includes/join.inc';
					}
				?>
			</div>
		</div>

		<!-- Footer -->
		<?php include 'includes/footer.php' ?>
		<!-- end of Footer -->
	</body>
</html>