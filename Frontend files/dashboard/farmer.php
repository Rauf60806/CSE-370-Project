<?php
require "../db.php";
require "auth.php";
if ($_SESSION['role'] !== 'farmer') die("Unauthorized");

/* Load categories */
$cats = $conn->query("SELECT * FROM category");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<header>
    <h2>Farmer Dashboard</h2>
    <a href="logout.php">Logout</a>
</header>

<section class="dashboard-grid">

    <div class="card">
        <h3>Add Category</h3>
        <input id="categoryName" placeholder="Category name">
        <button onclick="addCategory()">Add</button>
    </div>

    <div class="card">
        <h3>Add Cattle</h3>

        <select id="cattleCategory">
            <option value="">Select Category</option>
            <?php while($c = $cats->fetch_assoc()): ?>
                <option value="<?= $c['category_id'] ?>">
                    <?= htmlspecialchars($c['category_name']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <input type="number" id="cattleAge" placeholder="Age">
        <input id="cattleHealth" placeholder="Health status">

        <button onclick="addCattle()">Add Cattle</button>
    </div>

</section>

<script src="../farmer.js"></script>
</body>
</html>

