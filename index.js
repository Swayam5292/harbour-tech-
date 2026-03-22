// index.js

let darkMode = false;

function toggleTheme() {
  darkMode = !darkMode;
  document.body.classList.toggle("dark-mode", darkMode);
  document.querySelector('.theme-icon').innerText = darkMode ? '☀' : '☾';
  localStorage.setItem("darkMode", darkMode);
}

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
    setTimeout(() => { document.getElementById("contactSuccess").style.display = "none"; }, 5000);
  }, 1000);
}

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
const projects = {
  P101: {
    id: 'P101', title: 'Cloud Migration System',
    status: 'completed', statusLabel: 'Completed', statusNote: 'Delivered on time',
    description: 'Migrated a legacy on-premise infrastructure to AWS cloud for a mid-sized logistics company. Handles real-time shipment tracking, automated scaling during peak loads, and reduced infrastructure costs by 40%.',
    tech: ['AWS EC2', 'Docker', 'Kubernetes', 'Terraform', 'CI/CD'],
    start: 'Jan 2025', end: 'Jun 2025', team: '5 Engineers', client: 'LogiTrack Ltd.',
    progress: 100, progressLabel: 'All milestones completed',
    deliverables: ['Cloud architecture design and planning', 'Data migration with zero downtime', 'Containerization of 12 microservices', 'Auto-scaling and load balancer setup', 'Full monitoring and alerting dashboard']
  },
  P102: {
    id: 'P102', title: 'AI Sales Analytics',
    status: 'in-progress', statusLabel: 'In Progress', statusNote: 'Currently in development',
    description: 'Building an AI-powered sales forecasting platform for a retail chain. Uses machine learning to predict demand, identify customer patterns, and generate automated weekly reports for management.',
    tech: ['Python', 'TensorFlow', 'Pandas', 'FastAPI', 'React', 'PostgreSQL'],
    start: 'Mar 2025', end: 'Dec 2025', team: '4 Engineers + 1 Data Scientist', client: 'RetailMax Inc.',
    progress: 65, progressLabel: 'Model training phase',
    deliverables: ['Data pipeline and ETL setup', 'Sales forecasting ML model', 'Customer segmentation module (in progress)', 'Analytics dashboard (in progress)', 'Automated reporting system (pending)']
  },
  P103: {
    id: 'P103', title: 'Business ERP System',
    status: 'planning', statusLabel: 'Planning', statusNote: 'Requirements gathering phase',
    description: 'Developing a full-scale ERP system for a manufacturing company to manage inventory, HR, payroll, procurement, and financial reporting in one unified platform. Replacing 6 separate legacy tools.',
    tech: ['React', 'Node.js', 'Express', 'MySQL', 'Redis', 'Docker'],
    start: 'Aug 2025', end: 'Mar 2026', team: '7 Engineers', client: 'ManuCorp Industries',
    progress: 12, progressLabel: 'Planning and architecture',
    deliverables: ['Requirements and scope documentation (in progress)', 'System architecture design (pending)', 'Inventory management module (pending)', 'HR and payroll module (pending)', 'Financial reporting dashboard (pending)']
  },
  P104: {
    id: 'P104', title: 'Cyber Security Audit',
    status: 'completed', statusLabel: 'Completed', statusNote: 'Report delivered',
    description: 'Comprehensive security audit for a fintech startup including penetration testing, vulnerability assessment, and compliance review against ISO 27001. Identified and resolved 23 critical vulnerabilities.',
    tech: ['Kali Linux', 'Metasploit', 'Nessus', 'Wireshark', 'Burp Suite'],
    start: 'Feb 2025', end: 'Apr 2025', team: '3 Security Specialists', client: 'FinSecure Pvt. Ltd.',
    progress: 100, progressLabel: 'Audit completed and certified',
    deliverables: ['Full penetration testing report', 'Vulnerability assessment (23 issues resolved)', 'ISO 27001 compliance review', 'Security policy recommendations', 'Staff security awareness training']
  }
};

function openModal(id) {
  const p = projects[id];
  if (!p) return;
  document.getElementById('mId').innerText = p.id;
  document.getElementById('mTitle').innerText = p.title;
  const statusEl = document.getElementById('mStatus');
  statusEl.innerText = p.statusLabel;
  statusEl.className = 'status-badge ' + p.status;
  document.getElementById('mStatusNote').innerText = p.statusNote;
  document.getElementById('mDesc').innerText = p.description;
  document.getElementById('mStart').innerText = p.start;
  document.getElementById('mEnd').innerText = p.end;
  document.getElementById('mTeam').innerText = p.team;
  document.getElementById('mClient').innerText = p.client;
  document.getElementById('mProgressLabel').innerText = p.progressLabel;
  document.getElementById('mProgressPct').innerText = p.progress + '%';
  document.getElementById('mProgressFill').style.width = p.progress + '%';
  document.getElementById('mTech').innerHTML = p.tech.map(t => '<span class="tech-tag">' + t + '</span>').join('');
  document.getElementById('mDeliverables').innerHTML = p.deliverables.map(d => '<li>' + d + '</li>').join('');
  document.getElementById('projectModal').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  document.getElementById('projectModal').classList.remove('open');
  document.body.style.overflow = '';
}

function closeModalOutside(e) {
  if (e.target.id === 'projectModal') closeModal();
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeModal();
});
