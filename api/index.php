<?php include 'process.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Harbour Tech Solutions — Build Smarter. Scale Faster.</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Harbour Tech Solutions delivers custom software, cloud infrastructure, and AI-powered analytics — engineered for businesses that refuse to stand still.">
  <meta name="keywords" content="software development, cloud solutions, AI analytics, cybersecurity, technology consulting India">
  <meta property="og:title" content="Harbour Tech Solutions — Build Smarter. Scale Faster.">
  <meta property="og:description" content="Custom software, cloud infrastructure, and AI-powered analytics for modern businesses.">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="index.css?v=3" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js"></script>
  <!-- Razorpay Checkout SDK -->
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

<!-- LIVE PARTICLE CANVAS (GLOBAL) -->
<canvas id="particleCanvas"></canvas>

<!-- SCROLL PROGRESS BAR -->
<div id="scrollProgress"></div>

<!-- CURSOR GLOW -->
<div id="cursorGlow"></div>

<!-- NAVBAR -->
<nav class="main-nav" id="main-nav">
  <a class="nav-brand" href="index.php" style="display:flex;align-items:center;gap:12px;text-decoration:none;">
    <svg width="34" height="40" viewBox="0 0 36 42" xmlns="http://www.w3.org/2000/svg" style="flex-shrink:0">
      <defs>
        <linearGradient id="navGrad" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" style="stop-color:#4f46e5"/>
          <stop offset="100%" style="stop-color:#06b6d4"/>
        </linearGradient>
      </defs>
      <path d="M2 8 L18 1 L34 8 L34 28 Q34 38 18 42 Q2 38 2 28 Z" fill="url(#navGrad)"/>
      <path d="M2 8 L18 1 L34 8 L34 28 Q34 38 18 42 Q2 38 2 28 Z" fill="none" stroke="rgba(255,255,255,0.20)" stroke-width="1.2"/>
      <path d="M8 13 L18 7 L28 13 L28 27 Q28 35 18 38 Q8 35 8 27 Z" fill="none" stroke="rgba(255,255,255,0.40)" stroke-width="1.4"/>
      <text x="18" y="27" text-anchor="middle" font-family="DM Sans,sans-serif" font-weight="800" fill="#ffffff" font-size="13" letter-spacing="1">HT</text>
    </svg>
    <span class="brand-name">Harbour Tech</span>
  </a>
  <div class="nav-links">
    <a href="index.php" class="active">Home</a>
    <a href="#services">Services</a>
    <a href="#process">Process</a>
    <a href="#pricing">Pricing</a>
    <a href="#testimonials">Reviews</a>
    <a href="#contact">Contact</a>
    <a href="login.html" id="loginLink" class="btn-nav-outline">Log In</a>
  </div>
  <div class="nav-actions">
    <span id="userDisplay"></span>
    <button id="logoutBtn" onclick="logout()" style="display:none;" class="btn-nav-outline">Logout</button>
    <button id="theme-btn" onclick="toggleTheme()" aria-label="Toggle theme">
      <span class="theme-icon">&#9790;</span>
    </button>
    <!-- Mobile Hamburger -->
    <button class="hamburger" id="hamburger" aria-label="Open menu" onclick="toggleMobileMenu()">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- MOBILE MENU -->
<nav class="mobile-menu" id="mobileMenu">
  <a href="index.php" onclick="closeMobileMenu()">🏠 Home</a>
  <a href="#services" onclick="closeMobileMenu()">⚙️ Services</a>
  <a href="#process" onclick="closeMobileMenu()">🗺️ Process</a>
  <a href="#pricing" onclick="closeMobileMenu()">💰 Pricing</a>
  <a href="#testimonials" onclick="closeMobileMenu()">⭐ Reviews</a>
  <a href="#estimator" onclick="closeMobileMenu()">🤖 Estimator</a>
  <a href="#contact" onclick="closeMobileMenu()">📩 Contact</a>
  <div class="mobile-menu-cta">
    <a href="login.html" class="btn-nav-outline" style="display:block; text-align:center;">Log In →</a>
  </div>
</nav>

