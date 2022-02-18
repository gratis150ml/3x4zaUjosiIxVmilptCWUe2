<?php
$servername = "localhost";
$username = "holix";
$password = "password";
try {
  $conn = new PDO("mysql:host=$servername;dbname=holixdb", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed.";
}
?> 