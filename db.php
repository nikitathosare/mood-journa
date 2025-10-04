<?php
$host = 'localhost';
$user = 'root'; // or 'webuser' if you created one
$password = ''; // your password if set
$database = 'mood_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
