<?php
require "db.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

/* Validate fields */
$required = ['username','password','access_key','farm_name','farm_location'];
foreach ($required as $r) {
    if (empty($data[$r])) {
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
$stmt2 = $conn->prepare(
    "INSERT INTO dashboard_panel (user_name,Farm_name, farm_location, password) VALUES (?,?,?,?)"
);
$stmt2->bind_param("ss", $data['username'],$data['farm_name'], $data['farm_location'], $data['password']);
$stmt2->execute();
$farm_id = $stmt2->insert_id;
/* Link access key */
$stmt3 = $conn->prepare(
    "INSERT INTO registers (registration_id, access_key, date)
     VALUES (?,?,CURDATE())"
);
$stmt3->bind_param("ii", $farm_id, $key);
$stmt3->execute();

$conn->commit();

echo json_encode(["success"=>true]);
