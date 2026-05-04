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
  <link href="index.css?v=3" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

  <canvas id="particleCanvas"></canvas>
  <div id="scrollProgress"></div>
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
        <path d="M2 8 L18 1 L34 8 L34 28 Q34 38 18 42 Q2 38 2 28 Z" fill="none" stroke="rgba(255,255,255,0.20)" stroke-width="1.2" />
        <path d="M8 13 L18 7 L28 13 L28 27 Q28 35 18 38 Q8 35 8 27 Z" fill="none" stroke="rgba(255,255,255,0.40)" stroke-width="1.4" />
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
      <a href="login.html" class="btn-nav-outline">Log In</a>
    </div>
    <div class="nav-actions">
      <span id="userDisplay"></span>
      <button id="logoutBtn" onclick="logout()" style="display:none;" class="btn-nav-outline">Logout</button>
      <button id="theme-btn" onclick="toggleTheme()" aria-label="Toggle theme">
        <span class="theme-icon">&#9790;</span>
      </button>
      <button class="hamburger" id="hamburger" onclick="toggleMobileMenu()">
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
  </nav>

  <!-- HERO SECTION -->
  <div class="hero-global-wrapper">
    <section class="hero perspective-container">
      <div class="hero-left" data-aos="fade-right" data-aos-duration="1000">
        <div class="hero-tag">&#10024; Technology Consulting</div>
        <h1 class="hero-heading">Build Smarter.<br><span class="hero-accent">Scale Faster.</span></h1>
        <p class="hero-sub">Harbour Tech Solutions delivers custom software, cloud infrastructure, and AI-powered analytics.</p>
        <div class="hero-btns">
          <a href="#contact" class="btn-primary">Start a Project &#8594;</a>
          <a href="#projects" class="btn-ghost">View Our Work &#8594;</a>
        </div>
        <div class="hero-social-proof">
          <div class="avatar-stack">
            <div class="avatar" style="background:#6366f1">A</div>
            <div class="avatar" style="background:#818cf8">B</div>
            <div class="avatar" style="background:#06b6d4">C</div>
          </div>
          <span>Trusted by <strong>50+</strong> businesses worldwide</span>
        </div>
      </div>

      <div class="hero-right preserve-3d" data-aos="fade-left" data-aos-duration="1000">
        <div class="hero-code-card" data-tilt>
          <div class="code-card-header">
            <div class="code-dots"><span></span><span></span><span></span></div>
            <span class="code-filename">harbourtech.php</span>
          </div>
          <div class="code-body">
            <div class="code-line"><span class="ck">&lt;?php</span></div>
            <div class="code-line"><span class="ck">echo</span> <span class="cs">"Building scalable systems..."</span>;</div>
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
          <div class="about-tags">
            <span>ISO Certified</span><span>AWS Partner</span><span>24/7 Support</span>
          </div>
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
            <span style="font-size:12px; color:var(--text-light); margin-left:10px;">Sorted by: <strong><?php echo $sort_label; ?></strong></span>
        </div>
      </div>
      <div class="services-grid">
        <?php foreach ($services as $s): ?>
        <div class="service-card" data-aos="fade-up">
          <div class="service-num"><?php echo $s['num']; ?></div>
          <div class="service-icon-wrap" style="font-size:32px;"><?php echo $s['icon']; ?></div>
          <h3><?php echo $s['title']; ?></h3>
          <p><?php echo $s['desc']; ?></p>
          <div class="service-tags">
            <?php foreach ($s['tags'] as $t): ?><span><?php echo $t; ?></span><?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- PRICING (Dynamic) -->
  <section class="section" id="pricing">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up">
        <div class="section-label">Investment</div>
        <h2 class="section-heading">Transparent pricing.<br><span class="hero-accent">No surprises.</span></h2>
        
        <!-- Feature Search -->
        <form method="GET" action="#pricing" style="margin-top:24px; display:flex; gap:10px; max-width:400px;">
            <input type="text" name="search_feature" placeholder="Search for a feature (e.g. SEO)..." value="<?php echo htmlspecialchars($search_feature); ?>" style="flex:1; background:var(--input-bg); border:1px solid var(--input-border); color:white; padding:10px; border-radius:10px;">
            <button type="submit" class="btn-primary">Search</button>
        </form>
        <?php if (!empty($search_results)): ?>
            <div style="margin-top:16px; background:var(--accent-glow); padding:15px; border-radius:12px; border:1px solid var(--accent2);">
                <div style="font-weight:700; color:var(--accent2); margin-bottom:8px;">Search Results for "<?php echo htmlspecialchars($search_feature); ?>":</div>
                <?php foreach ($search_results as $tier => $feats): ?>
                    <div style="font-size:13px; margin-bottom:4px;"><strong><?php echo $tier; ?>:</strong> <?php echo implode(', ', $feats); ?></div>
                <?php endforeach; ?>
            </div>
        <?php elseif (!empty($search_feature)): ?>
            <div style="margin-top:16px; color:#ef4444;">No plans found with that feature.</div>
        <?php endif; ?>
      </div>

      <div class="pricing-grid">
        <?php foreach ($pricing_plans as $p): ?>
        <div class="pricing-card <?php echo $p['featured']?'featured':''; ?>" data-aos="fade-up">
          <?php if($p['featured']): ?><div class="pricing-badge">Most Popular</div><?php endif; ?>
          <div class="pricing-tier"><?php echo $p['tier']; ?></div>
          <div class="pricing-desc"><?php echo $p['desc']; ?></div>
          <div class="pricing-amount"><?php echo $p['amount']; ?></div>
          <ul class="pricing-features">
            <?php foreach ($p['features'] as $f): ?>
            <li><span class="check">✓</span> <?php echo $f; ?></li>
            <?php endforeach; ?>
          </ul>
          <button class="<?php echo $p['btn_class']; ?>" onclick="<?php echo $p['btn_action']; ?>">Get Started &#8594;</button>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- TESTIMONIALS (Dynamic) -->
  <section class="section section--alt" id="testimonials">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up">
        <div class="section-label">Client Reviews</div>
        <h2 class="section-heading">Trusted by teams<br><span class="hero-accent">that mean business.</span></h2>
      </div>
      <div class="reviews-grid" data-aos="fade-up">
        <?php foreach ($reviews as $r): ?>
        <div class="review-card <?php echo $r['featured']?'review-card--featured':''; ?>">
          <div class="review-quote-mark">"</div>
          <div class="review-stars">★★★★★</div>
          <p class="review-text"><?php echo $r['text']; ?></p>
          <div class="review-impact"><?php echo $r['impact']; ?></div>
          <div class="review-author">
            <div class="review-avatar review-avatar--<?php echo $r['color']; ?>"><?php echo $r['avatar']; ?></div>
            <div class="review-author-info">
              <div class="review-name"><?php echo $r['name']; ?></div>
              <div class="review-role"><?php echo $r['role']; ?></div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- GITHUB REPOS (Table) -->
  <section class="section" id="projects">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up">
        <div class="section-label">Technical Mastery</div>
        <h2 class="section-heading">Built with the best.<br><span class="hero-accent">Live from GitHub.</span></h2>
      </div>
      <div class="profile-dashboard glass-panel" id="githubProfile"></div>
      <div class="projects-table-wrap">
        <table class="pro-table" id="repoTable">
          <thead><tr><th>Technology</th><th>Type</th><th>Live Stardom</th><th>Description</th><th>Action</th></tr></thead>
          <tbody id="repoBody"></tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- CONTACT (With PHP Validation) -->
  <section class="section section--alt" id="contact">
    <div class="page-wrapper">
      <div class="contact-grid">
        <div class="contact-info">
          <div class="section-label">Get In Touch</div>
          <h2 class="section-heading">Let's build<br>something great.</h2>
          <p>Contact us for a free technical consultation.</p>
          <div class="contact-details">
            <div class="contact-row"><span>support@harbourtech.com</span></div>
            <div class="contact-row"><span>+91 9876543210</span></div>
          </div>
        </div>
        <div class="contact-form-wrap">
          <h3 style="margin-bottom:20px;">Contact Us</h3>
          
          <?php if ($contact_processed): ?>
          <div style="margin-bottom:20px; padding:20px; border-radius:14px; background:var(--card-bg); border:1px solid var(--card-border);">
            <h4 style="color:var(--accent2); margin-bottom:10px;">Server Validation Results:</h4>
            <ul style="font-size:14px; color:var(--text-muted); list-style:none;">
                <li>Name Formatted: <strong><?php echo htmlspecialchars($formatted_name); ?></strong></li>
                <li>Email Domain: <strong><?php echo htmlspecialchars($email_domain); ?></strong></li>
                <li>Email Status: <span style="color:<?php echo $email_status==='valid'?'#10b981':'#ef4444'; ?>"><?php echo strtoupper($email_status); ?></span></li>
                <li>Phone Status: <span style="color:<?php echo $phone_status==='valid'?'#10b981':'#ef4444'; ?>"><?php echo strtoupper($phone_status); ?></span></li>
            </ul>
            <?php if ($email_status === 'valid' && $phone_status === 'valid'): ?>
                <div style="margin-top:15px; color:#10b981; font-weight:700;">&#10003; Data verified. Proceeding with inquiry!</div>
            <?php else: ?>
                <div style="margin-top:15px; color:#ef4444; font-weight:700;">&#10007; Please fix the errors above.</div>
            <?php endif; ?>
          </div>
          <?php endif; ?>

          <form method="POST" action="index.php#contact" id="contactForm">
            <input type="hidden" name="contact_php" value="1">
            <div class="form-row-2">
              <div class="form-group"><label>Full Name</label><input type="text" name="user_name" placeholder="John Smith" required value="<?php echo htmlspecialchars($post_name); ?>"></div>
              <div class="form-group"><label>Email</label><input type="email" name="user_email" placeholder="john@company.com" required value="<?php echo htmlspecialchars($post_email); ?>"></div>
            </div>
            <div class="form-row-2">
              <div class="form-group"><label>Phone</label><input type="tel" name="user_phone" placeholder="+91 9000000000" required value="<?php echo htmlspecialchars($post_phone); ?>"></div>
              <div class="form-group">
                <label>Service</label>
                <select name="service_type">
                  <option>Web Development</option>
                  <option>Cloud Solutions</option>
                  <option>AI &amp; Analytics</option>
                  <option>Cybersecurity</option>
                </select>
              </div>
            </div>
            <div class="form-group"><label>Message</label><textarea name="message" placeholder="Tell us about your project..."></textarea></div>
            <button type="submit" class="btn-primary w-full">Run Server Validation &#8594;</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="site-footer">
    <div class="page-wrapper">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="footer-logo">Harbour Tech</div>
          <p>Building modern, scalable digital solutions.</p>
        </div>
      </div>
      <div class="footer-bottom">&#169; 2026 Harbour Tech Solutions</div>
    </div>
  </footer>

  <script src="index.js?v=3"></script>
  <script src="particles.js?v=2"></script>
</body>
</html>
