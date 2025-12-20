<!DOCTYPE html>
<html>
<head>
    <title>Add Cattle</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg" margin="50px">

<div class="panel">
    <h2>Add New Cattle</h2><br>
</div>

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

    // SQL query to insert cattle data
    // NOTE: cattle_id is now auto-increment, so we don't include it
    $sql_cattle = "INSERT INTO cattle (cattle_type, age, gender, weight)
            VALUES ('$cattle_type', '$age', '$gender', '$weight')";
    $sql_owncattle = "INSERT INTO owns_cattle (registration_id,cattle_id)
            VALUES ('$farmar_id','$cattle__id')";
    $sql_getId = "";
    // Execute query
    if (mysqli_query($conn, $sql_cattle)) {
        $cattle_id = $conn->insert_id;
    }
    if (mysqli_query($conn, $sql_owncattle)) {
        header("Location: add_cattle.php?success=1");
        exit;
    } else {
        echo "<p style='color:red;'>Error adding cattle: " . mysqli_error($conn) . "</p>";
    }
}

// Show success message if redirected after insert
if (isset($_GET['success'])) {
    echo "<h2 style='color:white;'>Cattle added successfully</h2>";
}
?>

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
</body>
</html>