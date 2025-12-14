<?php
require "db.php";
$d=json_decode(file_get_contents("php://input"),true);
$conn->query(
 "INSERT INTO cattle (cattle_id,age,gender,weight,cattle_type)
  VALUES ({$d['cattle_id']},{$d['age']},'{$d['gender']}','{$d['weight']}','{$d['cattle_type']}')"
);
