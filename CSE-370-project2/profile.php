<?php
require_once "db.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$current_user = mysqli_real_escape_string($conn, $_SESSION['user']);
$message = "";

// 1. Handle Update Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $farm_name = mysqli_real_escape_string($conn, $_POST['farm_name']);

    $update_sql = "UPDATE dashboard_panel SET user_name='$full_name', email='$email', farm_name='$farm_name' 
                   WHERE user_name='$current_user'";

    if (mysqli_query($conn, $update_sql)) {
        $message = "<p style='color: #4CAF50; font-weight: bold;'>Profile updated successfully!</p>";
        // Logic to log this action
        $date = date("Y-m-d");
        $time = date("H:i:s");
        mysqli_query($conn, "INSERT INTO activity_logs (who, did_what, log_date, log_time) 
                             VALUES ('$current_user', 'Updated profile information', '$date', '$time')");
    } else {
        $message = "<p style='color: red;'>Error updating profile: " . mysqli_error($conn) . "</p>";
    }
}

// 2. Fetch Current User Data
$user_query = mysqli_query($conn, "SELECT * FROM dashboard_panel WHERE user_name='$current_user'");
$user_data = mysqli_fetch_assoc($user_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Farmer Profile</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">

    <div class="header-notch">
        <h1>My Profile</h1>
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

    <div class="main-content">
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <img src="assets/img/worker.png" alt="Profile Picture">
                </div>
                <h2><?php echo htmlspecialchars($user_data['user_name']); ?></h2>
                <p>Registered Farmer</p>
            </div>

            <?php echo $message; ?>

            <form method="POST" class="profile-form">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="<?php echo htmlspecialchars($user_data['full_name'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user_data['email'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label>Farm Name</label>
                    <input type="text" name="farm_name" value="<?php echo htmlspecialchars($user_data['farm_name'] ?? ''); ?>" placeholder="e.g. Green Valley Farm">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Save Changes</button>
                    <button type="button" onclick="location.href='dashboard.php'" class="btn-cancel">Back to Dashboard</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>