<!-- FLOATING SOCIAL BAR -->
<div id="floatingSocial">
  <a href="https://github.com/Swayam5292" target="_blank" class="social-pill github-pill" title="GitHub">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
  </a>
  <a href="https://linkedin.com" target="_blank" class="social-pill linkedin-pill" title="LinkedIn">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="#0A66C2" stroke="none"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
  </a>
  <a href="mailto:support@harbourtech.com" class="social-pill email-pill" title="Email">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EA4335" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
  </a>
</div>

<!-- HERO SECTION WRAPPER -->
<div class="hero-global-wrapper">

<!-- HERO — 3D Split Layout -->
<section class="hero perspective-container">

  <!-- LEFT -->
  <div class="hero-left" data-aos="fade-right" data-aos-duration="1000">
    <div class="hero-tag">&#10024; Technology Consulting</div>
    <h1 class="hero-heading">
      Build Smarter.<br>
      <span class="hero-accent">Scale Faster.</span>
    </h1>
    <p class="hero-sub">Harbour Tech Solutions delivers custom software, cloud infrastructure, and AI-powered analytics — engineered for businesses that refuse to stand still.</p>
    <div class="hero-btns">
      <a href="#contact" class="btn-primary" id="hero-cta">Start a Project &#8594;</a>
      <a href="#projects" class="btn-ghost">View Our Work &#8594;</a>
    </div>
    <div class="hero-social-proof">
      <div class="avatar-stack">
        <div class="avatar" style="background:linear-gradient(135deg,#6366f1,#4f46e5)">A</div>
        <div class="avatar" style="background:linear-gradient(135deg,#818cf8,#6366f1)">B</div>
        <div class="avatar" style="background:linear-gradient(135deg,#06b6d4,#0891b2)">C</div>
        <div class="avatar" style="background:linear-gradient(135deg,#10b981,#059669)">D</div>
      </div>
      <span>Trusted by <strong>50+</strong> businesses worldwide</span>
    </div>
  </div>

  <!-- RIGHT — 3D Command Center -->
  <div class="hero-right preserve-3d" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">

    <!-- Floating badges -->
    <div class="hero-badge hero-badge--tl">
      <div class="badge-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m13 2-2 10h8l-10 10 2-10H3l10-10z"></path></svg>
      </div>
      <div><div class="badge-num">120+</div><div class="badge-label">Projects Done</div></div>
    </div>
    <div class="hero-badge hero-badge--br">
      <div class="badge-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
      </div>
      <div><div class="badge-num">98%</div><div class="badge-label">Satisfaction</div></div>
    </div>
    <div class="hero-badge hero-badge--bl">
      <div class="badge-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
      </div>
      <div><div class="badge-num">50+</div><div class="badge-label">Clients</div></div>
    </div>

    <!-- Code card — 3D tilt -->
    <div class="hero-code-card" id="heroCodeCard" data-tilt data-tilt-max="12" data-tilt-speed="400" data-tilt-glare="true" data-tilt-max-glare="0.3" data-tilt-perspective="1000">
      <div class="code-card-header">
        <div class="code-dots">
          <span style="background:#ff5f57"></span>
          <span style="background:#febc2e"></span>
          <span style="background:#28c840"></span>
        </div>
        <span class="code-filename">harbourtech.js</span>
      </div>
      <div class="code-body">
        <div class="code-line"><span class="ck">const</span> <span class="cv">client</span> = {</div>
        <div class="code-line">&nbsp;&nbsp;<span class="cp">goal</span>: <span class="cs">"Scale business"</span>,</div>
        <div class="code-line">&nbsp;&nbsp;<span class="cp">stack</span>: <span class="cs">"Modern Tech"</span>,</div>
        <div class="code-line">&nbsp;&nbsp;<span class="cp">budget</span>: <span class="cs">"On track"</span>,</div>
        <div class="code-line">};</div>
        <div class="code-line">&nbsp;</div>
        <div class="code-line"><span class="ck">await</span> <span class="cf">harbourTech</span></div>
        <div class="code-line">&nbsp;&nbsp;.<span class="cf">build</span>(client);</div>
        <div class="code-line">&nbsp;</div>
        <div class="code-line"><span class="cc">// &#10003; Result: Delivered</span></div>
      </div>
    </div>

  </div>
</section>

