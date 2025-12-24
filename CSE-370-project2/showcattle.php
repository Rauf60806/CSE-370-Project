<!DOCTYPE html>+
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
        <h2>List of Cattles</h2><br>
        <button>
            <a href="add_cattle.php">Add Cattle</a>
        </button>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Cattle Id</th>
                    <th>Type</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Weight</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "db.php";
                session_start();
                $sql="SELECT * from cattle c join owns_cattle o on c.cattle_id = o.cattle_id group by user_name having user_name = '"
    .               mysqli_real_escape_string($conn, $_SESSION['user']) . "'";
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