
<!DOCTYPE html>
<html>
<head>
    <title>Cattle Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg" margin="50px">
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
    <div class="panel">
        <h2>List of products</h2><br>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Id</th>
                    <th>Category</th>
                    <th>Production date</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "db.php";
                session_start();
                $sql="SELECT * from product c join owns_product p on c.product_id = p.product_id WHERE p.user_name = '"
    .               mysqli_real_escape_string($conn, $_SESSION['user']) . "'";
                $result=mysqli_query($conn,$sql);
                if (mysqli_num_rows($result)> 0) {
                while ($row=mysqli_fetch_assoc($result)) {
                    echo"<tr>
                        <td>". $row["product_id"] ."</td>
                        <td>". $row["category"] . "</td>
                        <td>". $row["production_date"] ."</td>
                        <td>". $row["price"]. "</td>
                        <td>". $row["quantity"] ."</td>
                    <tr>";
                }
            }
                ?>
            </tbody>
        </table>
</body>

</html>