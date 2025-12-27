<?php
require_once "db.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = mysqli_real_escape_string($conn, $_SESSION['user']);

// --- 1. HANDLE SELL LOGIC ---
if (isset($_POST['sell_cattle_id'])) {
    $cattle_id = (int) $_POST['sell_cattle_id'];
    $check_ownership = mysqli_query($conn, "SELECT * FROM owns_cattle WHERE cattle_id = $cattle_id AND user_name = '$user'");
    
    if (mysqli_num_rows($check_ownership) > 0) {
        mysqli_query($conn, "DELETE FROM owns_cattle WHERE cattle_id = $cattle_id AND user_name = '$user'");
        mysqli_query($conn, "DELETE FROM cattle WHERE cattle_id = $cattle_id");
        
        $date = date("Y-m-d");
        $time = date("H:i:s");
        mysqli_query($conn, "INSERT INTO activity_logs (who, did_what, log_date, log_time) 
                             VALUES ('$user', 'Sold Cattle ID: #$cattle_id', '$date', '$time')");
    }
}

// --- 2. FILTERS ---
$type_filter = $_GET['type'] ?? '';
$gender_filter = $_GET['gender'] ?? '';

$query = "SELECT * FROM cattle c JOIN owns_cattle o ON c.cattle_id = o.cattle_id WHERE o.user_name = '$user'";
if (!empty($type_filter)) $query .= " AND c.cattle_type = '" . mysqli_real_escape_string($conn, $type_filter) . "'";
if (!empty($gender_filter)) $query .= " AND c.gender = '" . mysqli_real_escape_string($conn, $gender_filter) . "'";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cattle Management</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Unified Container */
        .management-card {
            background: white;
            max-width: 950px;
            margin: 100px auto 40px 110px; /* Aligned with sidebar and notch */
            border-radius: 20px;
            overflow: hidden; /* Important for keeping table corners rounded */
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        /* Filter Section Header */
        .card-header {
            padding: 20px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .filter-row {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .filter-row select {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-family: sans-serif;
        }

        .btn-add {
            background: #009879;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            margin-left: auto; /* Pushes button to the far right */
        }

        /* Reset table margins to fit flush in card */
        .table {
            margin: 0 !important;
            width: 100%;
            border-radius: 0;
            box-shadow: none;
        }
    </style>
</head>
<body class="farm-bg">

    <div class="header-notch">
        <h1>Cattle Inventory</h1>
    </div>

    <div class="topbar">
        <button onclick="location.href='dashboard.php'"><img src="assets/img/barn.png"></button>
        <button onclick="showCattle()"><img src="assets/img/cattle.png"></button>
        <button onclick="showLog()"><img src="assets/img/wood.png"></button>
        <button style='background:red;' onclick="location.href='logout.php'"><img src="assets/img/logout.png"></button>
    </div>

    <div class="management-card">
        
        <div class="card-header">
            <div style="display: flex; align-items: center;">
                <h2 style="margin: 0; color: #333;">Livestock Filter</h2>
                <button class="btn-add" onclick="window.location.href='add_cattle.php'">+ Add New Cattle</button>
            </div>

            <form method="GET" class="filter-row">
                <select name="type">
                    <option value="">All Types</option>
                    <option value="Cow" <?php if($type_filter == 'Cow') echo 'selected'; ?>>Cow</option>
                    <option value="Goat" <?php if($type_filter == 'Goat') echo 'selected'; ?>>Goat</option>
                    <option value="Sheep" <?php if($type_filter == 'Sheep') echo 'selected'; ?>>Sheep</option>
                </select>

                <select name="gender">
                    <option value="">Any Gender</option>
                    <option value="Male" <?php if($gender_filter == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if($gender_filter == 'Female') echo 'selected'; ?>>Female</option>
                </select>

                <button type="submit" style="background:#333; color:white; border:none; padding:8px 15px; border-radius:8px; cursor:pointer;">Apply</button>
                <a href="showcattle.php" style="color: #666; font-size: 0.9em; text-decoration: none;">Clear All</a>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Weight</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>#<?php echo $row['cattle_id']; ?></td>
                        <td><strong><?php echo $row['cattle_type']; ?></strong></td>
                        <td><?php echo $row['age']; ?> Yrs</td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['weight']; ?> kg</td>
                        <td>
                            <form method='post' onsubmit="return confirm('Sell Cattle #<?php echo $row['cattle_id']; ?>?')">
                                <input type='hidden' name='sell_cattle_id' value='<?php echo $row['cattle_id']; ?>'>
                                <button type='submit' style='background:#ff4d4d; color:white; border:none; padding:5px 12px; border-radius:5px; cursor:pointer;'>Sell</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script>
        function showCattle() { window.location.href="showcattle.php"; }
        function showLog() { window.location.href="report.php"; }
    </script>
</body>
</html>