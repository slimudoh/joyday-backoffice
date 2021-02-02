<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
//
// $servername = "localhost";
// $username = "sendbnku";
// $password = "L1VVd3cc5y0O";
// $dbname = "sendbnku_ind";

$servername = "localhost";
$username = "root";
$password = "obalende";
$dbname = "joyday";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
