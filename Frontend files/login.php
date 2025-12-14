<?php
session_start();
require "db.php";
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$user = $data['username'];
$pass = $data['password'];
$key  = $data['access_key'];

/* Access key validation */
$keyCheck = $conn->prepare("SELECT access_key FROM admin_panel WHERE access_key=?");
$keyCheck->bind_param("i", $key);
$keyCheck->execute();
if ($keyCheck->get_result()->num_rows == 0) {
    echo json_encode(["success"=>false,"message"=>"Invalid access key"]);
    exit;
}

/* Login check */
$stmt = $conn->prepare("SELECT login_id,password FROM dashboard_panel WHERE user_name=?");
$stmt->bind_param("s", $user);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    echo json_encode(["success"=>false,"message"=>"Invalid username"]);
    exit;
}

$row = $res->fetch_assoc();
if ($row['password'] !== $pass) {
    echo json_encode(["success"=>false,"message"=>"Wrong password"]);
    exit;
}

/* Role detection */
$role = "farmer";

$r = $conn->query("SELECT * FROM worker WHERE access_key=$key");
if ($r->num_rows > 0) $role = "worker";

if ($user === "admin") $role = "admin";

/* Session */
$_SESSION['login_id'] = $row['login_id'];
$_SESSION['role'] = $role;

echo json_encode([
    "success"=>true,
    "redirect"=>"dashboard/$role.php"
]);
