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
    <div class="header-notch">
        <h1>🐄Brac Cattle Management 🐐</h1>
</div>
<div class="box" class = "panel" style="max-width: 430px; margin: 100px auto;">
    <h2>Please Log in</h2>
    <?php 
    if (isset($_GET['success'])) {
        echo "<h2 style='color:red;'>User name or Password is incorrect</h2>";
    }
    ?>
<br>
    <!-- LOGIN -->
    <form id="loginForm" action="login.php" method="post" style="margin: 0 auto; max-width: 500px; font-weight: bold; text-shadow: 1px 1px 2px white;">
        <label style="font-weight: bold;">Username</label><br>
        <input type="text" name="uname" width="100%" required style="width: 400px; padding: 8px; border-radius: 5px;"><br/>
        <label style="font-weight: bold;">Email</label><br>
        <input type="text" name="email" width="100%" required style="width: 400px; padding: 8px; border-radius: 5px;"><br/>
        <label style="font-weight: bold;">Password</label><br>
        <input type="password" name="pass" width="99%" required style="width: 400px; padding: 8px; border-radius: 5px;"><br/><br/>
        <button style="width:100px;">Login</button>
    </form>
    <h3>Don't have an account? <a href="register.php">Register</a> now!</h3>
</div>
</body>
</html>
