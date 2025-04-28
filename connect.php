<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to get environment variable with a default value
function getEnvOrDefault($key, $default) {
	$value = getenv($key);
	return $value !== false ? $value : $default;
}

// Get database credentials from environment variables with defaults
$db_host = getEnvOrDefault('DB_HOST', 'localhost');
$db_port = getEnvOrDefault('DB_PORT', '3306');
$db_user = getEnvOrDefault('DB_USER', 'root');
$db_pass = getEnvOrDefault('DB_PASS', '');
$db_name = getEnvOrDefault('DB_NAME', 'dbms_prison');

// Log connection attempt (for debugging)
error_log("Attempting to connect to database at $db_host:$db_port with user $db_user and database $db_name");

// Create connection with error handling and retry logic
$maxRetries = 5;
$retryDelay = 5; // seconds
$connected = false;

for ($i = 0; $i < $maxRetries && !$connected; $i++) {
	try {
		if ($i > 0) {
			error_log("Retry attempt " . ($i + 1) . " of $maxRetries");
			sleep($retryDelay);
		}

		$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
		
		if (!$con) {
			throw new Exception("Connection failed: " . mysqli_connect_error());
		}
		
		// Set charset to ensure proper encoding
		mysqli_set_charset($con, "utf8mb4");
		
		// Log successful connection
		error_log("Database connection successful");
		$connected = true;
		
	} catch (Exception $e) {
		// Log error with detailed information
		error_log("Database connection error: " . $e->getMessage());
		error_log("Connection details - Host: $db_host, Port: $db_port, User: $db_user, Database: $db_name");
		
		if ($i === $maxRetries - 1) {
			// Display user-friendly error message on final retry
			echo "<div style='color: red; padding: 20px; text-align: center;'>";
			echo "<h2>Database Connection Error</h2>";
			echo "<p>Unable to connect to the database. Please try again later.</p>";
			if (getenv('PHP_DISPLAY_ERRORS') == '1') {
				echo "<p>Error details: " . htmlspecialchars($e->getMessage()) . "</p>";
				echo "<p>Retry attempts: " . ($i + 1) . "</p>";
			}
			echo "</div>";
			exit;
		}
	}
}
?>



