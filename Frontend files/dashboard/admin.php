<?php require "auth.php"; ?>
<h2>Admin Dashboard</h2>
<p>Access Keys: <?= $conn->query("SELECT COUNT(*) c FROM admin_panel")->fetch_assoc()['c'] ?></p>
<a href="logout.php">Logout</a>
