<?php

// -- Setup MySQL Connection
// ------------------------------------------------------
$servername = "localhost";
$username = "root";
$password = "newpwd";
$db = "MacroTracker";

// Open Connection
$conn = new mysqli($servername, $username, $password, $db);

// Check Connection
if($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}

// -- Process Data and Insert
$sql  = "SELECT * FROM dailyMacros";
try { // Execute insert
  $result = mysqli_query($conn, $sql);
} catch (Exception $err) {
  die("Insert Failed: ".$err->error());
}

// -- Pass to POST