<!-- METRICS BAR -->
<div class="metrics-bar" data-aos="fade-up" data-aos-duration="800">
  <div class="metric-item">
    <div class="metric-num" data-count="8">0+</div>
    <div class="metric-label">Years Experience</div>
  </div>
  <div class="metric-divider"></div>
  <div class="metric-item">
    <div class="metric-num" data-count="120">0+</div>
    <div class="metric-label">Projects Completed</div>
  </div>
  <div class="metric-divider"></div>
  <div class="metric-item">
    <div class="metric-num" data-count="50">0+</div>
    <div class="metric-label">Happy Clients</div>
  </div>
  <div class="metric-divider"></div>
  <div class="metric-item">
    <div class="metric-num" data-count="15">0+</div>
    <div class="metric-label">Team Members</div>
  </div>
</div>
</div><!-- /hero-dark-section -->

<!-- ABOUT -->
<section class="section" id="about">
  <div class="page-wrapper" data-aos="fade-up" data-aos-duration="800">
    <div class="about-grid">
      <div class="about-left">
        <div class="section-label">Who We Are</div>
        <h2 class="section-heading">Built for businesses<br>that mean business.</h2>
      </div>
      <div class="about-right">
        <p>Harbour Tech Solutions is a technology consulting firm that partners with businesses to design, build, and scale digital products. We bring together engineering excellence and strategic thinking to deliver solutions that actually move the needle.</p>
        <p>From startups to enterprises, we've helped organizations replace outdated systems, migrate to the cloud, and harness the power of AI — all while keeping things practical, on-budget, and on-time.</p>
        <div class="about-tags">
          <span>ISO Certified</span>
          <span>AWS Partner</span>
          <span>24/7 Support</span>
          <span>Agile Process</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- HOW WE WORK — Process Section -->
<section class="section section--alt" id="process">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">Our Approach</div>
      <h2 class="section-heading">How we work,<br><span class="hero-accent">step by step.</span></h2>
      <p style="color: var(--text-muted); font-size: 15px; margin-top: 16px; max-width: 480px; margin-left: auto; margin-right: auto; line-height: 1.7;">A proven 4-phase process that takes your idea from concept to a live, revenue-generating product.</p>
    </div>
    <div class="process-grid">
      <div class="process-step" data-aos="fade-up" data-aos-delay="100">
        <div class="process-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
        </div>
        <div class="process-num">01</div>
        <div class="process-title">Discovery</div>
        <p class="process-desc">We deep-dive into your goals, users, and market. We map out the full scope, risks, and opportunities before a single line of code is written.</p>
      </div>
      <div class="process-step" data-aos="fade-up" data-aos-delay="200">
        <div class="process-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path><path d="M2 2l7.5 1.5"></path><path d="M7.5 9.5L11 13"></path><path d="m5 1l4.5 4.5"></path><path d="m4.5 5.5-4-4"></path></svg>
        </div>
        <div class="process-num">02</div>
        <div class="process-title">Design & Blueprint</div>
        <p class="process-desc">Our architects craft system designs, wireframes, and tech stack decisions — all reviewed with you before development begins.</p>
      </div>
      <div class="process-step" data-aos="fade-up" data-aos-delay="300">
        <div class="process-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
        </div>
        <div class="process-num">03</div>
        <div class="process-title">Build & Iterate</div>
        <p class="process-desc">Agile 2-week sprints. You see real progress every fortnight. Automated testing and CI/CD pipelines ensure zero-compromise quality.</p>
      </div>
      <div class="process-step" data-aos="fade-up" data-aos-delay="400">
        <div class="process-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4 4 4"></path><path d="M16 10v11"></path><path d="M22 15V9a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v6"></path><path d="M2 15h20"></path><path d="M15 15h2"></path><path d="M7 15h2"></path></svg>
        </div>
        <div class="process-num">04</div>
        <div class="process-title">Launch & Scale</div>
        <p class="process-desc">We deploy, monitor, and optimize. Post-launch support ensures your product grows seamlessly as your user base expands.</p>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES (Dynamic) -->
