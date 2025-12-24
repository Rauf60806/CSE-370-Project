<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cattle Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">
<div class="box">
    <h2>Cattle Management System</h2>
    <?php 
    if (isset($_GET['success'])) {
        echo "<h2 style='color:red;'>User name or Password is incorrect</h2>";
    }
    ?>
<br>
    <!-- LOGIN -->
    <form id="loginForm" action="login.php" method="post">
        <label style="font-weight: bold;">Username</label><br>
        <input type="text" name="uname" width="100%"><br/>
        <label style="font-weight: bold;">Password</label><br>
        <input type="password" name="pass" width="99%"><br/><br/>
        <button>Login</button>
    </form>
    <h3>Don't have an account? <a href="register.php">Register</a> now!</h3>
</div>
</body>
</html>
