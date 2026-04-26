<?php include 'process.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Harbour Tech Solutions — Build Smarter. Scale Faster.</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Harbour Tech Solutions delivers custom software, cloud infrastructure, and AI-powered analytics — engineered for businesses that refuse to stand still.">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="index.css?v=2" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js"></script>
  <!-- Razorpay Checkout SDK -->
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <style>
    /* PHP Result Boxes */
    .php-result-box {
      margin-top: 20px;
      padding: 20px 24px;
      background: rgba(99, 102, 241, 0.06);
      border: 1px solid rgba(99, 102, 241, 0.18);
      border-radius: 16px;
      font-size: 14px;
      color: var(--text);
      line-height: 1.8;
      backdrop-filter: blur(12px);
    }
    .php-result-box strong { color: var(--accent2); }
    .php-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(119, 123, 179, 0.15);
      color: #a5b4fc;
      border: 1px solid rgba(119, 123, 179, 0.25);
      padding: 3px 10px;
      border-radius: 6px;
      font-size: 10px;
      font-weight: 800;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      vertical-align: middle;
    }
    .php-tag-valid {
      color: #10b981;
      background: rgba(16, 185, 129, 0.1);
      border-color: rgba(16, 185, 129, 0.25);
      padding: 2px 10px;
      border-radius: 6px;
      font-weight: 700;
      font-size: 12px;
    }
    .php-tag-invalid {
      color: #ef4444;
      background: rgba(239, 68, 68, 0.1);
      border-color: rgba(239, 68, 68, 0.25);
      padding: 2px 10px;
      border-radius: 6px;
      font-weight: 700;
      font-size: 12px;
    }
    .sort-controls {
      display: flex;
      align-items: center;
      gap: 12px;
      justify-content: center;
      margin-top: 20px;
      flex-wrap: wrap;
    }
    .sort-controls a {
      padding: 8px 18px;
      border-radius: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s;
      border: 1px solid var(--card-border);
      color: var(--text-muted);
    }
    .sort-controls a:hover, .sort-controls a.active-sort {
      background: var(--accent-glow);
      color: var(--accent2);
      border-color: rgba(99, 102, 241, 0.3);
    }
    .sort-controls .sort-label {
      font-size: 12px;
      color: var(--text-light);
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 600;
    }
    .feature-search-bar {
      display: flex;
      gap: 12px;
      max-width: 500px;
      margin: 24px auto 0;
    }
    .feature-search-bar input {
      flex: 1;
      padding: 12px 18px;
      background: var(--input-bg);
      border: 1px solid var(--input-border);
      border-radius: 12px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      transition: all 0.3s;
    }
    .feature-search-bar input:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 4px var(--accent-glow);
    }
    .feature-search-bar button {
      padding: 12px 24px;
      cursor: pointer;
    }
    .search-results-box {
      max-width: 700px;
      margin: 24px auto 0;
      padding: 20px 24px;
      background: rgba(99, 102, 241, 0.06);
      border: 1px solid rgba(99, 102, 241, 0.18);
      border-radius: 16px;
      font-size: 14px;
      color: var(--text);
      line-height: 1.8;
    }
    .search-results-box .plan-name {
      font-weight: 700;
      color: var(--accent2);
      margin-top: 8px;
    }
    .search-results-box .plan-name:first-child { margin-top: 0; }
  </style>
</head>
<body>

<!-- LIVE PARTICLE CANVAS -->
<canvas id="particleCanvas"></canvas>

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
    <a href="#pricing">Pricing</a>
    <a href="#projects">Projects</a>
    <a href="#estimator">Estimator</a>
    <a href="#contact">Contact</a>
    <a href="login.html" id="loginLink" class="btn-nav-outline">Log In</a>
  </div>
  <div class="nav-actions">
    <span id="userDisplay"></span>
    <button id="logoutBtn" onclick="logout()" style="display:none;" class="btn-nav-outline">Logout</button>
    <button id="theme-btn" onclick="toggleTheme()" aria-label="Toggle theme">
      <span class="theme-icon">&#9790;</span>
    </button>
  </div>
