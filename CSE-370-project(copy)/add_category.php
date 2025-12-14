<?php
require "db.php";
$d=json_decode(file_get_contents("php://input"),true);
$conn->query("INSERT INTO category (category_name) VALUES ('{$d['name']}')");
