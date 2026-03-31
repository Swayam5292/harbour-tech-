// login.js

// ================================
// REDIRECT IF ALREADY LOGGED IN
// ================================
if (localStorage.getItem("loggedInUser")) {
  window.location.href = "index.html";
}

// ================================
// THEME TOGGLE
// ================================
let darkMode = false;

function toggleTheme() {
  darkMode = !darkMode;
  document.body.classList.toggle("dark-mode", darkMode);
  localStorage.setItem("darkMode", darkMode);
  const tb = document.getElementById("theme-btn");
  if(tb) tb.innerHTML = darkMode ? "&#9788;" : "&#9790;"; // Sun in dark mode, Moon in light mode
}

const savedTheme = localStorage.getItem("darkMode");
if (savedTheme === "true") {
  document.body.classList.add("dark-mode");
  darkMode = true;
}
const tb = document.getElementById("theme-btn");
if(tb) tb.innerHTML = darkMode ? "&#9788;" : "&#9790;";

// ================================
// TAB SWITCHING
// ================================
function switchTab(tab) {
  document.querySelectorAll('.tab-btn').forEach((btn, i) => {
    btn.classList.toggle('active', (i === 0 && tab === 'login') || (i === 1 && tab === 'register'));
  });
  document.getElementById('loginPanel').classList.toggle('active', tab === 'login');
  document.getElementById('registerPanel').classList.toggle('active', tab === 'register');

  // Update header text
  const h2 = document.querySelector('.auth-brand h2');
  const sub = document.querySelector('.auth-subtitle');
  if (tab === 'login') {
    h2.textContent = 'Welcome Back';
    sub.textContent = 'Sign in to access your dashboard and projects';
  } else {
    h2.textContent = 'Get Started';
    sub.textContent = 'Create your account and start building today';
  }
}

// ================================
// SHOW/HIDE PASSWORD
// ================================
function togglePw(id, btn) {
  const input = document.getElementById(id);
  if (input.type === "password") {
    input.type = "text";
    btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>';
  } else {
    input.type = "password";
    btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
  }
}

// ================================
// PASSWORD STRENGTH
// ================================
document.getElementById("regPassword").addEventListener("input", function () {
  const val = this.value;
  const el = document.getElementById("pwStrength");
  if (!val) { el.innerText = ""; return; }
  const strong = /[A-Z]/.test(val) && /[0-9]/.test(val) && /[@$!%*?&]/.test(val) && val.length >= 8;
  const medium = /[A-Z]/.test(val) && /[0-9]/.test(val) && val.length >= 6;
  if (strong) { el.innerText = "✦ Strong password"; el.style.color = "#22c55e"; }
  else if (medium) { el.innerText = "◆ Medium password"; el.style.color = "#f59e0b"; }
  else { el.innerText = "✧ Weak password"; el.style.color = "#ef4444"; }
});

// ================================
// REGISTER
// ================================
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

// ================================
// LOGIN
// ================================
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

// ================================
// NAVBAR STATE
// ================================
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
