<?php
require_once("db.php");
if (isset($_POST["uname"]) && isset($_POST["pass"])) {
    $user = $_POST["uname"];
    $pass = $_POST["pass"];
    $sql = "Select * from dashboard_panel WHERE user_name = '$user' AND pass = '$pass'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) != 0) {
        header("Location: dashboard.php");
    }
    else {
        //header("Location: index.php");
        die("unsuccess");
    }
}