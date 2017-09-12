<?php
/**
 * Created by PhpStorm.
 * User: tyler.w.sriver
 * Date: 4/11/17
 * Time: 4:48 PM
 *
 * Page to search for past meal
 * and display all results in table
 */

// -- Includes
// ------------------------------------------------------
include_once ("lib/lib-includes.php");
?>
<link rel="stylesheet" type="text/css" href="../styles/table-styles.css">
<div>
    <h2>Search For Meal</h2>
    <form action="meal-search.php" method="post">
        <p>Description: <input type="text" name="description"> <input type="submit" value="Search"></p>
    </form>
</div>
<div>
    <table>
        <tr>
            <th>Description</th>
            <th>Protein</th>
            <th>Fat</th>
            <th>Carbs</th>
        </tr>
<?php

// -- Pull Post var
// ------------------------------------------------------
$description = 
        ( ($_POST != null) 
            ? $_POST['description'] 
            : null );

// -- Open Connection and search
// ------------------------------------------------------
if($description != null) {
    $conn = new MySQL_Tool();
    $sql = "SELECT DISTINCT description, protein, fat, carbs 
            FROM mealEntries
            WHERE description  
            LIKE ?";
    $description = $description.'%';

    $result = $conn->query($sql, array($description));

    // -- echo information in table
    // ------------------------------------------------------
    while ($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "    <td>".$row['description']."</td>";
        echo "    <td>".$row['protein']."</td>";
        echo "    <td>".$row['fat']."</td>";
        echo "    <td>".$row['carbs']."</td>";
        echo "</tr>";
    } 
    $conn->close();
}?>
        </table>
    </div>
