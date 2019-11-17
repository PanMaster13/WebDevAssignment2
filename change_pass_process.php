<?php
	session_start();
	
	if (isset($_POST["reset_btn"])){
		$reset_email = $_POST["email"];
		$password = $_POST["password"];
		$confirm_password = $_POST["confirm_password"];
		$counter_value = $_POST["change_counter"];
		
		if ((empty($password)) || (empty($confirm_password))){
			$_SESSION['reset_feedback'] = "<p style='color:red'>It seems there are missing fields in the input form.<br/> Please ensure that all the fields are filled in.";
			header("Location: change_pass.php");
		} else if($confirm_password != $password){
			$_SESSION['reset_feedback'] = "<p style='color:red'>Your password does not seem to match your confirmation password.<br/> Please retype the password again slowly and ensure that CAPSLOCK is not active.</p>";
			header("Location: change_pass.php");
		} else {
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			// Increases the reset attempts by 1 (Max: 3)
			$counter_value++;
			
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
			
			$reset_query = "UPDATE user SET password=?, change_pwd_counter=? WHERE email=?";
			$reset_prep = mysqli_prepare($conn, $reset_query);
			mysqli_stmt_bind_param($reset_prep, 'sis', $hashed_password, $counter_value, $reset_email);
			mysqli_stmt_execute($reset_prep);
			$reset_result = mysqli_stmt_get_result($reset_prep);
			$_SESSION['reset_feedback'] = "<p style='color:green'>Your account password have been reset.</p>";
			header("Location: change_pass.php");
		}
	} else {
		$_SESSION['reset_feedback'] = "";
		header("Location: change_pass.php");
	}
?>