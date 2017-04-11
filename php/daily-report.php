<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/11/2017
 * Time: 10:20 AM
 */

include_once ("global-header.php");
include_once ("lib/MySQL_Tool.php");
?>

<div>
    <h2>Meal Entries for Today</h2>
<?php
$conn = new MySQL_Tool();
$sql = "SELECT TIME(entryTime), protein, fat, carbs FROM mealEntries WHERE DATE(entryTime) = DATE(NOW())";
$result = $conn->executeSelect($sql);

?>
<link rel="stylesheet" type="text/css" href="../styles/table-styles.css">
<table>
    <tr>
        <th>Entry Time</th>
        <th>Protein</th>
        <th>Fat</th>
        <th>Carbs</th>
    </tr>
<?php while ($row = mysqli_fetch_row($result)){
    echo "<tr>";
    echo "    <td>".$row[0]."</td>";
    echo "    <td>".$row[1]."</td>";
    echo "    <td>".$row[2]."</td>";
    echo "    <td>".$row[3]."</td>";
    echo "</tr>";
} ?>
</table>
</div>
