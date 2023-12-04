<?php
$server = "bankingwithphp-server.mysql.database.azure.com";
$database = "net_banking";
$username = "nakshatra";
$password = "Darshan@96";

// Establishes the connection
$conn = new mysqli($server, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
