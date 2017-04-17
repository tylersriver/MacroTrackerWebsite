<?php
/**
 * This file displays remaining daily macros
 * and allows entry of a new meal
 */

// -- Includes
// ------------------------------------------------------
include_once ("global-header.php");
include_once ("lib/MySQL_Tool.php");

// -- Setup MySQL Connection and pull information
// ------------------------------------------------------
$conn = new MySQL_Tool();

// Calculate remaining daily macros
$protein_remaining = $conn->getRemainingMacro("protein");
$fat_remaining = $conn->getRemainingMacro("fat");
$carbs_remaining = $conn->getRemainingMacro("carbs");

$conn->closeConn();
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
                    <label for="description">Description</label>
                </td>
                <td valign="top">
                    <input type="text" name="description">
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <label for="protein">Protein</label>
                </td>
                <td valign="top">
                    <input type="number" maxlength="3" name="protein">
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <label for="fat">Fat</label>
                </td>
                <td valign="top">
                    <input type="number" maxlength="3" name="fat">
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <label for="carbs">Carbs</label>
                </td>
                <td valign="top">
                    <input type="number" maxlength="3" name="carbs">
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

