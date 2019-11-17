<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Login Page</title>
	<link rel="stylesheet" href="styles/style.css" />
</head>
<body>
	<div class="logo">
		<img src="images/logo.png" alt="Company Logo" />
	</div>
	<nav>
		<ul>
			<li><a href="register.php">Register another user</a></li>
			<li><a href="index.php">Back to home page</a></li>
		</ul>
	</nav>
	<header>
		<h1>Account Login Form</h1>
	</header>
	<article>
		<form action="login_process.php" method="post">
			<p>Login Email: <input type="text" name="login_email" /></p>
			<p>Password: <input type="password" name="password" /></p>
			<p><input type="reset" value="Reset" />
			<p><input type="submit" value="Log In" name="login_btn" /></p>
		</form>
	</article>
	<footer>
		<p><a href="contact.php">Contact Us</a></p>
	</footer>
</body>
</html>