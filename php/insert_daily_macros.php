<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/10/2017
 * Time: 8:03 PM
 */

include_once ("lib/MySQL_Tool.php");

// -- Get POST Variables
// ------------------------------------------------------
$protein = $_POST['protein'];
$carbs = $_POST['carbs'];
$fat = $_POST['fat'];

// -- Setup MySQL Connection
// ------------------------------------------------------
$conn = new MySQL_Tool();

// Update Macros
$sql = "UPDATE dailyMacros 
          SET protein = $protein,  fat = $fat, carbs = $carbs";
$conn->executeUpdate($sql);
$conn->closeConn();
header( "Location: http://192.168.1.76/MacroTrackerWebsite/php/get_daily_macros.php" );
