// index.js — Harbour Tech Solutions
// Fixed modal logic, 3D effects, Razorpay, AI Estimator, counter animation

let darkMode = false;

// ================================
// THEME TOGGLE
// ================================
function toggleTheme() {
  darkMode = !darkMode;
  document.body.classList.toggle("dark-mode", darkMode);
  const icon = document.querySelector('.theme-icon');
  if (icon) icon.innerText = darkMode ? '☀' : '☾';
  localStorage.setItem("darkMode", darkMode);
}

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
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2-0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
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


// ================================
// NAVBAR SCROLL EFFECT
// ================================
let lastScroll = 0;
window.addEventListener('scroll', function () {
  const nav = document.getElementById('main-nav');
  if (!nav) return;
  if (window.scrollY > 80) {
    nav.classList.add('nav-scrolled');
  } else {
    nav.classList.remove('nav-scrolled');
  }
  lastScroll = window.scrollY;
});

// ================================
// COUNTER ANIMATION
// ================================
function animateCounters() {
  const counters = document.querySelectorAll('.metric-num[data-count]');
  counters.forEach(counter => {
    const target = parseInt(counter.getAttribute('data-count'));
    const duration = 2000;
    const startTime = performance.now();

    function update(currentTime) {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 4); // ease-out quart
      const current = Math.floor(eased * target);
      counter.textContent = current + '+';
      if (progress < 1) {
        requestAnimationFrame(update);
      }
    }
    requestAnimationFrame(update);
  });
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
      <div class="skeleton-line skeleton-icon" style="flex-shrink:0; width:88px; height:88px; border-radius:50%;"></div>
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

    // Parallelize repo fetching
    const repoPromises = repos.map(async (r) => {
      const cacheKey = `${r.owner}/${r.repo}`;
      if (dataCache[cacheKey]) return dataCache[cacheKey];

      const res = await fetch(`https://api.github.com/repos/${r.owner}/${r.repo}`);
      const data = await res.json();
      
      if (data.message || !data.name) return null;

      const ownerName = (typeof data.owner === 'object') ? data.owner.login : r.owner;
      const fullData = { ...data, ...r, githubOwner: ownerName };
      dataCache[cacheKey] = fullData;
      return fullData;
    });

    const repoResults = await Promise.all(repoPromises);
    repoResults.forEach(data => {
      if (data) createRepoRow(tableBody, data);
    });

  } catch (err) {
    console.error('Fetch error:', err);
    tableBody.innerHTML = `<tr><td colspan="5" style="color:#ef4444; text-align:center; padding: 40px;">⚠️ API limit reached or network error. Try again later.</td></tr>`;
  }
}

