<?php
		error_reporting(E_ALL ^ E_NOTICE); 

		// Get database credentials from environment variables
		$db_host = getenv('DB_HOST') ?: 'localhost';
		$db_port = getenv('DB_PORT') ?: '3306';
		$db_user = getenv('DB_USER') ?: 'root';
		$db_pass = getenv('DB_PASS') ?: '';
		$db_name = getenv('DB_NAME') ?: 'dbms_prison';

		// Create connection with error handling
		try {
			$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
			
			if (!$con) {
				throw new Exception("Connection failed: " . mysqli_connect_error());
			}
			
			// Set charset to ensure proper encoding
			mysqli_set_charset($con, "utf8mb4");
			
		} catch (Exception $e) {
			// Log error (in production, don't display error details to users)
			error_log("Database connection error: " . $e->getMessage());
			echo "<script> alert('Connection Failed! Please try again later.'); </script>";
		}
?>



