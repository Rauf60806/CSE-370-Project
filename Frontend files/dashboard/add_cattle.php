<?php
require "db.php";
session_start();
header("Content-Type: application/json");

if ($_SESSION['role'] !== 'farmer') {
    echo json_encode(["success"=>false,"message"=>"Unauthorized"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$category = $data['category_id'];
$age = $data['age'];
$health = $data['health_status'];

if (!$category || !$age || !$health) {
    echo json_encode(["success"=>false,"message"=>"Missing fields"]);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO cattle (category_id, age, health_status)
     VALUES (?, ?, ?)"
);
$stmt->bind_param("iis", $category, $age, $health);
$stmt->execute();

echo json_encode(["success"=>true]);
