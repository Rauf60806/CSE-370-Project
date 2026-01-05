<?php
require_once "db.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['user'];
function analyzeCattle($data) {
    $sumXY = 0;
    $sumXX = 0;
    foreach ($data as $c) {
        $sumXY += $c['age'] * $c['weight'];
        $sumXX += $c['age'] * $c['age'];
    }

    if ($sumXX == 0) return [0, []];

    $m = $sumXY / $sumXX; 

    $outliers = [];
    foreach ($data as $c) {
        $expected = $m * $c['age'];
        $deviation = abs($c['weight'] - $expected);

        if ($deviation > (0.30 * $expected)) {
            $c['expected_weight'] = round($expected, 2);
            $c['deviation'] = round($deviation, 2);
            $outliers[] = $c;
        }
    }
    return [$m, $outliers];
}
$sql = "SELECT c.cattle_id, c.age, c.weight, c.cattle_type FROM cattle c
        JOIN owns_cattle o ON c.cattle_id = o.cattle_id 
        WHERE o.user_name = '" . mysqli_real_escape_string($conn, $current_user) . "'";
$result = mysqli_query($conn, $sql);

$cow = []; $goat = []; $sheep = [];

while ($row = mysqli_fetch_assoc($result)) {
    $row['age'] = (float)$row['age'];
    $row['weight'] = (float)$row['weight'];
    if ($row['cattle_type'] === 'Cow') $cow[] = $row;
    elseif ($row['cattle_type'] === 'Goat') $goat[] = $row;
    elseif ($row['cattle_type'] === 'Sheep') $sheep[] = $row;
}

list($cowSlope, $cowOutliers)     = analyzeCattle($cow);
list($goatSlope, $goatOutliers)   = analyzeCattle($goat);
list($sheepSlope, $sheepOutliers) = analyzeCattle($sheep);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medical Record</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .analysis-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 50px;
        }
        .chart-box {
            flex: 2;
            min-width: 400px;
            max-width: 700px;
            text-align: center;
        }
        .table-box {
            flex: 1;
            min-width: 300px;
            max-width: 500px;
        }
        canvas {
            width: 100% !important;
            height: auto !important;
        }
    </style>
</head>
<body class="farm-bg">

    <div class="header-notch"><h1>Medical Record</h1></div>

    <div class="topbar">
        <button onclick="profile()"><img src="assets/img/farmer.png"></button>
        <button type="button" onclick="location.href='dashboard.php'" title="Home"><img src="assets/img/barn.png"></button>
        <button onclick="showCattle()"><img src="assets/img/cattle.png"></button>
        <button onclick="showWorker()"><img src="assets/img/worker.png"></button>
        <button onclick="showProduct()"><img src="assets/img/product.png"></button>
        <button onclick="medical_record()"><img src="assets/img/medical.png"></button>
        <button onclick="showinvent()"><img src="assets/img/market.png"></button>
        <button onclick="showLog()"><img src="assets/img/wood.png"></button>
        <button style='background:red;' onclick="location.href='logout.php'"><img src="assets/img/logout.png"></button>
    </div>

    <div class="main-content">

        <?php
        function renderSection($title, $canvasId, $outliers, $data) {
            if (empty($data)) return;
            echo "<div class='analysis-row'>";
            echo "
            <div class='box chart-box'>
                <h2>$title Graph</h2>
                <canvas id='$canvasId' width='600' height='350'></canvas>
            </div>";
            if (!empty($outliers)) {
                echo "
                <div class='box table-box' style='border-top: 5px solid #d32f2f;'>
                    <h3 style='color:#d32f2f; text-align:center;'>⚠️ Attention Needed</h3>
                    <table class='table' style='width:100%; margin: 10px 0; font-size:0.85em;'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Exp. (kg)</th>
                                <th>Dev.</th>
                            </tr>
                        </thead>
                        <tbody>";
                foreach ($outliers as $c) {
                    echo "
                        <tr>
                            <td>#{$c['cattle_id']}</td>
                            <td>{$c['expected_weight']}</td>
                            <td style='color:red; font-weight:bold;'>{$c['deviation']}</td>
                        </tr>";
                }
                echo "</tbody></table></div>";
            }
            echo "</div>";
        }
        renderSection("Cow",   "cowGraph",   $cowOutliers,   $cow);
        renderSection("Goat",  "goatGraph",  $goatOutliers,  $goat);
        renderSection("Sheep", "sheepGraph", $sheepOutliers, $sheep);
        
        if(empty($cow) && empty($goat) && empty($sheep)){
            echo "<div class='box' style='text-align:center;'><h3>No Cattle Data Found to Analyze</h3></div>";
        }
        ?>
    </div>
    <script>
    function profile() {window.location.href="profile.php"}
    function Dashboard() {window.location.href="dashboard.php"}
    function addCattle() {window.location.href="add_cattle.php"}
    function showCattle() {window.location.href="showcattle.php"}
    function addWorker() {window.location.href="addWorker.php"}
    function showWorker() {window.location.href="showWorker.php"}
    function addProduct() {window.location.href="addProduct.php"}
    function showProduct() {window.location.href="showProduct.php"}
    function medical_record() {window.location.href="medical_record.php"}
    function showLog() {window.location.href="report.php"}
    function showinvent(){window.location.href="showInventory.php"}
    function addinvent(){window.location.href="addInventory.php"}
    function drawGraph(canvasId, data, slope, color) {
        const canvas = document.getElementById(canvasId);
        if (!canvas) return;
        const ctx = canvas.getContext("2d");
        const padding = 50; 
        const width = canvas.width - padding * 2;
        const height = canvas.height - padding * 2;
        const maxAge = Math.max(...data.map(d => d.age)) + 5;
        const maxWeight = Math.max(...data.map(d => d.weight), slope * maxAge) + 10;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.strokeStyle = "#ddd";
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(padding, padding);
        ctx.lineTo(padding, canvas.height - padding);
        ctx.lineTo(canvas.width - padding, canvas.height - padding);
        ctx.stroke();
        ctx.fillStyle = "#555";
        ctx.font = "14px Segoe UI";
        ctx.fillText("Weight (kg)", 10, padding - 15);
        ctx.fillText("Age (mo)", canvas.width - padding - 30, canvas.height - 15);
        ctx.fillStyle = color;
        data.forEach(c => {
            const x = padding + (c.age / maxAge) * width;
            const y = canvas.height - padding - (c.weight / maxWeight) * height;
            ctx.beginPath();
            ctx.arc(x, y, 5, 0, Math.PI * 2);
            ctx.fill();
        });
        ctx.strokeStyle = "rgba(255, 50, 50, 0.7)";
        ctx.lineWidth = 2;
        ctx.setLineDash([5, 5]);
        ctx.beginPath();
        ctx.moveTo(padding, canvas.height - padding);
        ctx.lineTo(
            padding + width,
            canvas.height - padding - (slope * maxAge / maxWeight) * height
        );
        ctx.stroke();
        ctx.setLineDash([]);
    }
    <?php if(!empty($cow)): ?>
        drawGraph("cowGraph",   <?= json_encode($cow) ?>,   <?= $cowSlope ?>,   "#009879");
    <?php endif; ?>
    <?php if(!empty($goat)): ?>
        drawGraph("goatGraph",  <?= json_encode($goat) ?>,  <?= $goatSlope ?>,  "#2980b9");
    <?php endif; ?>
    <?php if(!empty($sheep)): ?>
        drawGraph("sheepGraph", <?= json_encode($sheep) ?>, <?= $sheepSlope ?>, "#e67e22");
    <?php endif; ?>
    </script>

</body>
</html>