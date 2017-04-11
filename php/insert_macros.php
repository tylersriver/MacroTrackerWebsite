<?php
// Created by Tyler Sriver on 2/24/2017

// -- Get POST Variables
// ------------------------------------------------------
$protein = $_POST['protein'];
$carbs = $_POST['carbs'];
$fat = $_POST['fat'];

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
$sql  = "INSERT INTO mealEntries (entryTime, protein, carbs, fat)
          VALUES (NOW(), $protein, $carbs, $fat)";
try { // Execute insert
  mysqli_query($conn, $sql);
} catch (Exception $err) {
  die("Insert Failed: ".$err->getMessage());
} // End SQL

header( "Location: http://192.168.1.76/MacroTrackerWebsite/html/home.html" );
exit();
