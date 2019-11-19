<?php
	session_start();
	
	if (!isset($_SESSION['email'])){
		$userLoggedIn = false;
	} else {
		$userLoggedIn = true;
	}
	// Unsets reset feedback session data in password reset page
	if (isset($_SESSION['reset_feedback'])){
		unset($_SESSION['reset_feedback']);
	}
	// Unsets reset email session data to prevent users from going back to the password reset page via back button
	if (isset($_SESSION['reset_email'])){
		unset($_SESSION['reset_email']);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Homepage of PC-Way</title>
	<link rel="stylesheet" href="styles/style.css" />
</head>
<body>
	<div class="logo">
		<img src="images/logo.png" alt="Company Logo" />
	</div>
	<nav>
		<?php 
			if (!$userLoggedIn){
				echo "
					<ul>
						<li><a href='register.php'>Register</a></li>
						<li><a href='login.php'>Login</a></li>
						<li><a href='contact.php'>Contact Us</a></li>
					</ul>";
					$price_multiplier = 1;
			} else {
				echo "
					<ul>
						<li><a href='logout_process.php'>Logout</a></li>
						<li><a href='update.php'>Change Account Details</a></li>
						<li><a href='contact.php'>Contact Us</a></li>
					</ul>";
					$price_multiplier = 0.5;
			}
		?>
	</nav>
	<article>
		<?php 
			if ($userLoggedIn){
				echo "<p>Welcome back, " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!</p>";
			}
		?>
		<h2>Here are some of our featured products that we are selling.</h2>
		<div id="product-box">
			<div class="product-item">
				<img src="images/keyboard-1.png" alt="Image of Cougar Attack X3 Keyboard" />
				<p>Name: Cougar Attack X3 Gaming Keyboard<?php echo "<br/>Price: RM " . number_format((float)(45.00 * $price_multiplier), 2, '.', '');?></p>
				
			</div>
			<div class="product-item">
				<img src="images/keyboard-2.png" alt="Image of Logitech G410 Atlas Keyboard" />
				<p>Name: Logitech G410 Atlas Gaming Keyboard<?php echo "<br/>Price: RM " . number_format((float)(48.00 * $price_multiplier), 2, '.', '');?></p>
				
			</div>
			<div class="product-item">
				<img src="images/mouse-1.png" alt="Image of Logitech G502 HERO Mouse" />
				<p>Name: Logitech G502 HERO Gaming Mouse<?php echo "<br/>Price: RM " . number_format((float)(25.00 * $price_multiplier), 2, '.', '');?></p>
				
			</div>
			<div class="product-item">
				<img src="images/mouse-2.png" alt="Image of Razer Lancehead Mouse" />
				<p>Name: Razer Lancehead Gaming Mouse<?php echo "<br/>Price: RM " . number_format((float)(24.00 * $price_multiplier), 2, '.', '');?></p>
				
			</div>
			<div class="product-item">
				<img src="images/mouse-pad-1.png" alt="Image of Qck Large Mousepad" />
				<p>Name: Qck Large Gaming Mousepad<?php echo "<br/>Price: RM " . number_format((float)(15.00 * $price_multiplier), 2, '.', '');?></p>
				
			</div>
			<div class="product-item">
				<img src="images/mouse-pad-2.png" alt="Image of Homemade Mousepad" />
				<p>Name: Custom Designed Homemade Mousepad<?php echo "<br/>Price: RM " . number_format((float)(14.00 * $price_multiplier), 2, '.', '');?></p>
				
			</div>
			<div class="product-item">
				<img src="images/laptop-1.png" alt="Image of a Classy Laptop" />
				<p>Name: The one & only Classly Laptop<?php echo "<br/>Price: RM " . number_format((float)(2500.00 * $price_multiplier), 2, '.', '');?></p>
				
			</div>
			<div class="product-item">
				<img src="images/laptop-2.png" alt="Image of MacBook Air+ Laptop" />
				<p>Name: The signature MacBook Air+ Laptop<?php echo "<br/>Price: RM " . number_format((float)(3000.00 * $price_multiplier), 2, '.', '');?></p>
				
			</div>
			<div class="product-item">
				<img src="images/card-1.png" alt="Image of Graphics card 1050 ti" />
				<p>Name: NVIDIA GeForce 1050 Ti Graphics Card<?php echo "<br/>Price: RM " . number_format((float)(1600.00 * $price_multiplier), 2, '.', '');?></p>
				
			</div>
			<div class="product-item">
				<img src="images/card-2.png" alt="Image of Graphics card 1070" />
				<p>Name: NVIDIA Gtx 1070 Graphics Card<?php echo "<br/>Price: RM " . number_format((float)(1900.00 * $price_multiplier), 2, '.', '');?></p>
				
			</div>
		</div>
	</article>
</body>
</html>