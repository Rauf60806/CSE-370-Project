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
            
    if (!mysqli_query($conn, $sql)) {
    }
}
// 1. Check Farmer Login (Using 'user')
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['user'];
$message = "";

// 2. Handle Update Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $farm_name = mysqli_real_escape_string($conn, $_POST['farm_name']);
    $farm_loc = mysqli_real_escape_string($conn, $_POST['Farm_location']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    $update_sql = "UPDATE dashboard_panel 
                   SET email='$email', farm_name='$farm_name', Farm_location='$farm_loc', pass='$pass' 
                   WHERE user_name='$current_user'";

    if (mysqli_query($conn, $update_sql)) {
        $message = "<p style='color: #009879; font-weight: bold; text-align:center;'>Profile updated successfully!</p>";
        if(function_exists('addLog')) {
            // Log: Owner=user, Who=user
            addLog($conn, $current_user, $current_user, "Updated own profile info");
        }
    } else {
        $message = "<p class='error' style='text-align:center;'>Error updating: " . mysqli_error($conn) . "</p>";
    }
}

// 3. Fetch Data
$query = "SELECT * FROM dashboard_panel WHERE user_name='$current_user'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);
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
        <button onclick="location.href='profile.php'"><img src="assets/img/farmer.png"></button>
        <button onclick="location.href='dashboard.php'"><img src="assets/img/barn.png"></button>
        <button onclick="location.href='showcattle.php'"><img src="assets/img/cattle.png"></button>
        <button onclick="location.href='showWorker.php'"><img src="assets/img/worker.png"></button>
        <button onclick="location.href='showProduct.php'"><img src="assets/img/product.png"></button>
        <button onclick="location.href='medical_record.php'"><img src="assets/img/medical.png"></button>
        <button onclick="location.href='showInventory.php'"><img src="assets/img/market.png"></button>
        <button onclick="location.href='report.php'"><img src="assets/img/wood.png"></button>
        <button style='background:red;' onclick="location.href='logout.php'"><img src="assets/img/logout.png"></button>
    </div>

    <div class="profile-container">
        
        <div class="profile-header">
            <div class="profile-avatar">
                <img src="assets/img/farmer.png" alt="Profile">
            </div>
            <h2><?php echo htmlspecialchars($user_data['user_name']); ?></h2>
            <p style="color: #666;">Farm Owner</p>
        </div>

        <?php echo $message; ?>

        <form method="POST" class="profile-form">
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
            </div>

            <div class="form-group">
                <label>Farm Name</label>
                <input type="text" name="farm_name" value="<?php echo htmlspecialchars($user_data['farm_name']); ?>" required>
            </div>

            <div class="form-group">
                <label>Farm Location</label>
                <input type="text" name="Farm_location" value="<?php echo htmlspecialchars($user_data['Farm_location']); ?>" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" name="pass" value="<?php echo htmlspecialchars($user_data['pass']); ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Save Changes</button>
                <button type="button" onclick="location.href='dashboard.php'" class="btn-cancel">Back</button>
            </div>
        </form>
    </div>

</body>
</html>