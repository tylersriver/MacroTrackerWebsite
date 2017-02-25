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

// Open Connection
$conn = new mysqli($servername, $username, $password);

// Check Connection
if($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}

echo "Connected Successfully";
