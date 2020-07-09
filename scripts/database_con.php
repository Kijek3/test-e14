<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "e14";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");

return $conn;
