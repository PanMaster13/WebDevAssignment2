<?php
	session_start();
	if (!isset($_SESSION['email'])){
		header("Location: index.php");
	} else {
		$email = $_SESSION['email'];
	}
	
	if (isset($_POST["update_btn"])){
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$password = $_POST["password"];
		$confirm_password = $_POST["confirm_password"];
		
		// Validating for Empty inputs
		if ((empty($fname)) || (empty($lname)) || (empty($password)) || (empty($confirm_password))){
			$feedback = "<p style='color:red'>It seems there are missing fields in the input form.<br/> Please ensure that all the fields are filled in.</p>";
		// Validating for Non matching passwords
		} else if ($confirm_password != $password){
			$feedback = "<p style='color:red'>Your new password does not seem to match your confirmation password.<br/> Please retype the new password again slowly and ensure that CAPSLOCK is not active.</p>";
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
			
			// Hashing and Salting
			$hased_password = password_hash($password, PASSWORD_DEFAULT);
			$update_query = "UPDATE user SET fname=?, lname=?, password=? WHERE email=?";
			$update_prep = mysqli_prepare($conn, $update_query);
			mysqli_stmt_bind_param($update_prep, 'ssss', $fname, $lname, $hased_password, $email);
			mysqli_stmt_execute($update_prep);
			$update_result = mysqli_stmt_get_result($update_prep);
			
			$feedback = "<p style='color:green'>Your account details have been updated successfully.</strong></p>";
			$_SESSION['fname'] = $fname;
			$_SESSION['lname'] = $lname;
			
			// Close Connection
			mysqli_close($conn);
		}
	} else {
		$feedback = "";
	}
	
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Account Settings Page</title>
	<link rel="stylesheet" href="styles/style.css" />
</head>
<body>
	<div class="logo">
		<img src="images/logo.png" alt="Company Logo" />
	</div>
	<nav>
		<ul>
			<li><a href='logout_process.php'>Logout</a></li>
			<li><a href='contact.php'>Contact Us</a></li>
			<li><a href="index.php">Back to home page</a></li>
		</ul>
	</nav>
	<header>
		<h1>Account Settings Page</h1>
	</header>
	<article class='content'>
		<form action="update.php" method="post">
			<p>New first name: <input type="text" name="fname"/></p>
			<p>New last name: <input type="text" name="lname"/></p>
			<p>Email address (Cannot be changed): <input type="text" name="email" placeholder="<?php echo $email; ?>" disabled="disabled"/></p>
			<p>New password: <input type="password" name="password"/></p>
			<p>Confirm new password: <input type="password" name="confirm_password"></p>
			<p><input type="submit" value="Save Account Settings" name="update_btn"/></p>
		</form>
		<?php echo $feedback; ?>
	</article>
</body>
</html>
