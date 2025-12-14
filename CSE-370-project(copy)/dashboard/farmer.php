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
<h3>Add Category</h3>
<input id="cat">
<button onclick="addCategory()">Add</button>
</div>

<div class="card">
<h3>Add Cattle</h3>
<input id="cid" placeholder="Cattle ID">
<input id="age" placeholder="Age">
<input id="health" placeholder="Health Status">
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
