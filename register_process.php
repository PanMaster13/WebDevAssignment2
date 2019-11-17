<?php
	if (isset($_POST["submit_btn"])){
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$confirm_password = $_POST["confirm_password"];
		$counter = 0;
		
		if ((empty($fname)) || (empty($lname)) || (empty($email)) || (empty($password)) || (empty($confirm_password))){
			$feedback = "<p style='color:red'>It seems there are missing fields in the registration form.<br/> Please ensure that all the fields are filled in.</p>";
		} else if($confirm_password != $password){
			$feedback = "<p style='color:red'>Your password does not seem to match your confirmation password.<br/> Please retype the password again slowly and ensure that CAPSLOCK is not active.</p>";
		} else {
			// Initialise database variables
			$host = "localhost";
			$username = "root";
			$db_password = "";
			$database = "pcway";

			// Create connection
			$conn = mysqli_connect($host, $username, $db_password, $database);

			// Check connection
			if (!$conn){
				die("<p style='color:red'><strong>Failed to connect to database: " . mysqli_connect_error() . "</strong></p>");
			}
			
			$validation_query = "SELECT * FROM user WHERE email=?";
			$validation_prep = mysqli_prepare($conn, $validation_query);
			mysqli_stmt_bind_param($validation_prep, 's', $email);
			mysqli_stmt_execute($validation_prep);
			$validation_result = mysqli_stmt_get_result($validation_prep);
			$numRows = mysqli_num_rows($validation_result);
			
			if ($numRows == 0){
				// Hashing and Salting
				$hased_password = password_hash($password, PASSWORD_DEFAULT);
				$insert_query = "INSERT INTO user (fname, lname, email, password, change_pwd_counter) VALUES (?, ?, ?, ?, ?)";
				$insert_prep = mysqli_prepare($conn, $insert_query);
				mysqli_stmt_bind_param($insert_prep, 'ssssi', $fname, $lname, $email, $hased_password, $counter);
				mysqli_stmt_execute($insert_prep);
				$insert_result = mysqli_stmt_get_result($insert_prep);
				
				$feedback = "<p style='color:green'>Your account has been registered successfully.<br/> You can log in to that account or create another account.</p>";
			} else {
				$feedback = "<p style='color:red'>It seems that the email you are trying to register has already belonged to an existing account.<br/> Please try with another account.</p>";
			}
			// Free query Result
			mysqli_free_result($validation_result);
			// Close Connection
			mysqli_close($conn);
		}
	} else {
		$feedback = "<p style='color:red'>Please fill in the registration form.</p>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Confirmation Page</title>
	<link rel="stylesheet" href="styles/style.css" />
</head>
<body>
	<div class="logo">
		<img src="images/logo.png" alt="Company Logo" />
	</div>
	<nav>
		<ul>
			<li><a href="register.php">Register another user</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="index.php">Back to home page</a></li>
		</ul>
	</nav>
	<header>
		<h1>Account Confirmation Page</h1>
	</header>
	<article>
		<?php echo $feedback; ?>
	</article>
	<footer>
		<p><a href="contact.php">Contact Us</a></p>
	</footer>
</body>
</html>