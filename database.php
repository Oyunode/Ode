<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "your_password";  // Replace with your MySQL root password
$dbname = "GBL_game";  // Database name you want to work with

// Create a connection using mysqli
$conn = new mysqli($servername, $username, $password);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to MySQL!<br>";

// Step 1: Create Database (if not already created)
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists successfully.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Step 2: Select the database to work with
$conn->select_db($dbname);

// Step 3: Create Users Table (if not already created)
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Step 4: Insert Data into Users Table (for example)
$username = 'testuser';
$email = 'testuser@example.com';
$password_hash = password_hash('password123', PASSWORD_DEFAULT);  // Using bcrypt hashing for the password

$sql = "INSERT INTO users (username, email, password_hash) VALUES ('$username', '$email', '$password_hash')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully in 'users' table.<br>";
} else {
    echo "Error inserting record: " . $conn->error . "<br>";
}

// Step 5: Retrieve and Display Data from Users Table
$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Username: " . $row["username"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "No results found.<br>";
}

// Close the connection
$conn->close();
?>