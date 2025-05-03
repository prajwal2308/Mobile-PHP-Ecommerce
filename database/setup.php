<?php
require_once 'DBController.php';

// Create database connection
$db = new DBController();

if (!$db->con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Read SQL file
$sql = file_get_contents('setup.sql');

// Execute multi query
if (mysqli_multi_query($db->con, $sql)) {
    echo "Database setup completed successfully";
} else {
    echo "Error setting up database: " . mysqli_error($db->con);
}

$db->closeConnection();
?> 