function showTab(t){
 loginForm.style.display = t=='login'?'block':'none';
 registerForm.style.display = t=='register'?'block':'none';
}

role.onchange=()=>{
 farmerFields.style.display = role.value=='farmer'?'block':'none';
 workerFields.style.display = role.value=='worker'?'block':'none';
};

loginForm.onsubmit=e=>{
 e.preventDefault();
 fetch("login.php",{method:"POST",
 headers:{'Content-Type':'application/json'},
 body:JSON.stringify({
   username:luser.value,
   password:lpass.value,
   access_key:lkey.value
 })})
 .then(r=>r.json())
 .then(d=>{
   if(!d.success) loginError.innerText=d.message;
   else location=d.redirect;
 });
};

registerForm.onsubmit=e=>{
 e.preventDefault();
 let url = role.value=="farmer"?"register_farmer.php":"register_worker.php";
 let data = role.value=="farmer"?
 {username:ruser.value,password:rpass.value,access_key:rkey.value,
  farm_name:farmName.value,farm_location:farmLoc.value}:
 {username:ruser.value,password:rpass.value,access_key:rkey.value,
  name:wname.value,age:wage.value,salary:wsalary.value,work_hour:whour.value};
 fetch(url,{method:"POST",headers:{'Content-Type':'application/json'},body:JSON.stringify(data)})
 .then(()=>alert("Registered"));
};
