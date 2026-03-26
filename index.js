
// index.js

let darkMode = false;

// ================================
// THEME TOGGLE
// ================================
function toggleTheme() {
  darkMode = !darkMode;
  document.body.classList.toggle("dark-mode", darkMode);
  document.querySelector('.theme-icon').innerText = darkMode ? '☀' : '☾';
  localStorage.setItem("darkMode", darkMode);
}

// ================================
// NAVBAR LOGIN STATE
// ================================
function updateNavbar() {
  const user = localStorage.getItem("loggedInUser");
  const userDisplay = document.getElementById("userDisplay");
  const logoutBtn = document.getElementById("logoutBtn");
  const loginLink = document.querySelector('a[href="login.html"]');

  if (user) {
    if (userDisplay) userDisplay.innerText = "👤 " + user;
    if (logoutBtn) logoutBtn.style.display = "inline-block";
    if (loginLink) loginLink.style.display = "none";
  } else {
    if (userDisplay) userDisplay.innerText = "";
    if (logoutBtn) logoutBtn.style.display = "none";
    if (loginLink) loginLink.style.display = "inline-block";
  }
}

function logout() {
  localStorage.removeItem("loggedInUser");
  location.reload();
}

// ================================
// CONTACT FORM
// ================================
function handleContact(e) {
  e.preventDefault();

  const btn = e.target.querySelector('button[type="submit"]');
  btn.innerText = 'Sending...';
  btn.disabled = true;

  setTimeout(() => {
    e.target.reset();
    btn.innerText = 'Send Message →';
    btn.disabled = false;

    document.getElementById("contactSuccess").style.display = "block";

    setTimeout(() => {
      document.getElementById("contactSuccess").style.display = "none";
    }, 5000);

  }, 1000);
}

// ================================
// INITIAL LOAD
// ================================
document.addEventListener("DOMContentLoaded", function () {
  updateNavbar();

  const saved = localStorage.getItem("darkMode");
  if (saved === "true") {
    darkMode = true;
    document.body.classList.add("dark-mode");
    const icon = document.querySelector('.theme-icon');
    if (icon) icon.innerText = '☀';
  }
});

// ================================
// PROJECT DATA & MODALS
// ================================
const projects = { /* (unchanged - keep your existing project data here) */ };

// Modal functions (keep same as your file)
function openModal(id) { /* keep same */ }
function closeModal() { /* keep same */ }
function closeModalOutside(e) { if (e.target.id === 'projectModal') closeModal(); }

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeModal();
});

// ================================
// JQUERY FEATURES (ALL INSIDE READY)
// ================================
$(document).ready(function () {

  // ================================
  // HERO BUTTON ONLY
  // ================================
  $(".hero .btn-primary").click(function () {
    $(this).text("Loading...");
    $(this).fadeOut(200).fadeIn(200);

    setTimeout(() => {
      $(this).text("Start a Project");
    }, 1000);
  });

  // ================================
  // SERVICE CARD HOVER
  // ================================
  $(".service-card").hover(
    function () {
      $(this).stop().animate({ marginTop: "-10px" }, 200);
    },
    function () {
      $(this).stop().animate({ marginTop: "0px" }, 200);
    }
  );

  // ================================
  // TABLE ROW EFFECT
  // ================================
  $(".pro-table tbody tr").hover(
    function () {
      $(this).stop().animate({ paddingLeft: "10px" }, 150);
      $(this).css({
        "background": "rgba(92,106,196,0.06)",
        "transition": "all 0.2s ease"
      });
    },
    function () {
      $(this).stop().animate({ paddingLeft: "0px" }, 150);
      $(this).css("background", "");
    }
  );

  // ================================
  // INPUT FOCUS EFFECT
  // ================================
  $("input, textarea, select").focus(function () {
    $(this).css("border", "2px solid #5C6AC4");
  });

  $("input, textarea, select").blur(function () {
    $(this).css("border", "");
  });

  // ================================
  // FORM SUBMIT ANIMATION
  // ================================
  $("#contactForm").submit(function () {
    $("#contactSuccess").hide().fadeIn(800);
  });

  // ================================
  // SMOOTH SCROLL
  // ================================
  $(".nav-links a").click(function (e) {
    if (this.hash !== "") {
      e.preventDefault();

      let target = $(this.hash);

      $("html, body").animate({
        scrollTop: target.offset().top - 60
      }, 600);
    }
  });

  // ================================
  // HERO FADE-IN
  // ================================
  $(".hero-left").hide().fadeIn(1200);

  // ================================
  // PROJECT BUTTON EFFECT
  // ================================
  $(".btn-view").click(function () {
    $(this).text("Opening...");
    $(this).fadeOut(200).fadeIn(200);

    setTimeout(() => {
      $(this).text("View Details");
    }, 800);
  });

});
