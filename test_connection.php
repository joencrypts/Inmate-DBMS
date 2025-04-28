<?php
include 'connect.php';

echo "<h2>Database Connection Test</h2>";

if ($con) {
    echo "<p style='color: green;'>✅ Database connection successful!</p>";
    
    // Test query to show tables
    $result = mysqli_query($con, "SHOW TABLES");
    if ($result) {
        echo "<h3>Available Tables:</h3>";
        echo "<ul>";
        while ($row = mysqli_fetch_row($result)) {
            echo "<li>" . $row[0] . "</li>";
        }
        echo "</ul>";
    }
    
    // Test query to count records in each table
    echo "<h3>Record Counts:</h3>";
    echo "<ul>";
    
    // First get all tables
    $tables_result = mysqli_query($con, "SHOW TABLES");
    while ($table_row = mysqli_fetch_row($tables_result)) {
        $table_name = $table_row[0];
        $count = mysqli_query($con, "SELECT COUNT(*) as count FROM `$table_name`");
        if ($count) {
            $row = mysqli_fetch_assoc($count);
            echo "<li>$table_name: " . $row['count'] . " records</li>";
        } else {
            echo "<li>$table_name: Error counting records</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<p style='color: red;'>❌ Database connection failed!</p>";
    echo "<p>Error: " . mysqli_connect_error() . "</p>";
}
?> 