<section class="section section--alt" id="services">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">What We Do</div>
      <h2 class="section-heading">Services built around<br>your goals.</h2>
      <div style="margin-top:20px;">
          <a href="?sort_services=asc#services" class="btn-nav-outline <?php echo $sort_order==='asc'?'active':''; ?>">A-Z</a>
          <a href="?sort_services=desc#services" class="btn-nav-outline <?php echo $sort_order==='desc'?'active':''; ?>">Z-A</a>
          <a href="?sort_services=default#services" class="btn-nav-outline <?php echo $sort_order==='default'?'active':''; ?>">Reset</a>
      </div>
    </div>
    <div class="services-grid">
      <?php foreach ($services as $index => $s): ?>
      <div class="service-card" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>" data-tilt data-tilt-max="5" data-tilt-speed="400" data-tilt-glare="true" data-tilt-max-glare="0.15">
        <div class="service-num"><?php echo $s['num']; ?></div>
        <div class="service-icon-wrap"><?php echo $s['icon']; ?></div>
        <h3><?php echo $s['title']; ?></h3>
        <p><?php echo $s['desc']; ?></p>
        <div class="service-tags"><?php foreach ($s['tags'] as $t): ?><span><?php echo $t; ?></span><?php endforeach; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- EXPERTISE — Animated Skill Bars -->
<section class="section" id="expertise">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">Expertise</div>
      <h2 class="section-heading">Deep skills across<br><span class="hero-accent">every layer.</span></h2>
    </div>
    <div class="skills-grid" id="skillsGrid" data-aos="fade-up" data-aos-delay="100">
      <div class="skill-item">
        <div class="skill-header"><span class="skill-name">Frontend Development</span><span class="skill-pct">95%</span></div>
        <div class="skill-track"><div class="skill-fill" data-pct="95"></div></div>
      </div>
      <div class="skill-item">
        <div class="skill-header"><span class="skill-name">Cloud & DevOps (AWS / GCP)</span><span class="skill-pct">90%</span></div>
        <div class="skill-track"><div class="skill-fill" data-pct="90"></div></div>
      </div>
      <div class="skill-item">
        <div class="skill-header"><span class="skill-name">Backend & API Engineering</span><span class="skill-pct">92%</span></div>
        <div class="skill-track"><div class="skill-fill" data-pct="92"></div></div>
      </div>
      <div class="skill-item">
        <div class="skill-header"><span class="skill-name">AI & Machine Learning</span><span class="skill-pct">82%</span></div>
        <div class="skill-track"><div class="skill-fill" data-pct="82"></div></div>
      </div>
      <div class="skill-item">
        <div class="skill-header"><span class="skill-name">Mobile Development</span><span class="skill-pct">80%</span></div>
        <div class="skill-track"><div class="skill-fill" data-pct="80"></div></div>
      </div>
      <div class="skill-item">
        <div class="skill-header"><span class="skill-name">Cybersecurity & Compliance</span><span class="skill-pct">88%</span></div>
        <div class="skill-track"><div class="skill-fill" data-pct="88"></div></div>
      </div>
    </div>
  </div>
</section>

<!-- PRICING — Razorpay Integration -->
<section class="section" id="pricing">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">Investment</div>
      <h2 class="section-heading">Transparent pricing.<br><span class="hero-accent">No surprises.</span></h2>
      <form method="GET" action="#pricing" style="margin-top:24px; display:flex; gap:10px; max-width:400px;">
          <input type="text" name="search_feature" placeholder="Search for a feature..." value="<?php echo htmlspecialchars($search_feature); ?>" style="flex:1; background:var(--input-bg); border:1px solid var(--input-border); color:white; padding:10px; border-radius:10px; outline:none;">
          <button type="submit" class="btn-primary">Search</button>
      </form>
    </div>
    <div class="pricing-grid">
      <?php foreach ($pricing_plans as $p): ?>
      <div class="pricing-card <?php echo $p['featured']?'featured':''; ?>" data-aos="fade-up" data-tilt data-tilt-max="5" data-tilt-speed="400">
        <?php if ($p['featured']): ?><div class="pricing-badge">Most Popular</div><?php endif; ?>
        <div class="pricing-tier"><?php echo $p['tier']; ?></div>
        <div class="pricing-desc"><?php echo $p['desc']; ?></div>
        <div class="pricing-amount"><?php echo $p['amount']; ?></div>
        <ul class="pricing-features"><?php foreach ($p['features'] as $f): ?><li><span class="check">✓</span> <?php echo $f; ?></li><?php endforeach; ?></ul>
        <button class="<?php echo $p['btn_class']; ?>" onclick="<?php echo $p['btn_action']; ?>">Get Started &#8594;</button>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- TESTIMONIALS (Dynamic) -->
