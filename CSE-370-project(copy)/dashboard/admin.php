<?php
require "auth.php";
require "../db.php";
if ($_SESSION['role'] !== 'admin') die("Unauthorized");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="farm-bg">

<div class="panel">
<h2>Admin Dashboard</h2>
    <input id="access_key" placeholder="Add Key">
    <input id="registration_id" placeholder="Registration id">
    <button>submit</button>

<?php
if (isset($_POST['create'])) {
    $stmt = $conn->prepare(
        "INSERT INTO admin_panel (access_key,registration_id)
         VALUES (0,?)"
    );
}
?>
<h3>Existing Keys</h3>
<ul>
</ul>
</div>
</body>
</html>
