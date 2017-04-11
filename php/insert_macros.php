<?php
// Created by Tyler Sriver on 2/24/2017
/**
 * This file is called by home.php
 * to insert the meal values into the
 * database and then redirects back to home
 */

include_once ("lib/sql-utils.php");

// -- Get POST Variables
// ------------------------------------------------------
$protein = $_POST['protein'];
$carbs = $_POST['carbs'];
$fat = $_POST['fat'];

// -- Setup MySQL Connection
$conn = setupConnection();

// -- Process Data and Insert
$sql  = "INSERT INTO mealEntries (entryTime, protein, carbs, fat)
          VALUES (NOW(), $protein, $carbs, $fat)";
try { // Execute insert
  mysqli_query($conn, $sql);
} catch (Exception $err) {
  die("Insert Failed: ".$err->getMessage());
} // End SQL

$conn->close();
header( "Location: http://192.168.1.76/MacroTrackerWebsite/php/home.php" );
exit();
