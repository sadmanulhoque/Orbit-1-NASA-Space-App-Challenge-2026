document.addEventListener('DOMContentLoaded', () => {
    initStarfield();
    initModals();
    initHealthTrendsChart();
    initHotspotFeedback();
});

/* Starfield */
function initStarfield() {
    const canvas = document.getElementById('stars-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let width = canvas.width = window.innerWidth;
    let height = canvas.height = window.innerHeight;

    window.addEventListener('resize', () => {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
    });

    const stars = Array.from({ length: 120 }, () => ({
        x: Math.random() * width,
        y: Math.random() * height,
        size: Math.random() * 1.6 + 0.4,
        alpha: Math.random(),
        speed: Math.random() * 0.015 + 0.005,
        direction: Math.random() > 0.5 ? 1 : -1
    }));

    function animate() {
        ctx.clearRect(0, 0, width, height);
        stars.forEach(star => {
            star.alpha += star.speed * star.direction;
            if (star.alpha >= 1 || star.alpha <= 0.1) star.direction *= -1;
            ctx.beginPath();
            ctx.arc(star.x, star.y, star.size, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(186, 230, 253, ${star.alpha * 0.75})`;
            ctx.fill();
        });
        requestAnimationFrame(animate);
    }
    animate();
}

/* Modals */
function initModals() {
    // Questionnaire open (Edit button)
    document.getElementById('open-checkin-edit')?.addEventListener('click', () => {
        document.getElementById('modal-questionnaire')?.classList.add('active');
    });

    // Flight Surgeon
    const surgeonModal = document.getElementById('modal-surgeon');
    document.getElementById('btn-contact-surgeon')?.addEventListener('click', () => surgeonModal?.classList.add('active'));
    document.getElementById('close-surgeon-modal')?.addEventListener('click', () => surgeonModal?.classList.remove('active'));
    document.getElementById('cancel-surgeon-modal')?.addEventListener('click', () => surgeonModal?.classList.remove('active'));
    document.getElementById('send-surgeon-modal')?.addEventListener('click', () => {
        surgeonModal?.classList.remove('active');
        showToast('Telemetry & Message Transmitted to Flight Surgeon', 'fa-solid fa-satellite-dish');
    });

    // Hazards
    const hazardsModal = document.getElementById('modal-hazards');
    document.getElementById('open-hazards-modal')?.addEventListener('click', () => hazardsModal?.classList.add('active'));
    document.getElementById('close-hazards-modal')?.addEventListener('click', () => hazardsModal?.classList.remove('active'));
    document.getElementById('ack-hazards-modal')?.addEventListener('click', () => hazardsModal?.classList.remove('active'));

    // Outside click close
    window.addEventListener('click', (e) => {
        if (e.target === surgeonModal) surgeonModal.classList.remove('active');
        if (e.target === hazardsModal) hazardsModal.classList.remove('active');
    });
}

function showToast(message, iconClass = 'fa-solid fa-info-circle') {
    const container = document.getElementById('toast-container');
    if (!container) return;
    const toast = document.createElement('div');
    toast.className = 'hud-toast';
    toast.innerHTML = `<i class="${iconClass}" style="color: var(--neon-cyan);"></i><span>${message}</span>`;
    container.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
}

/* Simple chart */
function initHealthTrendsChart() {
    const canvas = document.getElementById('healthTrendsCanvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    const currentHR = parseInt(document.querySelector('.tooltip-val')?.textContent.match(/\d+/)?.[0]) || 72;

    const data = {
        hr: [78, 85, 75, currentHR],
        bp: [120, 126, 122, 118],
        temp: [36.7, 36.8, 36.6, 36.6]
    };

    function resize() {
        const rect = canvas.getBoundingClientRect();
        canvas.width = rect.width * devicePixelRatio;
        canvas.height = rect.height * devicePixelRatio;
        ctx.scale(devicePixelRatio, devicePixelRatio);
        draw();
    }

    function getY(val, min, max, h) {
        return h - 15 - ((val - min) / (max - min)) * (h - 30);
    }

    function drawLine(points, color) {
        ctx.beginPath();
        ctx.strokeStyle = color;
        ctx.lineWidth = 2.5;
        ctx.lineCap = 'round';
        ctx.moveTo(points[0].x, points[0].y);
        for (let i = 0; i < points.length - 1; i++) {
            const mid = (points[i].x + points[i+1].x) / 2;
            ctx.bezierCurveTo(mid, points[i].y, mid, points[i+1].y, points[i+1].x, points[i+1].y);
        }
        ctx.stroke();
        points.forEach((p, i) => {
            ctx.beginPath();
            ctx.arc(p.x, p.y, i === points.length-1 ? 4.5 : 3, 0, Math.PI*2);
            ctx.fillStyle = '#fff';
            ctx.fill();
        });
    }

    function draw() {
        const rect = canvas.getBoundingClientRect();
        const w = rect.width, h = rect.height;
        ctx.clearRect(0, 0, w, h);
        ctx.strokeStyle = 'rgba(56,189,248,0.08)';
        for (let i = 0; i < 4; i++) {
            ctx.beginPath();
            ctx.moveTo(0, (h/3)*i);
            ctx.lineTo(w, (h/3)*i);
            ctx.stroke();
        }
        const step = w / 3;
        drawLine(data.hr.map((v,i) => ({x: i*step, y: getY(v,60,150,h)})), '#d946ef');
        drawLine(data.bp.map((v,i) => ({x: i*step, y: getY(v,60,150,h)})), '#38bdf8');
        drawLine(data.temp.map((v,i) => ({x: i*step, y: getY(60 + ((v-36)/1.5)*35, 60,150,h)})), '#10b981');
    }

    window.addEventListener('resize', resize);
    setTimeout(resize, 50);
}

function initHotspotFeedback() {
    document.querySelectorAll('.holo-hotspot').forEach(el => {
        el.addEventListener('click', () => {
            el.style.transform = 'scale(1.08)';
            setTimeout(() => el.style.transform = '', 300);
        });
    });
}
