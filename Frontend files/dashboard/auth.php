<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../index.html");
    exit;
}
