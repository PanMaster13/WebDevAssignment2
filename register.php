<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Registration Page</title>
	<link rel="stylesheet" href="styles/style.css" />
</head>
<body>
	<nav>
		<div class="logo"><img src="images/logo.png" alt="Company Logo" /></div>
		<p><a href="register.php">Register</a></p>
		<p><a href="login.php">Login</a></p>
	</nav>
	<header>
		<h1>Account Registration Form</h1>
	</header>
	<article>
		<form action="register_process.php" method="post">
			<p>First name: <input type="text" name="fname"/></p>
			<p>Last name: <input type="text" name="lname"/></p>
			<p>Email address: <input type="email" name="email"/></p>
			<p>Password: <input type="password" name="password"/></p>
			<p>Confirm password: <input type="password" name="confirm_password"/></p>
			<p><input type="reset" value="Reset form" name="reset_btn"/></p>
			<p><input type="submit" value="Create account" name="submit_btn"/></p>
		</form>
		<button onclick="window.location.href='index.php';">Back to home page</button>
	</article>
</body>
</html>