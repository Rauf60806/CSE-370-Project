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
    <section id="header">
        <div class="panel">
            <h2>🌾 Farmer Dashboard</h2>
        </div>
        <div class="panel">
            <button onclick="addCattle()">Add Catttle</button>
            <button onclick="showCattle()">Show Catttle</button>
        </div>
    </section>

</body>

<script>
    function addCattle() {
        window.location.href="add_cattle.php"
    }

    function showCattle() {
        window.location.href="showcattle.php"
    }
</script>
</html>