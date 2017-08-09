<?php
/**
 * Created by Tyler Sriver on 2/24/2017
 *
 * This file is called by home.php
 * to insert the meal values into the
 * database and then redirects back to home
 */

// -- Includes
// ------------------------------------------------------
include_once("../lib/MySQL_Tool.php");

// -- Setup MySQL Connection
// ------------------------------------------------------
$conn = new MySQL_Tool();

// -- Get POST Variables
// ------------------------------------------------------
$protein = $_POST['protein'];
$carbs = $_POST['carbs'];
$fat = $_POST['fat'];
$description = $_POST['description'];

// -- Process Data and Insert
// ------------------------------------------------------
$sql  = "INSERT INTO mealEntries (entryTime, protein, carbs, fat, description)
          VALUES (NOW(), $protein, $carbs, $fat, '$description')";
$conn->executeInsert($sql);
$conn->close();

// redirect page
// ------------------------------------------------------
header( "Location: http://localhost/xampp/MacroTrackerWebsite/php/home.php" );

exit();
