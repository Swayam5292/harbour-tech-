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
  const loginLink = document.getElementById("loginLink");

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
// TECH STACK CONFIGURATION
// ================================
const repos = [
  { owner: "microsoft", repo: "TypeScript", category: "frontend", icon: "TS", why: "TypeScript is the foundation of our engineering. It ensures type safety and prevents errors across our entire stack, making our codebase robust and scalable." },
  { owner: "microsoft", repo: "vscode", category: "devops", icon: "VS", why: "Visual Studio Code is our preferred development environment. Its huge ecosystem allows us to customize our workflow for maximum speed and efficiency." },
  { owner: "microsoft", repo: "playwright", category: "devops", icon: "🎭", why: "We use Playwright for all our end-to-end testing. It ensures your application works perfectly across all modern browsers with incredible reliability." },
  { owner: "microsoft", repo: "fluentui", category: "frontend", icon: "💎", why: "Fluent UI provides us with a suite of professional, accessible, and high-performance React components that align with modern design systems." },
  { owner: "microsoft", repo: "monaco-editor", category: "frontend", icon: "📝", why: "The Monaco Editor powers the code experience in our custom internal tools, providing a rich and familiar interface for our engineers." },
  { owner: "microsoft", repo: "terminal", category: "devops", icon: "🐚", why: "Windows Terminal is a core part of our local development setup, providing a fast and efficient way to manage our build processes and servers." }
];

let dataCache = {};

// ================================
// TECH STACK FETCHING
// ================================
async function fetchRepos() {
  const tableBody = document.getElementById('repoBody');
  const profile = document.getElementById('githubProfile');
  if (!tableBody) return;

  // Inject skeleton rows
  tableBody.innerHTML = '';
  for (let i = 0; i < 6; i++) {
    tableBody.innerHTML += `
      <tr class="skeleton-row">
        <td><div class="skeleton-line" style="width: 120px;"></div></td>
        <td><div class="skeleton-line" style="width: 80px;"></div></td>
        <td class="hide-mobile"><div class="skeleton-line" style="width: 60px;"></div></td>
        <td><div class="skeleton-line" style="width: 100%;"></div></td>
        <td><div class="skeleton-line" style="width: 40px;"></div></td>
      </tr>
    `;
  }

  if (profile) {
    profile.innerHTML = `
      <div class="skeleton-icon" style="flex-shrink:0;"></div>
      <div style="flex:1;">
        <div class="skeleton-line" style="width: 200px; margin-bottom:12px; height: 28px;"></div>
        <div class="skeleton-line" style="width: 80%; margin-bottom:12px;"></div>
        <div class="skeleton-line" style="width: 40%;"></div>
      </div>
    `;
  }

  await new Promise(r => setTimeout(r, 600));
  tableBody.innerHTML = '';

  try {
    const profRes = await fetch('https://api.github.com/users/microsoft');
    const profData = await profRes.json();
    
    if (profile && profData.avatar_url) {
      profile.innerHTML = `
        <img src="${profData.avatar_url}" alt="Microsoft Avatar" class="profile-avatar">
        <div class="profile-info">
          <div class="profile-name">${profData.name || 'Microsoft'}</div>
          <div class="profile-bio">${profData.bio || 'Developing technologies that empower every person on the planet.'}</div>
          <div class="profile-stats">
            <span class="profile-stat"><span class="profile-stat-icon">👥</span> ${formatNum(profData.followers)} Followers</span>
            <span class="profile-stat"><span class="profile-stat-icon">📁</span> ${profData.public_repos} Public Repos</span>
          </div>
        </div>
      `;
    }

    for (const r of repos) {
        let data;
        const cacheKey = `${r.owner}/${r.repo}`;
        if (dataCache[cacheKey]) {
          data = dataCache[cacheKey];
        } else {
          const res = await fetch(`https://api.github.com/repos/${r.owner}/${r.repo}`);
          data = await res.json();
        }

        if (data.message || !data.name) continue;
        const fullData = { ...data, ...r, githubOwner: data.owner };
        dataCache[cacheKey] = fullData;
        createRepoRow(tableBody, fullData);
    }

  } catch (err) {
    console.error('Fetch error:', err);
    tableBody.innerHTML = `<tr><td colspan="5" style="color:#ef4444; text-align:center; padding: 40px;">⚠️ API limit reached. Try again later.</td></tr>`;
  }
}

