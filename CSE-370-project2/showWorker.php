<?php
require_once "db.php";
session_start();

// Check Login
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// Helper: Log Function
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

// 1. Handle Remove Worker Logic
if (isset($_POST['remove_worker_id'])) {
    $worker_id = (int) $_POST['remove_worker_id'];
    $user = mysqli_real_escape_string($conn, $_SESSION['user']);
    $current_worker = $_SESSION['worker'] ?? $user;

    $sql_delete = "DELETE FROM owns_worker WHERE worker_id = $worker_id AND user_name = '$user'";
    $sql_delete_worker = "DELETE FROM worker WHERE worker_id = $worker_id";
    
    // Log it
    addLog($conn, $user, $current_worker, "Removed Worker #$worker_id");
    
    mysqli_query($conn, $sql_delete);
    mysqli_query($conn, $sql_delete_worker);
}

// 2. Handle Search Logic
$search_term = "";
$search_sql = "";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = mysqli_real_escape_string($conn, $_GET['search']);
    // Search by Name OR ID
    $search_sql = " AND (c.name LIKE '%$search_term%' OR c.worker_id LIKE '%$search_term%') ";
}

// 3. Fetch Data
$user_name = mysqli_real_escape_string($conn, $_SESSION['user']);
$sql = "SELECT * FROM worker c 
        JOIN owns_worker w ON c.worker_id = w.worker_id 
        WHERE w.user_name = '$user_name' 
        $search_sql";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Show Worker</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">

    <div class="header-notch">
        <h1>List of Workers</h1>
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
                
            <form method="GET" class="filter-row" style="margin-top: 10px;">
                <input type="text" name="search" 
                       value="<?php echo htmlspecialchars($search_term); ?>" 
                       placeholder="Search by Name or ID..." 
                       style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 250px;">
                
                <button type="submit" class="btn-apply">Search</button>
                <button class="btn-add" onclick="window.location.href='addWorker.php'">+ Register Worker</button>

                <?php if(!empty($search_term)): ?>
                    <a href="showWorker.php" class="link-clear">Clear Search</a>
                <?php endif; ?>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Worker Id</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Salary</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Highlight search term if exists
                        $display_name = $row['name'];
                        if(!empty($search_term)) {
                            // Simple highlight logic
                            $display_name = str_ireplace($search_term, "<span style='background:yellow;'>$search_term</span>", $row['name']);
                        }

                        echo "<tr>
                            <td>#{$row['worker_id']}</td>
                            <td><strong>{$display_name}</strong></td>
                            <td>{$row['age']}</td>
                            <td>{$row['salary']}</td>
                            <td>{$row['contact_number']}</td>
                            <td>
                                <form method='post' style='margin:0;' onsubmit=\"return confirm('Remove worker #{$row['worker_id']}?');\">
                                    <input type='hidden' name='remove_worker_id' value='{$row['worker_id']}'>
                                    <button type='submit' class='btn-danger'>Remove</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; padding:20px; color:#666;'>
                            No workers found matching your search.
                          </td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>