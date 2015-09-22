<!DOCTYPE html>
<html lang="en">
	<head>
		<title>DVD'sy movie rentals</title>
		<meta charset="utf-8">
		<meta name="description" content="DVD'sy movie rentals">
		<!-- Common 'head' content -->
		<?php include 'includes/head.php' ?>
		<!-- end of Common 'head' content -->
	</head>

	<body>
		<!-- Header & Navigation -->
		<?php include 'includes/header-nav.php' ?>
		<!-- end of Header & Navigation -->
		<div class="container">
			<img class="feature-images" alt="banner image - Renevant movie coming soon" 
				src="images/banner-revenant.jpg" width="980" height="397">
		</div>
		<div class="container">
			<div class="left-box bg-opacity box-orange-border">
				<h2 class="orange">New Release</h2>
				<?php 
					include_once 'includes/randomNewRelease.php';
					randomNewRelease();
				?>
				<p class="orange-text"><b>Rent it now on DVD or BluRay!</b></p>
			</div>
			<div class="right-box bg-opacity">
				<h2 class="black-orange">Welcome</h2>
				<div class="left-align-text">
					<p>Hi, and welcome to DVD'sy!</p>
					<p>We are a dedicated team who have a passion for movies, and we're here to 
					provide you with the latest and greatest from Hollywood, Bollywood, 
					and beyond!</p>
					<p>Please feel free to browse our collection at the <a href="moviezone.php" target="_self">Moviezone page</a> where you can rent or purchase movies.</p>
				</div>
				<h3 class="orange-text">Booking engine almost ready!</h3>
				<div class="left-align-text">
					<p>Our developer is working around the clock to finish the booking engine/cart, 
						where you will be able to rent and purchase your movies from.</p>
					<p>Please be patient as we are still developing this system, in the meantime you can browse our movies and see what we have available in store, and call us when your ready to pick them up and we'll have them ready for you!</p>
					<p>If you'd like to join up and receive our newsletter, please navigate to the <a href="join.php" target="_self">join page</a>, otherwise if you'd like to contact us please head to the <a href="contact.php" target="_self">contact page</a>.</p>
					<p>Lastly, we also offer advice from our tech expert, check out his articles at the <a href="techzone.php" target="_self">techzone page</a>.</p>
				</div>
			</div>
			<div class="clear"></div>
			<div class="fw-box bg-opacity">
				<h2 class="black-orange">Movies coming to our collection</h2>
				<div class="fav-picks">
					<img src="images/dead-poets-society.jpg" width="214" height="317" alt="Dead Poets Society">
					<img src="images/a-beautiful-mind.jpg" width="214" height="317" alt="A Beautiful Mind">
					<img src="images/good-will-hunting.jpg" width="214" height="317" alt="Good Will Hunting">
					<img src="images/gladiator.jpg" width="214" height="317" alt="Gladiator">
					<img src="images/pursuit-of-happiness.jpg" width="214" height="317" alt="Pursuit Of Happyness">
					<img src="images/gran-torino.jpg" width="214" height="317" alt="Gran Torino">
					<img src="images/ff6.jpg" width="214" height="317" alt="Fast and Furious 6">
					<img src="images/insurgent.jpg" width="214" height="317" alt="Insurgent">
				</div>
			</div>
		</div>
		
		<!-- Footer -->
		<?php include 'includes/footer.php' ?>
		<!-- end of Footer -->
	</body>
</html>