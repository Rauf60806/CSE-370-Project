<!DOCTYPE html>
<html>
<head>
    <title>Cattle Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg">
    <div class="topbar">
        <button type="button" onclick="location.href='dashboard.php'" title="Home">
            <img src="assets/img/barn.png">
        </button>
        <button onclick="showCattle()">
            <img src="assets/img/cattle.png">
        </button>
        <button onclick="showWorker()">
            <img src="assets/img/worker.png">
        </button>
        <button onclick="showProduct()">
            <img src="assets/img/product.png">
        </button>
        <button onclick="medical_record()">
            <img src="assets/img/medical.png">
        </button>
        <button onclick="medical_record()">
            <img src="assets/img/wood.png">
        </button>
        <button style='background:red;' onclick="location.href='logout.php'">
            <img src="assets/img/logout.png">
        </button>
    <script>
    function Dashboard() {
        window.location.href="dashboard.php"
    }
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
    </div>

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