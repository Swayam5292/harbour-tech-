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
// PROJECT DATA
// ================================
const projects = {
  P101: {
    title: "Cloud Migration System",
    status: "completed",
    statusNote: "Successfully deployed",
    description: "A comprehensive cloud migration project that moved legacy on-premise infrastructure to AWS. Included database migration, application containerization, and implementation of CI/CD pipelines for automated deployments.",
    tech: ["AWS", "Docker", "Kubernetes", "Terraform", "PostgreSQL"],
    startDate: "Jan 2024",
    endDate: "Apr 2024",
    teamSize: "8 Engineers",
    client: "FinServe Corp",
    progress: 100,
    progressLabel: "Completed",
    deliverables: [
      "Full infrastructure migration to AWS",
      "Containerized microservices architecture",
      "Automated CI/CD pipeline setup",
      "99.9% uptime SLA achieved",
      "40% reduction in operational costs"
    ]
  },
  P102: {
    title: "AI Sales Analytics",
    status: "in-progress",
    statusNote: "On track for Q2 delivery",
    description: "Building an AI-powered sales analytics platform that uses machine learning to predict customer behavior, optimize pricing strategies, and provide actionable insights for the sales team.",
    tech: ["Python", "TensorFlow", "Power BI", "Azure ML", "FastAPI"],
    startDate: "Feb 2024",
    endDate: "Jul 2024",
    teamSize: "6 Engineers",
    client: "RetailMax Inc",
    progress: 65,
    progressLabel: "Development Phase",
    deliverables: [
      "ML model for sales prediction",
      "Real-time analytics dashboard",
      "Customer segmentation engine",
      "Automated reporting system",
      "API integration with existing CRM"
    ]
  },
  P103: {
    title: "Business ERP System",
    status: "planning",
    statusNote: "Requirements gathering",
    description: "Enterprise resource planning system designed to streamline business operations including inventory management, HR, finance, and supply chain management in a unified platform.",
    tech: ["React", "Node.js", "TypeScript", "MongoDB", "Redis"],
    startDate: "May 2024",
    endDate: "Dec 2024",
    teamSize: "12 Engineers",
    client: "GlobalTrade Ltd",
    progress: 15,
    progressLabel: "Planning Phase",
    deliverables: [
      "Inventory management module",
      "HR & payroll system",
      "Financial reporting dashboard",
      "Supply chain tracking",
      "Mobile app for field operations"
    ]
  },
  P104: {
    title: "Cyber Security Audit",
    status: "completed",
    statusNote: "All vulnerabilities patched",
    description: "Comprehensive security audit including penetration testing, vulnerability assessment, and compliance verification. Delivered detailed remediation roadmap and implemented security hardening measures.",
    tech: ["Kali Linux", "Burp Suite", "Nessus", "OWASP ZAP", "Splunk"],
    startDate: "Dec 2023",
    endDate: "Feb 2024",
    teamSize: "4 Engineers",
    client: "SecureBank",
    progress: 100,
    progressLabel: "Completed",
    deliverables: [
      "Full penetration testing report",
      "Vulnerability assessment document",
      "ISO 27001 compliance audit",
      "Security hardening implementation",
      "Employee security training"
    ]
  }
};

// ================================
// MODAL FUNCTIONS
// ================================
function openModal(id) {
  const project = projects[id];
  
  if (!project) {
    console.error('Project not found:', id);
    return;
  }

  // Populate modal content
  document.getElementById('mId').textContent = id;
  document.getElementById('mTitle').textContent = project.title;
  
  // Status badge
  const statusEl = document.getElementById('mStatus');
  statusEl.textContent = project.status.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase());
  statusEl.className = 'status-badge ' + project.status;
  
  document.getElementById('mStatusNote').textContent = project.statusNote;
  document.getElementById('mDesc').textContent = project.description;
  
  // Tech tags
  const techContainer = document.getElementById('mTech');
  techContainer.innerHTML = project.tech.map(t => `<span class="tech-tag">${t}</span>`).join('');
  
  // Meta info
  document.getElementById('mStart').textContent = project.startDate;
  document.getElementById('mEnd').textContent = project.endDate;
  document.getElementById('mTeam').textContent = project.teamSize;
  document.getElementById('mClient').textContent = project.client;
  
  // Progress bar
  document.getElementById('mProgressLabel').textContent = project.progressLabel;
  document.getElementById('mProgressPct').textContent = project.progress + '%';
  document.getElementById('mProgressFill').style.width = project.progress + '%';
  
  // Deliverables
  const deliverablesList = document.getElementById('mDeliverables');
  deliverablesList.innerHTML = project.deliverables.map(d => `<li>${d}</li>`).join('');
  
  // Show modal
  document.getElementById('projectModal').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  document.getElementById('projectModal').classList.remove('open');
  document.body.style.overflow = 'auto';
}

function closeModalOutside(e) {
  if (e.target.id === 'projectModal') {
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

  // Form submit animation
  $("#contactForm").submit(function () {
    $("#contactSuccess").hide().fadeIn(800);
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

  // Project button effect
  $(".btn-view").click(function () {
    $(this).text("Opening...");
    $(this).fadeOut(200).fadeIn(200);

    setTimeout(() => {
      $(this).text("View Details");
    }, 800);
  });

});