<section class="section" id="testimonials">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">Client Reviews</div>
      <h2 class="section-heading">Trusted by teams<br><span class="hero-accent">that mean business.</span></h2>
    </div>
    <div class="testimonials-track" data-aos="fade-up" data-aos-delay="100">
      <div class="testimonials-inner" id="testimonialsInner">
        <?php foreach ($reviews as $r): ?>
        <div class="testimonial-card">
          <div class="testimonial-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
          <p class="testimonial-text">"<?php echo $r['text']; ?>"</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar" style="background: <?php echo $r['grad']; ?>;"><?php echo $r['avatar']; ?></div>
            <div style="flex:1;">
              <div class="testimonial-name"><?php echo $r['name']; ?> <span class="verified-badge">Verified</span></div>
              <div class="testimonial-role"><?php echo $r['role']; ?></div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="testimonials-controls">
      <button class="testimonials-btn" id="tPrev" onclick="moveTestimonials(-1)">←</button>
      <div class="testimonials-dots" id="testimonialsDots"></div>
      <button class="testimonials-btn" id="tNext" onclick="moveTestimonials(1)">→</button>
    </div>
  </div>
</section>

<!-- LARAVEL SHOWCASE -->
<section class="section section--alt" id="live-portfolio" style="background-color: var(--bg-card);">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">Live Portfolio</div>
      <h2 class="section-heading">Featured <span class="hero-accent">Client Projects.</span></h2>
    </div>
    <div class="projects-grid" id="laravelProjectsContainer" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; margin-top: 40px;"></div>
  </div>
</section>

<!-- PROJECTS — GitHub -->
<section class="section" id="projects">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">Technical Mastery</div>
      <h2 class="section-heading">Built with the best.<br><span class="hero-accent">Live from GitHub.</span></h2>
    </div>
    <div class="profile-dashboard glass-panel" id="githubProfile" data-aos="fade-up"></div>
    <div class="projects-table-wrap" data-aos="fade-up">
      <table class="pro-table" id="repoTable">
        <thead>
          <tr><th>Technology</th><th>Type</th><th class="hide-mobile">Stardom</th><th>Description</th><th>Action</th></tr>
        </thead>
        <tbody id="repoBody"></tbody>
      </table>
    </div>
  </div>
</section>

<!-- AI PROJECT ESTIMATOR -->
<section class="section" id="estimator">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">AI Tool</div>
      <h2 class="section-heading">Instant project<br><span class="hero-accent">estimates.</span></h2>
    </div>
    <div class="estimator-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
      <div class="estimator-form" data-aos="fade-right">
        <div class="form-group"><label>Project Brief</label><textarea id="estimatorDesc" placeholder="Describe your product..."></textarea></div>
        <div class="form-row-2">
          <div class="form-group"><label>Industry</label><select id="estimatorIndustry"><option>E-Commerce</option><option>Healthcare</option><option>FinTech</option></select></div>
          <div class="form-group"><label>Budget Range</label><select id="estimatorBudget"><option>₹25K - ₹50K</option><option>₹50K - ₹1.5L</option></select></div>
        </div>
        <button class="btn-primary w-full" id="estimateBtn" onclick="generateEstimate()">Generate AI Estimate</button>
      </div>
      <div class="estimator-result" id="estimatorResult" data-aos="fade-left">
         <div id="estimatorPlaceholder">Your estimate will appear here...</div>
         <div id="estimatorOutput" style="display:none;"></div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ SECTION (RESTORED FULL) -->
