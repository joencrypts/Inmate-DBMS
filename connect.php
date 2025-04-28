<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get database credentials from environment variables
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_port = getenv('DB_PORT') ?: '3306';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'dbms_prison';

// Log connection attempt (for debugging)
error_log("Attempting to connect to database at $db_host:$db_port with user $db_user");

// Create connection with error handling
try {
	$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
	
	if (!$con) {
		throw new Exception("Connection failed: " . mysqli_connect_error());
	}
	
	// Set charset to ensure proper encoding
	mysqli_set_charset($con, "utf8mb4");
	
	// Log successful connection
	error_log("Database connection successful");
	
} catch (Exception $e) {
	// Log error with detailed information
	error_log("Database connection error: " . $e->getMessage());
	error_log("Connection details - Host: $db_host, Port: $db_port, User: $db_user, Database: $db_name");
	
	// Display user-friendly error message
	echo "<div style='color: red; padding: 20px; text-align: center;'>";
	echo "<h2>Database Connection Error</h2>";
	echo "<p>Unable to connect to the database. Please check your configuration.</p>";
	if (getenv('PHP_DISPLAY_ERRORS') == '1') {
		echo "<p>Error details: " . htmlspecialchars($e->getMessage()) . "</p>";
	}
	echo "</div>";
	exit;
}
?>



