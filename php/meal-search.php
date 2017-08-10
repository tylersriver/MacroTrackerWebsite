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
    $sql = "SELECT description, protein, fat, carbs 
            FROM mealEntries
            WHERE description  
            LIKE ?";
    $description = $description.'%';

    $result = $conn->query($sql, array($description));
    $result = $result->fetch_assoc();

    // -- echo information in table
    // ------------------------------------------------------
    foreach ($result as $row){
        echo "<tr>";
        echo "    <td>".$row."</td>";
        echo "    <td>".$row."</td>";
        echo "    <td>".$row."</td>";
        echo "    <td>".$row."</td>";
        echo "</tr>";
    } 
    $conn->close();
}?>
        </table>
    </div>
