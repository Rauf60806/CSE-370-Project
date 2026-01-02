<?php
require_once "db.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['user'];
$where_sql = "WHERE user_name = '$current_user'";
$filter_date = "";

if (isset($_GET['filter_date']) && !empty($_GET['filter_date'])) {
    $filter_date = mysqli_real_escape_string($conn, $_GET['filter_date']);
    $where_sql .= " AND log_date = '$filter_date' ";
}

$query = "SELECT * FROM activity_logs $where_sql ORDER BY log_date DESC, log_time DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Activity Report</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">

    <div class="header-notch">
        <h1>Activity Logs</h1>
    </div>

    <div class="topbar">
        <button onclick="location.href='profile.php'"><img src="assets/img/farmer.png"></button>
        <button onclick="location.href='dashboard.php'"><img src="assets/img/barn.png"></button>
        <button onclick="location.href='showCattle.php'"><img src="assets/img/cattle.png"></button>
        <button onclick="location.href='showWorker.php'"><img src="assets/img/worker.png"></button>
        <button onclick="location.href='showProduct.php'"><img src="assets/img/product.png"></button>
        <button onclick="location.href='medical_record.php'"><img src="assets/img/medical.png"></button>
        <button onclick="location.href='showInventory.php'"><img src="assets/img/market.png"></button>
        <button onclick="location.href='report.php'"><img src="assets/img/wood.png"></button>
        <button style='background:red;' onclick="location.href='logout.php'"><img src="assets/img/logout.png"></button>
    </div>

    <div class="management-card">
        <div class="card-header">
            <div class="card-header-top">
                <h2>Daily Activities</h2>
                
                <form method="GET" class="filter-row">
                    <label>Date:</label>
                    <input type="date" name="filter_date" value="<?php echo $filter_date; ?>" style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
                    <button type="submit" style="background: #009879; color: white; border: none; padding: 6px 12px; border-radius: 5px; cursor: pointer;">Filter</button>
                    <?php if($filter_date): ?>
                        <a href="report.php" style="color: #666; font-size: 0.9em; text-decoration: none;">Clear</a>
                    <?php endif; ?>
                </form>
            </div>
            <div style="font-size: 0.9em; color: #888;">
                Found: <?php echo mysqli_num_rows($result); ?> records
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Performer</th>
                    <th>Action</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>#" . $row['report_id'] . "</td>";
                        echo "<td style='color: #009879; font-weight:bold;'>" . htmlspecialchars($row['who']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['did_what']) . "</td>";
                        echo "<td>" . $row['log_date'] . "</td>";
                        echo "<td>" . $row['log_time'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>No activity logs found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>