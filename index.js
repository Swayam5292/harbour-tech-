// index.js

let darkMode = false;

function toggleTheme() {
  darkMode = !darkMode;
  document.body.classList.toggle("dark-mode", darkMode);
  document.querySelector('#theme-btn .theme-icon').innerText = darkMode ? '☀️' : '🌙';
  document.getElementById("theme-label").innerText = darkMode ? 'Light Mode' : 'Dark Mode';
  localStorage.setItem("darkMode", darkMode);
}

function updateNavbar() {
  const user = localStorage.getItem("loggedInUser");
  const userDisplay = document.getElementById("userDisplay");
  const logoutBtn = document.getElementById("logoutBtn");
  const loginLink = document.querySelector('a[href="login.html"]');
  if (user) {
    userDisplay.innerText = "👤 " + user;
    logoutBtn.style.display = "inline-block";
    if (loginLink) loginLink.style.display = "none";
  } else {
    userDisplay.innerText = "";
    logoutBtn.style.display = "none";
    if (loginLink) loginLink.style.display = "inline-block";
  }
}

function logout() {
  localStorage.removeItem("loggedInUser");
  location.reload();
}

function handleContact(e) {
  e.preventDefault();
  const btn = document.querySelector('.btn-send');
  btn.innerText = 'Sending...';
  btn.disabled = true;
  setTimeout(() => {
    document.getElementById("contactForm").reset();
    btn.innerText = 'Send Message →';
    btn.disabled = false;
    document.getElementById("contactSuccess").style.display = "block";
    setTimeout(() => {
      document.getElementById("contactSuccess").style.display = "none";
    }, 5000);
  }, 1000);
}

document.addEventListener("DOMContentLoaded", function () {
  updateNavbar();
  const saved = localStorage.getItem("darkMode");
  if (saved === "true") { toggleTheme(); }
});
