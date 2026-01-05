<!DOCTYPE html>
<html>
<head>
    <title>Add Worker</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg" margin="50px">
</div>
<div class="topbar">
        <button onclick="profile()"><img src="assets/img/farmer.png"></button>
        <button type="button" onclick="location.href='dashboard.php'" title="Home"><img src="assets/img/barn.png"></button>
        <button onclick="showCattle()"><img src="assets/img/cattle.png"></button>
        <button onclick="showWorker()"><img src="assets/img/worker.png"></button>
        <button onclick="showProduct()"><img src="assets/img/product.png"></button>
        <button onclick="medical_record()"><img src="assets/img/medical.png"></button>
        <button onclick="showinvent()"><img src="assets/img/market.png"></button>
        <button onclick="showLog()"><img src="assets/img/wood.png"></button>
        <button style='background:red;' onclick="location.href='logout.php'"><img src="assets/img/logout.png"></button>
    <script>
    function profile() {window.location.href="profile.php"}
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
    function showinvent(){window.location.href="showInventory.php"}
    function addinvent(){window.location.href="addInventory.php"}
    </script>
</div>
    <div class="header-notch">
        <h1>Register New Workers</h1>
    </div>
<div class = "panel" style="max-width: 430px; margin: 100px auto;">
<?php
require_once "db.php";
session_start();
function addLog($conn, $owner, $worker, $action) {
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $owner  = mysqli_real_escape_string($conn, $owner);
    $worker = mysqli_real_escape_string($conn, $worker); 
    $action = mysqli_real_escape_string($conn, $action);
    $sql = "INSERT INTO activity_logs (user_name, who, did_what, log_date, log_time) 
            VALUES ('$owner', '$worker', '$action', '$date', '$time')";
            
    if (!mysqli_query($conn, $sql)) {
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $age         = $_POST["age"];
    $salary      = $_POST["salary"];
    $work_hour   = $_POST["work_hour"];
    $contact  = $_POST["contact"];

    $sql = "INSERT INTO worker (pass,name, age, salary, work_hour,contact_number)
            VALUES ('$pass','$name', '$age', '$salary', '$work_hour', '$contact')";

    if (mysqli_query($conn, $sql)) {
        $worker_id = $conn->insert_id;
        $sql_ownworker = "INSERT INTO owns_worker (user_name, worker_id) VALUES ('"
    . mysqli_real_escape_string($conn, $_SESSION['user']) . "', "
    . (int)$worker_id . ")";
    }
    if (mysqli_query($conn, $sql_ownworker)) {
        
            $log_message = "Added a new Worker (ID: $worker_id, Contact: $contact)";
            addLog($conn, $_SESSION['user'], $_SESSION['worker'], $log_message);

        header("Location: addWorker.php?success=1");
        exit;
    } else {
        echo "<p style='color:red;'>Error adding worker: " . mysqli_error($conn) . "</p>";
    }
}
if (isset($_GET['success'])) {
    echo "<h2>Worker added successfully</h2>";
}
?>
<form method="post" style="margin: 0 auto; max-width: 500px; font-weight: bold; text-shadow: 1px 1px 2px white;">
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Name</label><br>
        <input type="text" name="name" required style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>
    <div style="margin-bottom: 20px;">
        <label style="font-weight: bold;">Password</label><br>
        <input type="password" name="pass" required style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Age</label><br>
        <input type="number" name="age" required style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Salary</label><br>
        <input type="number" name="salary" required style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Work Hour [Per Week]</label><br>
        <input type="number" name="work_hour" required style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>
    <div style="margin-bottom: 20px;">
        <label style="font-weight: bold;">Contact Number</label><br>
        <input type="text" name="contact" required style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>
    <button type="submit" style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
        Add Worker
    </button>

</form>
</div>
</body>
</html>