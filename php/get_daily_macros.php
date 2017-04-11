<?php
/**
 * Created by PhpStorm.
 * User: tyler
 * Date: 4/10/2017
 */

include_once ("lib/MySQL_Tool.php");
$conn = new MySQL_Tool();

// -- Process Data and Insert
$sql  = "SELECT protein, fat, carbs FROM dailyMacros";
$result = $conn->executeSelect($sql);

// -- Pass to POST
$daily = $result->fetch_row();
$protein = $daily[0];
$fat = $daily[1];
$carbs = $daily[2];

$conn->closeConn();
?>
<head>
    <title>Macro Tracker</title>
    <link rel="stylesheet" type="text/css" href="../styles/global-styles.css">
</head>
<body>
<header>
    <ul>
        <li><a href="home.php" class="button">Home</a></li>
        <li><a href="get_daily_macros.php" class="button">Daily Macros</a></li>
    </ul>
</header>
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
                <td valign="top">
                    <input type="text" name="protein">
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <label>Carbs</label>
                <td valign="top">
                    <input type="text" name="carbs">
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <label>Fat</label>
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


