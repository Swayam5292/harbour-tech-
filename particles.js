// particles.js — Harbour Tech — ULTRA Visibility Edition (Light Mode Focused)
(function () {
  const canvas = document.getElementById('particleCanvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let width, height, particles, mouse, animId;
  let isRunning = true;

  mouse = { x: null, y: null };

  // ── Particle Configuration ──────────────────────────────────
  const config = {
    count: 140, 
    minRadius: 2.5, // Much larger base radius
    maxRadius: 6.0, // Much larger max radius
    minSpeed: 0.2,
    maxSpeed: 0.5,
    maxLineDist: 180,
    mouseDist: 250,
    // Solid high-contrast colors for visibility on light backgrounds
    colors: [
      { r: 49, g: 46, b: 129 },  // Indigo-900
      { r: 30, g: 27, b: 75 },   // Indigo-950
      { r: 8, g: 47, b: 73 },    // Sky-950
      { r: 2, g: 132, b: 199 }   // Deep Sky-600
    ]
  };

  function resize() {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
  }
  window.addEventListener('resize', () => {
    resize();
    initParticles();
  });
  resize();

  window.addEventListener('mousemove', e => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
  }, { passive: true });

  window.addEventListener('mouseleave', () => {
    mouse.x = null;
    mouse.y = null;
  });

  class Particle {
    constructor() {
      this.init();
    }

    init() {
      this.x = Math.random() * width;
      this.y = Math.random() * height;
      this.radius = config.minRadius + Math.random() * (config.maxRadius - config.minRadius);
      
      const angle = Math.random() * Math.PI * 2;
      const speed = config.minSpeed + Math.random() * (config.maxSpeed - config.minSpeed);
      this.vx = Math.cos(angle) * speed;
      this.vy = Math.sin(angle) * speed;

      const colorIdx = Math.floor(Math.random() * config.colors.length);
      this.color = config.colors[colorIdx];
      // Solid opacity (0.75 to 1.0) for maximum visibility
      this.opacity = 0.75 + Math.random() * 0.25;
      this.pulse = Math.random() * Math.PI;
    }

    update() {
      this.x += this.vx;
      this.y += this.vy;

      if (this.x < 0) this.x = width;
      else if (this.x > width) this.x = 0;
      if (this.y < 0) this.y = height;
      else if (this.y > height) this.y = 0;

      this.pulse += 0.02;
    }

    draw() {
      const pOpacity = this.opacity * (0.85 + 0.15 * Math.sin(this.pulse));
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
      
      // Shadow for subtle "lift" effect
      ctx.shadowBlur = 4;
      ctx.shadowColor = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, 0.3)`;
      
      ctx.fillStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${pOpacity})`;
      ctx.fill();
      
      ctx.shadowBlur = 0;
    }
  }

  function initParticles() {
    particles = [];
    const count = Math.min(config.count, Math.floor((width * height) / 10000));
    for (let i = 0; i < count; i++) {
      particles.push(new Particle());
    }
  }
  initParticles();

  function drawLines() {
    for (let i = 0; i < particles.length; i++) {
      const p1 = particles[i];

      for (let j = i + 1; j < particles.length; j++) {
        const p2 = particles[j];
        const dx = p1.x - p2.x;
        const dy = p1.y - p2.y;
        const distSq = dx * dx + dy * dy;
        const maxDistSq = config.maxLineDist * config.maxLineDist;

        if (distSq < maxDistSq) {
          const dist = Math.sqrt(distSq);
          // Darker, thicker lines (up to 0.5 opacity)
          const opacity = (1 - dist / config.maxLineDist) * 0.5;
          ctx.beginPath();
          ctx.moveTo(p1.x, p1.y);
          ctx.lineTo(p2.x, p2.y);
          ctx.strokeStyle = `rgba(49, 46, 129, ${opacity})`;
          ctx.lineWidth = 1.2;
          ctx.stroke();
        }
      }

      if (mouse.x !== null) {
        const dx = p1.x - mouse.x;
        const dy = p1.y - mouse.y;
        const distSq = dx * dx + dy * dy;
        const mouseDistSq = config.mouseDist * config.mouseDist;

        if (distSq < mouseDistSq) {
          const dist = Math.sqrt(distSq);
          const opacity = (1 - dist / config.mouseDist) * 0.7;
          ctx.beginPath();
          ctx.moveTo(p1.x, p1.y);
          ctx.lineTo(mouse.x, mouse.y);
          ctx.strokeStyle = `rgba(2, 132, 212, ${opacity})`;
          ctx.lineWidth = 2.0;
          ctx.stroke();
        }
      }
    }
  }

  function animate() {
    if (!isRunning) return;
    ctx.clearRect(0, 0, width, height);

    particles.forEach(p => {
      p.update();
      p.draw();
    });

    drawLines();
    animId = requestAnimationFrame(animate);
  }

  document.addEventListener('visibilitychange', () => {
    isRunning = !document.hidden;
    if (isRunning) animate();
  });

  animate();
})();
