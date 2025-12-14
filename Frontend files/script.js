const farmerFields = document.getElementById('farmerFields');
const workerFields = document.getElementById('workerFields');
const loginUsername = document.getElementById('loginUsername');
const loginPassword = document.getElementById('loginPassword');
const loginAccessKey = document.getElementById('loginAccessKey');
const loginError = document.getElementById('loginError');
const regUsername = document.getElementById('regUsername');
const regPassword = document.getElementById('regPassword');
const regAccessKey = document.getElementById('regAccessKey');
const registerRole = document.getElementById('registerRole');
const farmName = document.getElementById('farmName');
const farmLocation = document.getElementById('farmLocation');



function showTab(tab) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

    document.querySelector(`[onclick="showTab('${tab}')"]`).classList.add('active');
    document.getElementById(tab + 'Form').classList.add('active');
}

/* Role-based fields */
role.addEventListener('change', () => {
    farmerFields.classList.add('hidden');
    workerFields.classList.add('hidden');

    if (role.value === 'farmer') farmerFields.classList.remove('hidden');
    if (role.value === 'worker') workerFields.classList.remove('hidden');
});

/* LOGIN */
loginForm.addEventListener('submit', e => {
    e.preventDefault();

    fetch('login.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({
            username: loginUsername.value,
            password: loginPassword.value,
            access_key: loginAccessKey.value
        })
    })
    .then(r => r.json())
    .then(d => {
        if (!d.success) {
            loginError.innerText = d.message;
            loginError.classList.remove('hidden');
            return;
        }
        window.location.href = d.redirect;
    });
});

/* REGISTER */
registerForm.addEventListener('submit', e => {
    e.preventDefault();

    let url = role.value === 'farmer'
        ? 'register_farmer.php'
        : 'register_worker.php';

    let payload = {
        username: regUsername.value,
        password: regPassword.value,
        access_key: regAccessKey.value
    };

    if (role.value === 'farmer') {
        payload.farm_name = farmName.value;
        payload.farm_location = farmLocation.value;
    } else {
        payload.name = workerName.value;
        payload.age = workerAge.value;
        payload.salary = workerSalary.value;
        payload.work_hour = workerHours.value;
    }

    fetch(url, {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(payload)
    })
    .then(r => r.json())
    .then(d => {
        if (!d.success) {
            alert(d.message);
            return;
        }
        alert('Registration successful. Please login.');
        showTab('login');
        registerForm.reset();
    });
});


function showLoginError(msg) {
    loginError.innerText = msg || 'Login failed';
    loginError.classList.remove('hidden');
}
