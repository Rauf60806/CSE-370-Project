<?php
require_once "db.php";
session_start();

if (!isset($_SESSION['worker'])) {
    header("Location: index.php");
    exit();
}

$worker_id = $_SESSION['worker'];  
$current_user = $_SESSION['user']; 
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

$sql_product_count = "SELECT COUNT(*) as total FROM product c join owns_product p on c.product_id = p.product_id WHERE user_name = '$current_user'";
$product_count = mysqli_fetch_assoc(mysqli_query($conn, $sql_product_count))['total'];

$sql_logs = "SELECT * FROM activity_logs WHERE who = '$worker_id' ORDER BY report_id DESC LIMIT 10";
$recent_logs = mysqli_query($conn, $sql_logs);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Worker Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">

    <div class="header-notch">
        <h1>Worker Dashboard</h1>
    </div>

    <div class="topbar">
        <button onclick="profile()"><img src="assets/img/worker.png"></button>
        <button type="button" onclick="location.href='worker.php'" title="Home"><img src="assets/img/barn.png"></button>
        <button onclick="updateCattle()"><img src="assets/img/medical2.png"></button>
        <button onclick="addProduct()"><img src="assets/img/product.png"></button>
        <button onclick="medical_record()"><img src="assets/img/medical.png"></button>
        <button onclick="addLog()"><img src="assets/img/wood.png"></button>
        <button style='background:red;' onclick="location.href='logout.php'"><img src="assets/img/logout.png"></button>
        <script>
            function profile() {window.location.href="workerProfile.php"}
            function Dashboard() {window.location.href="worker.php"}
            function updateCattle() {window.location.href="updateCattleInfo.php"}
            function addProduct() {window.location.href="addProductW.php"}
            function medical_record() {window.location.href="medical_recordW.php"}
            function addLog() {window.location.href="addLog.php"}
            function sellproduct() {window.location.href="showStock.php"}
        </script>
    </div>
    <div class="main-content" >
        <div class="stats-grid">
            <div class="stat-card highlight" >
                <h3>Total Livestock</h3>
                <p class="stat-number"><?php echo $total_cattle; ?></p>
                <div class="breakdown">
                    <span>Cows: <?php echo $cow_count; ?></span> | 
                    <span>Goats: <?php echo $goat_count; ?></span> | 
                    <span>Sheep: <?php echo $sheep_count; ?></span>
                </div>
            </div>
            <div class="stat-card highlight" onclick="sellproduct()">
                <h3 >Sell Product</h3>
                <p class="stat-number"><?php echo $product_count; ?></p>
            </div>
        </div>
            <table class="table" style="border-collapse: collapse;">
                <thead>
                    <tr style="text-align: center; ;">
                        <th colspan="3"><h2 style="color:white">My Recent Activity Log</h2></th>
                    </tr>
                    <tr style="text-align: left;">
                        <th style="padding: 10px; border-bottom: 1px solid #ddd;">Action</th>
                        <th style="padding: 10px; border-bottom: 1px solid #ddd;">Date</th>
                        <th style="padding: 10px; border-bottom: 1px solid #ddd;">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($recent_logs) > 0) {
                        while($row = mysqli_fetch_assoc($recent_logs)) {
                            echo "<tr>
                                    <td style='padding: 10px; border-bottom: 1px solid #eee;'>". htmlspecialchars($row['did_what']) ."</td>
                                    <td style='padding: 10px; border-bottom: 1px solid #eee;'>". $row['log_date'] ."</td>
                                    <td style='padding: 10px; border-bottom: 1px solid #eee;'>". $row['log_time'] ."</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' style='padding: 20px; text-align:center; color:#666;'>No recent activity found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

    </div>

</body>
</html>