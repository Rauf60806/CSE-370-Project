<?php
require_once "db.php";
session_start();
if (!isset($_SESSION['worker'])) {
    header("Location: index.php");
    exit();
}

$worker_id = $_SESSION['worker'];
$owner_name = $_SESSION['user'] ?? '';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $cattle_id = (int) $_POST['cattle_id'];
    $new_weight = (float) $_POST['new_weight'];

    if ($cattle_id > 0 && $new_weight > 0) {
        $update_sql = "UPDATE cattle SET weight = '$new_weight' WHERE cattle_id = $cattle_id";
        
        if (mysqli_query($conn, $update_sql)) {
            $message = "<h2 style='color:green; text-align:center;'>Weight Updated Successfully!</h2>";
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $log_desc = "Updated Cattle #$cattle_id weight to $new_weight kg";
            $log_sql = "INSERT INTO activity_logs (user_name, who, did_what, log_date, log_time) 
                        VALUES ('$owner_name', '$worker_id', '$log_desc', '$date', '$time')";
            mysqli_query($conn, $log_sql);

        } else {
            $message = "<h2 style='color:red; text-align:center;'>Error updating weight</h2>";
        }
    } else {
        $message = "<h2 style='color:red; text-align:center;'>Invalid Input</h2>";
    }
}
$sql_list = "SELECT c.cattle_id, c.cattle_type, c.weight 
             FROM cattle c 
             JOIN owns_cattle o ON c.cattle_id = o.cattle_id 
             WHERE o.user_name = '$owner_name'";
$result_list = mysqli_query($conn, $sql_list);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Cattle Weight</title>
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
    <h1>Update Cattle Weight</h1>
</div>
<div class="panel" class = "panel" style="max-width: 430px; margin: 100px auto;">
    <?php echo $message; ?>
    <form method="post" style="margin: 0 auto; max-width: 500px; font-weight: bold; text-shadow: 1px 1px 2px white;">
        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">Select Cattle</label><br>
            <select name="cattle_id" required style="width: 417px; padding: 8px; border-radius: 5px;">
                <option value="">-- Select Animal --</option>
                <?php 
                while($row = mysqli_fetch_assoc($result_list)) {
                    echo "<option value='{$row['cattle_id']}'>
                            #{$row['cattle_id']} - {$row['cattle_type']} (Current: {$row['weight']} kg)
                          </option>";
                }
                ?>
            </select>
        </div>
        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">New Weight (kg)</label><br>
            <input type="number" step="0.01" name="new_weight" placeholder="Enter current weight" required style="width: 400px; padding: 8px; border-radius: 5px;">
        </div>
        <div style="margin-top: 30px; text-align: center;">
            <button type="submit" style="width: 150px; padding: 10px; font-weight: bold;">Update</button>
        </div>
    </form>
</div>

</body>
</html>