</nav>

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
      <div class="badge-icon">&#9889;</div>
      <div><div class="badge-num">120+</div><div class="badge-label">Projects Done</div></div>
    </div>
    <div class="hero-badge hero-badge--br">
      <div class="badge-icon">&#128200;</div>
      <div><div class="badge-num">98%</div><div class="badge-label">Satisfaction</div></div>
    </div>
    <div class="hero-badge hero-badge--bl">
      <div class="badge-icon">&#128101;</div>
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

<!-- ============================================================
     SERVICES — PHP Array Sorting with usort()
     ============================================================ -->
<section class="section section--alt" id="services">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">What We Do <span class="php-badge">&#9889; PHP sort()</span></div>
      <h2 class="section-heading">Services built around<br>your goals.</h2>
      <!-- Sort Controls -->
      <div class="sort-controls">
        <span class="sort-label">Sort by Name:</span>
        <a href="index.php?sort_services=default#services" class="<?php echo $sort_order === 'default' ? 'active-sort' : ''; ?>">Default</a>
        <a href="index.php?sort_services=asc#services" class="<?php echo $sort_order === 'asc' ? 'active-sort' : ''; ?>">A → Z</a>
        <a href="index.php?sort_services=desc#services" class="<?php echo $sort_order === 'desc' ? 'active-sort' : ''; ?>">Z → A</a>
      </div>
    </div>
    <div class="services-grid">
      <?php
      // PHP foreach loop renders service cards from the sorted array
      $delay = 100;
      foreach ($services as $index => $svc): ?>
        <div class="service-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>" data-tilt data-tilt-max="5" data-tilt-speed="400" data-tilt-glare="true" data-tilt-max-glare="0.15">
          <div class="service-num"><?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></div>
          <div class="service-icon-wrap"><?php echo $svc['icon']; ?></div>
          <h3><?php echo $svc['title']; ?></h3>
          <p><?php echo $svc['desc']; ?></p>
          <div class="service-tags">
            <?php foreach ($svc['tags'] as $tag): ?>
              <span><?php echo $tag; ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      <?php $delay += 100; endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     PRICING — PHP array_merge() + in_array() Search
     ============================================================ -->
<section class="section" id="pricing">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">Investment <span class="php-badge">&#9889; PHP array_merge()</span></div>
      <h2 class="section-heading">Transparent pricing.<br><span class="hero-accent">No surprises.</span></h2>
      <!-- Feature Search -->
      <form method="GET" action="index.php#pricing" class="feature-search-bar">
        <input type="hidden" name="sort_services" value="<?php echo htmlspecialchars($sort_order); ?>">
        <input type="text" name="search_feature" placeholder="Search features (e.g. SEO, API, support)..." value="<?php echo htmlspecialchars($search_feature); ?>">
        <button type="submit" class="btn-primary" style="padding: 12px 24px;">Search</button>
      </form>
    </div>

    <?php if (!empty($search_feature)): ?>
      <div class="search-results-box" data-aos="fade-up">
        <strong>🔍 in_array() Search Results for "<?php echo htmlspecialchars($search_feature); ?>":</strong><br>
        <?php if (!empty($search_results)): ?>
          <?php foreach ($search_results as $plan_name => $features): ?>
            <div class="plan-name">📦 <?php echo $plan_name; ?> Plan:</div>
            <?php foreach ($features as $f): ?>
              <div style="padding-left: 20px;">✓ <?php echo htmlspecialchars($f); ?></div>
            <?php endforeach; ?>
          <?php endforeach; ?>
        <?php else: ?>
          <div style="color: var(--text-muted);">No matching features found across any plan.</div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <div class="pricing-grid">
      <?php
      $delay = 100;
      foreach ($pricing_plans as $plan): ?>
        <div class="pricing-card <?php echo $plan['featured'] ? 'featured' : ''; ?>" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>" data-tilt data-tilt-max="5" data-tilt-speed="400">
          <?php if ($plan['featured']): ?>
            <div class="pricing-badge">Most Popular</div>
          <?php endif; ?>
          <div class="pricing-tier"><?php echo $plan['tier']; ?></div>
          <div class="pricing-desc"><?php echo $plan['desc']; ?></div>
          <div class="pricing-amount"><?php echo $plan['amount']; ?></div>
          <ul class="pricing-features">
            <?php
            // Features rendered from array_merge() result
            foreach ($plan['features'] as $feature): ?>
              <li>
                <span class="check">✓</span>
                <?php
                // Highlight matched features from search
                if (!empty($search_feature) && stripos($feature, $search_feature) !== false) {
                    echo '<strong style="color:var(--accent3);">' . htmlspecialchars($feature) . '</strong>';
                } else {
                    echo htmlspecialchars($feature);
                }
                ?>
              </li>
            <?php endforeach; ?>
          </ul>
          <button class="<?php echo $plan['btn_class']; ?>" onclick="<?php echo $plan['btn_action']; ?>">
            <?php echo $plan['tier'] === 'Enterprise' ? 'Contact Sales' : 'Get Started'; ?> &#8594;
          </button>
        </div>
      <?php $delay += 100; endforeach; ?>
    </div>
  </div>
