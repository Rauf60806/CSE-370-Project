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
    <link rel="stylesheet" href="..assets/style.css">
</head>
<body>

<div class="box">
    <h2>Cattle Management System</h2>

    <div class="tabs">
        <button onclick="showTab('login')">Login</button>
        <button onclick="showTab('register')">Register</button>
    </div>

    <!-- LOGIN -->
    <form id="loginForm">
        <input id="luser" placeholder="Username" required>
        <input id="lpass" type="password" placeholder="Password" required>
        <input id="lkey" placeholder="Access Key" required>
        <button>Login</button>
        <div id="loginError"></div>
    </form>

    <!-- REGISTER -->
    <form id="registerForm" style="display:none">
        <select id="role">
            <option value="">Select Role</option>
            <option value="farmer">Farmer</option>
            <option value="worker">Worker</option>
        </select>

        <input id="ruser" placeholder="Username">
        <input id="rpass" type="password" placeholder="Password">
        <input id="rkey" placeholder="Access Key">

        <div id="farmerFields" style="display:none">
            <input id="farmName" placeholder="Farm Name">
            <input id="farmLoc" placeholder="Farm Location">
        </div>

        <div id="workerFields" style="display:none">
            <input id="wname" placeholder="Name">
            <input id="wage" placeholder="Age">
            <input id="wsalary" placeholder="Salary">
            <input id="whour" placeholder="Work Hour">
        </div>

        <button>Register</button>
    </form>
</div>

<script src="assets/script.js"></script>
</body>
</html>
