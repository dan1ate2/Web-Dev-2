<?php
session_start();
session_cache_limiter('private_no_expire');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DVD'sy - MovieZone</title>
	<meta charset="utf-8">
	<meta name="description" content="DVD'sy movie rentals - MovieZone DVD hire">
	<!-- Common 'head' content -->
	<?php include 'includes/head.php' ?>
	<!-- end of Common 'head' content -->
</head>
<body>
	<!-- Header & Navigation -->
		<?php include 'includes/header-nav.php' ?>
	<!-- end of Header & Navigation -->
	<div class="container">
		<?php 
			// figure out if user, admin, or neither
			include_once 'includes/sessionCheck.php';
			$sessionStatus = checkSession();
			switch ($sessionStatus) {
				case "member":
					echo '<p class="system-message">Logged in as <span style="color:#f1592a"><b>'.$_SESSION["Username"].'</b></span></p>';
					include_once 'includes/shop/processBookingMenu.php';
					break;
				case "admin":
					echo '<p class="system-message">
        				Logged into <span style="color:#f1592a"><b>admin</b></span> as 
        				<span style="color:#f1592a"><b>'.$_SESSION["StaffName"].'</b></span></p>';
					include_once 'includes/shop/processBookingMenu.php';
					break;
				case "none":
					echo '<p class="system-message error-text">You must be logged in to view this page.
					</p>';
					break;
				case "timed out":
					echo '<p class="system-message error-text">
	        			Your session has expired, please login again</p>';
					break;
				default:
					echo '<p class="system-message error-text">An unknown error has occured.
						<br>Please contact the system administrator.</p>';
					break;
			}
		?>
	</div> <!-- end container -->
	<!-- Footer -->
		<?php include 'includes/footer.php' ?>
	<!-- end of Footer -->
</body>
</html>