// particles.js — Theme-aware particle network animation
(function () {
  const canvas = document.getElementById('particleCanvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let width, height, particles, mouse, animId;
  let isRunning = true;

  mouse = { x: null, y: null };

  // Theme-aware colors
  function getColors() {
    const dark = document.body.classList.contains('dark-mode');
    return {
      particle: dark
        ? { r: 129, g: 140, b: 248 }   // Light indigo on dark
        : { r: 45, g: 53, b: 128 },     // Dark navy on light
      line: dark
        ? { r: 129, g: 140, b: 248 }
        : { r: 92, g: 106, b: 196 },
      particleOpacityRange: dark ? [0.08, 0.35] : [0.10, 0.30],
      lineMaxOpacity: dark ? 0.10 : 0.08,
      mouseLineMaxOpacity: dark ? 0.18 : 0.14,
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

  // Pause when tab is hidden (battery + perf)
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
      this.vx = (Math.random() - 0.5) * 0.35;
      this.vy = (Math.random() - 0.5) * 0.35;
      this.radius = Math.random() * 1.8 + 0.6;
      this.baseOpacity = Math.random();
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
      const c = colors.particle;
      const [minO, maxO] = colors.particleOpacityRange;
      const opacity = minO + this.baseOpacity * (maxO - minO);
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(${c.r}, ${c.g}, ${c.b}, ${opacity})`;
      ctx.fill();
    }
  }

  // Adaptive particle count
  const count = Math.min(Math.floor((width * height) / 14000), 100);
  particles = [];
  for (let i = 0; i < count; i++) {
    particles.push(new Particle());
  }

  function drawLines(colors) {
    const maxDist = 140;
    const c = colors.line;
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < maxDist) {
          const opacity = (1 - dist / maxDist) * colors.lineMaxOpacity;
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = `rgba(${c.r}, ${c.g}, ${c.b}, ${opacity})`;
          ctx.lineWidth = 0.6;
          ctx.stroke();
        }
      }

      // Lines to mouse
      if (mouse.x !== null) {
        const dx = particles[i].x - mouse.x;
        const dy = particles[i].y - mouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 180) {
          const opacity = (1 - dist / 180) * colors.mouseLineMaxOpacity;
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(mouse.x, mouse.y);
          ctx.strokeStyle = `rgba(${c.r}, ${c.g}, ${c.b}, ${opacity})`;
          ctx.lineWidth = 0.7;
          ctx.stroke();
        }
      }
    }
  }

  function animate() {
    if (!isRunning) return;
    ctx.clearRect(0, 0, width, height);
    const colors = getColors(); // Re-read on each frame so theme toggle is instant
    particles.forEach(p => {
      p.update();
      p.draw(colors);
    });
    drawLines(colors);
    animId = requestAnimationFrame(animate);
  }

  animate();
})();
