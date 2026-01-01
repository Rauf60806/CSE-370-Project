<?php
require_once "db.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['user']; // This is the Farmer/Owner

// 1. Logic for filtering by date
$where_sql = "WHERE user_name = '$current_user'"; // Default: Get logs for this farm only
$filter_date = "";

if (isset($_GET['filter_date']) && !empty($_GET['filter_date'])) {
    $filter_date = mysqli_real_escape_string($conn, $_GET['filter_date']);
    // Append the date filter to the existing WHERE clause
    $where_sql .= " AND log_date = '$filter_date' ";
}

// 2. Fetch logs (Newest first)
// We select where user_name = Session User, but we display 'who' in the table
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
    </div>

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
        function showLog() {window.location.href="report.php"}
        function showinvent(){window.location.href="showInventory.php"}
        function addinvent(){window.location.href="addInventory.php"}
    </script>

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
                <th>Who (Performer)</th>
                <th>Action</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Check if the 'who' matches the 'owner'. If so, we can style it differently or just show name.
                    $performer = htmlspecialchars($row['who']);
                    
                    echo "<tr>";
                    echo "<td>#" . $row['report_id'] . "</td>";
                    echo "<td style='color: #009879; font-weight:bold;'>" . $performer . "</td>";
                    echo "<td>" . htmlspecialchars($row['did_what']) . "</td>";
                    echo "<td>" . $row['log_date'] . "</td>";
                    echo "<td>" . $row['log_time'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>No activities found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>