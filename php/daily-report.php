<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/11/2017
 * Time: 10:20 AM
 *
 * This file prints a table
 * of all the entries for the day
 */

// -- Includes
// ------------------------------------------------------
include_once ("global-header.php");
include_once ("lib/MySQL_Tool.php");
?>
<div>
    <h2>Meal Entries for Today</h2>
<link rel="stylesheet" type="text/css" href="../styles/table-styles.css">
<table>
    <tr>
        <th>Entry Time</th>
        <th>Description</th>
        <th>Protein</th>
        <th>Fat</th>
        <th>Carbs</th>
    </tr>
<?php

// -- Setup MySQL Conn and pull information
// ------------------------------------------------------
$conn = new MySQL_Tool();
$sql = "SELECT TIME(entryTime), description, protein, fat, carbs FROM mealEntries WHERE DATE(entryTime) = DATE(NOW())";
$result = $conn->executeSelect($sql);

// -- echo information in table
// ------------------------------------------------------
while ($row = mysqli_fetch_row($result)){
    echo "<tr>";
    echo "    <td>".$row[0]."</td>";
    echo "    <td>".$row[1]."</td>";
    echo "    <td>".$row[2]."</td>";
    echo "    <td>".$row[3]."</td>";
    echo "    <td>".$row[4]."</td>";
    echo "</tr>";
} ?>
</table>
</div>
