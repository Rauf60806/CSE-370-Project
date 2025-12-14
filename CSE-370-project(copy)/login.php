<?php
session_start();
require "db.php";
$data = json_decode(file_get_contents("php://input"), true);

$user = $data['username'];
$pass = $data['password'];
$key  = $data['access_key'];

/* Validate key */
$k = $conn->prepare("SELECT access_key FROM admin_panel WHERE access_key=?");
$k->bind_param("i", $key);
$k->execute();
if ($k->get_result()->num_rows == 0) {
    echo json_encode(["success"=>false,"message"=>"Invalid access key"]);
    exit;
}

/* Admin */
if ($user === "admin") {
    $_SESSION['role'] = "admin";
    echo json_encode(["success"=>true,"redirect"=>"dashboard/farmer.php"]);
    exit;
}

/* User */
$s = $conn->prepare(
    "SELECT registration_id,password FROM dashboard_panel WHERE user_name=?"
);
$s->bind_param("s",$user);
$s->execute();
$r = $s->get_result();

if ($r->num_rows == 0) {
    echo json_encode(["success"=>false,"message"=>"User not found"]);
    exit;
}

$row = $r->fetch_assoc();
if ($row['password'] !== $pass) {
    echo json_encode(["success"=>false,"message"=>"Wrong password"]);
    exit;
}

$rid = $row['registration_id'];

/* Farmer */
$f = $conn->prepare(
    "SELECT * FROM registers WHERE registration_id=? AND access_key=?"
);
$f->bind_param("ii",$rid,$key);
$f->execute();
if ($f->get_result()->num_rows > 0) {
    $_SESSION['role']="farmer";
    $_SESSION['rid']=$rid;
    echo json_encode(["success"=>true,"redirect"=>"dashboard/farmer.php"]);
    exit;
}

/* Worker */
$w = $conn->prepare("SELECT * FROM worker WHERE access_key=?");
$w->bind_param("i",$key);
$w->execute();
if ($w->get_result()->num_rows > 0) {
    $_SESSION['role']="worker";
    echo json_encode(["success"=>true,"redirect"=>"dashboard/worker.php"]);
    exit;
}

echo json_encode(["success"=>false,"message"=>"Role not found"]);
