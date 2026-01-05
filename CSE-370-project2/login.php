<?php
session_start();
require_once("db.php");

if (isset($_POST["uid"]) && isset($_POST["pass"]) && isset($_POST["usertype"])) {
    $uid = mysqli_real_escape_string($conn, $_POST["uid"]);
    $pass = mysqli_real_escape_string($conn, $_POST["pass"]);
    $type = $_POST["usertype"];
    if ($type == "worker") {
        
        $sql = "SELECT * FROM worker WHERE worker_id = '$uid' AND pass = '$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $owner_sql = "SELECT user_name FROM owns_worker WHERE worker_id = '$uid'";
            $owner_result = mysqli_query($conn, $owner_sql);
            
            if (mysqli_num_rows($owner_result) > 0) {
                $owner_row = mysqli_fetch_assoc($owner_result);
                $farmer_name = $owner_row['user_name'];
            } else {
                $farmer_name = "Unknown"; 
            }
            $_SESSION["worker"] = $uid;          
            $_SESSION["user"] = $farmer_name; 
            header("Location: worker.php");
            exit();
        } else {
            header("Location: index.php?success=1");
            exit();
        }
    }
    elseif ($type == "farmer") { 
        
        if ($uid === '@Admin' && $pass === 'Admin123') {
            $_SESSION["user"] = "Admin"; 
            $_SESSION["worker"] = "Admin";  

            header("Location: adminDashboard.php");
            exit();
        }
        $sql = "SELECT * FROM dashboard_panel WHERE email = '$uid' AND pass = '$pass'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $farmer_name = $row['user_name'];
            
            $_SESSION["user"] = $farmer_name; 
            $_SESSION["worker"] = $farmer_name;    

            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: index.php?success=1");
            exit();
        }
    }
}
?>