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

<form method="post">
    <input name="duration" placeholder="Contract duration (months)" required>
    <button name="create">Generate Access Key</button>
</form>

<?php
if (isset($_POST['create'])) {
    $stmt = $conn->prepare(
        "INSERT INTO admin_panel (registration_id,contract_duration)
         VALUES (0,?)"
    );
    $stmt->bind_param("i",$_POST['duration']);
    $stmt->execute();
    echo "<p>New Access Key Created</p>";
}
?>

<h3>Existing Keys</h3>
<ul>
<?php
$r=$conn->query("SELECT access_key,contract_duration FROM admin_panel");
while($row=$r->fetch_assoc()){
    echo "<li>Key: {$row['access_key']} | {$row['contract_duration']} months</li>";
}
?>
</ul>
</div>
</body>
</html>
