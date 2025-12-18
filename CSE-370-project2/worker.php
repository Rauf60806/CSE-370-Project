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
            <h2>🌾 Worker Dashboard</h2>
        </div>
        <div class="panel">
            <button onclick="addProduct()">Add Product</button>
            <button onclick="showCattle()">Show Catttle</button>
            <button onclick="logCattle()">Add Log</button>

        </div>
    </section>

</body>

<script>
    function addProduct() {
        window.location.href="addProduct.php"
    }

    function showCattle() {
        window.location.href="showcattle.php"
    }
    function logCattle() {
        window.location.href="addWorker.php"
    }
</script>
</html>