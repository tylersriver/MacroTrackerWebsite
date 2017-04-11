<?php

// -- Setup MySQL Connection
// ------------------------------------------------------
$servername = "localhost";
$username = "root";
$password = "newpwd";
$db = "MacroTracker";

// Open Connection
$conn = new mysqli($servername, $username, $password, $db);

// Check Connection
if($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}

// -- Process Data and Insert
$sql  = "SELECT protein, fat, carbs FROM dailyMacros";
try { // Execute insert
  $result = mysqli_query($conn, $sql);
} catch (Exception $err) {
  die("Insert Failed: ".$err->getMessage());
}

// -- Pass to POST
$daily = $result->fetch_row();
$protein = $daily[0];
$fat = $daily[1];
$carbs = $daily[2];

$conn->close();
?>
<header>
    <title>Macro Tracker</title>
</header>
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
    <form action="insert_daily_macros.php" method="post">
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


