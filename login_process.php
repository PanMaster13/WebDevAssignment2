<?php
	if (isset($_POST["login_btn"])){
		$email = $_POST["login_email"];
		$password = $_POST["password"];
		
		if ((empty($email)) || (empty($password))){
			$feedback = "<p style='color:red'>It seems there are missing fields in the login form.<br/> Please ensure that all the fields are filled in.";
		} else {
			// Initialise database variables
			$host = "sql313.byethost15.com";
			$username = "b15_24802769";
			$db_password = "waitNhope";
			$database = "b15_24802769_pcway";

			// Create connection
			$conn = mysqli_connect($host, $username, $db_password, $database);

			// Check connection
			if (!$conn){
				die("<p style='color:red'><strong>Failed to connect to database: " . mysqli_connect_error() . "</strong></p>");
			}
			
			$login_query = "SELECT * FROM user WHERE email=?";
			$login_prep = mysqli_prepare($conn, $login_query);
			mysqli_stmt_bind_param($login_prep, 's', $email);
			mysqli_stmt_execute($login_prep);
			$login_result = mysqli_stmt_get_result($login_prep);
			$numRows = mysqli_num_rows($login_result);
			
			if ($numRows > 0){
				$row = mysqli_fetch_assoc($login_result);
				// No hashing or salting required with password_verify() function
				if (password_verify($password, $row['password'])){
					session_start();
					$_SESSION['fname'] = $row['fname'];
					$_SESSION['lname'] = $row['lname'];
					$_SESSION['email'] = $row['email'];
					header("Location: index.php");
				} else {
					session_start();
					$feedback = "<p style='color:red'>Your given password does not seem to match with the password for this account.<br/> Please retype the password again slowly and ensure that CAPSLOCK is not active.</p>
								<p class='forgot_pass_text'><a class='forgot_pass_link' href='change_pass.php'>Forgot Password?</a></p>";
					$_SESSION['reset_email'] = $row['email'];
				}
			} else {
				$feedback = "<p style='color:red'>There are no accounts with this email address.<br/> Please try another email address or register with that email instead.</p>";	
			}
			mysqli_free_result($login_result);
			mysqli_close($conn);
		}
	} else {
		$feedback = "<p style='color:red'>Please fill in the login form.</p>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Login Confirmation Page</title>
	<link rel="stylesheet" href="styles/style.css" />
</head>
<body>
	<div class="logo">
		<img src="images/logo.png" alt="Company Logo" />
	</div>
	<nav>
		<ul>
			<li><a href="register.php">Register</a></li>
			<li><a href="login.php">Log In to another account</a></li>
			<li><a href="index.php">Back to home page</a></li>
		</ul>
	</nav>
	<header>
		<h1>Login Confirmation Page</h1>
	</header>
	<article class='content'>
		<?php echo $feedback; ?>
	</article>
</body>
</html>