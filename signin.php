<?php
$name = $_POST["usn"];
$email = $_POST["email"];
$pass = $_POST["pass"];

// Database connection settings matching Docker configuration
$conn = mysqli_connect(
    "db",      // Docker service name from docker-compose.yml
    "user",    // MySQL username from docker-compose.yml
    "pass",    // MySQL password from docker-compose.yml
    "mydb"     // Database name from docker-compose.yml
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create table if it doesn't exist
$create_table = "CREATE TABLE IF NOT EXISTS signup (
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

if (!mysqli_query($conn, $create_table)) {
    die("Error creating table: " . mysqli_error($conn));
}

// Insert new user
$sql = "INSERT INTO signup (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $pass);

if ($stmt->execute()) {
    header("Location: login page.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
