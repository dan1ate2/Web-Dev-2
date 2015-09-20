<!DOCTYPE html>
<html lang="en">
	<head>
		<title>DVD'sy - TechZone</title>
		<meta charset="utf-8">
		<meta name="description" content="DVD'sy movie rentals - TechZone articles">
		<!-- Common 'head' content -->
		<?php include 'includes/head.php' ?>
		<!-- end of Common 'head' content -->
	</head>

	<body>
		<!-- Header & Navigation -->
		<?php include 'includes/header-nav.php' ?>
		<!-- end of Header & Navigation -->

		<div class="container">
			<h1 class="page-title">TechZone</h1>
			<div class="left-box bg-opacity">
				<h2 class="orange">Dan the 'tech-x-pert'</h2>
					<p>Hi I'm Dan, I'm here to give you advice on all things tech.</p><br>
					<p>I have a solid I.T. background and started with computers at a very young age.</p><br>
					<p>I enjoy both the front-end and back-end of web development and enjoy a little graphic design on the side.</p><br>
					<p>Check out my articles below!</p>
			</div>
			<div class="right-box bg-opacity">
				<h2 class="black-orange">Dan</h2>
				<img src="images/dan.jpg" class="center-align" height="350" width="252" alt="dan">
			</div>
			<div class="clear"></div>
			<div class="fw-row">
				<br>
				<?php include_once 'includes/techzone/best_cms.inc' ?>
			</div>
			<div class="clear"></div>
			<div class="fw-row">
				<br>
				<?php include_once 'includes/techzone/iis_vs_apache.inc' ?>
			</div>
		</div>
		
		<!-- Footer -->
		<?php include 'includes/footer.php' ?>
		<!-- end of Footer -->
	</body>
</html>