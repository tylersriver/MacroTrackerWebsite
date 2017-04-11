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
include_once ("global-header.php");
include_once ("lib/MySQL_Tool.php");
?>
<link rel="stylesheet" type="text/css" href="../styles/table-styles.css">
<div>
    <h2>Search For Meal</h2>
    <form action="meal-search.php" method="post">
        <table>
            <tr>
                <td valign="top">
                    <label for="description">Description</label>
                </td>
                <td valign="top">
                    <input type="text" name="description">
                </td>
            </tr>
            <tr>
                <td style="text-align:center">
                    <input type="submit" value="Search">
                </td>
            </tr>
        </table>
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

// -- Open Connection and search
// ------------------------------------------------------
$conn = new MySQL_Tool();
$description = $_POST['description'];
$sql = "SELECT (description, protein, fat, carbs) FROM mealEntries WHERE description LIKE '%".$description."%'";
$result = $conn->executeSelect($sql);

// -- echo information in table
// ------------------------------------------------------
while ($row = mysqli_fetch_row($result)){
    echo "<tr>";
    echo "    <td>".$row[0]."</td>";
    echo "    <td>".$row[1]."</td>";
    echo "    <td>".$row[2]."</td>";
    echo "    <td>".$row[3]."</td>";
    echo "</tr>";
} ?>
        </table>
    </div>