</section>

<!-- PROJECTS — Tech Stack Table (unchanged) -->
<section class="section section--alt" id="projects">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">Technical Mastery</div>
      <h2 class="section-heading">Built with the best.<br><span class="hero-accent">Live from GitHub.</span></h2>
    </div>

    <!-- GitHub Profile Banner -->
    <div class="profile-dashboard glass-panel" id="githubProfile" data-aos="fade-up" data-aos-delay="100">
        <!-- Rendered by JS -->
    </div>

    <!-- Repo Table -->
    <div class="projects-table-wrap" data-aos="fade-up" data-aos-delay="200">
      <table class="pro-table" id="repoTable">
        <thead>
          <tr>
            <th>Technology</th>
            <th>Type</th>
            <th class="hide-mobile">Live Stardom</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="repoBody">
          <!-- Skeleton Rows injected by JS -->
        </tbody>
      </table>
    </div>

    <div style="text-align: center; margin-top: 44px;" data-aos="fade-up">
        <button class="btn-primary" onclick="fetchRepos()">
            ↻ Refresh Tech Stack
        </button>
    </div>
  </div>
</section>

<!-- AI PROJECT ESTIMATOR (unchanged) -->
<section class="section" id="estimator">
  <div class="page-wrapper">
    <div class="section-header" data-aos="fade-up">
      <div class="section-label">AI-Powered</div>
      <h2 class="section-heading">Instant project<br><span class="hero-accent">estimates.</span></h2>
      <p style="color: var(--text-muted); font-size: 15px; margin-top: 16px; max-width: 500px; margin-left: auto; margin-right: auto; line-height: 1.7;">Describe your project and our AI engine will generate a rough estimate of scope, timeline, and budget.</p>
    </div>
    <div class="estimator-grid">
      <!-- Form -->
      <div class="estimator-form" data-aos="fade-right" data-aos-delay="100">
        <div class="form-group">
          <label>Project Description</label>
          <textarea id="estimatorDesc" placeholder="e.g., I need an e-commerce platform with user auth, payment integration, product catalog, and admin dashboard..." style="min-height: 140px;"></textarea>
        </div>
        <div class="form-row-2">
          <div class="form-group">
            <label>Industry</label>
            <select id="estimatorIndustry">
              <option value="">Select industry...</option>
              <option>E-Commerce</option>
              <option>Healthcare</option>
              <option>FinTech</option>
              <option>EdTech</option>
              <option>SaaS</option>
              <option>Real Estate</option>
              <option>Other</option>
            </select>
          </div>
          <div class="form-group">
            <label>Budget Range</label>
            <select id="estimatorBudget">
              <option value="">Select range...</option>
              <option>₹25K - ₹50K</option>
              <option>₹50K - ₹1.5L</option>
              <option>₹1.5L - ₹5L</option>
              <option>₹5L+</option>
            </select>
          </div>
        </div>
        <div class="form-group" style="margin-bottom: 0;">
          <label>Priority Features</label>
          <input type="text" id="estimatorFeatures" placeholder="e.g., Payment gateway, Real-time chat, Dashboard">
        </div>
        <button class="btn-primary w-full" id="estimateBtn" onclick="generateEstimate()" style="margin-top: 8px;">
          &#9889; Generate AI Estimate
        </button>
      </div>
      <!-- Result -->
      <div class="estimator-result" data-aos="fade-left" data-aos-delay="200" id="estimatorResult">
        <div class="estimator-placeholder" id="estimatorPlaceholder">
          <div class="estimator-placeholder-icon">&#129302;</div>
          <div style="font-size: 16px; font-weight: 600; color: var(--text-muted);">Your AI estimate will appear here</div>
          <div style="font-size: 13px; color: var(--text-light);">Fill in the form and click "Generate"</div>
        </div>
        <div id="estimatorOutput" style="display: none;"></div>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section class="section section--alt" id="contact">
  <div class="page-wrapper" data-aos="fade-up">
    <div class="contact-grid">
      <div class="contact-info">
        <div class="section-label">Get In Touch</div>
        <h2 class="section-heading">Let's build<br>something great.</h2>
        <p>Have a project in mind? We'd love to hear about it. Our team typically responds within 2 business hours.</p>
        

        <div class="contact-details" style="margin-top: 32px;">
          <div class="contact-row"><span class="contact-icon">&#128231;</span><span>support@harbourtech.com</span></div>
          <div class="contact-row"><span class="contact-icon">&#128222;</span><span>+91 9876543210</span></div>
          <div class="contact-row"><span class="contact-icon">&#128205;</span><span>Mumbai, India</span></div>
        </div>
      </div>

      <div class="contact-form-wrap">
        <h3 style="font-size: 24px; color: var(--text); margin-bottom: 8px; font-weight: 700; font-family: 'DM Sans', sans-serif;">Contact Us</h3>
        <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 28px;">Our PHP Validation Engine will format and verify your input server-side.</p>
        
        <form method="POST" action="index.php#contact" id="contactForm">
          <input type="hidden" name="contact_php" value="1">
          
          <?php if ($contact_processed): ?>
            <div style="background: var(--bg-alt); border: 1px solid var(--card-border); border-radius: 14px; padding: 16px; margin-bottom: 24px;">
              <div style="font-size: 12px; font-weight: 700; color: var(--accent2); margin-bottom: 12px; text-transform: uppercase;">⚡ Server Validation Results</div>
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <div style="font-size: 13px; color: var(--text);">
                  <div style="color: var(--text-muted); font-size: 10px; margin-bottom: 2px;">FORMATTED NAME</div>
                  <strong><?php echo htmlspecialchars($formatted_name); ?></strong>
                </div>
                <div style="font-size: 13px; color: var(--text);">
                  <div style="color: var(--text-muted); font-size: 10px; margin-bottom: 2px;">EMAIL DOMAIN</div>
                  <strong><?php echo htmlspecialchars($email_domain); ?></strong>
                </div>
                <div style="margin-top: 4px;">
                   <span class="<?php echo $email_status === 'valid' ? 'php-tag-valid' : 'php-tag-invalid'; ?>" style="font-size: 10px;">
                     <?php echo $email_status === 'valid' ? '✓ Email Valid' : '✗ Email Error'; ?>
                   </span>
                </div>
                <div style="margin-top: 4px;">
                   <span class="<?php echo $phone_status === 'valid' ? 'php-tag-valid' : 'php-tag-invalid'; ?>" style="font-size: 10px;">
                     <?php echo $phone_status === 'valid' ? '✓ Phone Valid' : '✗ Phone Error'; ?>
                   </span>
                </div>
              </div>
            </div>
          <?php endif; ?>

          <div class="form-row-2">
            <div class="form-group"><label>Full Name</label><input type="text" name="user_name" placeholder="John Smith" required value="<?php echo htmlspecialchars($post_name); ?>"></div>
            <div class="form-group"><label>Email</label><input type="email" name="user_email" placeholder="john@company.com" required value="<?php echo htmlspecialchars($post_email); ?>"></div>
          </div>
          <div class="form-row-2">
            <div class="form-group"><label>Phone</label><input type="tel" name="user_phone" placeholder="+91 9000000000" required value="<?php echo htmlspecialchars($post_phone); ?>"></div>
            <div class="form-group">
              <label>Service</label>
              <select name="service_type">
                <option value="">Select a service...</option>
                <option>Web Development</option>
                <option>Cloud Solutions</option>
                <option>AI &amp; Analytics</option>
                <option>Cybersecurity</option>
              </select>
            </div>
          </div>
          <div class="form-group"><label>Message</label><textarea name="message" placeholder="Tell us about your project..."></textarea></div>
          <button type="submit" id="submitBtn" class="btn-primary w-full">Run Server Validation &#8594;</button>
          <p id="contactSuccess" style="display:none; color:var(--accent3); text-align:center; margin-top:16px; font-weight:600;">&#10003; Message processed successfully!</p>
          <p id="contactError" style="display:none; color:#ef4444; text-align:center; margin-top:16px; font-weight:600;">&#10007; Failed to send message. Please try again.</p>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- EmailJS SDK -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script type="text/javascript">
  (function(){
      emailjs.init("d7p6Li5EMWhr56g5c");
  })();
