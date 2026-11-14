/**
 * NASA ASTRONAUT BIOMETRIC HUD - INTERACTIVE LOGIC
 * NasaSpaceAppChallengeDesign
 */

document.addEventListener('DOMContentLoaded', () => {
  initStarfield();
  initReadinessGauge();
  initHealthTrendsChart();
  initModalsAndToasts();
  initHotspotFeedback();
});



/* ==========================================================================
   2. Dynamic Cosmic Starfield & Space Dust
   ========================================================================== */
function initStarfield() {
  const canvas = document.getElementById('stars-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');

  let width = (canvas.width = window.innerWidth);
  let height = (canvas.height = window.innerHeight);

  window.addEventListener('resize', () => {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
  });

  const stars = [];
  const starCount = 120;

  for (let i = 0; i < starCount; i++) {
    stars.push({
      x: Math.random() * width,
      y: Math.random() * height,
      size: Math.random() * 1.6 + 0.4,
      alpha: Math.random(),
      speed: Math.random() * 0.015 + 0.005,
      direction: Math.random() > 0.5 ? 1 : -1
    });
  }

  function animateStars() {
    ctx.clearRect(0, 0, width, height);

    stars.forEach(star => {
      star.alpha += star.speed * star.direction;
      if (star.alpha >= 1) {
        star.alpha = 1;
        star.direction = -1;
      } else if (star.alpha <= 0.1) {
        star.alpha = 0.1;
        star.direction = 1;
      }

      ctx.beginPath();
      ctx.arc(star.x, star.y, star.size, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(186, 230, 253, ${star.alpha * 0.75})`;
      ctx.fill();
    });

    requestAnimationFrame(animateStars);
  }

  animateStars();
}

/* ==========================================================================
   3. Mission Readiness Radial Gauge Animation
   ========================================================================== */
function initReadinessGauge() {
  const gaugeFill = document.getElementById('readiness-gauge-fill');
  const gaugeNumber = document.querySelector('.gauge-number');
  if (!gaugeFill || !gaugeNumber) return;

  const targetPercent = 92;
  const radius = 54;
  const circumference = 2 * Math.PI * radius; // ~339.29

  gaugeFill.style.strokeDasharray = `${circumference} ${circumference}`;
  gaugeFill.style.strokeDashoffset = circumference;

  let current = 0;
  const duration = 1600;
  const start = performance.now();

  function animateGauge(time) {
    const elapsed = time - start;
    const progress = Math.min(elapsed / duration, 1);
    // Ease out cubic
    const eased = 1 - Math.pow(1 - progress, 3);

    current = Math.round(eased * targetPercent);
    gaugeNumber.textContent = current;

    const offset = circumference - (eased * targetPercent / 100) * circumference;
    gaugeFill.style.strokeDashoffset = offset;

    if (progress < 1) {
      requestAnimationFrame(animateGauge);
    }
  }

  requestAnimationFrame(animateGauge);
}

/* ==========================================================================
   4. Health Trends Canvas Chart
   ========================================================================== */
function initHealthTrendsChart() {
  const canvas = document.getElementById('healthTrendsCanvas');
  const marker = document.getElementById('chart-marker');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');

  // Datasets for 7D, 30D, and Mission
  const datasets = {
    '7d': {
      hr: [78, 85, 75, 72],
      bp: [120, 126, 122, 118],
      temp: [36.7, 36.8, 36.6, 36.6],
      labels: ['Day 6', 'Day 8', 'Day 10', 'Day 12'],
      activeTooltip: { title: 'Day 12', value: 'HR: 72 bpm', index: 3 }
    },
    '30d': {
      hr: [80, 76, 79, 72],
      bp: [124, 120, 122, 118],
      temp: [36.6, 36.7, 36.6, 36.6],
      labels: ['Day 1', 'Day 10', 'Day 20', 'Day 30'],
      activeTooltip: { title: 'Day 30', value: 'HR: 72 bpm', index: 3 }
    },
    'mission': {
      hr: [82, 80, 78, 72],
      bp: [128, 124, 120, 118],
      temp: [36.8, 36.7, 36.6, 36.6],
      labels: ['Launch', 'Orbit', 'Lunar', 'Current'],
      activeTooltip: { title: 'Current', value: 'HR: 72 bpm', index: 3 }
    }
  };

  let currentKey = '7d';
  let animProgress = 1;

  function resizeCanvas() {
    const rect = canvas.getBoundingClientRect();
    canvas.width = rect.width * window.devicePixelRatio;
    canvas.height = rect.height * window.devicePixelRatio;
    ctx.scale(window.devicePixelRatio, window.devicePixelRatio);
    drawChart();
  }

  function getScaledY(val, minVal, maxVal, height) {
    const padding = 15;
    const availableHeight = height - padding * 2;
    const norm = (val - minVal) / (maxVal - minVal);
    return height - padding - norm * availableHeight;
  }

  function drawSmoothLine(ctx, points, color, lineWidth = 2.5) {
    if (points.length < 2) return;

    ctx.save();
    ctx.beginPath();
    ctx.strokeStyle = color;
    ctx.lineWidth = lineWidth;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    ctx.moveTo(points[0].x, points[0].y);

    for (let i = 0; i < points.length - 1; i++) {
      const p0 = points[i];
      const p1 = points[i + 1];
      const midX = (p0.x + p1.x) / 2;
      ctx.bezierCurveTo(midX, p0.y, midX, p1.y, p1.x, p1.y);
    }
    ctx.stroke();

    // Draw restrained point markers
    points.forEach((pt, idx) => {
      ctx.beginPath();
      ctx.arc(pt.x, pt.y, idx === points.length - 1 ? 4.5 : 3, 0, Math.PI * 2);
      ctx.fillStyle = '#ffffff';
      ctx.fill();
    });

    ctx.restore();
  }

  function drawChart() {
    const rect = canvas.getBoundingClientRect();
    const width = rect.width;
    const height = rect.height;

    ctx.clearRect(0, 0, width, height);

    // Draw subtle grid lines
    ctx.save();
    ctx.strokeStyle = 'rgba(56, 189, 248, 0.08)';
    ctx.lineWidth = 1;
    for (let i = 0; i < 4; i++) {
      const y = (height / 3) * i;
      ctx.beginPath();
      ctx.moveTo(0, y);
      ctx.lineTo(width, y);
      ctx.stroke();
    }
    ctx.restore();

    const data = datasets[currentKey];
    const n = data.hr.length;
    const stepX = width / (n - 1);

    // Heart Rate (Magenta)
    const hrPoints = data.hr.map((v, i) => ({
      x: i * stepX,
      y: getScaledY(v, 60, 150, height)
    }));
    drawSmoothLine(ctx, hrPoints, '#d946ef', 2.5);

    // Blood Pressure (Electric Blue)
    const bpPoints = data.bp.map((v, i) => ({
      x: i * stepX,
      y: getScaledY(v, 60, 150, height)
    }));
    drawSmoothLine(ctx, bpPoints, '#38bdf8', 2.5);

    // Temperature (Neon Green/Cyan)
    const tempPoints = data.temp.map((v, i) => {
      // Map 36.0 - 37.5 to scale
      const norm = (v - 36.0) / 1.5;
      const pseudoVal = 60 + norm * 35;
      return {
        x: i * stepX,
        y: getScaledY(pseudoVal, 60, 150, height)
      };
    });
    drawSmoothLine(ctx, tempPoints, '#10b981', 2.5);
  }

  window.addEventListener('resize', resizeCanvas);
  setTimeout(resizeCanvas, 50);

  // Filter tabs click handling
  const tabButtons = document.querySelectorAll('.trend-tab-btn');
  tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      tabButtons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      currentKey = btn.getAttribute('data-range');

      // Update X axis text labels
      const xAxisEl = document.querySelector('.chart-x-axis');
      if (xAxisEl && datasets[currentKey]) {
        const labels = datasets[currentKey].labels;
        xAxisEl.innerHTML = labels
          .map((lbl, idx) => `<span class="${idx === labels.length - 1 ? 'active-day' : ''}">${lbl}</span>`)
          .join('');
      }

      // Update active marker tooltip
      if (marker && datasets[currentKey]) {
        const tt = datasets[currentKey].activeTooltip;
        marker.querySelector('.tooltip-title').textContent = tt.title;
        marker.querySelector('.tooltip-val').innerHTML = `<span class="tt-dot"></span> ${tt.value}`;
      }

      drawChart();
    });
  });
}

/* ==========================================================================
   5. Static Astronaut Hotspot Feedback
   ========================================================================== */
function initHotspotFeedback() {
  document.querySelectorAll('.holo-hotspot').forEach(hotspot => {
    hotspot.addEventListener('click', () => {
      hotspot.style.transform = 'scale(1.08)';
      setTimeout(() => {
        hotspot.style.transform = '';
      }, 300);
    });
  });
}

/* ==========================================================================
   6. Modals, Action Triggers & Toasts
   ========================================================================== */
function initModalsAndToasts() {
  // Flight Surgeon Modal
  const surgeonModal = document.getElementById('modal-surgeon');
  const btnContactSurgeon = document.getElementById('btn-contact-surgeon');
  const btnCloseSurgeon = document.getElementById('close-surgeon-modal');
  const btnCancelSurgeon = document.getElementById('cancel-surgeon-modal');
  const btnSendSurgeon = document.getElementById('send-surgeon-modal');

  if (btnContactSurgeon && surgeonModal) {
    btnContactSurgeon.addEventListener('click', () => {
      surgeonModal.classList.add('active');
    });
  }

  const closeSurgeon = () => {
    if (surgeonModal) surgeonModal.classList.remove('active');
  };

  if (btnCloseSurgeon) btnCloseSurgeon.addEventListener('click', closeSurgeon);
  if (btnCancelSurgeon) btnCancelSurgeon.addEventListener('click', closeSurgeon);

  if (btnSendSurgeon) {
    btnSendSurgeon.addEventListener('click', () => {
      closeSurgeon();
      showToast('Telemetry & Message Transmitted to Flight Surgeon', 'fa-solid fa-satellite-dish');
    });
  }

  // NASA's 5 Hazards Modal
  const hazardsModal = document.getElementById('modal-hazards');
  const btnOpenHazards = document.getElementById('open-hazards-modal');
  const btnCloseHazards = document.getElementById('close-hazards-modal');
  const btnAckHazards = document.getElementById('ack-hazards-modal');

  if (btnOpenHazards && hazardsModal) {
    btnOpenHazards.addEventListener('click', () => {
      hazardsModal.classList.add('active');
    });
  }

  const closeHazards = () => {
    if (hazardsModal) hazardsModal.classList.remove('active');
  };

  if (btnCloseHazards) btnCloseHazards.addEventListener('click', closeHazards);
  if (btnAckHazards) btnAckHazards.addEventListener('click', closeHazards);

  // Daily Check-in Edit Button
  const btnEditCheckin = document.getElementById('open-checkin-edit');
  if (btnEditCheckin) {
    btnEditCheckin.addEventListener('click', () => {
      showToast('Check-in Log Updated - All vitals locked to baseline', 'fa-solid fa-check');
    });
  }

  // Close modals on outside backdrop click
  window.addEventListener('click', (e) => {
    if (e.target === surgeonModal) closeSurgeon();
    if (e.target === hazardsModal) closeHazards();
  });
}

function showToast(message, iconClass = 'fa-solid fa-info-circle') {
  const container = document.getElementById('toast-container');
  if (!container) return;

  const toast = document.createElement('div');
  toast.className = 'hud-toast';
  toast.innerHTML = `
    <i class="${iconClass}" style="color: var(--neon-cyan); font-size: 1.1rem;"></i>
    <span>${message}</span>
  `;

  container.appendChild(toast);

  setTimeout(() => {
    if (toast.parentElement) {
      toast.remove();
    }
  }, 4000);
}
