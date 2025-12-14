//commit
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

    document.querySelector(`.tab[onclick="showTab('${tab}')"]`).classList.add('active');
    document.getElementById(tab + 'Form').classList.add('active');
}

/* Role-based register fields */
document.getElementById('registerRole').addEventListener('change', e => {
    farmerFields.classList.add('hidden');
    workerFields.classList.add('hidden');

    if (e.target.value === 'farmer') farmerFields.classList.remove('hidden');
    if (e.target.value === 'worker') workerFields.classList.remove('hidden');
});

/* LOGIN */
document.getElementById('loginForm').addEventListener('submit', e => {
    e.preventDefault();

    fetch('login.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            username: loginUsername.value,
            password: loginPassword.value,
            access_key: loginAccessKey.value
        })
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            showLoginError(data.message);
            return;
        }
        window.location.href = data.redirect;
    });
});

/* REGISTER */
document.getElementById('registerForm').addEventListener('submit', e => {
    e.preventDefault();

    const role = registerRole.value;
    let url = role === 'farmer' ? 'register_farmer.php' : 'register_worker.php';

    let payload = {
        username: regUsername.value,
        password: regPassword.value,
        access_key: regAccessKey.value
    };

    if (role === 'farmer') {
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
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(() => {
        alert('Registration successful. You can login now.');
        showTab('login');
        document.getElementById('registerForm').reset();
    });
});

function showLoginError(msg) {
    loginError.innerText = msg || 'Login failed';
    loginError.classList.remove('hidden');
}
