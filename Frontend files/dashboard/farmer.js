function addCategory() {
    fetch('../add_category.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({
            category_name: document.getElementById('categoryName').value
        })
    })
    .then(r=>r.json())
    .then(d=>{
        if(!d.success){
            alert(d.message);
            return;
        }
        alert('Category added');
        location.reload();
    });
}

function addCattle() {
    fetch('../add_cattle.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({
            category_id: document.getElementById('cattleCategory').value,
            age: document.getElementById('cattleAge').value,
            health_status: document.getElementById('cattleHealth').value
        })
    })
    .then(r=>r.json())
    .then(d=>{
        if(!d.success){
            alert(d.message);
            return;
        }
        alert('Cattle added');
        location.reload();
    });
}
