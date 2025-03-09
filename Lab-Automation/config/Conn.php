<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "e";


// Create connection
$conn = mysqli_connect($hostname, $username, $password, $database);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}



// $conn = mysqli_connect($hostname, $username, $password, $database) or die("Database connection failed");
// $conn = new mysqli("localhost","root","","e-project");

// // Check connection
// if ($conn -> connect_errno) {
//   echo "Failed to connect to MySQL: " . $conn -> connect_error;
//   exit();
// }

?>