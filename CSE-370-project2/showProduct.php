
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
        <button onclick="location.href='logout.php'">Logout</button>
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
                $sql="SELECT * from product c join owns_product p on c.product_id = p.product_id group by user_name having user_name = '"
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