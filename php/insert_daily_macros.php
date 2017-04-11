<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/10/2017
 * Time: 8:03 PM
 */

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

// Update Macros
$sql = "UPDATE dailyMacros 
          SET protein = $protein,  fat = $fat, carbs = $carbs";

try { // Execute insert
    mysqli_query($conn, $sql);
} catch (Exception $err) {
    die("Insert Failed: ".$err->getMessage());
} // End SQL

$conn->close();
header( "Location: http://192.168.1.76/MacroTrackerWebsite/php/get_daily_macros.php" );
