<?php require "auth.php"; ?>
<h2>Worker Dashboard</h2>
<p>Tasks: <?= $conn->query("SELECT COUNT(*) c FROM report")->fetch_assoc()['c'] ?></p>
<a href="logout.php">Logout</a>
