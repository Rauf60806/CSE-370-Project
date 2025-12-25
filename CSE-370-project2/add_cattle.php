<!DOCTYPE html>
<html>
<head>
    <title>Add Cattle</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg" margin="50px">
<div class="topbar">
        <button type="button" onclick="location.href='dashboard.php'" title="Home">
            <img src="assets/img/barn.png">
        </button>
        <button onclick="location.href='logout.php'">Logout</button>
</div>
<div class="panel">
    <h2>Add New Cattle</h2><br>


<?php
// Include database connection
require_once "db.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Read form values safely
    $cattle_type = $_POST["cattle_type"];
    $age         = $_POST["age"];
    $gender      = $_POST["gender"];
    $weight      = $_POST["weight"];

    $sql_cattle = "INSERT INTO cattle ( age, gender, weight,cattle_type)
            VALUES ( '$age', '$gender', '$weight','$cattle_type')";
    if (mysqli_query($conn, $sql_cattle)) {
        $cattle_id = $conn->insert_id;
        $sql_owncattle = "INSERT INTO owns_cattle (user_name, cattle_id) VALUES ('"
    . mysqli_real_escape_string($conn, $_SESSION['user']) . "', "
    . (int)$cattle_id . ")";

    } 
    if (mysqli_query($conn, $sql_owncattle)) {
       header("Location: add_cattle.php?success=1");
        exit;
    } 
     else {
        echo "<p style='color:red;'>Error adding cattle: " . mysqli_error($conn) . "</p>";
    }
}

// Show success message if redirected after insert
if (isset($_GET['success'])) {
    echo "<h2 style='color:#4CAF50;'>Cattle added successfully</h2>";
}
?>
</div>
<!--
|--------------------------------------------------------------------------
| ADD CATTLE FORM
|--------------------------------------------------------------------------
| This form collects cattle information from the user
-->
<div class = "panel">
<form method="post" style="margin: 0 auto; max-width: 500px; font-weight: bold; text-shadow: 1px 1px 2px white;">

    <!-- Cattle Type selection -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Cattle Type</label><br>
        <select name="cattle_type" required style="width: 100%; padding: 8px; border-radius: 5px;">
            <option value="">Select type</option>
            <option value="Cow">Cow</option>
            <option value="Goat">Goat</option>
            <option value="Sheep">Sheep</option>
        </select>
    </div>

    <!-- Age input -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Age</label><br>
        <input type="number" name="age" required style="width: 100%; padding: 8px; border-radius: 5px;">
    </div>

    <!-- Gender selection -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Gender</label><br>
        <select name="gender" required style="width: 100%; padding: 8px; border-radius: 5px;">
            <option value="">Select gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>

    <!-- Weight input -->
    <div style="margin-bottom: 20px;">
        <label style="font-weight: bold;">Weight (kg)</label><br>
        <input type="number" name="weight" required style="width: 100%; padding: 8px; border-radius: 5px;">
    </div>

    <!-- Submit button -->
    <button type="submit" style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
        Add Cattle
    </button>
</form>
</div>
<div class="panel" style="margin-top: 20px;">
    <button onclick="window.location.href='showcattle.php'">
        Show Cattle
    </button>
</div>
</body>
</html>