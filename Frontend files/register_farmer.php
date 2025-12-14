<?php
require "db.php";
$data = json_decode(file_get_contents("php://input"), true);

$conn->query("
INSERT INTO dashboard_panel (user_name,Farm_name,farm_location,password)
VALUES ('{$data['username']}','{$data['farm_name']}','{$data['farm_location']}','{$data['password']}')
");

$conn->query("
INSERT INTO registers (registration_id,access_key,date)
VALUES (LAST_INSERT_ID(),{$data['access_key']},CURDATE())
");
$conn->query("
INSERT INTO admin_panel (access_key,registration_id,date)
VALUES ({$data['access_key']},LAST_INSERT_ID(),CURDATE())
");

echo json_encode(["success"=>true]);
header("location: index.php");
?>

