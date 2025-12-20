<?php
require_once "db.php";

//function to analyze cattle data and find outliers
function analyzeCattle($data) {
    $sumXY = 0;
    $sumXX = 0;
    foreach ($data as $c) {
        $sumXY += $c['age'] * $c['weight'];
        $sumXX += $c['age'] * $c['age'];
    }

    if ($sumXX == 0) return [0, []];

    $m = $sumXY / $sumXX; // slope

    $outliers = [];
    foreach ($data as $c) {
        $expected = $m * $c['age'];
        $deviation = abs($c['weight'] - $expected);

        if ($deviation > (0.20 * $expected)) {
            $c['expected_weight'] = round($expected, 2);
            $c['deviation'] = round($deviation, 2);
            $outliers[] = $c;
        }
    }

    return [$m, $outliers];
}

/*
|--------------------------------------------------------------------------
| FETCH DATA
|--------------------------------------------------------------------------
*/
$sql = "SELECT cattle_id, age, weight, cattle_type FROM cattle";
$result = mysqli_query($conn, $sql);

$cow = $goat = $sheep = [];

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['cattle_type'] === 'Cow') $cow[] = $row;
    elseif ($row['cattle_type'] === 'Goat') $goat[] = $row;
    elseif ($row['cattle_type'] === 'Sheep') $sheep[] = $row;
}

list($cowSlope, $cowOutliers)     = analyzeCattle($cow);
list($goatSlope, $goatOutliers)  = analyzeCattle($goat);
list($sheepSlope, $sheepOutliers)= analyzeCattle($sheep);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Medical Record</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body class="farm-bg">

<div class="panel">
    <h2>Medical Record</h2>
</div>

<!-- ===================== GRAPHS ===================== -->
<?php
function renderGraph($id, $title) {
    echo "
    <div class='box' style='text-align:center; width:750px; margin-top:30px;'>
        <h2>$title</h2>
        <canvas id='$id' width='700' height='400'
                style='background:#fff; border:1px solid #333;'></canvas>
    </div>";
}


function renderOutliers($title, $data) {
    if (empty($data)) return;

    echo "
    <div class='box'>
        <h3>$title</h3>
        <table class='table'>
            <tr>
                <th>ID</th>
                <th>Age</th>
                <th>Weight</th>
                <th>Expected</th>
                <th>Deviation</th>
            </tr>";
    foreach ($data as $c) {
        echo "
            <tr>
                <td>{$c['cattle_id']}</td>
                <td>{$c['age']}</td>
                <td>{$c['weight']}</td>
                <td>{$c['expected_weight']}</td>
                <td style='color:red;font-weight:bold;'>{$c['deviation']}</td>
            </tr>";
    }
    echo "</table></div>";
}
renderGraph("cowGraph", "Cow: Weight vs Age");
renderOutliers("Cows Needing Attention", $cowOutliers);

renderGraph("goatGraph", "Goat: Weight vs Age");
renderOutliers("Goats Needing Attention", $goatOutliers);

renderGraph("sheepGraph", "Sheep: Weight vs Age");
renderOutliers("Sheep Needing Attention", $sheepOutliers);


?>

<!-- scripts.. -->
<script>
function drawGraph(canvasId, data, slope, color) {
    if (data.length === 0) return;

    const canvas = document.getElementById(canvasId);
    const ctx = canvas.getContext("2d");

    const padding = 60;
    const width = canvas.width - padding * 2;
    const height = canvas.height - padding * 2;

    const maxAge = Math.max(...data.map(d => d.age));
    const maxWeight = Math.max(...data.map(d => d.weight), slope * maxAge);

    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Axes
    ctx.strokeStyle = "#333";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(padding, padding);
    ctx.lineTo(padding, canvas.height - padding);
    ctx.lineTo(canvas.width - padding, canvas.height - padding);
    ctx.stroke();

    // Labels
    ctx.fillStyle = "#000";
    ctx.fillText("Weight ↑", 10, padding);
    ctx.fillText("Age →", canvas.width - padding - 20, canvas.height - 20);

    // Points
    ctx.fillStyle = color;
    data.forEach(c => {
        const x = padding + (c.age / maxAge) * width;
        const y = canvas.height - padding - (c.weight / maxWeight) * height;

        ctx.beginPath();
        ctx.arc(x, y, 5, 0, Math.PI * 2);
        ctx.fill();
    });

    // Average line y = m x
    ctx.strokeStyle = "red";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(padding, canvas.height - padding);
    ctx.lineTo(
        padding + width,
        canvas.height - padding - (slope * maxAge / maxWeight) * height
    );
    ctx.stroke();
}

drawGraph("cowGraph",   <?= json_encode($cow) ?>,   <?= $cowSlope ?>,   "green");
drawGraph("goatGraph",  <?= json_encode($goat) ?>,  <?= $goatSlope ?>,  "blue");
drawGraph("sheepGraph", <?= json_encode($sheep) ?>, <?= $sheepSlope ?>, "orange");
</script>



</body>
</html>
