<h1 class="page-title">Booking</h1>
<strong><p class="error-text">Still under construction!</p></strong>
<div class="center-hw-box bg-opacity">
	<h2 class="black-orange">Menu</h2>
	<div class="form-buttons">
		<form name="booking-menu" id="admin-menu" action="booking.php" method="get">
			<input type="submit" name="booking" value="View Cart">
		</form>
	</div>
</div>
<?php processBookingMenu(); ?>

<?php
// get cart details
function processBookingMenu() {
	if (isset($_GET['booking'])) {
		$option = $_GET['booking'];
		switch ($option) {
			case "View Cart":
				include_once 'includes/shop/printCurrentCart.php';
				printCurrentCart();
				break;
			default:
				echo '<p class="error-text">An unexpected error has occured.<br>
					Please contact the system administrator.</p>';
				break;
		}
	}
	else {
		include_once 'includes/shop/bookingWelcome.inc';
	}
} // end getCartDetails