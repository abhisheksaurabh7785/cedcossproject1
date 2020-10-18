<?php

$siteurl ="http://localhost/trainingced/app/admin";

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "gue55me";
$dbname = "products";

 //Create connection
$conn = new mysqli( $dbhost, $dbuser,$dbpass,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);

}
?>