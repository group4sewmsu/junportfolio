<?php
$dbHost = 'localhost'; // Change this if your database is hosted elsewhere
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'junportfolio';

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
