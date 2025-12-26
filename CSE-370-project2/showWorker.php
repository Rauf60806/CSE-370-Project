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
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "db.php";
                session_start();
                if (isset($_POST['remove_worker_id'])) {
                    $worker_id = (int) $_POST['remove_worker_id'];
                    $user = mysqli_real_escape_string($conn, $_SESSION['user']);

                    $sql_delete = "DELETE FROM owns_worker
                                WHERE worker_id = $worker_id
                                AND user_name = '$user'";
                    $sql_delete_cattle = "DELETE FROM worker
                                WHERE worker_id = $worker_id";

                    mysqli_query($conn, $sql_delete);
                    mysqli_query($conn, $sql_delete_cattle);
                }
                $sql="SELECT * from worker c join owns_worker w on c.worker_id = w.worker_id WHERE w.user_name = '"
    .               mysqli_real_escape_string($conn, $_SESSION['user']) . "'";
                $result=mysqli_query($conn,$sql);
                if (mysqli_num_rows($result)> 0) {
                while ($row=mysqli_fetch_assoc($result)) {
                    echo"<tr>
                        <td>". $row["worker_id"] ."</td>
                        <td>". $row["name"] . "</td>
                        <td>". $row["age"] ."</td>
                        <td>". $row["salary"]. "</td>
                        <td>
                            <form method='post' style='margin:0;'>
                                <input type='hidden' name='remove_worker_id' value='{$row['worker_id']}'>
                                <button type='submit' style='background:red;'>Remove</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No workers found.</td></tr>";
            }
                ?>
            </tbody>
        </table>
</body>

</html>