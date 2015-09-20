<header>
	<div class="fw-row bg-opacity">
		<div class="container">
				<img src="images/logo.png" width="215" height="128" alt="DVDsy logo">
		</div>
	</div>
	<div class="fw-row bg-black">
		<div class="container">
			<nav>	
				<ul>
					<li><a href="index.php">home</a></li>
					<li><a href="moviezone.php">moviezone</a></li>
					<li><a href="techzone.php">techzone</a></li>
					<li><a href="join.php">join</a></li>
					<li><a href="contact.php">contact</a></li>
					<?php
						if (stripos($_SERVER['REQUEST_URI'], 'moviezone.php') || 
							stripos($_SERVER['REQUEST_URI'], 'login.php') ||
							stripos($_SERVER['REQUEST_URI'], 'logout.php') ||
							stripos($_SERVER['REQUEST_URI'], 'admin.php')) {
							    echo '<div class="user-nav">
									<li><a href="login.php">login</a></li>
								    <li><a href="includes/logout.php">logout</a></li>
								    <li><a href="admin.php">admin</a></li>
								    </div>';
						}
					?>
				</ul>
			</nav>
		</div>
	</div>
</header>