// particles.js — Neo-Indigo 3D theme-aware particle network
(function () {
  const canvas = document.getElementById('particleCanvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let width, height, particles, mouse, animId;
  let isRunning = true;

  mouse = { x: null, y: null };

  // Theme-aware colors — Neo-Indigo palette
  function getColors() {
    const dark = document.body.classList.contains('dark-mode');
    return {
      particle: dark
        ? { r: 129, g: 140, b: 248 }   // Indigo on dark
        : { r: 79, g: 70, b: 229 },     // Deep indigo on light
      line: dark
        ? { r: 99, g: 102, b: 241 }     // Indigo
        : { r: 99, g: 102, b: 241 },
      accent: dark
        ? { r: 34, g: 211, b: 238 }     // Cyan glow
        : { r: 6, g: 182, b: 212 },
      particleOpacityRange: dark ? [0.06, 0.30] : [0.08, 0.25],
      lineMaxOpacity: dark ? 0.08 : 0.06,
      mouseLineMaxOpacity: dark ? 0.15 : 0.12,
    };
  }

  function resize() {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
  }

  window.addEventListener('resize', resize);
  resize();

  // Track mouse for interactive lines
  window.addEventListener('mousemove', function (e) {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
  });
  window.addEventListener('mouseout', function () {
    mouse.x = null;
    mouse.y = null;
  });

  // Pause when tab is hidden
  document.addEventListener('visibilitychange', function () {
    if (document.hidden) {
      isRunning = false;
      cancelAnimationFrame(animId);
    } else {
      isRunning = true;
      animate();
    }
  });

  class Particle {
    constructor() {
      this.reset();
    }
    reset() {
      this.x = Math.random() * width;
      this.y = Math.random() * height;
      this.vx = (Math.random() - 0.5) * 0.30;
      this.vy = (Math.random() - 0.5) * 0.30;
      this.radius = Math.random() * 2 + 0.5;
      this.baseOpacity = Math.random();
      // Some particles are "accent" colored
      this.isAccent = Math.random() < 0.15;
    }
    update() {
      this.x += this.vx;
      this.y += this.vy;
      if (this.x < 0) this.x = width;
      if (this.x > width) this.x = 0;
      if (this.y < 0) this.y = height;
      if (this.y > height) this.y = 0;
    }
    draw(colors) {
      const c = this.isAccent ? colors.accent : colors.particle;
      const [minO, maxO] = colors.particleOpacityRange;
      const opacity = minO + this.baseOpacity * (maxO - minO);
      ctx.beginPath();
      // Added glow effect
      ctx.shadowBlur = this.isAccent ? 12 : 5;
      ctx.shadowColor = `rgba(${c.r}, ${c.g}, ${c.b}, ${opacity * 2})`;
      ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(${c.r}, ${c.g}, ${c.b}, ${opacity})`;
      ctx.fill();
      // Reset shadow to avoid affecting lines
      ctx.shadowBlur = 0;
    }
  }

  // Adaptive particle count
  const count = Math.min(Math.floor((width * height) / 16000), 90);
  particles = [];
  for (let i = 0; i < count; i++) {
    particles.push(new Particle());
  }

  function drawLines(colors) {
    const maxDist = 130;
    const c = colors.line;
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const distSq = dx * dx + dy * dy;
        if (distSq < maxDist * maxDist) {
          const dist = Math.sqrt(distSq);
          const opacity = (1 - dist / maxDist) * colors.lineMaxOpacity;
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = `rgba(${c.r}, ${c.g}, ${c.b}, ${opacity})`;
          ctx.lineWidth = 0.5;
          ctx.stroke();
        }
      }

      // Lines to mouse — with gradient effect
      if (mouse.x !== null) {
        const dx = particles[i].x - mouse.x;
        const dy = particles[i].y - mouse.y;
        const distSq = dx * dx + dy * dy;
        const mouseRange = 200;
        if (distSq < mouseRange * mouseRange) {
          const dist = Math.sqrt(distSq);
          const opacity = (1 - dist / mouseRange) * colors.mouseLineMaxOpacity;
          const ac = colors.accent;
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(mouse.x, mouse.y);
          ctx.strokeStyle = `rgba(${ac.r}, ${ac.g}, ${ac.b}, ${opacity})`;
          ctx.lineWidth = 0.6;
          ctx.stroke();
        }
      }
    }
  }

  function animate() {
    if (!isRunning) return;
    ctx.clearRect(0, 0, width, height);
    const colors = getColors();
    particles.forEach(p => {
      p.update();
      p.draw(colors);
    });
    drawLines(colors);
    animId = requestAnimationFrame(animate);
  }

  animate();
})();
