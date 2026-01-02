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

if (isset($_POST['sell_product_id'])) {
    $product_id = (int) $_POST['sell_product_id'];
    $user = mysqli_real_escape_string($conn, $_SESSION['user']);
    $current_worker = $_SESSION['worker'] ?? $user;

    $sql_delete = "DELETE FROM owns_product WHERE product_id = $product_id AND user_name = '$user'";
    $sql_delete_prod = "DELETE FROM product WHERE product_id = $product_id";
    
    $log_message = "Sold Product $product_id";
    addLog($conn, $_SESSION['user'], $current_worker, $log_message);
    
    mysqli_query($conn, $sql_delete);
    mysqli_query($conn, $sql_delete_prod);
}

$sql = "SELECT * FROM product c JOIN owns_product p ON c.product_id = p.product_id 
        WHERE p.user_name = '" . mysqli_real_escape_string($conn, $_SESSION['user']) . "'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">

    <div class="header-notch">
        <h1>List of Products</h1>
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
                <h2>Product Inventory</h2>
                <button class="btn-add" onclick="window.location.href='addProduct.php'">+ Add Product</button>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Product Id</th>
                    <th>Category</th>
                    <th>Production Date</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>#{$row['product_id']}</td>
                            <td>{$row['category']}</td>
                            <td>{$row['production_date']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['quantity']}</td>
                            <td>
                                <form method='post' style='margin:0;' onsubmit=\"return confirm('Sell Product #{$row['product_id']}?');\">
                                    <input type='hidden' name='sell_product_id' value='{$row['product_id']}'>
                                    <button type='submit' style='background:red; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;'>Sell</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>