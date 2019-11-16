<?php
	if (isset($_POST["submit_btn"])){
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$confirm_password = $_POST["confirm_password"];
		
		if ((empty($fname)) || (empty($lname)) || (empty($email)) || (empty($password)) || (empty($confirm_password))){
			echo "double gae";
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
				
			} else {
				echo "u R a dupe";
			}
			// Free query Result
			mysqli_free_result($validation_result);
			// Close Connection
			mysqli_close($conn);
		}
	} else {
		echo "gae";
	}
?>