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
    <div class="topbar">
        <button onclick="location.href='dashboard.php'">Home</button>
        <button onclick="location.href='logout.php'">Logout</button>
    </div>

    <section id="header">
        <div class="panel">
            <h2>🌾 Farmer Dashboard</h2>
            <h2>User: <?php echo $_SESSION["user"]; ?></h2>
        </div>
        <div class="panel">
            <button onclick="addCattle()">Add Catttle</button>
            <button onclick="showCattle()">Show Catttle</button>
            <button onclick="addWorker()">Add Worker</button>
            <button onclick="showWorker()">Show Worker</button>
            <button onclick="addProduct()">Add Products</button>
            <button onclick="addProduct()">Add Product</button>
            <button onclick="showProduct()">Show Products</button>
            <button onclick="medical_record()">Show Medical Records</button>

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
    function addWorker() {
        window.location.href="addWorker.php"
    }
    function showWorker() {
        window.location.href="showWorker.php"
    }
    function addProduct() {
        window.location.href="addProduct.php"
    }
    function showProduct() {
        window.location.href="showProduct.php"
    }
    function medical_record() {
        window.location.href="medical_record.php"
    }
    function addProduct() {
        window.location.href="addProduct.php"
    }
</script>
</html>