function createRepoRow(tbody, data) {
  const row = document.createElement('tr');
  row.className = 'repo-row';
  
  row.innerHTML = `
    <td class="td-tech">
      <div style="display:flex; align-items:center; gap:12px;">
        <span class="tech-icon-small">${data.icon}</span>
        <strong style="color:var(--text);">${data.name}</strong>
      </div>
    </td>
    <td class="td-type"><span class="status-badge ${data.category}">${data.category}</span></td>
    <td class="td-stats hide-mobile">
      <span class="stat-mini">⭐ ${formatNum(data.stargazers_count)}</span>
    </td>
    <td class="td-desc">${data.description || 'Enterprise-grade building block.'}</td>
    <td class="td-action">
      <button class="btn-view" onclick="openRepoModal('${data.owner}', '${data.repo}')">View</button>
    </td>
  `;
  tbody.appendChild(row);
}

function formatNum(num) {
  if (num >= 1000) return (num / 1000).toFixed(1) + 'k';
  return num;
}

// ================================
// MODAL FUNCTIONS
// ================================
function openRepoModal(owner, repoName) {
  const data = dataCache[`${owner}/${repoName}`];
  if (!data) return;

  const modal = document.getElementById('repoModal');
  if (!modal) return;
  
  document.getElementById('modalAvatar').src = data.githubOwner.avatar_url;
  document.getElementById('modalAvatar').alt = data.name;
  document.getElementById('modalName').textContent = data.name;
  document.getElementById('modalOwner').textContent = `${owner}/${repoName}`;
  document.getElementById('modalDesc').textContent = data.description || 'No description available.';
  document.getElementById('modalWhy').textContent = data.why || 'Critical piece of our infrastructure.';
  document.getElementById('modalStars').textContent = formatNum(data.stargazers_count);
  document.getElementById('modalForks').textContent = formatNum(data.forks_count);
  document.getElementById('modalIssues').textContent = formatNum(data.open_issues_count || 0);

  document.getElementById('modalLink').href = data.html_url;
  document.getElementById('modalIssuesLink').href = `${data.html_url}/issues`;

  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  const repoModal = document.getElementById('repoModal');
  if (repoModal) repoModal.style.display = 'none';
  document.body.style.overflow = 'auto';
}

function closeModalOutside(e) {
  if (e.target.id === 'repoModal') {
    closeModal();
  }
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeModal();
});

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

  // Initialize Tech Stack
  fetchRepos();

  // Initialize AOS
  if (typeof AOS !== 'undefined') {
    AOS.init({
      once: true,
      offset: 50,
      duration: 800,
      easing: 'ease-out-cubic'
    });
  }
});

// ================================
// JQUERY FEATURES
// ================================
$(document).ready(function () {

  // Hero button effect
  $(".hero .btn-primary").click(function () {
    $(this).text("Loading...");
    $(this).fadeOut(200).fadeIn(200);

    setTimeout(() => {
      $(this).text("Start a Project");
    }, 1000);
  });

  // Service card hover
  $(".service-card").hover(
    function () {
      $(this).stop().animate({ marginTop: "-10px" }, 200);
    },
    function () {
      $(this).stop().animate({ marginTop: "0px" }, 200);
    }
  );

  // Table row effect
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

  // Input focus effect
  $("input, textarea, select").focus(function () {
    $(this).css("border", "2px solid #5C6AC4");
  });

  $("input, textarea, select").blur(function () {
    $(this).css("border", "");
  });

  // Form submit animation & EmailJS
  $("#contactForm").submit(function (e) {
    e.preventDefault(); // Prevent default page refresh

    const btn = $("#submitBtn");
    const originalText = btn.html();
    btn.html("Sending... &#8987;");
    btn.prop("disabled", true);
    $("#contactSuccess, #contactError").hide();

    emailjs.sendForm('service_pcqzlcb', 'template_8tyn0yi', this)
      .then(function() {
          btn.html("Message Sent! &#10003;");
          $("#contactSuccess").fadeIn(800);
          $("#contactForm")[0].reset();
          setTimeout(() => {
            btn.html(originalText);
            btn.prop("disabled", false);
          }, 3000);
      }, function(error) {
          console.error("EmailJS Error:", error);
          btn.html("Failed &#10007;");
          $("#contactError").fadeIn(800);
          setTimeout(() => {
            btn.html(originalText);
            btn.prop("disabled", false);
          }, 3000);
      });
  });

  // Smooth scroll
  $(".nav-links a").click(function (e) {
    if (this.hash !== "") {
      e.preventDefault();
      let target = $(this.hash);
      if (target.length) {
        $("html, body").animate({
          scrollTop: target.offset().top - 60
        }, 600);
      }
    }
  });

  // Hero fade-in
  $(".hero-left").hide().fadeIn(1200);

});