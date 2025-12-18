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
<body class="farm-bg" margin="50px">
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
                $sql="select * from product";
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