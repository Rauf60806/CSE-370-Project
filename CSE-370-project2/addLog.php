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
    
    $task_type = mysqli_real_escape_string($conn, $_POST['task_type']);
    $details   = mysqli_real_escape_string($conn, trim($_POST['details']));
    $action_text = $task_type;
    if (!empty($details)) {
        $action_text .= " - " . $details;
    }
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $sql = "INSERT INTO activity_logs (user_name, who, did_what, log_date, log_time) 
            VALUES ('$owner_name', '$worker_id', '$action_text', '$date', '$time')";

    if (mysqli_query($conn, $sql)) {
        $message = "<p style='color: #009879; font-weight: bold; text-align: center;'>Work logged successfully!</p>";
    } else {
        $message = "<p style='color: red; text-align: center;'>Error logging work: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Log Daily Work</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">

    <div class="header-notch">
        <h1>Daily Task Entry</h1>
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

    <div class="main-content">
        <div class="box" style="max-width: 500px; margin: 50px auto; text-align: center;">
            <h2 style="margin-bottom: 20px;">Record Your Work</h2>
            
            <?php echo $message; ?>

            <form method="POST" style="text-align: left;">
                
                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Select Task Type</label>
                    <select name="task_type" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                        <option value="" disabled selected>-- Choose Activity --</option>
                        <option value="Clean Cattle">Clean Cattle (Wash/Groom)</option>
                        <option value="Feed Cattle">Feed Cattle</option>
                        <option value="Clean Shed">Clean Shed/Barn</option>
                        <option value="Milking">Milking</option>
                        <option value="Health Check">Health Inspection</option>
                        <option value="Maintenance">Repair/Maintenance</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Additional Details (Optional)</label>
                    <textarea name="details" rows="3" placeholder="e.g. Fed cow #205 extra hay..." style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-family: sans-serif; resize: vertical; box-sizing: border-box;"></textarea>
                </div>

                <button type="submit" style="width: 100%; padding: 12px; background-color: #009879; color: white; font-weight: bold; font-size: 1rem; border-radius: 8px;">Submit Log</button>
                
                <div style="margin-top: 15px; text-align: center;">
                    <a href="worker.php" style="color: #666; text-decoration: none;">Back to Dashboard</a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>