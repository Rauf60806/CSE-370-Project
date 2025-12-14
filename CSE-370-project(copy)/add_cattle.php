<?php
require "db.php";
$d=json_decode(file_get_contents("php://input"),true);
$conn->query(
 "INSERT INTO cattle (category_id,age,health_status)
  VALUES ({$d['category_id']},{$d['age']},'{$d['health_status']}')"
);
