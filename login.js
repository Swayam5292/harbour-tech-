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
    btn.classList.toggle('active', (i === 0 && tab === 'login') || (i === 1 && tab === 'register') || (i === 2 && tab === 'admin'));
  });
  
  // Admin and Login share the same panel, just different modes
  document.getElementById('loginPanel').classList.toggle('active', tab === 'login' || tab === 'admin');
  document.getElementById('registerPanel').classList.toggle('active', tab === 'register');

  // Update header text
  const h2 = document.querySelector('.auth-brand h2');
  const sub = document.querySelector('.auth-subtitle');
  const loginBtn = document.querySelector('#loginForm .btn-primary-pro span');
  
  if (tab === 'login') {
    h2.textContent = 'Welcome Back';
    sub.textContent = 'Sign in to access your dashboard and projects';
    if(loginBtn) loginBtn.textContent = 'Sign In';
  } else if (tab === 'admin') {
    h2.textContent = 'Admin Access';
    sub.textContent = 'Secure gateway for Management & Analytics';
    if(loginBtn) loginBtn.textContent = 'Unlock Dashboard';
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

  // New Admin Check
  if (email === "swayamkerekar@gmail.com" && password === "Swayam1314") {
    localStorage.setItem("ht_admin_session", Date.now());
    localStorage.setItem("loggedInUser", "Swayam Kerekar");
    alert("Welcome to the Command Center, Admin.");
    window.location.href = "admin_dashboard.html";
    return;
  }

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
// NAVBAR LOGIN STATE
// ================================
function updateNavbar() {
  const user = localStorage.getItem("loggedInUser");
  const isAdmin = localStorage.getItem("ht_admin_session");
  const userDisplay = document.getElementById("userDisplay");
  const logoutBtn = document.getElementById("logoutBtn");
  const loginLink = document.getElementById("loginLink");

  if (user) {
    if (userDisplay) {
      const initials = user.substring(0, 1).toUpperCase();
      let dropdownHtml = `
        <div class="profile-dropdown" id="profileDropdown">
          <button class="profile-trigger" id="profileTrigger">
            <div class="profile-avatar" style="width:28px; height:28px; min-width:28px; min-height:28px; flex: 0 0 28px;">${initials}</div>
            <span>${user}</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="dropdown-menu">
            <div style="padding: 12px 14px; margin-bottom: 4px;">
              <div style="font-weight: 600; font-size: 14px; color: #fff;">${user}</div>
              <div style="font-size: 12px; color: #94a3b8; margin-top: 2px;">${isAdmin ? 'Systems Administrator' : 'Access Level: Standard'}</div>
            </div>
            <div class="dropdown-divider"></div>`;

      if (isAdmin) {
        dropdownHtml += `
            <a href="admin_dashboard.html" class="dropdown-item">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
              Admin Dashboard
            </a>
            <div class="dropdown-divider"></div>`;
      }

      dropdownHtml += `
            <button onclick="logout()" class="dropdown-item" style="color: #f87171;">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
              Log out
            </button>
          </div>
        </div>
      `;
      userDisplay.innerHTML = dropdownHtml;

      // Profile dropdown toggle logic
      const trigger = document.getElementById('profileTrigger');
      const dropdown = document.getElementById('profileDropdown');
      if (trigger && dropdown) {
        trigger.onclick = (e) => {
          e.stopPropagation();
          dropdown.classList.toggle('open');
        };
      }
    }
    
    if (logoutBtn) logoutBtn.style.display = "none";
    if (loginLink) loginLink.style.display = "none";
  } else {
    if (userDisplay) userDisplay.innerHTML = "";
    if (logoutBtn) logoutBtn.style.display = "none";
    if (loginLink) loginLink.style.display = "inline-flex";
  }
}

function logout() {
  localStorage.removeItem("loggedInUser");
  localStorage.removeItem("ht_admin_session");
  location.reload();
}

// Global click handler to close dropdowns
document.addEventListener('click', (e) => {
  const dropdown = document.getElementById('profileDropdown');
  if (dropdown && !dropdown.contains(e.target)) {
    dropdown.classList.remove('open');
  }
});

document.addEventListener("DOMContentLoaded", updateNavbar);
