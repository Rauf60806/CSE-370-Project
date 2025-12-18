<?php require "auth.php"; ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../assets/style.css">
<title>Farmer Dashboard</title>
</head>
<body class="farm-bg">

<div class="dashboard">
<h2>🌾 Farmer Dashboard</h2>


<div class="card">
<h3>Add Cattle</h3>
<input id="cid" placeholder="Cattle ID">
<input id="age" placeholder="Age">
<input id="gender" placeholder="gender">
<input id="weight" placeholder="weight">
<select id="Cattle_type">
            <option value="">Select Type</option>
            <option value="Cow">Cow</option>
            <option value="Goat">Goat</option>
            <option value="Sheep">Sheep</option>
        </select>
<button onclick="addCattle()">Add Cattle</button>
</div>
</div>

<script>
function addCategory(){
 fetch("../add_category.php",{method:"POST",
 headers:{'Content-Type':'application/json'},
 body:JSON.stringify({name:cat.value})}).then(()=>alert("Added"));
}
function addCattle(){
 fetch("../add_cattle.php",{method:"POST",
 headers:{'Content-Type':'application/json'},
 body:JSON.stringify({
 category_id:cid.value,
 age:age.value,
 health_status:health.value
 })}).then(()=>alert("Cattle Added"));
}
</script>

</body>
</html>
