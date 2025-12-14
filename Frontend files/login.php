<?php
session_start();
require "db.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$username = trim($data['username'] ?? '');
$password = trim($data['password'] ?? '');
$access   = intval($data['access_key'] ?? 0);

/* Basic validation */
if (!$username || !$password || !$access) {
    echo json_encode(["success"=>false,"message"=>"All fields required"]);
    exit;
}

/* Validate access key */
$keyStmt = $conn->prepare(
    "SELECT access_key FROM admin_panel WHERE access_key=?"
);
$keyStmt->bind_param("i", $access);
$keyStmt->execute();
if ($keyStmt->get_result()->num_rows === 0) {
    echo json_encode(["success"=>false,"message"=>"Invalid access key"]);
    exit;
}

/* ADMIN LOGIN (no dashboard_panel row) */
if ($username === "admin") {
    $_SESSION['role'] = "admin";
    $_SESSION['login_id'] = null;

    echo json_encode([
        "success"=>true,
        "redirect"=>"dashboard/admin.php"
    ]);
    exit;
}

/* USER LOGIN */
$stmt = $conn->prepare(
    "SELECT registration_id, password
     FROM dashboard_panel
     WHERE user_name=?"
);
$stmt->bind_param("s", $username);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo json_encode(["success"=>false,"message"=>"User not found"]);
    exit;
}

$row = $res->fetch_assoc();
if ($row['password'] !== $password) {
    echo json_encode(["success"=>false,"message"=>"Incorrect password"]);
    exit;
}

$registration_id = $row['registration_id'];

/* ROLE DETECTION */

/* Worker check */
$w = $conn->prepare(
    "SELECT worker_id FROM worker WHERE access_key=?"
);
$w->bind_param("i", $access);
$w->execute();
if ($w->get_result()->num_rows > 0) {
    $_SESSION['role'] = "worker";
}

/* Farmer check */
$r = $conn->prepare(
    "SELECT * FROM registers
     WHERE registration_id=? AND access_key=?"
);
$r->bind_param("ii", $registration_id, $access);
$r->execute();
if ($r->get_result()->num_rows > 0) {
    $_SESSION['role'] = "farmer";
}

if (!isset($_SESSION['role'])) {
    echo json_encode(["success"=>false,"message"=>"Role not assigned"]);
    exit;
}

$_SESSION['login_id'] = $registration_id;

echo json_encode([
    "success"=>true,
    "redirect"=>"dashboard/" . $_SESSION['role'] . ".php"
]);
