<?php 
  $host = "127.0.0.1"; $database = "zeus_airsoft"; $user = "root"; $password = "";
  try {
    $connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
  } catch (PDOException $e) {
    die("PDO Connection Error: " . $e->getMessage());
  }
?>