<DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="farm-bg" margin="50px">

<div class="header-notch">
    <h1>Fill up the form</h1>
</div>
<div class = "panel" style="max-width: 430px; margin: 100px auto;">
<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Get inputs (User Name is no longer retrieved from POST)
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $farm_name = $_POST["farm_name"];
    $email = $_POST["email"];
    $Farm_location  = $_POST["Farm_location"];
    $pass      = $_POST["pass"];

    // 2. Logic to generate Unique User Name
    $user_name = "";
    $is_unique = false;

    // Clean names to remove spaces or special chars for the username (e.g. "O'Neil" -> "oneil")
    $clean_first = preg_replace("/[^a-zA-Z0-9]/", "", $first_name);
    $clean_last = preg_replace("/[^a-zA-Z0-9]/", "", $last_name);
    $base_name = strtolower($clean_first . $clean_last);

    // Loop until we find a username that doesn't exist
    while (!$is_unique) {
        $rand_num = rand(100, 9999); // Generate random number between 100 and 9999
        $candidate_name = $base_name . $rand_num;

        // Check if this specific name exists in database
        $check_sql = "SELECT * FROM dashboard_panel WHERE user_name = '$candidate_name'";
        $result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($result) == 0) {
            // It does not exist, so we can use it
            $user_name = $candidate_name;
            $is_unique = true;
        }
    }

    // 3. Insert into database with the auto-generated user_name
    $sql = "INSERT INTO dashboard_panel (user_name, first_name, last_name, email, farm_name, Farm_location, pass)
            VALUES ('$user_name', '$first_name', '$last_name', '$email', '$farm_name', '$Farm_location', '$pass')";

    if (mysqli_query($conn, $sql)) {
        // Optional: You might want to show the user their new username in the success message
        header("Location: register.php?success=1&newuser=$user_name");
        exit;
    } else {
        echo "<p style='color:red;'>Error adding user: " . mysqli_error($conn) . "</p>";
    }
}

if (isset($_GET['success'])) {
    $msg = "User added successfully.";
    if(isset($_GET['newuser'])){
        // Display the generated username to the user
        $msg .= " Your Username is: " . htmlspecialchars($_GET['newuser']);
    }
    echo "<h2 style='color:black;'>$msg</h2>";
}
?>


<form method="post" style="margin: 0 auto; max-width: 500px; font-weight: bold; text-shadow: 1px 1px 2px white;">
    
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">First Name</label><br>
        <input type="text" name="first_name" required style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Last Name</label><br>
        <input type="text" name="last_name" required style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Email</label><br>
        <input type="email" name="email" required style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Farm Name</label><br>
        <input type="text" name="farm_name" required style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label style="font-weight: bold;">Farm Location</label><br>
        <input type="text" name="Farm_location" required style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>
    <div style="margin-bottom: 20px;">
        <label style="font-weight: bold;">Password</label><br>
        <input type="password" name="pass" style="width: 400px; padding: 8px; border-radius: 5px;">
    </div>
    <button type="submit" >
        Register
    </button>
    <h3>Already Registered? <a href="index.php">Sign in</a> now!</h3>

</form>
</div>
</body>
</html>