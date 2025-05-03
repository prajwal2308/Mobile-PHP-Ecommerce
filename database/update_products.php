<?php
require_once 'DBController.php';

// Create database connection
$db = new DBController();

if (!$db->con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Read SQL file
$sql = file_get_contents('update_products.sql');

// Execute multi query
if (mysqli_multi_query($db->con, $sql)) {
    echo "Products updated successfully";
} else {
    echo "Error updating products: " . mysqli_error($db->con);
}

$db->closeConnection();
?> 