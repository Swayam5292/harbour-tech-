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
  <link href="index.css?v=4" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.0/vanilla-tilt.min.js"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <style>
    /* Centering the Search Bar in Pricing */
    .pricing-search-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 40px 0;
      width: 100%;
    }
    .pricing-search-form {
      display: flex;
      gap: 12px;
      width: 100%;
      max-width: 500px;
    }
    .php-validation-tag {
        display: inline-block;
        font-size: 10px;
        font-weight: 700;
        background: rgba(99, 102, 241, 0.15);
        color: var(--accent2);
        padding: 2px 8px;
        border-radius: 4px;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
  </style>
</head>
<body>

  <canvas id="particleCanvas"></canvas>
  <div id="scrollProgress"></div>
  <div id="cursorGlow"></div>

  <!-- NAVBAR -->
  <nav class="main-nav" id="main-nav">
    <a class="nav-brand" href="index.php" style="display:flex;align-items:center;gap:12px;text-decoration:none;">
      <svg width="34" height="40" viewBox="0 0 36 42" xmlns="http://www.w3.org/2000/svg">
        <path d="M2 8 L18 1 L34 8 L34 28 Q34 38 18 42 Q2 38 2 28 Z" fill="url(#navGrad)" />
        <text x="18" y="27" text-anchor="middle" font-family="DM Sans" font-weight="800" fill="#ffffff" font-size="13">HT</text>
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
      <button id="theme-btn" onclick="toggleTheme()" aria-label="Toggle theme">
        <span class="theme-icon">&#9790;</span>
      </button>
      <button class="hamburger" onclick="toggleMobileMenu()"><span></span><span></span><span></span></button>
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
      <div class="hero-left" data-aos="fade-right">
        <div class="hero-tag">&#10024; Technology Consulting</div>
        <h1 class="hero-heading">Build Smarter.<br><span class="hero-accent">Scale Faster.</span></h1>
        <p class="hero-sub">Custom software, cloud infrastructure, and AI-powered analytics — engineered for businesses that refuse to stand still.</p>
        <div class="hero-btns">
          <a href="#contact" class="btn-primary">Start a Project &#8594;</a>
          <a href="#projects" class="btn-ghost">View Our Work</a>
        </div>
      </div>
      <div class="hero-right" data-aos="fade-left">
        <div class="hero-image-wrap" data-tilt>
           <!-- NEW HERO IMAGE -->
           <img src="hero_tech_dashboard_1777904492695.png" alt="Futuristic Tech Dashboard" style="width:100%; border-radius:30px; box-shadow: 0 40px 100px rgba(0,0,0,0.5), 0 0 40px var(--accent-glow);">
        </div>
      </div>
    </section>
  </div>

  <!-- WHO WE ARE (EXPANDED) -->
  <section class="section" id="about">
    <div class="page-wrapper" data-aos="fade-up">
      <div class="about-grid" style="grid-template-columns: 1fr; gap: 40px;">
        <div class="about-header" style="text-align: center;">
          <div class="section-label">Who We Are</div>
          <h2 class="section-heading">Built for businesses that mean business.</h2>
        </div>
        <div class="about-content-full" style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
          <div>
            <p style="font-size: 18px; line-height: 1.8; color: var(--text-muted); margin-bottom: 24px;">Harbour Tech Solutions is not just a dev shop; we are your technical partners in growth. We combine deep engineering expertise with strategic product thinking to build software that drives real business value.</p>
            <p style="font-size: 16px; line-height: 1.7; color: var(--text-light);">Our mission is to democratize high-end technology. Whether it's a startup looking for an MVP or an enterprise needing a cloud migration, we deliver on time and within budget, with zero compromises on quality.</p>
          </div>
          <div style="background: var(--card-bg); padding: 40px; border-radius: 24px; border: 1px solid var(--card-border);">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
              <div><h4 style="color:var(--accent2); font-size: 24px;">50+</h4><p style="font-size:12px;">Clients Worldwide</p></div>
              <div><h4 style="color:var(--accent2); font-size: 24px;">120+</h4><p style="font-size:12px;">Projects Delivered</p></div>
              <div><h4 style="color:var(--accent2); font-size: 24px;">98%</h4><p style="font-size:12px;">Client Retention</p></div>
              <div><h4 style="color:var(--accent2); font-size: 24px;">24/7</h4><p style="font-size:12px;">Technical Support</p></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PROCESS (EXPANDED) -->
  <section class="section section--alt" id="process">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up">
        <div class="section-label">Our Approach</div>
        <h2 class="section-heading">How we work,<br><span class="hero-accent">step by step.</span></h2>
      </div>
      <div class="process-grid">
        <div class="process-step" data-aos="fade-up" data-aos-delay="100">
          <div class="process-num">01</div>
          <div class="process-title">Discovery</div>
          <p class="process-desc">We deep-dive into your goals and market to map out the full scope before coding.</p>
        </div>
        <div class="process-step" data-aos="fade-up" data-aos-delay="200">
          <div class="process-num">02</div>
          <div class="process-title">Design</div>
          <p class="process-desc">Architecting system designs and wireframes reviewed with you in real-time.</p>
        </div>
        <div class="process-step" data-aos="fade-up" data-aos-delay="300">
          <div class="process-num">03</div>
          <div class="process-title">Build</div>
          <p class="process-desc">Agile 2-week sprints with automated testing and zero-compromise quality.</p>
        </div>
        <div class="process-step" data-aos="fade-up" data-aos-delay="400">
          <div class="process-num">04</div>
          <div class="process-title">Scale</div>
          <p class="process-desc">Deployment and monitoring to ensure your product grows seamlessly.</p>
        </div>
      </div>
      
      <!-- ADDED PROCESS DETAIL -->
      <div class="process-harbour-detail" style="margin-top: 60px; background: var(--card-bg); padding: 40px; border-radius: 24px; border: 1px solid var(--card-border);" data-aos="fade-up">
         <h3 style="margin-bottom: 20px;">The Harbour Advantage</h3>
         <p style="color: var(--text-muted); line-height: 1.8;">At Harbour Tech, our process is built on <strong>Transparency</strong>. You don't just see the final product; you gain access to our Jira boards and staging environments. We use a hybrid-agile methodology that allows for flexibility while strictly adhering to your budget and launch deadlines. Every line of code undergoes peer review and automated security scanning before reaching production.</p>
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
            <a href="?sort_services=default#services" class="btn-nav-outline <?php echo $sort_order==='default'?'active':''; ?>">Reset</a>
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

  <!-- PRICING (Dynamic Search Centered) -->
  <section class="section section--alt" id="pricing">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up">
        <div class="section-label">Investment</div>
        <h2 class="section-heading">Transparent pricing.<br><span class="hero-accent">No surprises.</span></h2>
        
        <!-- CENTERED Search Bar -->
        <div class="pricing-search-wrap">
            <form method="GET" action="#pricing" class="pricing-search-form">
                <input type="text" name="search_feature" placeholder="Search for a feature (e.g. AI)..." value="<?php echo htmlspecialchars($search_feature); ?>" style="flex:1; background:var(--input-bg); border:1px solid var(--input-border); color:white; padding:12px 16px; border-radius:12px; outline:none;">
                <button type="submit" class="btn-primary" style="padding:12px 24px;">Search</button>
            </form>
            <?php if (!empty($search_results)): ?>
                <div style="margin-top:16px; text-align:center; color:var(--accent2); font-size:14px;">
                    Found "<?php echo htmlspecialchars($search_feature); ?>" in: <strong><?php echo implode(', ', array_keys($search_results)); ?></strong>
                </div>
            <?php endif; ?>
        </div>
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

  <!-- AI ESTIMATOR (RESTORED) -->
  <section class="section" id="estimator">
    <div class="page-wrapper">
      <div class="section-header" data-aos="fade-up">
        <div class="section-label">AI Tool</div>
        <h2 class="section-heading">Instant project<br><span class="hero-accent">estimates.</span></h2>
      </div>
      <div class="estimator-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
        <div class="estimator-form" data-aos="fade-right">
          <div class="form-group"><label>Project Brief</label><textarea id="estimatorDesc" placeholder="Describe your product..."></textarea></div>
          <button class="btn-primary w-full" id="estimateBtn" onclick="generateEstimate()">Generate AI Estimate</button>
        </div>
        <div class="estimator-result" data-aos="fade-left" id="estimatorResult" style="background:var(--card-bg); border:1px solid var(--card-border); padding:30px; border-radius:24px; min-height:300px;">
           <div id="estimatorPlaceholder">Estimate will appear here...</div>
           <div id="estimatorOutput" style="display:none;"></div>
        </div>
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
      <div class="reviews-grid">
        <?php foreach ($reviews as $r): ?>
        <div class="review-card <?php echo $r['featured']?'review-card--featured':''; ?>" data-aos="fade-up">
          <p class="review-text"><?php echo $r['text']; ?></p>
          <div class="review-author">
            <div class="review-avatar review-avatar--<?php echo $r['color']; ?>"><?php echo $r['avatar']; ?></div>
            <div class="review-author-info"><div class="review-name"><?php echo $r['name']; ?></div><div class="review-role"><?php echo $r['role']; ?></div></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
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

  <!-- CONTACT (With Detailed PHP Labels) -->
  <section class="section section--alt" id="contact">
    <div class="page-wrapper">
      <div class="contact-grid">
        <div class="contact-info" data-aos="fade-right">
          <div class="section-label">Get In Touch</div>
          <h2 class="section-heading">Let's build<br>something great.</h2>
          <p>Experience the Harbour Advantage with a free consultation.</p>
        </div>
        <div class="contact-form-wrap" data-aos="fade-left">
          
          <?php if ($contact_processed): ?>
          <div style="margin-bottom:20px; padding:20px; border-radius:14px; background:var(--card-bg); border:1px solid var(--card-border);">
            <h4 style="color:var(--accent2); margin-bottom:10px;">PHP Validation Log:</h4>
            <ul style="font-size:12px; color:var(--text-muted); list-style:none;">
                <li>Name: <strong>String Formatting Applied</strong></li>
                <li>Email: <strong>Regex Format + Domain Extraction</strong></li>
                <li>Phone: <strong>Indian Format Regex Check</strong></li>
            </ul>
          </div>
          <?php endif; ?>

          <form method="POST" action="index.php#contact" id="contactForm">
            <input type="hidden" name="contact_php" value="1">
            <div class="form-row-2">
              <div class="form-group">
                <span class="php-validation-tag">String: format(ucwords)</span>
                <label>Full Name</label>
                <input type="text" name="user_name" placeholder="John Smith" required value="<?php echo htmlspecialchars($post_name); ?>">
              </div>
              <div class="form-group">
                <span class="php-validation-tag">Regex: email_pattern</span>
                <label>Email</label>
                <input type="email" name="user_email" placeholder="john@company.com" required value="<?php echo htmlspecialchars($post_email); ?>">
              </div>
            </div>
            <div class="form-row-2">
              <div class="form-group">
                <span class="php-validation-tag">Regex: IN_phone_pattern</span>
                <label>Phone</label>
                <input type="tel" name="user_phone" placeholder="+91 9000000000" required value="<?php echo htmlspecialchars($post_phone); ?>">
              </div>
              <div class="form-group">
                <label>Service</label>
                <select name="service_type">
                  <option>Web Development</option><option>Cloud Solutions</option>
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

  <footer class="site-footer">
    <div class="page-wrapper" style="text-align:center;">
      <div class="footer-logo">Harbour Tech</div>
      <p style="margin-top:20px;">&#169; 2026 Harbour Tech Solutions &middot; Built with PHP & Passion</p>
    </div>
  </footer>

  <script src="index.js?v=4"></script>
  <script src="particles.js?v=2"></script>
</body>
</html>
