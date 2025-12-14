<?php require "auth.php"; ?>
<h2>Farmer Dashboard</h2>
<p>Total Cattle: <?= $conn->query("SELECT COUNT(*) c FROM cattle")->fetch_assoc()['c'] ?></p>
<a href="logout.php">Logout</a>