function createRepoRow(tbody, data) {
  const row = document.createElement('tr');
  row.className = 'repo-row';
  // FIX: Use data-owner and data-repo attributes to avoid [object Object] issue
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
      <button class="btn-view" data-owner="${data.githubOwner}" data-repo="${data.name}">View</button>
    </td>
  `;

  // FIX: Attach event listener properly to avoid string interpolation issues
  const viewBtn = row.querySelector('.btn-view');
  viewBtn.addEventListener('click', function () {
    const ownerAttr = this.getAttribute('data-owner');
    const repoAttr = this.getAttribute('data-repo');
    openRepoModal(ownerAttr, repoAttr);
  });

  tbody.appendChild(row);
}

// Helper: Format numbers (1200 -> 1.2k)
function formatNum(num) {
  if (!num) return '0';
  if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
  if (num >= 1000) return (num / 1000).toFixed(1) + 'k';
  return num;
}

// ================================
// MODAL FUNCTIONS — FIXED
// ================================
function openRepoModal(ownerName, repoName) {
  if (!localStorage.getItem("loggedInUser")) {
    alert("Please log in to view detailed repository analytics.");
    window.location.href = "login.html";
    return;
  }

  const data = dataCache[`${ownerName}/${repoName}`];
  if (!data) {
    console.warn('No cached data for:', ownerName, repoName);
    return;
  }

  const modal = document.getElementById('repoModal');
  if (!modal) return;

  const avatar = document.getElementById('modalAvatar');
  if (avatar && data.githubOwner && data.githubOwner.avatar_url) {
    avatar.src = data.githubOwner.avatar_url;
    avatar.alt = data.name;
  }
  
  const nameEl = document.getElementById('modalName');
  if (nameEl) nameEl.textContent = data.name;

  const ownerEl = document.getElementById('modalOwner');
  if (ownerEl) ownerEl.textContent = `${ownerName}/${repoName}`;

  const descEl = document.getElementById('modalDesc');
  if (descEl) descEl.textContent = data.description || 'No description available.';

  const whyEl = document.getElementById('modalWhy');
  if (whyEl) whyEl.textContent = data.why || 'Critical piece of our infrastructure.';

  const starsEl = document.getElementById('modalStars');
  if (starsEl) starsEl.textContent = formatNum(data.stargazers_count);

  const forksEl = document.getElementById('modalForks');
  if (forksEl) forksEl.textContent = formatNum(data.forks_count);

  const issuesEl = document.getElementById('modalIssues');
  if (issuesEl) issuesEl.textContent = formatNum(data.open_issues_count || 0);

  const linkEl = document.getElementById('modalLink');
  if (linkEl) linkEl.href = data.html_url;

  const issuesLinkEl = document.getElementById('modalIssuesLink');
  if (issuesLinkEl) issuesLinkEl.href = `${data.html_url}/issues`;

  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}

// FIX: Unified closeModal that takes a modal ID
function closeModal(modalId) {
  if (modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.style.display = 'none';
  } else {
    // Close all modals
    document.querySelectorAll('.modal-overlay').forEach(m => m.style.display = 'none');
  }
  document.body.style.overflow = 'auto';
}

// FIX: closeModalOutside now takes the specific modal ID
function closeModalOutside(e, modalId) {
  if (e.target.id === modalId) {
    closeModal(modalId);
  }
}

// Close on Escape key
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') closeModal();
});

// ================================
// RAZORPAY PAYMENT INTEGRATION
// ================================
// ✅ SET YOUR RAZORPAY KEY HERE (get it from https://dashboard.razorpay.com/app/keys)
// Leave as empty string '' to use the built-in demo checkout modal.
const RAZORPAY_KEY = '';

function initiatePayment(planName, amount) {
  if (!localStorage.getItem("loggedInUser")) {
    alert("Please log in or create an account to process investments & payments.");
    window.location.href = "login.html";
    return;
  }

  // If no real key is set, show the demo checkout modal
  if (!RAZORPAY_KEY || RAZORPAY_KEY === 'rzp_test_XXXXXXXXXXXX') {
    openDemoCheckout(planName, amount);
    return;
  }

  // Real Razorpay checkout
  const options = {
    key: RAZORPAY_KEY,
    amount: amount * 100,
    currency: 'INR',
    name: 'Harbour Tech Solutions',
    description: `${planName} Plan — Project Retainer`,
    handler: function (response) {
      const txnId = response.razorpay_payment_id;
      showToast('✅', `Payment successful! ID: ${txnId}`);
      
      savePayment({
        txnId: txnId,
        plan: planName,
        amount: amount,
        customer: localStorage.getItem('loggedInUser') || 'Customer',
        email: '',
        method: 'Razorpay'
      });
    },
    prefill: {
      name: localStorage.getItem('loggedInUser') || '',
      email: '',
      contact: ''
    },
    notes: { plan: planName, source: 'harbour-tech-website' },
    theme: { color: '#6366f1' },
    modal: {
      ondismiss: function () {
        showToast('ℹ️', 'Payment cancelled. No charges applied.');
      }
    }
  };

  try {
    const rzp = new Razorpay(options);
    rzp.on('payment.failed', function (response) {
      showToast('❌', `Payment failed: ${response.error.description}`);
    });
    rzp.open();
  } catch (err) {
    openDemoCheckout(planName, amount);
  }
}

// ================================
// DEMO CHECKOUT MODAL (works without Razorpay key)
// ================================
function openDemoCheckout(planName, amount) {
  // Remove existing demo modal if any
  const existing = document.getElementById('demoCheckoutModal');
  if (existing) existing.remove();

  const formattedAmount = amount.toLocaleString('en-IN');

  const overlay = document.createElement('div');
  overlay.id = 'demoCheckoutModal';
  overlay.className = 'modal-overlay';
  overlay.style.display = 'flex';
  overlay.onclick = function(e) { if (e.target === overlay) closeDemoCheckout(); };

  overlay.innerHTML = `
    <div class="modal-box" style="max-width:480px; max-height:85vh; overflow-y:auto;">
      <div class="modal-top-bar"></div>
      <div style="padding:36px;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:28px;">
          <div style="display:flex; align-items:center; gap:14px;">
            <div style="width:48px; height:48px; background:var(--accent-glow); border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:24px;">💳</div>
            <div>
              <div style="font-size:18px; font-weight:700; color:var(--text); font-family:'DM Sans',sans-serif;">Checkout</div>
              <div style="font-size:12px; color:var(--text-muted);">${planName} Plan</div>
            </div>
          </div>
          <button class="modal-close" onclick="closeDemoCheckout()">✕</button>
        </div>

        <div style="background:var(--bg-alt); border-radius:16px; padding:24px; margin-bottom:24px; border:1px solid var(--card-border);">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <span style="font-size:14px; color:var(--text-muted);">Plan</span>
            <span style="font-size:14px; font-weight:600; color:var(--text);">${planName}</span>
          </div>
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <span style="font-size:14px; color:var(--text-muted);">Retainer Amount</span>
            <span style="font-size:14px; font-weight:600; color:var(--text);">₹${formattedAmount}</span>
          </div>
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <span style="font-size:14px; color:var(--text-muted);">GST (18%)</span>
            <span style="font-size:14px; font-weight:600; color:var(--text);">₹${Math.round(amount * 0.18).toLocaleString('en-IN')}</span>
          </div>
          <div style="border-top:1px solid var(--card-border); padding-top:12px; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-size:15px; font-weight:700; color:var(--text);">Total</span>
            <span style="font-size:20px; font-weight:700; background:var(--accent-gradient); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">₹${Math.round(amount * 1.18).toLocaleString('en-IN')}</span>
          </div>
        </div>

        <div class="form-group" style="margin-bottom:14px;">
          <label>Full Name</label>
          <input type="text" id="demoPayName" placeholder="John Smith" value="${localStorage.getItem('loggedInUser') || ''}">
        </div>
        <div class="form-group" style="margin-bottom:14px;">
          <label>Email Address</label>
          <input type="email" id="demoPayEmail" placeholder="john@company.com">
        </div>
        <div class="form-group" style="margin-bottom:20px;">
          <label>Phone</label>
          <input type="tel" id="demoPayPhone" placeholder="+91 9876543210">
        </div>

        <button class="btn-primary w-full" id="demoPayBtn" onclick="processDemoPayment('${planName}', ${amount})" style="font-size:15px; padding:16px;">
          Pay ₹${Math.round(amount * 1.18).toLocaleString('en-IN')} →
        </button>

        <div style="display:flex; align-items:center; justify-content:center; gap:8px; margin-top:16px; font-size:12px; color:var(--text-light);">
          <span>🔒</span> Secured by Razorpay · 256-bit SSL
        </div>
      </div>
    </div>
  `;

  document.body.appendChild(overlay);
  document.body.style.overflow = 'hidden';
}

function closeDemoCheckout() {
  const modal = document.getElementById('demoCheckoutModal');
  if (modal) modal.remove();
  document.body.style.overflow = 'auto';
}

function processDemoPayment(planName, amount) {
  const name = document.getElementById('demoPayName').value.trim();
  const email = document.getElementById('demoPayEmail').value.trim();
  const phone = document.getElementById('demoPayPhone').value.trim();
  const btn = document.getElementById('demoPayBtn');

  if (!name || !email) {
    showToast('⚠️', 'Please fill in your name and email.');
    return;
  }

  btn.innerHTML = '⏳ Processing...';
  btn.disabled = true;

  // Simulate payment processing
  setTimeout(() => {
    closeDemoCheckout();

    // Show success modal
    const successOverlay = document.createElement('div');
    successOverlay.id = 'paymentSuccessModal';
    successOverlay.className = 'modal-overlay';
    successOverlay.style.display = 'flex';
    successOverlay.onclick = function(e) { if (e.target === successOverlay) { successOverlay.remove(); document.body.style.overflow = 'auto'; } };

    const txnId = 'HT' + Date.now().toString(36).toUpperCase();
    successOverlay.innerHTML = `
      <div class="modal-box" style="max-width:440px; text-align:center;">
        <div class="modal-top-bar" style="background:linear-gradient(90deg, #10b981, #06b6d4);"></div>
        <div style="padding:48px 36px;">
          <div style="width:72px; height:72px; background:rgba(16,185,129,0.12); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; font-size:36px;">✅</div>
          <h3 style="font-size:24px; color:var(--text); margin-bottom:8px; font-family:'DM Sans',sans-serif;">Payment Successful!</h3>
          <p style="font-size:14px; color:var(--text-muted); margin-bottom:24px; line-height:1.6;">Your ${planName} plan retainer has been received.<br>Our team will reach out within 2 hours.</p>
          <div style="background:var(--bg-alt); border-radius:12px; padding:16px; margin-bottom:24px; border:1px solid var(--card-border);">
            <div style="font-size:12px; color:var(--text-light); margin-bottom:4px;">Transaction ID</div>
            <div style="font-size:16px; font-weight:700; color:var(--accent2); font-family:monospace;">${txnId}</div>
          </div>
          <div style="display:flex; gap:12px;">
            <button class="btn-primary" style="flex:1;" onclick="document.getElementById('paymentSuccessModal').remove(); document.body.style.overflow='auto';">Done</button>
            <button class="btn-pricing btn-pricing-outline" style="flex:1;" onclick="document.getElementById('paymentSuccessModal').remove(); document.body.style.overflow='auto'; document.getElementById('contact').scrollIntoView({behavior:'smooth'});">Contact Team</button>
          </div>
        </div>
      </div>
    `;

    // Save to Admin History
    savePayment({
      txnId: txnId,
      plan: planName,
      amount: amount,
      customer: name,
      email: email,
      method: 'Demo Checkout'
    });

    document.body.appendChild(successOverlay);
    showToast('✅', `Payment of ₹${Math.round(amount * 1.18).toLocaleString('en-IN')} confirmed!`);
  }, 2000);
}

// ================================
// AI PROJECT ESTIMATOR
// ================================
let lastEstimateData = null; // Store for CTA buttons

function generateEstimate() {
  if (!localStorage.getItem("loggedInUser")) {
    alert("Please log in to access the AI Estimator Assistant.");
    window.location.href = "login.html";
    return;
  }

  const desc = document.getElementById('estimatorDesc').value.trim();
  const industry = document.getElementById('estimatorIndustry').value;
  const budget = document.getElementById('estimatorBudget').value;
  const features = document.getElementById('estimatorFeatures').value.trim();
  const btn = document.getElementById('estimateBtn');
  const placeholder = document.getElementById('estimatorPlaceholder');
  const output = document.getElementById('estimatorOutput');

  if (!desc) {
    showToast('⚠️', 'Please describe your project first.');
    return;
  }

  // Show loading
  btn.disabled = true;
  btn.innerHTML = '⏳ Analyzing...';
  if (placeholder) placeholder.style.display = 'none';
  output.style.display = 'block';
  output.innerHTML = `
    <div class="estimate-loading">
      <div class="loading-spinner"></div>
      <div style="color: var(--text-muted); font-size: 14px;">AI is analyzing your requirements...</div>
    </div>
  `;

  // Smart estimation engine (rule-based for now — can be replaced with OpenAI API)
  setTimeout(() => {
    const estimateResult = generateSmartEstimate(desc, industry, budget, features);
    lastEstimateData = estimateResult;
    saveEstimateCount(); // Track activity

    output.innerHTML = `
      <div class="estimator-result-header">
        <div class="estimator-result-icon">🧠</div>
        <div class="estimator-result-title">AI Estimate Report</div>
      </div>
      <div class="estimate-output">${estimateResult.report}</div>
      <div class="estimate-cta-section">
        <div class="estimate-cta-divider"></div>
        <div class="estimate-cta-title">Ready to get started?</div>
        <div class="estimate-cta-buttons">
          <button class="btn-primary estimate-cta-btn" onclick="proceedFromEstimate()">
            💳 Proceed to Payment
          </button>
          <button class="btn-ghost estimate-cta-btn" onclick="bookConsultationFromEstimate()">
            📞 Book Free Consultation
          </button>
        </div>
        <div class="estimate-cta-note">Pay a retainer to kick off your project, or book a free call to discuss further.</div>
      </div>
    `;
    btn.disabled = false;
    btn.innerHTML = '⚡ Generate AI Estimate';
  }, 2500);
}

// CTA: Proceed to Payment from AI Estimate
function proceedFromEstimate() {
  if (!lastEstimateData) return;
  const complexity = lastEstimateData.complexity;
  const planMap = { 1: { name: 'Starter', amount: 49999 }, 2: { name: 'Growth', amount: 149999 }, 3: { name: 'Enterprise', amount: 349999 } };
  const plan = planMap[complexity] || planMap[2];
  initiatePayment(plan.name + ' (from AI Estimate)', plan.amount);
}

// CTA: Book consultation — pre-fill contact form with project details
function bookConsultationFromEstimate() {
  if (!lastEstimateData) {
    document.getElementById('contact').scrollIntoView({ behavior: 'smooth' });
    return;
  }
  // Scroll to contact
  document.getElementById('contact').scrollIntoView({ behavior: 'smooth' });

  // Pre-fill the form after a brief delay for scroll
  setTimeout(() => {
    const nameInput = document.querySelector('#contactForm input[name="user_name"]');
    const msgInput = document.querySelector('#contactForm textarea[name="message"]');
    const serviceSelect = document.querySelector('#contactForm select[name="service_type"]');

    if (msgInput) {
      msgInput.value = `[AI Estimate Generated]\n\nProject: ${lastEstimateData.desc}\nComplexity: ${lastEstimateData.complexityLabel}\nEstimated Budget: ${lastEstimateData.costRange}\nTimeline: ${lastEstimateData.timeline}\n\nI'd like to discuss this project further and get a detailed proposal.`;
      msgInput.style.height = 'auto';
      msgInput.style.height = msgInput.scrollHeight + 'px';
    }

    // Try to match service
    if (serviceSelect) {
      const desc = lastEstimateData.desc.toLowerCase();
      if (desc.includes('ai') || desc.includes('ml') || desc.includes('data')) {
        serviceSelect.value = 'AI & Analytics';
      } else if (desc.includes('cloud') || desc.includes('aws') || desc.includes('deploy')) {
        serviceSelect.value = 'Cloud Solutions';
      } else if (desc.includes('security') || desc.includes('pen test')) {
        serviceSelect.value = 'Cybersecurity';
      } else {
        serviceSelect.value = 'Web Development';
      }
    }

    if (nameInput && !nameInput.value) nameInput.focus();
    showToast('✅', 'Contact form pre-filled with your estimate details!');
  }, 800);
}