</script>

<!-- FOOTER -->
<footer class="site-footer">
  <div class="page-wrapper">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="footer-logo">
          <svg width="28" height="33" viewBox="0 0 36 42" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <linearGradient id="footGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#4f46e5"/>
                <stop offset="100%" style="stop-color:#06b6d4"/>
              </linearGradient>
            </defs>
            <path d="M2 8 L18 1 L34 8 L34 28 Q34 38 18 42 Q2 38 2 28 Z" fill="url(#footGrad)" />
            <path d="M8 13 L18 7 L28 13 L28 27 Q28 35 18 38 Q8 35 8 27 Z" fill="none" stroke="rgba(255,255,255,0.40)" stroke-width="1.4"/>
            <text x="18" y="27" text-anchor="middle" font-family="DM Sans,sans-serif" font-weight="800" fill="#ffffff" font-size="13" letter-spacing="1">HT</text>
          </svg>
          <span class="brand-name" style="color:#e2e8f0">Harbour Tech</span>
        </div>
        <p>Building modern, scalable digital solutions for businesses that want to lead.</p>
      </div>
      <div class="footer-col">
        <h6>Services</h6>
        <a href="#services">Web Development</a>
        <a href="#services">Cloud Solutions</a>
        <a href="#services">AI &amp; Analytics</a>
        <a href="#services">Cybersecurity</a>
      </div>
      <div class="footer-col">
        <h6>Company</h6>
        <a href="#about">About Us</a>
        <a href="#projects">Projects</a>
        <a href="#pricing">Pricing</a>
        <a href="admin_login.html" style="opacity: 0.6; font-size: 12px; margin-top: 12px;">Admin Portal</a>
        <a href="login.html">Login</a>
        <a href="privacy.html">Privacy Policy</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>&#169; 2026 Harbour Tech Solutions &middot; All Rights Reserved</span>
    </div>
  </div>
