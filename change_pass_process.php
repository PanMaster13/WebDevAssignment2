<?php
	if (!isset($_SESSION['reset_email'])){
		//header("Location: index.php");
		echo "gae";
	} else {
		$reset_email = $_SESSION['reset_email'];
		echo "gae1";
	}

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
		echo "gae2";
	}

	if (isset($_POST["reset_btn"])){
		$password = $_POST["password"];
		$confirm_password = $_POST["confirm_password"];
		$new_counter_value = $_POST["change_counter"];
		
		if ((empty($password)) || (empty($confirm_password))){
			$_SESSION['reset_feedback'] = "<p style='color:red'>It seems there are missing fields in the input form.<br/> Please ensure that all the fields are filled in.";
			echo "gae5";
		} else if($confirm_password != $password){
			$_SESSION['reset_feedback'] = "<p style='color:red'>Your password does not seem to match your confirmation password.<br/> Please retype the password again slowly and ensure that CAPSLOCK is not active.</p>";
			echo "gae6";
		} else {
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			$new_counter_value = $new_counter_value + 1;
			$reset_query = "UPDATE user SET password=?, change_pwd_counter=? WHERE email=?";
			$reset_prep = mysqli_prepare($conn, $reset_query);
			mysqli_stmt_bind_param($reset_prep, 'sis', $hashed_password, $new_counter_value, $reset_email);
			mysqli_stmt_execute($reset_prep);
			$reset_result = mysqli_stmt_get_result($reset_prep);
			$_SESSION['reset_feedback'] = "<p style='color:green'>Your account password have been reset.</p>";
			echo "gae7";
		}
		echo "gae4";
	} else {
		$_SESSION['reset_feedback'] = "";
		echo "gae3";
	}
?>