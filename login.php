<?php
session_start();
session_cache_limiter('private_no_expire');
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
				echo '<p class="system-message">
				You are logged in as <span style="color:#f1592a">'
				.$_SESSION["Username"].'</span></p>';
				header('Location: moviezone.php'); // for testing!!!!!!!!!
				break;
			case "timed out":
				echo '<p class="system-message error-text">
				Session timed out, please log in again.</p>';
				include 'includes/shop/user-login.inc';
				break;
			case "incorrect login":
				echo '<p class="system-message error-text">
				Username and/or Password is incorrect, please try again.</p>';
				break;
			case "new session":
				include 'includes/shop/user-login.inc';
				break;
			case "empty found":
				echo '<p class="system-message error-text">
				Username and/or Password fields cannot be empty, try again.</p>';
				break;
			case "admin logged in":
                    echo '<p class="system-message error-text">Already logged into 
                    <span style="color:#f1592a"><b>admin</b></span> as 
                    <span style="color:#f1592a"><b>'.$_SESSION["StaffName"].'</b></span><br>
                    Please logout first to access the user/member login.</p>';
                    break;
			default:
				echo '<p class="system-message error-text">
				An unknown error has occured</p>';
				break;
		}
	?>
	</div>
	
	<!-- Footer -->
	<?php include 'includes/footer.php' ?>
	<!-- end of Footer -->
</body>
</html>