</footer>

<!-- PROJECT MODAL (generic) -->
<div class="modal-overlay" id="projectModal" onclick="closeModalOutside(event, 'projectModal')">
  <div class="modal-box">
    <div class="modal-top-bar"></div>
    <div class="modal-header">
      <div class="modal-title-area">
        <div class="modal-id" id="mId"></div>
        <div class="modal-title" id="mTitle"></div>
      </div>
      <button class="modal-close" onclick="closeModal('projectModal')">&#x2715;</button>
    </div>
    <div class="modal-body">
      <div class="modal-status-row">
        <span class="status-badge" id="mStatus"></span>
        <span class="modal-status-note" id="mStatusNote"></span>
      </div>
      <div class="modal-section-title">Overview</div>
      <p class="modal-description" id="mDesc"></p>
      <div class="modal-section-title">Tech Stack</div>
      <div class="tech-tags" id="mTech"></div>
      <div class="modal-section-title">Project Details</div>
      <div class="modal-meta-grid">
        <div class="meta-item"><span>Start Date</span><strong id="mStart"></strong></div>
        <div class="meta-item"><span>End Date</span><strong id="mEnd"></strong></div>
        <div class="meta-item"><span>Team Size</span><strong id="mTeam"></strong></div>
        <div class="meta-item"><span>Client</span><strong id="mClient"></strong></div>
      </div>
      <div class="modal-section-title">Progress</div>
      <div class="progress-bar-wrap">
        <div class="progress-label"><span id="mProgressLabel"></span><span id="mProgressPct"></span></div>
        <div class="progress-track"><div class="progress-fill" id="mProgressFill"></div></div>
      </div>
      <div class="modal-section-title">Key Deliverables</div>
      <ul class="deliverables-list" id="mDeliverables"></ul>
    </div>
  </div>
