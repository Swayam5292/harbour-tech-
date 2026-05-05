/* Harbour Tech Login Logic */

function switchTab(tabId) {
    // Remove active classes
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.remove('active'));
    
    // Add active classes
    const activeBtn = Array.from(document.querySelectorAll('.tab-btn')).find(b => b.getAttribute('onclick').includes(tabId));
    if (activeBtn) activeBtn.classList.add('active');
    
    const activePanel = document.getElementById(tabId + 'Panel');
    if (activePanel) activePanel.classList.add('active');
}

function togglePw(inputId, btn) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
    } else {
        input.type = 'password';
        btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
    }
}

// Check for errors in URL
window.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    if (params.has('error')) {
        switchTab('admin');
        const adminPanel = document.getElementById('adminPanel');
        if (adminPanel) {
            const errorMsg = document.createElement('div');
            errorMsg.style.color = '#ef4444';
            errorMsg.style.fontSize = '13px';
            errorMsg.style.marginBottom = '16px';
            errorMsg.style.textAlign = 'center';
            errorMsg.innerText = 'Invalid password. Please try again.';
            adminPanel.prepend(errorMsg);
        }
    }
});

// Particles init
if (typeof initParticles === 'function') {
    initParticles(document.getElementById('particleCanvas'));
}

// Mobile Menu
function toggleMobileMenu() {
    const m = document.getElementById('mobileMenu');
    const h = document.getElementById('hamburger');
    m.style.display = (m.style.display === 'flex') ? 'none' : 'flex';
    h.classList.toggle('open');
}
function closeMobileMenu() {
    const m = document.getElementById('mobileMenu');
    const h = document.getElementById('hamburger');
    if (m) m.style.display = 'none';
    if (h) h.classList.remove('open');
}

let darkMode = false;
function toggleTheme() {
    darkMode = !darkMode;
    document.body.classList.toggle("dark-mode", darkMode);
    const sunIcon = document.querySelector('.sun-icon');
    const moonIcon = document.querySelector('.moon-icon');
    if (sunIcon && moonIcon) {
        sunIcon.style.display = darkMode ? 'block' : 'none';
        moonIcon.style.display = darkMode ? 'none' : 'block';
    }
    localStorage.setItem("darkMode", darkMode);
}

function updateNavbar() {
    const user = localStorage.getItem("loggedInUser");
    const isAdmin = localStorage.getItem("ht_admin_session");
    const userDisplay = document.getElementById("userDisplay");
    const loginLink = document.getElementById("loginLink");
    if (user) {
        if (userDisplay) {
            const initials = user.substring(0, 1).toUpperCase();
            userDisplay.innerHTML = `<div class="profile-avatar" style="width:28px; height:28px; background:var(--accent); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:12px; font-weight:700;">${initials}</div>`;
        }
        if (loginLink) loginLink.style.display = "none";
    }
}

window.addEventListener('load', () => {
    updateNavbar();
    if (localStorage.getItem("darkMode") === "true") {
        darkMode = false;
        toggleTheme();
    }
});
