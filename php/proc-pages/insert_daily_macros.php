<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/10/2017
 * Time: 8:03 PM
 *
 * Used for updating the total
 * daily macro nutrient counts
 */

// -- Includes
// ------------------------------------------------------
include_once("../lib/MySQL_Tool.php");

// -- Get POST Variables
// ------------------------------------------------------
$protein = $_POST['protein'];
$carbs = $_POST['carbs'];
$fat = $_POST['fat'];

// -- Setup MySQL Connection
// ------------------------------------------------------
$conn = new MySQL_Tool();

// Update Macros
// ------------------------------------------------------
$sql = "UPDATE dailyMacros
          SET protein = $protein,  fat = $fat, carbs = $carbs";
$conn->executeUpdate($sql);
$conn->closeConn();

// redirect page
// ------------------------------------------------------
if($_SERVER['REMOTE_ADDR'] == '192.168.1.70'){
    header( "Location: http://192.168.1.76/MacroTrackerWebsite/php/get_daily_macros.php" );
} else {
    header("Location: http://sriver.hopto.org/MacroTrackerWebsite/php/get_daily_macros.php");
}
exit();