<section class="section section--alt" id="faq">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up"><div class="section-label">FAQ</div><h2 class="section-heading">Frequently asked<br><span class="hero-accent">questions.</span></h2></div>
    <div class="faq-list" data-aos="fade-up">
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)"><span class="faq-q-text">How long does a typical project take?</span><span class="faq-chevron">▼</span></div>
        <div class="faq-answer"><div class="faq-answer-inner">Timelines vary by complexity. Simple websites take 2-4 weeks. Full-stack applications typically take 6-12 weeks.</div></div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)"><span class="faq-q-text">Do you offer support after delivery?</span><span class="faq-chevron">▼</span></div>
        <div class="faq-answer"><div class="faq-answer-inner">Yes. All plans include a post-launch support window — 1 week for Starter, 30 days for Growth.</div></div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)"><span class="faq-q-text">Can I see progress during development?</span><span class="faq-chevron">▼</span></div>
        <div class="faq-answer"><div class="faq-answer-inner">Absolutely. We work in 2-week Agile sprints and schedule a demo call at the end of each sprint.</div></div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)"><span class="faq-q-text">What technologies do you specialize in?</span><span class="faq-chevron">▼</span></div>
        <div class="faq-answer"><div class="faq-answer-inner">React, Next.js, Node.js, Python, TypeScript, PostgreSQL, MongoDB, Docker, Kubernetes, AWS, GCP, and Azure.</div></div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)"><span class="faq-q-text">Is the Starter plan suitable for a startup MVP?</span><span class="faq-chevron">▼</span></div>
        <div class="faq-answer"><div class="faq-answer-inner">Yes — the Starter plan is specifically designed for MVPs and validation-stage products.</div></div>
      </div>
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFaq(this)"><span class="faq-q-text">Do you sign NDAs?</span><span class="faq-chevron">▼</span></div>
        <div class="faq-answer"><div class="faq-answer-inner">Yes, always. We sign a mutual NDA before any discovery call.</div></div>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section class="section section--alt" id="contact">
  <div class="page-wrapper" data-aos="fade-up">
    <div class="contact-grid">
      <div class="contact-info">
        <div class="section-label">Get In Touch</div><h2 class="section-heading">Let's build<br>something great.</h2>
        <div class="contact-details">
          <div class="contact-row"><span>support@harbourtech.com</span></div>
          <div class="contact-row"><span>+91 9876543210</span></div>
        </div>
      </div>
      <div class="contact-form-wrap">
        <?php if ($contact_processed): ?>
        <div style="margin-bottom:20px; padding:15px; border-radius:10px; background:var(--card-bg); border:1px solid var(--card-border);">
          <div style="color:var(--accent2); font-weight:700;">PHP Validation:</div>
          Name: <?php echo htmlspecialchars($formatted_name); ?> | Domain: <?php echo htmlspecialchars($email_domain); ?>
        </div>
        <?php endif; ?>
        <form method="POST" action="index.php#contact" id="contactForm">
          <input type="hidden" name="contact_php" value="1">
          <div class="form-row-2">
            <div class="form-group"><label>Full Name</label><input type="text" name="user_name" required value="<?php echo htmlspecialchars($post_name); ?>"></div>
            <div class="form-group"><label>Email</label><input type="email" name="user_email" required value="<?php echo htmlspecialchars($post_email); ?>"></div>
          </div>
          <button type="submit" class="btn-primary w-full">Send Message &#8594;</button>
        </form>
      </div>
    </div>
  </div>
</section>

<footer class="site-footer"><div class="page-wrapper" style="text-align:center;">&#169; 2026 Harbour Tech Solutions</div></footer>

<!-- PROJECT MODAL -->
<div class="modal-overlay" id="projectModal" onclick="closeModalOutside(event, 'projectModal')">
  <div class="modal-box">
    <div class="modal-top-bar"></div>
    <div class="modal-header"><div class="modal-title" id="mTitle"></div><button class="modal-close" onclick="closeModal('projectModal')">&#x2715;</button></div>
    <div class="modal-body"><p id="mDesc"></p></div>
  </div>
</div>

<button id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" style="position:fixed; bottom:30px; right:30px; z-index:100; background:var(--accent); color:white; border:none; width:50px; height:50px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:20px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">↑</button>

<div id="chatWidget" style="position:fixed; bottom:30px; left:30px; z-index:100;">
  <button id="chatToggle" onclick="toggleChat()" style="background:var(--accent2); color:white; border:none; width:60px; height:60px; border-radius:50%; font-size:24px; cursor:pointer; box-shadow: 0 10px 30px rgba(0,0,0,0.3); display:flex; align-items:center; justify-content:center;">💬</button>
</div>

<script src="index.js?v=4"></script>
<script src="particles.js?v=2"></script>
</body>
</html>
