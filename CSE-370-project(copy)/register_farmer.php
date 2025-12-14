<?php
require "db.php";
$d = json_decode(file_get_contents("php://input"), true);

$conn->begin_transaction();

$conn->query(
 "INSERT INTO dashboard_panel (user_name,password,farm_name,Farm_location)
  VALUES ('{$d['username']}','{$d['password']}','{$d['farm_name']}','{$d['farm_location']}')"
);
$id = $conn->insert_id;

$conn->query(
 "INSERT INTO registers (registration_id,access_key,date)
  VALUES ($id,{$d['access_key']},CURDATE())"
);

$conn->commit();
echo json_encode(["success"=>true]);