function generateSmartEstimate(desc, industry, budget, features) {
  const descLower = desc.toLowerCase();
  const featureList = features ? features.split(',').map(f => f.trim()).filter(Boolean) : [];

  // Complexity scoring
  let complexity = 1; // 1=simple, 2=medium, 3=complex
  const complexKeywords = ['ai', 'machine learning', 'real-time', 'blockchain', 'microservices', 'kubernetes', 'payment', 'chat', 'video', 'streaming'];
  const mediumKeywords = ['dashboard', 'admin', 'api', 'authentication', 'database', 'cloud', 'integration', 'analytics'];
  const simpleKeywords = ['landing page', 'portfolio', 'blog', 'static', 'simple', 'basic'];

  complexKeywords.forEach(k => { if (descLower.includes(k)) complexity = 3; });
  mediumKeywords.forEach(k => { if (descLower.includes(k) && complexity < 3) complexity = 2; });
  simpleKeywords.forEach(k => { if (descLower.includes(k) && complexity > 1) complexity = 1; });

  if (featureList.length > 4) complexity = Math.max(complexity, 3);
  else if (featureList.length > 2) complexity = Math.max(complexity, 2);

  const complexityLabels = { 1: 'Low', 2: 'Medium', 3: 'High' };
  const timelineMap = { 1: '2-4 weeks', 2: '6-10 weeks', 3: '12-20 weeks' };
  const teamMap = { 1: '1-2 developers', 2: '3-4 developers', 3: '5-8 developers + PM' };
  const costMap = { 1: '₹30,000 - ₹75,000', 2: '₹1,00,000 - ₹3,00,000', 3: '₹3,50,000 - ₹10,00,000+' };

  // Suggest tech stack
  let techStack = ['HTML/CSS', 'JavaScript'];
  if (complexity >= 2) techStack.push('React.js', 'Node.js', 'PostgreSQL');
  if (complexity >= 3) techStack.push('Docker', 'AWS/GCP', 'Redis');
  if (descLower.includes('ai') || descLower.includes('ml')) techStack.push('Python', 'TensorFlow');
  if (descLower.includes('payment')) techStack.push('Razorpay/Stripe');
  if (descLower.includes('mobile') || descLower.includes('app')) techStack.push('React Native');

  // Build report
  let report = '';
  report += `<strong>📊 Project Complexity:</strong> ${complexityLabels[complexity]}\n\n`;
  report += `<strong>⏱️ Estimated Timeline:</strong> ${timelineMap[complexity]}\n\n`;
  report += `<strong>👥 Recommended Team:</strong> ${teamMap[complexity]}\n\n`;
  report += `<strong>💰 Estimated Investment:</strong> ${costMap[complexity]}\n\n`;
  report += `<strong>🛠️ Recommended Tech Stack:</strong>\n${techStack.map(t => `  • ${t}`).join('\n')}\n\n`;

  if (featureList.length > 0) {
    report += `<strong>✅ Feature Breakdown:</strong>\n`;
    featureList.forEach((f, i) => {
      const days = complexity <= 1 ? '2-3 days' : complexity === 2 ? '4-7 days' : '7-14 days';
      report += `  ${i + 1}. ${f} — ~${days}\n`;
    });
    report += '\n';
  }

  if (industry) {
    report += `<strong>🏢 Industry Insight (${industry}):</strong>\n`;
    const insights = {
      'E-Commerce': '  Payment security (PCI DSS) and inventory management are critical. Consider Razorpay for INR transactions.',
      'Healthcare': '  HIPAA compliance and data encryption must be prioritized. Consider end-to-end encryption.',
      'FinTech': '  Regulatory compliance (RBI guidelines), multi-factor auth, and audit trails are essential.',
      'EdTech': '  Video streaming, quiz engines, and progress tracking are key differentiators.',
      'SaaS': '  Multi-tenancy architecture, usage-based billing, and scalable infrastructure are priorities.',
      'Real Estate': '  Map integration, virtual tours, and lead management CRM features will drive conversions.',
      'Other': '  Our team will conduct a thorough discovery phase to identify industry-specific requirements.'
    };
    report += (insights[industry] || insights['Other']) + '\n\n';
  }

  // Return structured data (not just the string), so CTAs can use it
  return {
    report: report,
    complexity: complexity,
    complexityLabel: complexityLabels[complexity],
    timeline: timelineMap[complexity],
    costRange: costMap[complexity],
    team: teamMap[complexity],
    desc: desc,
    industry: industry
  };
}