</div>

<script src="particles.js?v=2"></script>

<!-- REPO DETAILS MODAL -->
<div class="modal-overlay" id="repoModal" onclick="closeModalOutside(event, 'repoModal')">
  <div class="modal-box" style="max-width:650px;">
    <div class="modal-top-bar"></div>
    <div style="padding:40px;">
        <div style="display:flex; align-items:center; gap:20px; margin-bottom:30px;">
            <img src="" alt="" id="modalAvatar" style="width:64px; height:64px; border-radius:14px; border:2px solid var(--card-border); object-fit:cover;">
            <div style="flex:1;">
                <h3 id="modalName" style="font-size:24px; color:var(--text); margin-bottom:4px; font-family:'DM Sans',sans-serif; font-weight:700;">Repo Name</h3>
                <div id="modalOwner" style="font-size:14px; color:var(--text-muted);">owner/repo</div>
            </div>
            <button class="modal-close" onclick="closeModal('repoModal')">✕</button>
        </div>

        <p id="modalDesc" style="font-size:16px; color:var(--text-muted); line-height:1.7; margin-bottom:30px;">Description...</p>

        <div style="background:var(--accent-glow); border:1px solid rgba(99, 102, 241, 0.2); border-radius:16px; padding:24px; margin-bottom:30px;">
            <div style="font-size:14px; font-weight:700; color:var(--accent2); text-transform:uppercase; letter-spacing:1px; margin-bottom:12px;">🚀 Why We Use This</div>
            <div id="modalWhy" style="font-size:15px; color:var(--text); line-height:1.6;">Explanation here...</div>
        </div>

        <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:16px; margin-bottom:30px;">
            <div style="text-align:center; padding:18px; background:var(--bg-alt); border-radius:14px; border:1px solid var(--card-border);">
                <div id="modalStars" style="font-size:22px; font-weight:700; color:var(--text);">0</div>
                <div style="font-size:12px; color:var(--text-muted); margin-top:4px;">Stars</div>
            </div>
            <div style="text-align:center; padding:18px; background:var(--bg-alt); border-radius:14px; border:1px solid var(--card-border);">
                <div id="modalForks" style="font-size:22px; font-weight:700; color:var(--text);">0</div>
                <div style="font-size:12px; color:var(--text-muted); margin-top:4px;">Forks</div>
            </div>
            <div style="text-align:center; padding:18px; background:var(--bg-alt); border-radius:14px; border:1px solid var(--card-border);">
                <div id="modalIssues" style="font-size:22px; font-weight:700; color:var(--text);">0</div>
                <div style="font-size:12px; color:var(--text-muted); margin-top:4px;">Issues</div>
            </div>
        </div>

        <div style="display:flex; gap:12px;">
            <a href="#" target="_blank" class="btn-primary" id="modalLink" style="flex:1; justify-content:center; text-align:center;">View on GitHub</a>
            <a href="#" target="_blank" class="btn-nav-outline" id="modalIssuesLink" style="flex:1; justify-content:center; border-color:var(--card-border); color:var(--text); text-align:center; padding:14px;">View Issues</a>
        </div>
    </div>
  </div>
</div>

<script src="index.js?v=3"></script>
</body>
</html>
