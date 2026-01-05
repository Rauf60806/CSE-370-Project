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
    <div class="box" style="max-width: 430px; margin: 100px auto;">
        <h2>Please Log in</h2>
        <?php 
        if (isset($_GET['success'])) {
            echo "<h2 style='color:red;'>Login Failed. Check credentials.</h2>";
        }
        ?>
        <br>
        <form id="loginForm" action="login.php" method="post" style="margin: 0 auto; max-width: 500px; font-weight: bold; text-shadow: 1px 1px 2px white;">
            
            <label style="font-weight: bold;">Login As:</label><br>
            <select name="usertype" style="width: 418px; padding: 8px; border-radius: 5px; margin-bottom: 10px;">
                <option value="farmer">Farmer</option>
                <option value="worker">Worker</option>
            </select><br/>

            <label style="font-weight: bold;">Email or Worker ID</label><br>
            <input type="text" name="uid" required style="width: 400px; padding: 8px; border-radius: 5px;" placeholder="Email (Farmer) or ID (Worker)"><br/>
            
            <label style="font-weight: bold;">Password</label><br>
            <input type="password" name="pass" required style="width: 400px; padding: 8px; border-radius: 5px;"><br/><br/>
            
            <button style="width:100px;">Login</button>
        </form>
        <h3>Don't have an account? <a href="register.php">Register</a> now!</h3>
    </div>
</body>
</html>