// ================================
// DATA PERSISTENCE FOR ADMIN DASHBOARD
// ================================
function saveToAdminData(key, item) {
  let data = JSON.parse(localStorage.getItem(key) || '[]');
  item.id = (key.charAt(0).toUpperCase() + Date.now().toString(36)).toUpperCase();
  item.timestamp = new Date().toLocaleString();
  data.unshift(item); // Newest first
  localStorage.setItem(key, JSON.stringify(data));
}

function saveLead(formData) {
  const lead = {
    name: formData.get('user_name'),
    email: formData.get('user_email'),
    phone: formData.get('user_phone'),
    service: formData.get('service_type'),
    message: formData.get('message'),
    status: 'New'
  };
  saveToAdminData('ht_leads', lead);
}

function savePayment(paymentData) {
  saveToAdminData('ht_payments', paymentData);
}

function saveEstimateCount() {
  let count = parseInt(localStorage.getItem('ht_estimates_count') || '0');
  localStorage.setItem('ht_estimates_count', (count + 1).toString());
}

// ================================
// TOAST NOTIFICATIONS
// ================================
function showToast(icon, message) {
  const existing = document.querySelector('.toast');
  if (existing) existing.remove();

  const toast = document.createElement('div');
  toast.className = 'toast';
  toast.innerHTML = `<span class="toast-icon">${icon}</span><span>${message}</span>`;
  document.body.appendChild(toast);

  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateY(20px)';
    toast.style.transition = 'all 0.4s ease';
    setTimeout(() => toast.remove(), 400);
  }, 4000);
}

