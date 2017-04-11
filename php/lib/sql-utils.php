<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/10/2017
 * Time: 8:56 PM
 */

/**
 * Setup Connection to database
 * @return mysqli
 */
function setupConnection(){
    $servername = "localhost";
    $username = "root";
    $password = "newpwd";
    $db = "MacroTracker";

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }
}