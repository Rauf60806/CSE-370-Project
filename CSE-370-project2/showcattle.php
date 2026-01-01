<!DOCTYPE html>
<html>
<head>
    <title>Cattle Management</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg" margin="50px">
</div>
<div class="topbar">
        <button onclick="profile()"><img src="assets/img/farmer.png"></button>
        <button type="button" onclick="location.href='dashboard.php'" title="Home"><img src="assets/img/barn.png"></button>
        <button onclick="showCattle()"><img src="assets/img/cattle.png"></button>
        <button onclick="showWorker()"><img src="assets/img/worker.png"></button>
        <button onclick="showProduct()"><img src="assets/img/product.png"></button>
        <button onclick="medical_record()"><img src="assets/img/medical.png"></button>
        <button onclick="showinvent()"><img src="assets/img/market.png"></button>
        <button onclick="showLog()"><img src="assets/img/wood.png"></button>
        <button style='background:red;' onclick="location.href='logout.php'"><img src="assets/img/logout.png"></button>
    <script>
    function profile() {window.location.href="profile.php"}
    function Dashboard() {window.location.href="dashboard.php"}
    function addCattle() {window.location.href="add_cattle.php"}
    function showCattle() {window.location.href="showcattle.php"}
    function addWorker() {window.location.href="addWorker.php"}
    function showWorker() {window.location.href="showWorker.php"}
    function addProduct() {window.location.href="addProduct.php"}
    function showProduct() {window.location.href="showProduct.php"}
    function medical_record() {window.location.href="medical_record.php"}
    function addProduct() {window.location.href="addProduct.php"}
    function showLog() {window.location.href="report.php"}
    function showinvent(){window.location.href="showInventory.php"}
    function addinvent(){window.location.href="addInventory.php"}
    </script>
</div>
    <div class="header-notch">
        <h1>List of Cattles</h1>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="6" style="text-align: center;"> Add new Cattle <button onclick="addCattle()" style="padding:3px 3px;">Here</button></th>
                </tr>
                <tr>
                    <th>Cattle Id</th>
                    <th>Type</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Weight</th>
                    <th>Sell</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "db.php";
                session_start();
                function addLog($conn, $owner, $worker, $action) {
                    $date = date("Y-m-d");
                    $time = date("H:i:s");
                    $owner  = mysqli_real_escape_string($conn, $owner);
                    $worker = mysqli_real_escape_string($conn, $worker); 
                    $action = mysqli_real_escape_string($conn, $action);
                    $sql = "INSERT INTO activity_logs (user_name, who, did_what, log_date, log_time) 
                            VALUES ('$owner', '$worker', '$action', '$date', '$time')";

                    if (!mysqli_query($conn, $sql)) {}
                    }
                if (isset($_POST['sell_cattle_id'])) {
                    $cattle_id = (int) $_POST['sell_cattle_id'];
                    $user = mysqli_real_escape_string($conn, $_SESSION['user']);

                    $sql_delete = "DELETE FROM owns_cattle
                                WHERE cattle_id = $cattle_id
                                AND user_name = '$user'";
                    $sql_delete_cattle = "DELETE FROM cattle
                                WHERE cattle_id = $cattle_id";
                    $log_message = "Sold Cattle $cattle_id";
                    addLog($conn, $_SESSION['user'], $_SESSION['worker'], $log_message);

                    mysqli_query($conn, $sql_delete);
                    mysqli_query($conn, $sql_delete_cattle);
                }
                
                $sql="SELECT * from cattle c join owns_cattle o on c.cattle_id = o.cattle_id WHERE o.user_name = '"
    .               mysqli_real_escape_string($conn, $_SESSION['user']) . "'";
                $result=mysqli_query($conn,$sql);
                if (mysqli_num_rows($result)> 0) {
                while ($row=mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['cattle_id']}</td>
                        <td>{$row['cattle_type']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['weight']}</td>
                        <td>
                            <form method='post' style='margin:0;'>
                                <input type='hidden' name='sell_cattle_id' value='{$row['cattle_id']}'>
                                <button type='submit' style='background:red;'>Sell</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No cattle found.</td></tr>";
            }
                ?>
            </tbody>
        </table>
</body>

</html>