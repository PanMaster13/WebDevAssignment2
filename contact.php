<?php
	session_start();
	
	if (!isset($_SESSION['email'])){
		$userLoggedIn = false;
	} else {
		$userLoggedIn = true;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Contact Us Page</title>
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
						<li><a href='index.php'>Back to home page</a></li>
					</ul>";
			} else {
				echo "
					<ul>
						<li><a href='logout_process.php'>Logout</a></li>
						<li><a href='update.php'>Change Account Details</a></li>
						<li><a href='index.php'>Back to home page</a></li>
					</ul>";
			}
		?>
	</nav>
	<article class='content'>
		<h1>Details of Web-Master</h1>
		<p>Student Name: Jason Ang Chia Wuen</p>
		<p>Student ID: 100087252</p>
		<p>Email Address: <a href="mailto: 100087252@students.swinburne.edu.my">100087252@students.swinburne.edu.my</a></p>
	
		<p><strong>Disclaimer</strong>: <br/>This website is created mainly for educational and non-commercial use only. It is a partial fulfillment for completion of unit COS30020 - Web Application Development offered in Swinburne University of Technology, Sarawak Campus for Semester 2, 2019. The web-master and author(s) do not represent the business entity. The content of the pages of this website might be outdated or inaccurate, thus, the author(s) and web-master does not take any responsibility for incorrect information disseminated or cited from this website.</p>
	</article>
</body>
</html>