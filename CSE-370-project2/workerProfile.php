<?php
require_once "db.php";
session_start();

// Logging Function
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

if (!isset($_SESSION['worker'])) {
    header("Location: index.php");
    exit();
}
$worker_id = $_SESSION['worker'];
$owner_name = $_SESSION['user'] ?? 'Unknown Owner'; 
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $update_sql = "UPDATE worker 
                   SET name='$name', age='$age', contact_number='$contact', pass='$pass' 
                   WHERE worker_id='$worker_id'";

    if (mysqli_query($conn, $update_sql)) {
        $message = "<p style='color: #009879; font-weight: bold; text-align:center;'>Profile updated successfully!</p>";
        addLog($conn, $owner_name, $worker_id, "Worker updated own profile");
    } else {
        $message = "<p class='error' style='text-align:center;'>Error updating: " . mysqli_error($conn) . "</p>";
    }
}
$query = "SELECT * FROM worker WHERE worker_id='$worker_id'";
$result = mysqli_query($conn, $query);
$worker_data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Worker Profile</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">

    <div class="header-notch">
        <h1>My Profile</h1>
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
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-avatar">
                <img src="assets/img/worker.png" alt="Profile">
            </div>
            <h2><?php echo htmlspecialchars($worker_data['name']); ?></h2>
            <p style="color: #666;">Employee ID: <?php echo htmlspecialchars($worker_data['worker_id']); ?></p>
        </div>
        <?php echo $message; ?>
        <form method="POST" class="profile-form">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($worker_data['name']); ?>" required>
            </div>

            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" value="<?php echo htmlspecialchars($worker_data['age']); ?>" required>
            </div>

            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" name="contact_number" value="<?php echo htmlspecialchars($worker_data['contact_number']); ?>" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" name="pass" value="<?php echo htmlspecialchars($worker_data['pass']); ?>" required>
            </div>

            <div class="form-group">
                <label>Salary (Fixed)</label>
                <input type="text" value="<?php echo htmlspecialchars($worker_data['salary']); ?>" disabled style="background-color: #f0f0f0; color: #888;">
            </div>

            <div class="form-group">
                <label>Work Hours (Fixed)</label>
                <input type="text" value="<?php echo htmlspecialchars($worker_data['work_hour']); ?>" disabled style="background-color: #f0f0f0; color: #888;">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Save Changes</button>
                <button type="button" onclick="location.href='worker.php'" class="btn-cancel">Back</button>
            </div>
        </form>
    </div>

</body>
</html>