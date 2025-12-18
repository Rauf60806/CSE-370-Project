<?php
$conn = new mysqli("localhost", "root", "", "cattle_managment");
if ($conn->connect_error) {
    die("DB Connection Failed");
}
