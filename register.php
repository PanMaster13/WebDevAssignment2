<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Registration Page</title>
	<link rel="stylesheet" href="styles/style.css" />
</head>
<body>
	<div class="logo">
		<img src="images/logo.png" alt="Company Logo" />
	</div>
	<nav>
		<ul>
			<li><a href="login.php">Login</a></li>
			<li><a href="index.php">Back to home page</a></li>
			<li><a href='contact.php'>Contact Us</a></li>
		</ul>
	</nav>
	<header>
		<h1>Account Registration Form</h1>
	</header>
	<article class='content'>
		<form action="register_process.php" method="post">
			<p>First name: <input type="text" name="fname"/></p>
			<p>Last name: <input type="text" name="lname"/></p>
			<p>Email address: <input type="text" name="email"/></p>
			<p>Password: <input type="password" name="password"/></p>
			<p>Confirm password: <input type="password" name="confirm_password"/></p>
			<p><input type="reset" value="Reset form" name="reset_btn"/><input type="submit" value="Create account" name="submit_btn"/></p>
		</form>
		<p></p>
		<p></p>
	</article>
</body>
</html>