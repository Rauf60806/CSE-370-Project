<?php
session_start();
if (isset($_SESSION['role'])) {
    header("Location: dashboard/" . $_SESSION['role'] . ".php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg" margin="50px">

<div class="panel">
    <h2>Fill up the form</h2><br>
</div>

<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Read form values safely
    $user_name = $_POST["user_name"];
    $farm_name = $_POST["farm_name"];
    $Farm_location  = $_POST["Farm_location"];
    $pass      = $_POST["pass"];

    // id is auto increment
    $sql = "INSERT INTO dashboard_panel (user_name, farm_name, Farm_location, pass)
            VALUES ('$user_name', '$farm_name', '$Farm_location', '$pass')";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        header("Location: register.php?success=1");
        exit;
    } else {
        echo "<p style='color:red;'>Error adding user: " . mysqli_error($conn) . "</p>";
    }
}
if (isset($_GET['success'])) {
    echo "<h2 style='color:white;'>User added successfully</h2>";
}
?>

<div class = "panel">
<form method="post" style="margin: 0 auto; max-width: 500px; font-weight: bold; text-shadow: 1px 1px 2px white;">

    <!-- User name -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">User Name</label><br>
        <input type="text" name="user_name" required >
    </div>

    <!-- Farm Name input -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Farm Name</label><br>
        <input type="text" name="farm_name" required >
    </div>

    <!-- Farm Location input -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Farm Location</label><br>
        <input type="text" name="Farm_location" required >
    </div>

    <!-- Password input -->
    <div style="margin-bottom: 20px;">
        <label style="font-weight: bold;">Password</label><br>
        <input type="password" name="pass" >
    </div>
    <!-- Submit button -->
    <button type="submit" >
        Register
    </button>
    <a href="index.php">
            <button type="button">Login Now</button>
    </a>

</form>
</div>
</body>
</html>