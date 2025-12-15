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
        <h2>List of Cattles</h2><br>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Cattle Id</th>
                    <th>Type</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Geight</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "db.php";
                $sql="select * from cattle";
                $result=mysqli_query($conn,$sql);
                if (mysqli_num_rows($result)> 0) {
                while ($row=mysqli_fetch_assoc($result)) {
                    echo"<tr>
                        <td>". $row["cattle_id"] ."</td>
                        <td>". $row["cattle_type"] . "</td>
                        <td>". $row["age"] ."</td>
                        <td>". $row["gender"]. "</td>
                        <td>". $row["weight"] ."</td>
                    <tr>";
                }
            }
                ?>
            </tbody>
        </table>
</body>

</html>