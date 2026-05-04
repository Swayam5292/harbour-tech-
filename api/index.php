<?php include 'process.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Harbour Tech Solutions — Build Smarter. Scale Faster.</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Harbour Tech Solutions delivers custom software, cloud infrastructure, and AI-powered analytics — engineered for businesses that refuse to stand still.">
  <meta name="keywords"
    content="software development, cloud solutions, AI analytics, cybersecurity, technology consulting India">
  <meta property="og:title" content="Harbour Tech Solutions — Build Smarter. Scale Faster.">
  <meta property="og:description"
    content="Custom software, cloud infrastructure, and AI-powered analytics for modern businesses.">
  <link
    href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
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
            <stop offset="0%" style="stop-color:#4f46e5" />
            <stop offset="100%" style="stop-color:#06b6d4" />
          </linearGradient>
        </defs>
        <path d="M2 8 L18 1 L34 8 L34 28 Q34 38 18 42 Q2 38 2 28 Z" fill="url(#navGrad)" />
        <path d="M2 8 L18 1 L34 8 L34 28 Q34 38 18 42 Q2 38 2 28 Z" fill="none" stroke="rgba(255,255,255,0.20)"
          stroke-width="1.2" />
        <path d="M8 13 L18 7 L28 13 L28 27 Q28 35 18 38 Q8 35 8 27 Z" fill="none" stroke="rgba(255,255,255,0.40)"
          stroke-width="1.4" />
        <text x="18" y="27" text-anchor="middle" font-family="DM Sans,sans-serif" font-weight="800" fill="#ffffff"
          font-size="13" letter-spacing="1">HT</text>
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
  </div>

  <div class="hero-global-wrapper">
    <!-- HERO SECTION -->
    <section class="hero perspective-container">
      <div class="hero-left" data-aos="fade-right" data-aos-duration="1000">
        <div class="hero-tag">&#10024; Technology Consulting</div>
        <h1 class="hero-heading">Build Smarter.<br><span class="hero-accent">Scale Faster.</span></h1>
        <p class="hero-sub">Harbour Tech Solutions delivers custom software, cloud infrastructure, and AI-powered analytics.</p>
        <div class="hero-btns">
          <a href="#contact" class="btn-primary" id="hero-cta">Start a Project &#8594;</a>
          <a href="#projects" class="btn-ghost">View Our Work &#8594;</a>
        </div>
      </div>
      <div class="hero-right preserve-3d" data-aos="fade-left" data-aos-duration="1000">
        <div class="hero-code-card" data-tilt data-tilt-max="12">
          <div class="code-card-header">
            <div class="code-dots"><span style="background:#ff5f57"></span><span style="background:#febc2e"></span><span style="background:#28c840"></span></div>
            <span class="code-filename">harbourtech.php</span>
          </div>
          <div class="code-body">
            <div class="code-line"><span class="ck">&lt;?php</span></div>
            <div class="code-line">&nbsp;&nbsp;<span class="ck">echo</span> <span class="cs">"Scaling Business..."</span>;</div>
            <div class="code-line"><span class="ck">?&gt;</span></div>
          </div>
        </div>
      </div>
    </section>

    <!-- METRICS -->
    <div class="metrics-bar" data-aos="fade-up">
      <div class="metric-item"><div class="metric-num" data-count="8">0+</div><div class="metric-label">Years Experience</div></div>
      <div class="metric-divider"></div>
      <div class="metric-item"><div class="metric-num" data-count="120">0+</div><div class="metric-label">Projects Completed</div></div>
      <div class="metric-divider"></div>
      <div class="metric-item"><div class="metric-num" data-count="50">0+</div><div class="metric-label">Happy Clients</div></div>
    </div>
  </div>

  <!-- ABOUT -->
  <section class="section" id="about">
    <div class="page-wrapper" data-aos="fade-up">
      <div class="about-grid">
        <div class="about-left">
          <div class="section-label">Who We Are</div>
          <h2 class="section-heading">Built for businesses<br>that mean business.</h2>
        </div>
        <div class="about-right">
          <p>Harbour Tech Solutions is a technology consulting firm that partners with businesses to design, build, and scale digital products.</p>
          <div class="about-tags"><span>ISO Certified</span><span>AWS Partner</span><span>24/7 Support</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- PROCESS -->
  <section class="section section--alt" id="process">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up"><div class="section-label">Our Approach</div><h2 class="section-heading">How we work,<br><span class="hero-accent">step by step.</span></h2></div>
      <div class="process-grid">
        <div class="process-step" data-aos="fade-up"><div class="process-num">01</div><div class="process-title">Discovery</div><p class="process-desc">We deep-dive into your goals and market scope.</p></div>
        <div class="process-step" data-aos="fade-up"><div class="process-num">02</div><div class="process-title">Design</div><p class="process-desc">Crafting system designs and wireframes.</p></div>
        <div class="process-step" data-aos="fade-up"><div class="process-num">03</div><div class="process-title">Build</div><p class="process-desc">Agile 2-week sprints with automated testing.</p></div>
        <div class="process-step" data-aos="fade-up"><div class="process-num">04</div><div class="process-title">Launch</div><p class="process-desc">Deployment and monitoring for seamless growth.</p></div>
      </div>
    </div>
  </section>

  <!-- SERVICES (Dynamic) -->
  <section class="section" id="services">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up">
        <div class="section-label">What We Do</div>
        <h2 class="section-heading">Services built around<br>your goals.</h2>
        <div style="margin-top:20px;">
            <a href="?sort_services=asc#services" class="btn-nav-outline <?php echo $sort_order==='asc'?'active':''; ?>">A-Z</a>
            <a href="?sort_services=desc#services" class="btn-nav-outline <?php echo $sort_order==='desc'?'active':''; ?>">Z-A</a>
        </div>
      </div>
      <div class="services-grid">
        <?php foreach ($services as $s): ?>
        <div class="service-card" data-aos="fade-up">
          <div class="service-num"><?php echo $s['num']; ?></div>
          <div class="service-icon-wrap" style="font-size:32px;"><?php echo $s['icon']; ?></div>
          <h3><?php echo $s['title']; ?></h3>
          <p><?php echo $s['desc']; ?></p>
          <div class="service-tags"><?php foreach ($s['tags'] as $t): ?><span><?php echo $t; ?></span><?php endforeach; ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- PRICING (Dynamic) -->
  <section class="section section--alt" id="pricing">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up">
        <div class="section-label">Investment</div>
        <h2 class="section-heading">Transparent pricing.<br><span class="hero-accent">No surprises.</span></h2>
        <form method="GET" action="#pricing" style="margin-top:24px; display:flex; gap:10px; max-width:400px;">
            <input type="text" name="search_feature" placeholder="Search for a feature..." value="<?php echo htmlspecialchars($search_feature); ?>" style="flex:1; background:var(--input-bg); border:1px solid var(--input-border); color:white; padding:10px; border-radius:10px;">
            <button type="submit" class="btn-primary">Search</button>
        </form>
      </div>
      <div class="pricing-grid">
        <?php foreach ($pricing_plans as $p): ?>
        <div class="pricing-card <?php echo $p['featured']?'featured':''; ?>" data-aos="fade-up">
          <div class="pricing-tier"><?php echo $p['tier']; ?></div>
          <div class="pricing-desc"><?php echo $p['desc']; ?></div>
          <div class="pricing-amount"><?php echo $p['amount']; ?></div>
          <ul class="pricing-features"><?php foreach ($p['features'] as $f): ?><li><span class="check">✓</span> <?php echo $f; ?></li><?php endforeach; ?></ul>
          <button class="<?php echo $p['btn_class']; ?>" onclick="<?php echo $p['btn_action']; ?>">Get Started</button>
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
      <div class="reviews-grid">
        <?php foreach ($reviews as $r): ?>
        <div class="review-card <?php echo $r['featured']?'review-card--featured':''; ?>" data-aos="fade-up">
          <p class="review-text"><?php echo $r['text']; ?></p>
          <div class="review-impact"><?php echo $r['impact']; ?></div>
          <div class="review-author">
            <div class="review-avatar review-avatar--<?php echo $r['color']; ?>"><?php echo $r['avatar']; ?></div>
            <div class="review-author-info"><div class="review-name"><?php echo $r['name']; ?></div><div class="review-role"><?php echo $r['role']; ?></div></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- LARAVEL SHOWCASE -->
  <section class="section section--alt" id="live-portfolio">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up">
        <div class="section-label">Live Portfolio</div>
        <h2 class="section-heading">Featured <span class="hero-accent">Client Projects.</span></h2>
      </div>
      <div class="projects-grid" id="laravelProjectsContainer" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; margin-top: 40px;"></div>
    </div>
  </section>

  <!-- GITHUB PROJECTS -->
  <section class="section" id="projects">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up">
        <div class="section-label">Technical Mastery</div>
        <h2 class="section-heading">Built with the best.<br><span class="hero-accent">Live from GitHub.</span></h2>
      </div>
      <div class="profile-dashboard glass-panel" id="githubProfile"></div>
      <div class="projects-table-wrap">
        <table class="pro-table" id="repoTable">
          <thead><tr><th>Technology</th><th>Type</th><th>Stardom</th><th>Action</th></tr></thead>
          <tbody id="repoBody"></tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- AI ESTIMATOR (RESTORED) -->
  <section class="section section--alt" id="estimator">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up"><div class="section-label">AI Tool</div><h2 class="section-heading">Instant project<br><span class="hero-accent">estimates.</span></h2></div>
      <div class="estimator-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:40px;">
        <div class="estimator-form">
          <div class="form-group"><label>Project Brief</label><textarea id="estimatorDesc" placeholder="Describe your product..."></textarea></div>
          <div class="form-row-2">
            <div class="form-group"><label>Industry</label><select id="estimatorIndustry"><option>E-Commerce</option><option>Healthcare</option><option>FinTech</option></select></div>
            <div class="form-group"><label>Budget Range</label><select id="estimatorBudget"><option>₹25K - ₹50K</option><option>₹50K - ₹1.5L</option></select></div>
          </div>
          <div class="form-group"><label>Features</label><input type="text" id="estimatorFeatures" placeholder="e.g., Payment, Chat"></div>
          <button class="btn-primary w-full" id="estimateBtn" onclick="generateEstimate()">Generate AI Estimate</button>
        </div>
        <div class="estimator-result" id="estimatorResult" style="background:var(--card-bg); border:1px solid var(--card-border); padding:30px; border-radius:24px;">
           <div id="estimatorPlaceholder">Your estimate will appear here...</div>
           <div id="estimatorOutput" style="display:none;"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ (RESTORED) -->
  <section class="section" id="faq">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up"><div class="section-label">FAQ</div><h2 class="section-heading">Frequently asked<br>questions.</h2></div>
      <div class="faq-list" data-aos="fade-up">
        <div class="faq-item"><div class="faq-question" onclick="toggleFaq(this)"><span class="faq-q-text">How long does a project take?</span><span class="faq-chevron">▼</span></div><div class="faq-answer"><div class="faq-answer-inner">Usually 4-12 weeks depending on complexity.</div></div></div>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section class="section section--alt" id="contact">
    <div class="page-wrapper" data-aos="fade-up">
      <div class="contact-grid">
        <div class="contact-info">
          <div class="section-label">Get In Touch</div><h2 class="section-heading">Let's build<br>something great.</h2>
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

  <!-- BACK TO TOP & CHAT BOT (RESTORED) -->
  <button id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" style="position:fixed; bottom:30px; right:30px; z-index:100; background:var(--accent); color:white; border:none; width:50px; height:50px; border-radius:50%; cursor:pointer; display:none;">↑</button>
  
  <div id="chatWidget" style="position:fixed; bottom:30px; left:30px; z-index:100;">
    <button id="chatToggle" onclick="toggleChat()" style="background:var(--accent2); color:white; border:none; width:60px; height:60px; border-radius:50%; font-size:24px; cursor:pointer;">💬</button>
  </div>

  <script src="index.js?v=4"></script>
  <script src="particles.js?v=2"></script>
</body>
</html>