// ================================
// 3D PARALLAX — Hero Mouse Tracking
// ================================
function init3DParallax() {
  const heroRight = document.querySelector('.hero-right');
  if (!heroRight) return;

  document.addEventListener('mousemove', function (e) {
    const x = (e.clientX / window.innerWidth - 0.5) * 2;
    const y = (e.clientY / window.innerHeight - 0.5) * 2;

    const badges = heroRight.querySelectorAll('.hero-badge');
    badges.forEach((badge, i) => {
      const depth = (i + 1) * 4;
      badge.style.transform = `translate(${x * depth}px, ${y * depth}px)`;
    });
  });
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

  // Initialize Tech Stack
  fetchRepos();

  // Initialize AOS
  if (typeof AOS !== 'undefined') {
    AOS.init({
      once: true,
      offset: 60,
      duration: 800,
      easing: 'ease-out-cubic'
    });
  }

  // Counter animation — trigger when metrics bar is in view
  const metricsBar = document.querySelector('.metrics-bar');
  if (metricsBar) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounters();
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });
    observer.observe(metricsBar);
  }

  // 3D Parallax
  init3DParallax();

  // Scroll Spy
  initScrollSpy();
});

// ================================
// SCROLL SPY
// ================================
function initScrollSpy() {
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-links a');

  window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;
      if (window.scrollY >= (sectionTop - 150)) {
        current = section.getAttribute('id');
      }
    });

    navLinks.forEach(link => {
      link.classList.remove('active');
      const href = link.getAttribute('href');
      // Fix for home / index.html
      if (href === 'index.html' && (current === '' || current === 'home')) {
        link.classList.add('active');
      } else if (href === '#' + current) {
        link.classList.add('active');
      }
    });
  });
}

