<?php
require "db.php";
$d = json_decode(file_get_contents("php://input"), true);

$conn->query(
 "INSERT INTO dashboard_panel (user_name,password)
  VALUES ('{$d['username']}','{$d['password']}')"
);

$conn->query(
 "INSERT INTO worker (name,age,salary,work_hour,access_key)
  VALUES ('{$d['name']}',{$d['age']},{$d['salary']},{$d['work_hour']},{$d['access_key']})"
);

echo json_encode(["success"=>true]);
