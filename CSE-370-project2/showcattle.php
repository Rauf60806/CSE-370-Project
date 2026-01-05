<?php
    require_once "db.php";
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: index.php"); 
        exit();
    }
    $current_user = mysqli_real_escape_string($conn, $_SESSION['user']);
    $current_worker = isset($_SESSION['worker']) ? mysqli_real_escape_string($conn, $_SESSION['worker']) : $current_user;

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
    if (isset($_POST['sell_cattle_id']) && isset($_POST['sell_price'])) {
        $cattle_id = (int) $_POST['sell_cattle_id'];
        $sale_price = (float) $_POST['sell_price'];
        $check_sql = "SELECT * FROM owns_cattle WHERE cattle_id = $cattle_id AND user_name = '$current_user'";
        $check_res = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_res) > 0) {

            $sql_profit = "UPDATE dashboard_panel SET profit = profit + $sale_price WHERE user_name = '$current_user'";
            mysqli_query($conn, $sql_profit);

            $log_message = "Sold Cattle ID: #$cattle_id";
            addLog($conn, $current_user, $current_worker, $log_message);

            $sql_delete_link = "DELETE FROM owns_cattle WHERE cattle_id = $cattle_id AND user_name = '$current_user'";
            mysqli_query($conn, $sql_delete_link);

            $sql_delete_cattle = "DELETE FROM cattle WHERE cattle_id = $cattle_id";
            mysqli_query($conn, $sql_delete_cattle);
        }
    }
    $type_filter = $_GET['type'] ?? '';
    $gender_filter = $_GET['gender'] ?? '';
    $sql = "SELECT c.* FROM cattle c 
            JOIN owns_cattle o ON c.cattle_id = o.cattle_id 
            WHERE o.user_name = '$current_user'";
    if (!empty($type_filter)) {
        $sql .= " AND c.cattle_type = '" . mysqli_real_escape_string($conn, $type_filter) . "'";
    }
    if (!empty($gender_filter)) {
        $sql .= " AND c.gender = '" . mysqli_real_escape_string($conn, $gender_filter) . "'";
    }
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cattle Management</title>
        <link rel="stylesheet" href="assets/style.css">
    </head>
<body class="farm-bg">

    <div class="header-notch">
        <h1>List of Cattle</h1>
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

    <div class="management-card">
        
        <div class="card-header">
            <div style="display: flex; align-items: center;">
                <h2 style="margin: 0; color: #333; font-size: 1.5rem;">Livestock Inventory</h2>
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
                <button type="submit" class="btn-apply">Apply Filter</button>
                <?php if(!empty($type_filter) || !empty($gender_filter)): ?>
                    <a href="showcattle.php" class="link-clear">Clear All</a>
                <?php endif; ?>
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
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>#{$row['cattle_id']}</td>";
                        echo "<td><strong>{$row['cattle_type']}</strong></td>";
                        echo "<td>{$row['age']} Yrs</td>";
                        echo "<td>{$row['gender']}</td>";
                        echo "<td>{$row['weight']} kg</td>";
                        echo "<td>{$row['price']} Taka</td>";
                        echo "<td>
                                <form method='post' onsubmit=\"return confirm('Are you sure you want to sell Cattle #{$row['cattle_id']}?');\" style='margin:0;'>
                                    <input type='hidden' name='sell_cattle_id' value='{$row['cattle_id']}'>
                                    <input type='hidden' name='sell_price' value='{$row['price']}'>
                                    <button type='submit' class='btn-danger'>Sell</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; padding: 20px;'>No cattle found matching your criteria.</td></tr>";
                }
                ?>
            </tbody>
        </table>
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
</body>
</html>