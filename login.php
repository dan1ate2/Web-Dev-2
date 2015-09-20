<?php
session_start();
session_cache_limiter('private_no_expire');
// if (isset($_SESSION["Username"])) {
// 	session_regenerate_id();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>DVD'sy - User Login</title>
	<meta charset="utf-8">
	<meta name="description" content="DVD'sy movie rentals - User login">
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
		include 'includes/shop/login-auth.php'; // auth function
		switch (memberAccess()) {
			case "ok":
				include 'includes/shop/user-login.inc'; // for testing!!!!!!!!!
				break;
			default:
				include 'includes/shop/user-login.inc';
				break;
		}
	?>
	</div>
	
	<!-- Footer -->
	<?php include 'includes/footer.php' ?>
	<!-- end of Footer -->
</body>
</html>