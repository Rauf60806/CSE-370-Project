<!DOCTYPE html>
<html>
<head>
    <title>Add Worker</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg" margin="50px">
<div class="topbar">
        <button type="button" onclick="location.href='dashboard.php'" title="Home"><img src="assets/img/barn.png"></button>
        <button onclick="showCattle()"><img src="assets/img/cattle.png"></button>
        <button onclick="showWorker()"><img src="assets/img/worker.png"></button>
        <button onclick="showProduct()"><img src="assets/img/product.png"></button>
        <button onclick="medical_record()"><img src="assets/img/medical.png"></button>
        <button onclick="showLog()"><img src="assets/img/wood.png"></button>
        <button style='background:red;' onclick="location.href='logout.php'"><img src="assets/img/logout.png"></button>
    <script>
    function Dashboard() {window.location.href="dashboard.php"}
    function addCattle() {window.location.href="add_cattle.php"}
    function showCattle() {window.location.href="showcattle.php"}
    function addWorker() {window.location.href="addWorker.php"}
    function showWorker() {window.location.href="showWorker.php"}
    function addProduct() {window.location.href="addProduct.php"}
    function showProduct() {window.location.href="showProduct.php"}
    function medical_record() {window.location.href="medical_record.php"}
    function addProduct() {window.location.href="addProduct.php"}
    function showLog() {window.location.href="report.php"}
    </script>
</div>
<div class="panel">
    <h2>Add New Worker</h2><br>
</div>

<?php
// Include database connection
require_once "db.php";
session_start();
/*
|--------------------------------------------------------------------------
| HANDLE FORM SUBMISSION
|--------------------------------------------------------------------------
| This block runs ONLY when the form is submitted using POST
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Read form values safely
    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $age         = $_POST["age"];
    $salary      = $_POST["salary"];
    $work_hour   = $_POST["work_hour"];
    $contact  = $_POST["contact"];

    // SQL query to insert worker data
    // NOTE: worker_id is now auto-increment, so we don't include it
    $sql = "INSERT INTO worker (pass,name, age, salary, work_hour,contact_number)
            VALUES ('$pass','$name', '$age', '$salary', '$work_hour', '$contact')";

    if (mysqli_query($conn, $sql)) {
        $worker_id = $conn->insert_id;
        $sql_ownworker = "INSERT INTO owns_worker (user_name, worker_id) VALUES ('"
    . mysqli_real_escape_string($conn, $_SESSION['user']) . "', "
    . (int)$worker_id . ")";
    }
    // Execute query
    if (mysqli_query($conn, $sql_ownworker)) {
        // Redirect after successful insert to avoid duplicate on reload (PRG pattern)
        header("Location: addWorker.php?success=1");
        exit;
    } else {
        echo "<p style='color:red;'>Error adding worker: " . mysqli_error($conn) . "</p>";
    }
}

// Show success message if redirected after insert
if (isset($_GET['success'])) {
    echo "<h2 style='color:white;'>Worker added successfully</h2>";
}
?>

<!--
| ADD WORKER FORM
|--------------------------------------------------------------------------
| This form collects worker information from the user
-->
<div class = "panel">
<form method="post" style="margin: 0 auto; max-width: 500px; font-weight: bold; text-shadow: 1px 1px 2px white;">

    <!-- Name input -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Name</label><br>
        <input type="text" name="name" required >
    </div>
    <div style="margin-bottom: 20px;">
        <label style="font-weight: bold;">Password</label><br>
        <input type="password" name="pass" required>
    </div>
    <!-- Age input -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Age</label><br>
        <input type="number" name="age" required >
    </div>

    <!-- Salary input -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Salary</label><br>
        <input type="number" name="salary" required >
    </div>

    <!-- Work Hour input -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Work Hour</label><br>
        <input type="number" name="work_hour" required >
    </div>

    <!-- Access Key input -->
    <div style="margin-bottom: 20px;">
        <label style="font-weight: bold;">contact Number</label><br>
        <input type="text" name="access_key" required >
    </div>
    <!-- Submit button -->
    <button type="submit" style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
        Add Worker
    </button>

</form>
</div>
</body>
</html>