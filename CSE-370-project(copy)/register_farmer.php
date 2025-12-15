<?php
require "db.php";
$d = json_decode(file_get_contents("php://input"), true);

$conn->begin_transaction();

$id = $conn->insert_id;

$conn->query(
 "INSERT INTO dashboard_panel (registration_id,user_name,farm_name,Farm_location,password)
  VALUES ($id,'{$d['ruser']}','{$d['farmName']}','{$d['farmLoc']}','{$d['rpass']}')"
);

$conn->query(
 "INSERT INTO admin_panel (access_key,registration_id,date)
  VALUES ({$d['access_key']},$id,CURDATE())"
);

$conn->commit();
echo json_encode(["success"=>true]);
