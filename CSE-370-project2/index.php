<?php
session_start();
if (isset($_SESSION['role'])) {
    header("Location: dashboard/" . $_SESSION['role'] . ".php");
    exit;
}
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

        <a href="register.php">
            <button type="button">Register</button>
        </a>
<br>
<br>
<br>
<br>
<br>
    <h3>Already Registered? Sign in now!</h3>
<br>

    <!-- LOGIN -->
    <form id="loginForm" action="login.php" method="post">
        Username:<input type="text" name="uname"><br/>
        password:<input type="password" name="pass"><br/><br/>
        <button>Login</button>
        <div id="loginError"></div>
    </form>
</div>
</body>
</html>
