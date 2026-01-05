<?php
require_once "db.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$current_user = $_SESSION['user'];
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
    $sell_qty   = (int) $_POST['sell_qty'];
    $sql_check = "SELECT p.price, d.quantity 
                  FROM product p 
                  JOIN production_date d ON p.product_id = d.product_id 
                  WHERE p.product_id = $product_id";
    $check_res = mysqli_query($conn, $sql_check);
    
    if(mysqli_num_rows($check_res) > 0){
        $prod_data = mysqli_fetch_assoc($check_res);
        $current_qty = $prod_data['quantity'];
        $price = $prod_data['price'];
        
        if ($sell_qty > $current_qty) {
            echo "<script>alert('Error: Not enough stock!');</script>";
        } else {
            $income = $sell_qty * $price;
            $sql_profit = "UPDATE dashboard_panel SET profit = profit + $income WHERE user_name = '$current_user'";
            mysqli_query($conn, $sql_profit);
            if ($sell_qty == $current_qty) {
                mysqli_query($conn, "DELETE FROM owns_product WHERE product_id = $product_id");
                mysqli_query($conn, "DELETE FROM production_date WHERE product_id = $product_id");
                mysqli_query($conn, "DELETE FROM product WHERE product_id = $product_id");
            } else {
                $new_qty = $current_qty - $sell_qty;
                mysqli_query($conn, "UPDATE production_date SET quantity = $new_qty WHERE product_id = $product_id");
            }
            addLog($conn, $current_user, $_SESSION['worker'] ?? $current_user, "Sold Product #$product_id (Qty: $sell_qty). Income: $income");
            header("Location: showProduct.php");
            exit;
        }
    }
}
$sql = "SELECT p.product_id, p.category, p.price, d.production_date, d.quantity 
        FROM product p 
        JOIN owns_product op ON p.product_id = op.product_id 
        JOIN production_date d ON p.product_id = d.product_id
        WHERE op.user_name = '$current_user'";

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

    <div class="management-card">
        <div class="card-header">
            <div class="card-header-top">
                <button class="btn-add" onclick="window.location.href='addProduct.php'">+ Add Product</button>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Prod. Date</th>
                    <th>Expiry Date</th>
                    <th>Price</th>
                    <th>Stock (Qty)</th>
                    <th>Action (Sell)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cat = $row['category'];
                        $pDate = $row['production_date'];
                        $expiry_display = "N/A";
                        $class = "fresh";
                        
                        if ($cat == 'Milk') {
                            $expiry_date = date('Y-m-d', strtotime($pDate . ' + 7 days'));
                            $expiry_display = $expiry_date;
                        } elseif ($cat == 'Meat') {
                            $expiry_date = date('Y-m-d', strtotime($pDate . ' + 30 days'));
                            $expiry_display = $expiry_date;
                        }
                        
                        if ($expiry_display != "N/A" && date('Y-m-d') > $expiry_display) {
                            $expiry_display .= " (EXPIRED)";
                            $class = "expired";
                        }

                        echo "<tr>
                            <td>{$row['category']}</td>
                            <td>{$pDate}</td>
                            <td class='$class'>{$expiry_display}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['quantity']}</td> <td>
                                <form method='post' style='display:flex; gap:5px; align-items:center;' onsubmit=\"return confirm('Confirm Sale?');\">
                                    <input type='hidden' name='sell_product_id' value='{$row['product_id']}'>
                                    <input type='number' name='sell_qty' 
                                           min='1' max='{$row['quantity']}' 
                                           value='{$row['quantity']}' 
                                           style='width:60px; padding:5px;' required>
                                    
                                    <button type='submit' class='btn-danger'>Sell</button>
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