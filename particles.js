// particles.js — Harbour Tech — Ultra Smooth & Integrated
(function () {
  const canvas = document.getElementById('particleCanvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let width, height, particles, mouse, animId;
  let isRunning = true;

  mouse = { x: null, y: null };

  // ── Particle Configuration ──────────────────────────────────
  const config = {
    count: 80, // Slightly fewer for a cleaner look
    minRadius: 1.2,
    maxRadius: 3.5,
    minSpeed: 0.05, // Slower movement (was 0.2)
    maxSpeed: 0.15, // Slower movement (was 0.6)
    maxLineDist: 150,
    mouseDist: 200,
    colors: [
      { r: 99, g: 102, b: 241 }, // Indigo
      { r: 6, g: 182, b: 212 },  // Cyan
      { r: 255, g: 255, b: 255 } // White
    ]
  };

  function resize() {
    // If inside a container, use container dimensions
    const parent = canvas.parentElement;
    width = canvas.width = parent.clientWidth || window.innerWidth;
    height = canvas.height = parent.clientHeight || window.innerHeight;
  }
  
  window.addEventListener('resize', () => {
    resize();
    initParticles();
  });
  resize();

  // Mouse tracking relative to the canvas if it's not fixed
  window.addEventListener('mousemove', e => {
    const rect = canvas.getBoundingClientRect();
    mouse.x = e.clientX - rect.left;
    mouse.y = e.clientY - rect.top;
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
      this.opacity = 0.5 + Math.random() * 0.5;
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
      const pOpacity = this.opacity * (0.7 + 0.3 * Math.sin(this.pulse));
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
      
      ctx.shadowBlur = 12;
      ctx.shadowColor = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${pOpacity})`;
      
      ctx.fillStyle = `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${pOpacity})`;
      ctx.fill();
      
      ctx.shadowBlur = 0;
    }
  }

  function initParticles() {
    particles = [];
    // Adjust density
    const count = Math.min(config.count, Math.floor((width * height) / 15000));
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
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < config.maxLineDist) {
          const opacity = (1 - dist / config.maxLineDist) * 0.3;
          ctx.beginPath();
          ctx.moveTo(p1.x, p1.y);
          ctx.lineTo(p2.x, p2.y);
          ctx.strokeStyle = `rgba(129, 140, 248, ${opacity})`;
          ctx.lineWidth = 0.8;
          ctx.stroke();
        }
      }

      if (mouse.x !== null) {
        const dx = p1.x - mouse.x;
        const dy = p1.y - mouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < config.mouseDist) {
          const opacity = (1 - dist / config.mouseDist) * 0.5;
          ctx.beginPath();
          ctx.moveTo(p1.x, p1.y);
          ctx.lineTo(mouse.x, mouse.y);
          ctx.strokeStyle = `rgba(34, 211, 238, ${opacity})`;
          ctx.lineWidth = 1.2;
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
