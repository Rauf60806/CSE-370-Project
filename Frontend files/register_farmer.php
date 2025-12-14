<?php
require "db.php";
$data = json_decode(file_get_contents("php://input"), true);

$conn->query("
INSERT INTO farm_owner (Farm_name,farm_location)
VALUES ('{$data['farm_name']}','{$data['farm_location']}')
");

$conn->query("
INSERT INTO dashboard_panel (user_name,password)
VALUES ('{$data['username']}','{$data['password']}')
");

$conn->query("
INSERT INTO registers (registration_id,access_key,date)
VALUES (LAST_INSERT_ID(),{$data['access_key']},CURDATE())
");

echo json_encode(["success"=>true]);
