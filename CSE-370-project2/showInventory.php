<!DOCTYPE html>
<html>
<head>
    <title>Cattle Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg" margin="50px">
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
    function addInventory() {window.location.href="addInventory.php"}
    function showInventory() {window.location.href="showInventory.php"}
    </script>
</div>
    <div class="header-notch">
    <h1>Inventory List</h1>
</div>

<table class="table">
    <thead>
        <tr>
            <th colspan="7" style="text-align:center;">
                Add new Inventory 
                <button onclick="addInventory()" style="padding:3px 5px;">Here</button>
            </th>
        </tr>
        <tr>
            <th>Inventory Id</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Purchase Date</th>
            <th>Price</th>
            <th>Owner</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once "db.php";
        session_start();

        /*----------------------log function----------------------*/
        function addLog($conn, $user, $action) {
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $user = mysqli_real_escape_string($conn, $user);
            $action = mysqli_real_escape_string($conn, $action);
            $sql = "INSERT INTO activity_logs (who, did_what, log_date, log_time) 
                    VALUES ('$user', '$action', '$date', '$time')";
            mysqli_query($conn, $sql);
        }
        /*----------------------log function----------------------*/

        // Handle deletion
        if (isset($_POST['delete_inventory_id'])) {
            $inventory_id = (int) $_POST['delete_inventory_id'];
            $user = mysqli_real_escape_string($conn, $_SESSION['user']);

            $sql_delete_inventory = "DELETE FROM inventory WHERE purchase_id = $inventory_id";
            if (mysqli_query($conn, $sql_delete_inventory)) {
                addLog($conn, $user, "Deleted inventory item ID: $inventory_id");
                echo "<tr><td colspan='7' style='color:green;'>Inventory ID $inventory_id deleted successfully.</td></tr>";
            } else {
                echo "<tr><td colspan='7' style='color:red;'>Error deleting inventory ID $inventory_id: " . mysqli_error($conn) . "</td></tr>";
            }
        }

        // Fetch inventory for logged-in user
        $user_name = mysqli_real_escape_string($conn, $_SESSION['user']);
        $sql = "SELECT purchase_id, inventory_type, amount, purchase_date, price, user_name 
                FROM inventory 
                WHERE user_name = '$user_name' 
                ORDER BY purchase_id DESC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['purchase_id']}</td>
                    <td>{$row['inventory_type']}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['purchase_date']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['user_name']}</td>
                    <td>
                        <form method='post' style='margin:0;' onsubmit='return confirm(\"Are you sure you want to delete this item?\");'>
                            <input type='hidden' name='delete_inventory_id' value='{$row['purchase_id']}'>
                            <button type='submit' style='background:red; color:white; padding:5px 8px; border:none; border-radius:3px;'>Delete</button>
                        </form>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No inventory found.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>