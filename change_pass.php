<?php
	session_start();
	if (!isset($_SESSION['reset_email'])){
		header("Location: index.php");
	} else {
		$reset_email = $_SESSION['reset_email'];
	}
	
	// Fetch counter variable from database (change_pwd_counter) to determine whether the reset password counter // has reached its maximum times.
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
	
	$check_query = "SELECT * FROM user WHERE email=?";
	$check_prep = mysqli_prepare($conn, $check_query);
	mysqli_stmt_bind_param($check_prep, 's', $reset_email);
	mysqli_stmt_execute($check_prep);
	$check_result = mysqli_stmt_get_result($check_prep);
	$check_numRows = mysqli_num_rows($check_result);
	$check_row = mysqli_fetch_assoc($check_result);
	$change_counter = $check_row['change_pwd_counter'];
	mysqli_free_result($check_result);
	
	mysqli_close($conn);
	
	if (!isset($_SESSION['reset_feedback'])){
		$_SESSION['reset_feedback'] = "";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Reset Password Page</title>
	<link rel="stylesheet" href="styles/style.css" />
</head>
<body>
	<div class="logo">
		<img src="images/logo.png" alt="Company Logo" />
	</div>
	<nav>
		<ul>
			<li><a href='register.php'>Register</a></li>
			<li><a href='login.php'>Login</a></li>
			<li><a href="index.php">Back to home page</a></li>
		</ul>
	</nav>
	<header>
		<h1>Reset Password Page</h1>
	</header>
	<article class='content'>
		<?php
			if ($change_counter == 3){
				echo "<p>You cannot reset the password for this account anymore.";
			} else {
				echo "<p>You can reset the password for this account " . (3 - $change_counter) . " more time(s).</p>
				<form action='change_pass_process.php' method='post'>
					<p>Email address (Cannot be changed): <input type='text' name='email' value='$reset_email' readonly='readonly'/></p>
					<p>New password: <input type='password' name='password'/></p>
					<p>Confirm new password: <input type='password' name='confirm_password'></p>
					<input type='hidden' name='change_counter' value='$change_counter' />
					<p><input type='submit' value='Reset Password' name='reset_btn'/></p>
				</form>";
			}
		?>
		<?php echo $_SESSION['reset_feedback'];
		?>
		<p></p>
	</article>
</body>
</html>
