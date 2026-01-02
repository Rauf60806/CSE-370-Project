<?php
require_once "db.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$current_user = mysqli_real_escape_string($conn, $_SESSION['user']);
$sql_cattle_count = "SELECT COUNT(*) as total FROM cattle 
                     INNER JOIN owns_cattle ON cattle.cattle_id = owns_cattle.cattle_id 
                     WHERE owns_cattle.user_name = '$current_user'";
$total_cattle = mysqli_fetch_assoc(mysqli_query($conn, $sql_cattle_count))['total'];
$sql_cow_count = "SELECT COUNT(*) as total FROM cattle 
                  INNER JOIN owns_cattle ON cattle.cattle_id = owns_cattle.cattle_id 
                  WHERE owns_cattle.user_name = '$current_user' AND cattle.cattle_type = 'Cow'";
$cow_count = mysqli_fetch_assoc(mysqli_query($conn, $sql_cow_count))['total'];
$sql_goat_count = "SELECT COUNT(*) as total FROM cattle 
                   INNER JOIN owns_cattle ON cattle.cattle_id = owns_cattle.cattle_id 
                   WHERE owns_cattle.user_name = '$current_user' AND cattle.cattle_type = 'Goat'";
$goat_count = mysqli_fetch_assoc(mysqli_query($conn, $sql_goat_count))['total'];
$sql_sheep_count = "SELECT COUNT(*) as total FROM cattle 
                    INNER JOIN owns_cattle ON cattle.cattle_id = owns_cattle.cattle_id 
                    WHERE owns_cattle.user_name = '$current_user' AND cattle.cattle_type = 'Sheep'";
$sheep_count = mysqli_fetch_assoc(mysqli_query($conn, $sql_sheep_count))['total'];


$sql_worker_count = "SELECT COUNT(*) as total FROM worker c join owns_worker w on c.worker_id = w.worker_id WHERE user_name = '$current_user'";
$worker_count = mysqli_fetch_assoc(mysqli_query($conn, $sql_worker_count))['total'];

$sql_product_count = "SELECT COUNT(*) as total FROM product c join owns_product p on c.product_id = p.product_id WHERE user_name = '$current_user'";
$product_count = mysqli_fetch_assoc(mysqli_query($conn, $sql_product_count))['total'];

$sql_logs = "SELECT * FROM activity_logs WHERE who = '$current_user' ORDER BY report_id DESC LIMIT 5";
$recent_logs = mysqli_query($conn, $sql_logs);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cattle Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">
    <div class="header-notch">
        <h1>🐄 Farmer Dashboard 🐐</h1>
        <h1>User: <?php echo $_SESSION["user"]; ?></h1>
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
<div class="main-content">
    <div class="stats-grid">
        <div class="stat-card highlight">
            <h3>Total Livestock</h3>
            <p class="stat-number"><?php echo $total_cattle; ?></p>
            <div class="breakdown">
                <span>Cows: <?php echo $cow_count; ?></span> | 
                <span>Goats: <?php echo $goat_count; ?></span> | 
                <span>Sheep: <?php echo $sheep_count; ?></span>
            </div>
        </div>

        <div class="stat-card">
            <h3>Staff Members</h3>
            <p class="stat-number"><?php echo $worker_count; ?></p>
        </div>

        <div class="stat-card">
            <h3>Farm Products</h3>
            <p class="stat-number"><?php echo $product_count; ?></p>
        </div>
    </div>
</div>
</body>
</html>