// ================================
// JQUERY FEATURES
// ================================
$(document).ready(function () {

  // Hero button magnetic effect
  $(".hero .btn-primary").on('mouseenter', function (e) {
    $(this).css({
      'box-shadow': '0 12px 40px rgba(99, 102, 241, 0.4)',
    });
  }).on('mouseleave', function () {
    $(this).css({
      'box-shadow': '',
    });
  });

  // Service card 3D hover
  $(".service-card").hover(
    function () {
      $(this).css("z-index", "2");
    },
    function () {
      $(this).css("z-index", "");
    }
  );

  // Input focus glow
  $("input, textarea, select").focus(function () {
    $(this).parent().addClass('input-focused');
  });

  $("input, textarea, select").blur(function () {
    $(this).parent().removeClass('input-focused');
  });

  // Form submit animation & EmailJS
  $("#contactForm").submit(function (e) {
    const isPhp = $(this).find('input[name="contact_php"]').length > 0;
    
    const btn = $("#submitBtn");
    const originalText = btn.html();
    
    const formData = new FormData(this);
    saveLead(formData); // Persistent Save for Admin

    if (isPhp) {
      // Let the browser perform the standard POST request for PHP processing
      btn.html("Processing Server Side... &#8987;");
      btn.prop("disabled", true);
      return true; 
    }

    // Standard EmailJS path if not PHP-integrated
    e.preventDefault();
    btn.html("Sending... &#8987;");
    btn.prop("disabled", true);
    $("#contactSuccess, #contactError").hide();

    emailjs.sendForm('service_pcqzlcb', 'template_8tyn0yi', this)
      .then(function () {
        btn.html("Message Sent! &#10003;");
        $("#contactSuccess").fadeIn(800);
        $("#contactForm")[0].reset();
        setTimeout(() => {
          btn.html(originalText);
          btn.prop("disabled", false);
        }, 3000);
      }, function (error) {
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
          scrollTop: target.offset().top - 70
        }, 700, 'swing');
      }
    }
  });

});