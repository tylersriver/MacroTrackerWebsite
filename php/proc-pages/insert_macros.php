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

// -- Get POST Variables
// ------------------------------------------------------
$protein = $_POST['protein'];
$carbs = $_POST['carbs'];
$fat = $_POST['fat'];
$description = $_POST['description'];

// -- Setup MySQL Connection
// ------------------------------------------------------
$conn = new MySQL_Tool();

// -- Process Data and Insert
// ------------------------------------------------------
$sql  = "INSERT INTO mealEntries (entryTime, protein, carbs, fat, description)
          VALUES (NOW(), $protein, $carbs, $fat, '$description')";
$conn->executeInsert($sql);
$conn->closeConn();

// redirect page
// ------------------------------------------------------
if($_SERVER['REMOTE_ADDR'] == '192.168.1.70'){
    header( "Location: http://192.168.1.76/MacroTrackerWebsite/php/home.php" );
} else {
    header("Location: http://sriver.hopto.org/MacroTrackerWebsite/php/home.php");
}
exit();
