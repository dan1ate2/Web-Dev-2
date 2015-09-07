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
			<h1 class="page-title">Admin login</h1>
			<div class="center-hw-box bg-opacity">
				<h2 class="orange">Login to your admin account</h2>
				<p>NOTE: Admin staff login ONLY!</p>
                <div id ="login-form">
                    <form name="admin-login" id="admin-login" action="" method="post" onsubmit="">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" maxlength="10" pattern=".{4,10}" title="Enter your admin username here"><br>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" maxlength="10" title="Enter your admin password here"><br>
                    </form>
                </div>
			</div>

		</div>
		
		<!-- Footer -->
		<?php include 'includes/footer.php' ?>
		<!-- end of Footer -->
	</body>
</html>