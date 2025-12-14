<?php
require "db.php";
$data = json_decode(file_get_contents("php://input"), true);

$conn->query("
INSERT INTO dashboard_panel (user_name,password)
VALUES ('{$data['username']}','{$data['password']}')
");

$conn->query("
INSERT INTO worker (name,age,salary,work_hour,access_key)
VALUES (
'{$data['name']}',
{$data['age']},
{$data['salary']},
{$data['work_hour']},
{$data['access_key']}
)
");

echo json_encode(["success"=>true]);
