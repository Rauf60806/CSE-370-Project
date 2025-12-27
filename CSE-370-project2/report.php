<?php
require_once "db.php";
session_start();

// 1. Logic for filtering by date
$filter_date = "";
$where_sql = "";

if (isset($_GET['filter_date']) && !empty($_GET['filter_date'])) {
    $filter_date = mysqli_real_escape_string($conn, $_GET['filter_date']);
    // Filter by the specific date chosen
    $where_sql = " WHERE log_date = '$filter_date' ";
}

// 2. Fetch logs (Newest first)
$query = "SELECT * FROM activity_logs $where_sql ORDER BY log_date DESC, log_time DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Activity Report</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Extra styling for the filter bar */
        .filter-container {
            background: white;
            padding: 15px;
            border-radius: 15px;
            margin: 100px auto 20px auto; /* Push down for header-notch */
            max-width: 800px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .filter-container input[type="date"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn-filter {
            background: #009879;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-reset {
            background: #666;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.8em;
        }
    </style>
</head>
<body class="farm-bg">

    <div class="header-notch">
        <h1>Activity Logs</h1>
    </div>

    </div>
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

    <div class="filter-container">
        <form method="GET" action="report.php">
            <label style="font-weight: bold;">Filter by Date: </label>
            <input type="date" name="filter_date" value="<?php echo $filter_date; ?>">
            <button type="submit" class="btn-filter">Apply Filter</button>
            <?php if($filter_date): ?>
                <a href="report.php" class="btn-reset">Clear</a>
            <?php endif; ?>
        </form>
        <div style="font-size: 0.9em; color: #666;">
            Showing: <?php echo mysqli_num_rows($result); ?> entries
        </div>
    </div>

    <table class="table" style="width: 90%; max-width: 800px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
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
                    echo "<td><strong>" . htmlspecialchars($row['who']) . "</strong></td>";
                    echo "<td>" . htmlspecialchars($row['did_what']) . "</td>";
                    echo "<td>" . $row['log_date'] . "</td>";
                    echo "<td>" . $row['log_time'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>No activities found for this date.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>