<!DOCTYPE html>+
<html>
<head>
    <title>Show worker</title>
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
        <h2>List of Workers</h2><br>
        <button>
            <a href="addWorker.php">Add Worker</a>
        </button>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Worker Id</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "db.php";
                session_start();
                $sql="SELECT * from worker c join owns_worker w on c.worker_id = w.worker_id group by user_name having user_name = '"
    .               mysqli_real_escape_string($conn, $_SESSION['user']) . "'";
                $result=mysqli_query($conn,$sql);
                if (mysqli_num_rows($result)> 0) {
                while ($row=mysqli_fetch_assoc($result)) {
                    echo"<tr>
                        <td>". $row["worker_id"] ."</td>
                        <td>". $row["name"] . "</td>
                        <td>". $row["age"] ."</td>
                        <td>". $row["salary"]. "</td>
                    <tr>";
                }
            }
                ?>
            </tbody>
        </table>
</body>

</html>