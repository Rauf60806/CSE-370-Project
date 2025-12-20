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
<br>
    <!-- LOGIN -->
    <form id="loginForm" action="login.php" method="post">
        Username:<input type="text" name="uname"><br/>
        password:<input type="password" name="pass"><br/><br/>
        <button>Login</button>
        <div id="loginError"></div>
    </form>
    <h3>Don't have an account?<a href="register.php">Register</a> now!</h3>
</div>
</body>
</html>
