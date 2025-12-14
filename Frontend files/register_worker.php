<?php
require "db.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

/* Validate fields */
$required = ['username','password','access_key','name','age','salary','work_hour'];
foreach ($required as $r) {
    if (!isset($data[$r]) || $data[$r] === "") {
        echo json_encode(["success"=>false,"message"=>"Missing field: $r"]);
        exit;
    }
}

/* Validate access key */
$key = $data['access_key'];
$k = $conn->prepare("SELECT access_key FROM admin_panel WHERE access_key=?");
$k->bind_param("i", $key);
$k->execute();
if ($k->get_result()->num_rows === 0) {
    echo json_encode(["success"=>false,"message"=>"Invalid access key"]);
    exit;
}

$conn->begin_transaction();

/* Create login */
$stmt1 = $conn->prepare(
    "INSERT INTO dashboard_panel (user_name,password) VALUES (?,?)"
);
$stmt1->bind_param("ss", $data['username'], $data['password']);
$stmt1->execute();

/* Create worker */
$stmt2 = $conn->prepare(
    "INSERT INTO worker (name,age,salary,work_hour,access_key)
     VALUES (?,?,?,?,?)"
);
$stmt2->bind_param(
    "siddi",
    $data['name'],
    $data['age'],
    $data['salary'],
    $data['work_hour'],
    $key
);
$stmt2->execute();

$conn->commit();

echo json_encode(["success"=>true]);
