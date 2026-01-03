<?php
require_once "db.php";
session_start();

// 1. Security Check: Ensure the logged-in user is explicitly 'Admin'
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// 2. Admin Queries (Global Counts)

// Count Total Users (Farmers in dashboard_panel)
$sql_user_count = "SELECT COUNT(*) as total FROM dashboard_panel";
$user_count = mysqli_fetch_assoc(mysqli_query($conn, $sql_user_count))['total'];

// Count Total Cattle (All cattle in the system)
$sql_cattle_count = "SELECT COUNT(*) as total FROM cattle";
$total_cattle = mysqli_fetch_assoc(mysqli_query($conn, $sql_cattle_count))['total'];

// Count Total Workers (All workers in the system)
$sql_worker_count = "SELECT COUNT(*) as total FROM worker";
$total_workers = mysqli_fetch_assoc(mysqli_query($conn, $sql_worker_count))['total'];

// 2. Handle Remove User Logic
if (isset($_POST['remove_user_name'])) {
    $remove_user = mysqli_real_escape_string($conn, $_POST['remove_user_name']);
    
    // Prevent Admin from deleting themselves
    if($remove_user !== 'Admin') {
        $sql_delete = "DELETE FROM dashboard_panel WHERE user_name = '$remove_user'";
        if (mysqli_query($conn, $sql_delete)) {
            $msg = "User removed successfully.";
        } else {
            $error = "Error removing user: " . mysqli_error($conn);
        }
    }
}

// 3. Handle Search Logic
$search_term = "";
$search_sql = "";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $term = mysqli_real_escape_string($conn, $_GET['search']);
    // Search by User Name, First/Last Name, or Farm Name
    $search_sql = " WHERE (user_name LIKE '%$term%' 
                      OR first_name LIKE '%$term%' 
                      OR last_name LIKE '%$term%' 
                      OR farm_name LIKE '%$term%') ";
}

// 4. Fetch Data (Farmers)
$sql = "SELECT * FROM dashboard_panel $search_sql ORDER BY user_name ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">
    <div class="header-notch">
        <h1>🛡️ System Administration 🛡️</h1>
    </div>

<div class="topbar">
    <button type="button" onclick="location.href='adminDashboard.php'" title="Home"><img src="assets/img/barn.png"></button>
    <button style='background:red;' onclick="location.href='logout.php'"><img src="assets/img/logout.png"></button>

    <script>
    function showUser() {window.location.href="showUser.php"}
    </script>
</div>

<div class="main-content" style="margin: 10px auto;">
    <div class="stats-grid">
        
        <div class="stat-card highlight">
            <h3>Total Registered Farmers</h3>
            <p class="stat-number"><?php echo $user_count; ?></p>
            <div class="breakdown">
                <span>System Wide Users</span>
            </div>
        </div>

        <div class="stat-card">
            <h3>Total Livestock</h3>
            <p class="stat-number"><?php echo $total_cattle; ?></p>
            <div class="breakdown">
                <span>All Farms Combined</span>
            </div>
        </div>

        <div class="stat-card">
            <h3>Total Staff</h3>
            <p class="stat-number"><?php echo $total_workers; ?></p>
            <div class="breakdown">
                <span>All Farm Hands</span>
            </div>
        </div>

    </div>
</div>
<div class="management-card">
        
        <div class="card-header">
            <form method="GET" class="filter-row" style="margin-top: 10px;">
                <input type="text" name="search" 
                       value="<?php echo htmlspecialchars($search_term); ?>" 
                       placeholder="Search Name, Farm, or Username..." 
                       style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 250px;">
                
                <button type="submit" class="btn-apply">Search</button>
                <?php if(!empty($search_term)): ?>
                    <a href="showUsers.php" class="link-clear">Clear Search</a>
                <?php endif; ?>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Farm Name</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        
                        // Skip showing the Admin account in the list (optional)
                        if($row['user_name'] === 'Admin') continue;

                        $full_name = $row['first_name'] . " " . $row['last_name'];
                        
                        // Highlight search term
                        if(!empty($search_term)) {
                            $full_name = str_ireplace($search_term, "<span style='background:yellow;'>$search_term</span>", $full_name);
                            $row['farm_name'] = str_ireplace($search_term, "<span style='background:yellow;'>$search_term</span>", $row['farm_name']);
                        }

                        echo "<tr>
                            <td><strong>{$row['user_name']}</strong></td>
                            <td>{$full_name}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['farm_name']}</td>
                            <td>{$row['Farm_location']}</td>
                            <td>
                                <form method='post' style='margin:0;' onsubmit=\"return confirm('Are you sure you want to remove user: {$row['user_name']}? This will delete their farm data.');\">
                                    <input type='hidden' name='remove_user_name' value='{$row['user_name']}'>
                                    <button type='submit' class='btn-danger'>Remove</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; padding:20px; color:#666;'>
                            No users found.
                          </td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>