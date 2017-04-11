<!DOCTYPE html>
<html>
<!-- Created by Tyler Sriver on 4/10/2017 -->
<header>
    <title>Macro Tracker</title>
</header>
<body>
<header>
    <ul>
        <li><a href="home.php" class="button">Home</a></li>
        <li><a href="../php/get_daily_macros.php" class="button">Daily Macros</a></li>
    </ul>
</header>
<?php
/**
 * Pull daily macros
 * and compare to meals to show whats left
 */

// -- Setup MySQL Connection
// ------------------------------------------------------
include_once ("lib/MySQL_Tool.php");
$conn = new MySQL_Tool();

// Pull and Store Daily Values in variables
$sql  = "SELECT protein, fat, carbs FROM dailyMacros";
$result = $conn->executeSelect($sql);
$daily = $result->fetch_row();
$proteinDaily = $daily[0];
$fatDaily = $daily[1];
$carbsDaily = $daily[2];

// Get Day Totals
$protein_result = mysqli_fetch_row($conn->executeSelect("SELECT SUM(m.protein) FROM mealEntries m WHERE DATE(entryTime) = DATE(NOW())"));
$protein_day_sum = $protein_result[0];

$fat_result = mysqli_fetch_row($conn->executeSelect("SELECT SUM(m.fat) FROM mealEntries m WHERE DATE(entryTime) = DATE(NOW())"));
$fat_day_sum = $fat_result[0];

$carbs_result = mysqli_fetch_row($conn->executeSelect("SELECT SUM(m.carbs) FROM mealEntries m WHERE DATE(entryTime) = DATE(NOW())"));
$carbs_day_sum = $carbs_result[0];

// Calculate remaining
$protein_remaining = $proteinDaily - $protein_day_sum;
$fat_remaining = $fatDaily - $fat_day_sum;
$carbs_remaining = $carbsDaily - $carbs_day_sum;

?>
<div>
    <h2>Current Macros Left</h2>
    <p>Protein: <?php echo $protein_remaining ?> </p>
    <p>Fat:  <?php echo $fat_remaining ?> </p>
    <p>Carbohydrates:  <?php echo $carbs_remaining ?> </p>
</div>
<div>
    <h2>Insert Meal</h2>
    <form action="proc-pages/insert_macros.php" method="post">
        <table>
            <tr>
                <td valign="top">
                    <label for="protein">Protein</label>
                <td valign="top">
                    <input type="text" name="protein">
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <label for="carbs">Carbs</label>
                <td valign="top">
                    <input type="text" name="carbs">
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <label for="fat">Fat</label>
                <td valign="top">
                    <input type="text" name="fat">
                </td>
            </tr>
            <tr>
                <td style="text-align:center">
                    <input type="submit" value="Insert">
                </td>
            </tr>
        </table>
    </form>
</div>
</body>

