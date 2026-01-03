<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg" margin="50px">
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
    </script>
</div>
<div class="header-notch">
        <h1>Add Product</h1>
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
    mysqli_query($conn, $sql);
}

$user = $_SESSION['user'];

// --- HANDLE FORM SUBMISSION ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = (int)$_POST["product_id"];
    $quantity   = (int)$_POST["quantity"];
    $p_date     = date("Y-m-d"); // Current Date automatically

    // Insert into production_date table (The Stock Batch)
    $sql_stock = "INSERT INTO production_date (product_id, production_date, quantity) 
                  VALUES ('$product_id', '$p_date', '$quantity')";

    if (mysqli_query($conn, $sql_stock)) {
        
        // Log the action (Fetching name for log)
        $res = mysqli_query($conn, "SELECT category FROM product WHERE product_id=$product_id");
        $cat = mysqli_fetch_assoc($res)['category'];
        
        $log_message = "Added Stock: $cat (Qty: $quantity, Date: $p_date)";
        addLog($conn, $_SESSION['user'], $_SESSION['worker'] ?? $_SESSION['user'], $log_message);

        header("Location: addProductW.php?success=1");
        exit;
    } else {
        echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}

$sql_dropdown = "SELECT p.product_id, p.category, p.price 
                 FROM product p 
                 JOIN owns_product op ON p.product_id = op.product_id 
                 WHERE op.user_name = '$user'";
$result_dropdown = mysqli_query($conn, $sql_dropdown);
if (isset($_GET['success'])) {
    echo "<h2>New Stock added</h2>";}
?>

<form method="post" style="margin: 0 auto; max-width: 500px; font-weight: bold; text-shadow: 1px 1px 2px white;">

    <div style="margin-bottom: 15px;">
        <label>Select Item to Stock</label><br>
            <select name="product_id" required style="width: 417px; padding: 8px;">
                <option value="">-- Choose Product --</option>
                <?php
                if (mysqli_num_rows($result_dropdown) > 0) {
                    while($row = mysqli_fetch_assoc($result_dropdown)) {
                        echo "<option value='{$row['product_id']}'>{$row['category']} (\${$row['price']})</option>";
                    }
                }
                ?>
            </select>
    </div>
    <div style="margin-bottom: 20px;">
        <label>Quantity to Add</label><br>
        <input type="number" name="quantity" required style="width: 400px; padding: 8px;" min="1">
    </div>
    <div style="margin-bottom: 15px;">
        <label>Production Date</label><br>
        <input type="text" value="<?php echo date('Y-m-d'); ?>" disabled style="width: 400px; padding: 8px; background:#ddd;">
        <small><i>(Automatically set to today)</i></small>
    </div>
    <button type="submit" style="padding: 10px 20px; color: white; border: none; cursor: pointer;">
        Add Stock
    </button>

</form>
</div>
</body>
</html>