<?php
session_start();
if (isset($_SESSION['role'])) {
    header("Location: dashboard/" . $_SESSION['role'] . ".php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Worker</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg" margin="50px">

<div class="panel">
    <h2>Add New Worker</h2><br>
</div>

<?php
// Include database connection
require_once "db.php";

/*
|--------------------------------------------------------------------------
| HANDLE FORM SUBMISSION
|--------------------------------------------------------------------------
| This block runs ONLY when the form is submitted using POST
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Read form values safely
    $name = $_POST["name"];
    $age         = $_POST["age"];
    $salary      = $_POST["salary"];
    $work_hour   = $_POST["work_hour"];
    $access_key  = $_POST["access_key"];

    // SQL query to insert worker data
    // NOTE: worker_id is now auto-increment, so we don't include it
    $sql = "INSERT INTO worker (name, age, salary, work_hour, access_key)
            VALUES ('$name', '$age', '$salary', '$work_hour', '$access_key')";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        // Redirect after successful insert to avoid duplicate on reload (PRG pattern)
        header("Location: addWorker.php?success=1");
        exit;
    } else {
        echo "<p style='color:red;'>Error adding worker: " . mysqli_error($conn) . "</p>";
    }
}

// Show success message if redirected after insert
if (isset($_GET['success'])) {
    echo "<h2 style='color:white;'>Worker added successfully</h2>";
}
?>

<!--
| ADD WORKER FORM
|--------------------------------------------------------------------------
| This form collects worker information from the user
-->
<div class = "panel">
<form method="post" style="margin: 0 auto; max-width: 500px; font-weight: bold; text-shadow: 1px 1px 2px white;">

    <!-- Name input -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Name</label><br>
        <input type="text" name="name" required style="width: 100%; padding: 8px; border-radius: 5px;">
    </div>

    <!-- Age input -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Age</label><br>
        <input type="number" name="age" required style="width: 100%; padding: 8px; border-radius: 5px;">
    </div>

    <!-- Salary input -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Salary</label><br>
        <input type="number" name="salary" required style="width: 100%; padding: 8px; border-radius: 5px;">
    </div>

    <!-- Work Hour input -->
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Work Hour</label><br>
        <input type="number" name="work_hour" required style="width: 100%; padding: 8px; border-radius: 5px;">
    </div>

    <!-- Access Key input -->
    <div style="margin-bottom: 20px;">
        <label style="font-weight: bold;">Access Key</label><br>
        <input type="text" name="access_key" required style="width: 100%; padding: 8px; border-radius: 5px;">
    </div>
    <!-- Submit button -->
    <button type="submit" style="padding: 10px 20px; border-radius: 5px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
        Add Worker
    </button>

</form>
</div>
</body>
</html>