// login.js

// Redirect if already logged in
if (localStorage.getItem("loggedInUser")) {
  window.location.href = "index.html";
}

// Theme
let darkMode = false;

function toggleTheme() {
  darkMode = !darkMode;
  document.body.classList.toggle("dark-mode", darkMode);
  localStorage.setItem("darkMode", darkMode);
}

const savedTheme = localStorage.getItem("darkMode");
if (savedTheme === "true") {
  document.body.classList.add("dark-mode");
  darkMode = true;
}

// Tab switching
function switchTab(tab) {
  document.querySelectorAll('.tab-btn').forEach((btn, i) => {
    btn.classList.toggle('active', (i === 0 && tab === 'login') || (i === 1 && tab === 'register'));
  });
  document.getElementById('loginPanel').classList.toggle('active', tab === 'login');
  document.getElementById('registerPanel').classList.toggle('active', tab === 'register');
}

// Show/hide password
function togglePw(id, btn) {
  const input = document.getElementById(id);
  if (input.type === "password") {
    input.type = "text";
    btn.innerText = "🙈";
  } else {
    input.type = "password";
    btn.innerText = "👁️";
  }
}

// Password strength
document.getElementById("regPassword").addEventListener("input", function () {
  const val = this.value;
  const el = document.getElementById("pwStrength");
  if (!val) { el.innerText = ""; return; }
  const strong = /[A-Z]/.test(val) && /[0-9]/.test(val) && /[@$!%*?&]/.test(val) && val.length >= 8;
  const medium = /[A-Z]/.test(val) && /[0-9]/.test(val) && val.length >= 6;
  if (strong) { el.innerText = "✅ Strong password"; el.style.color = "#16a34a"; }
  else if (medium) { el.innerText = "⚠️ Medium password"; el.style.color = "#d97706"; }
  else { el.innerText = "❌ Weak password"; el.style.color = "#dc2626"; }
});

// Register
document.getElementById("registerForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const name = document.getElementById("regName").value.trim();
  const email = document.getElementById("regEmail").value.toLowerCase().trim();
  const password = document.getElementById("regPassword").value;
  const confirm = document.getElementById("confirmPassword").value;

  if (name.length < 3) { alert("Name must be at least 3 characters."); return; }
  if (!/^[^ ]+@[^ ]+\.[a-z]{2,3}$/.test(email)) { alert("Invalid email format."); return; }
  if (!/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&]).{6,}$/.test(password)) {
    alert("Password must be at least 6 characters and include an uppercase letter, a number, and a special character.");
    return;
  }
  if (password !== confirm) { alert("Passwords do not match."); return; }

  localStorage.setItem("user", JSON.stringify({ name, email, password }));
  localStorage.setItem("loggedInUser", name);
  alert("Account created successfully!");
  window.location.href = "index.html";
});

// Login
document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const email = document.getElementById("loginEmail").value.toLowerCase().trim();
  const password = document.getElementById("loginPassword").value;
  const stored = JSON.parse(localStorage.getItem("user"));

  if (stored && stored.email === email && stored.password === password) {
    localStorage.setItem("loggedInUser", stored.name);
    alert("Welcome back, " + stored.name + "!");
    window.location.href = "index.html";
  } else {
    alert("Invalid email or password.");
  }
});

// Navbar
function updateNavbar() {
  const user = localStorage.getItem("loggedInUser");
  const display = document.getElementById("userDisplay");
  const logoutBtn = document.getElementById("logoutBtn");
  const loginLink = document.querySelector('a[href="login.html"]');
  if (user) {
    if (display) display.innerText = "👤 " + user;
    if (logoutBtn) logoutBtn.style.display = "inline-block";
    if (loginLink) loginLink.style.display = "none";
  }
}

function logout() {
  localStorage.removeItem("loggedInUser");
  location.reload();
}

document.addEventListener("DOMContentLoaded", updateNavbar);
