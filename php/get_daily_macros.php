<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/10/2017
 *
 * This file shows what the daily macros are
 * set to and allows them to be changed
 */

// -- Includes
// ------------------------------------------------------
include_once ("global-header.php");
include_once ("lib/MySQL_Tool.php");

// -- open conn and Select From daily
// ------------------------------------------------------
$conn = new MySQL_Tool();
$sql  = "SELECT protein, fat, carbs FROM dailyMacros";
$result = $conn->executeSelect($sql);
$daily = $result->fetch_row();
$conn->closeConn();

// Store in variables
// ------------------------------------------------------
$protein = $daily[0];
$fat = $daily[1];
$carbs = $daily[2];
?>
<div>
    <h2>Current Daily Macros</h2>
    <p>Protein: <?php echo $protein ?> </p>
    <p>Fat:  <?php echo $fat ?> </p>
    <p>Carbohydrates:  <?php echo $carbs ?> </p>
</div>
<div>
    <h2>Set Daily Macros</h2>
    <form action="proc-pages/insert_daily_macros.php" method="post">
        <table>
            <tr>
                <td valign="top">
                    <label>Protein</label>
                </td>
                <td valign="top">
                    <input type="text" name="protein">
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <label>Carbs</label>
                </td>
                <td valign="top">
                    <input type="text" name="carbs">
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <label>Fat</label>
                </td>
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


