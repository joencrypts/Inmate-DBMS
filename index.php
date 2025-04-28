<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require_once 'connect.php';

// Check if database connection is successful
if (isset($con) && $con) {
    // Redirect to the main page
    header("Location: index.html");
    exit();
} else {
    // Display error if database connection fails
    echo "<h1>Database Connection Error</h1>";
    echo "<p>Unable to connect to the database. Please check your configuration.</p>";
}
?> 