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
// Pull Current Numbers

?>
<div>
    <form action="../php/insert_macros.php" method="post">
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

