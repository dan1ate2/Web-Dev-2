<?php
session_start();
session_cache_limiter('private_no_expire');
if (isset($_SESSION["StaffName"])) {
	session_regenerate_id();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DVD'sy - Admin login</title>
	<meta charset="utf-8">
	<meta name="description" content="DVD'sy movie rentals - Admin login">
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
        <?php
        	include 'includes/admin/admin-auth.php'; // auth function

        	switch (authorisedAccess()) {
        		case "ok":
        			echo '<p class="error-message">
        			Logged into admin as "'.$_SESSION["StaffName"].'"</p>';
        			include 'includes/admin/menu.php';
        			break;
        		case "empty found":
        			echo '<p class="error-message">
        			Error: Staff member and Password field cannot be blank<br>
        			Please go back and try again</p>';
        			break;
        		case "timed out":
        			echo '<p class="error-message">
        			Your session has expired, please login again</p>';
        			include 'includes/admin/admin-login.inc';
        			break;
        		case "incorrect password":
        			echo '<p class="error-message">
        			Incorrect password, please go back and try again</p>';
        			break;
        		case "new session":
        			include 'includes/admin/admin-login.inc';
        			break;
        		default:
        			echo '<p class="error-message">
        			An unknown error has occurred</p>';
        			break;
        	}
        ?>
	</div>
	
	<!-- Footer -->
	<?php include 'includes/footer.php' ?>
	<!-- end of Footer -->
</body>
</html>