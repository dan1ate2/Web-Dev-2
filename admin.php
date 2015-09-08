<?php
// session_cache_limiter('private_no_expire');
session_start();
if (isset($_SESSION["Name"])) {
	session_regenerate_id();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DVD'sy - Admin login</title>
	<meta charset="utf-8">
	<meta name="description" content="DVD'sy movie rentals - Admin login">
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
        			echo "ok<br><br>";
        			echo "Login is authorised.<br>Username: " . $_SESSION['Name'] . "<br>Password: " . $_SESSION['Password'] . "<br>Session ID: " . session_id();
        			include 'includes/admin/admin-login.inc';
        			break;
        		case "empty found":
        			echo "empty found<br><br>";
        			echo "Username: " . $_SESSION['Name'] . "<br>Password: " . $_SESSION['Password'] . "<br>Session ID: " . session_id();
        			include 'includes/admin/admin-login.inc';
        			break;
        		case "timed out":
        			echo "timed out (not really, just debugging)<br><br>";
        			echo "Username: " . $_SESSION['Name'] . "<br>Password: " . $_SESSION['Password'] . "<br>Session ID: " . session_id();
        			include 'includes/admin/admin-login.inc';
        			break;
        		case "incorrect password":
        			echo "incorrect password<br><br>";
        			echo "Username: " . $_SESSION['Name'] . "<br>Password: " . $_SESSION['Password'] . "<br>Session ID: " . session_id();
        			include 'includes/admin/admin-login.inc';
        			break;
        		case "new session":
        			echo "new session<br><br>";
        			echo "Username: " . $_SESSION['Name'] . "<br>Password: " . $_SESSION['Password'] . "<br>Session ID: " . session_id();
        			include 'includes/admin/admin-login.inc';
        			break;
        		default:
        			echo "An error has occurred";
        			echo "Username: " . $_SESSION['Name'] . "<br>Password: " . $_SESSION['Password'] . "<br>Session ID: " . session_id();
        			include 'includes/admin/admin-login.inc';
        			break;
        	}
        ?>
	</div>
	
	<!-- Footer -->
	<?php include 'includes/footer.php' ?>
	<!-- end of Footer -->
</body>
</html>