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
    mysqli_query($conn, $sql);
}

$message = "";
if (isset($_POST['delete_inventory_id'])) {
    $inventory_id = (int) $_POST['delete_inventory_id'];
    $current_worker = $_SESSION['worker'] ?? $_SESSION['user'];

    $sql_delete = "DELETE FROM inventory WHERE purchase_id = $inventory_id";
    if (mysqli_query($conn, $sql_delete)) {      
        $log_message = "Used item $inventory_id";
        addLog($conn, $_SESSION['user'], $current_worker, $log_message);
        $message = "<p style='color:green; padding:10px;'>Inventory Item has been Used</p>";
    } else {
        $message = "<p style='color:red; padding:10px;'>Error deleting: " . mysqli_error($conn) . "</p>";
    }
}

$user_name = mysqli_real_escape_string($conn, $_SESSION['user']);
$sql = "SELECT * FROM inventory WHERE user_name = '$user_name' ORDER BY purchase_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">

    <div class="header-notch">
        <h1>Inventory List</h1>
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
                <button class="btn-add" onclick="window.location.href='addInventory.php'">+ Add Inventory</button>
            </div>
            <?php echo $message; ?>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Purchase Date</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>#{$row['purchase_id']}</td>
                            <td>{$row['inventory_type']}</td>
                            <td>{$row['purchase_date']}</td>
                            <td>{$row['price']}</td>
                            <td>
                                <form method='post' style='margin:0;' onsubmit='return confirm(\"Delete inventory #{$row['purchase_id']}?\");'>
                                    <input type='hidden' name='delete_inventory_id' value='{$row['purchase_id']}'>
                                    <button type='submit' style='background:red; color:white; padding:5px 10px; border:none; border-radius:5px; cursor:pointer;'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No inventory found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>