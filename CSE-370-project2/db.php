<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cattle_managment";
$conn = new mysqli( $servername, $username, $password, $dbname );
if ($conn->connect_error) {
    die("DB Connection Failed". $conn->connect_error);
}
else { 
    mysqli_select_db($conn, $dbname);
}