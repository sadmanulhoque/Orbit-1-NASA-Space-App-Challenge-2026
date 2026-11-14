@extends('frontend.layout.master')
@section('content')
    <!-- LEFT COLUMN -->
    <section class="grid-col col-left">
        <!-- Card: Mission Readiness -->
        <div class="glass-card mission-readiness-card" id="mission-readiness">
            <div class="card-head">
                <div class="head-title">
                    <span class="head-icon cyan-glow"><i class="fa-solid fa-heart-pulse"></i></span>
                    <h2>Mission Readiness</h2>
                </div>
            </div>

            <div class="card-body gauge-body">
                <div class="gauge-wrapper">
                    <!-- Radial Progress Gauge -->
                    <svg class="radial-gauge" viewBox="0 0 140 140">
                        <circle class="gauge-track" cx="70" cy="70" r="54"></circle>
                        <circle class="gauge-fill" id="readiness-gauge-fill" cx="70" cy="70" r="54" stroke-dasharray="339.292" stroke-dashoffset="27.14"></circle>
                    </svg>
                    <div class="gauge-value-box">
                        <span class="gauge-number">92</span><span class="gauge-percent">%</span>
                    </div>
                </div>

                <div class="gauge-info">
                    <div class="status-tag status-excellent">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Excellent</span>
                    </div>
                    <p class="gauge-desc">You're on track for a successful mission.</p>
                </div>
            </div>

            <div class="card-footer-pill">
                <div class="streak-pill">
                    <i class="fa-solid fa-star streak-star"></i>
                    <span>Streak: <strong>12 Days</strong></span>
                </div>
            </div>
        </div>

        <!-- Card: NASA's 5 Hazards -->
        <div class="glass-card hazards-card" id="nasa-hazards">
            <div class="card-head">
                <div class="head-title">
                    <span class="head-icon blue-glow"><i class="fa-solid fa-shield-halved"></i></span>
                    <h2>NASA's 5 Hazards</h2>
                </div>
                <button class="link-btn" id="open-hazards-modal">
                    View Details <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <div class="hazards-list">
                <!-- 1. Radiation -->
                <div class="hazard-row">
                    <div class="hazard-label">
                        <span class="hazard-icon color-amber"><i class="fa-solid fa-radiation"></i></span>
                        <span class="hazard-name">Radiation</span>
                    </div>
                    <div class="hazard-bar-container">
                        <div class="hazard-bar bar-amber" style="width: 58%"></div>
                    </div>
                    <div class="hazard-badge badge-amber">Medium</div>
                </div>

                <!-- 2. Isolation -->
                <div class="hazard-row">
                    <div class="hazard-label">
                        <span class="hazard-icon color-green"><i class="fa-solid fa-users"></i></span>
                        <span class="hazard-name">Isolation</span>
                    </div>
                    <div class="hazard-bar-container">
                        <div class="hazard-bar bar-green" style="width: 28%"></div>
                    </div>
                    <div class="hazard-badge badge-green">Low</div>
                </div>

                <!-- 3. Distance -->
                <div class="hazard-row">
                    <div class="hazard-label">
                        <span class="hazard-icon color-cyan"><i class="fa-solid fa-globe"></i></span>
                        <span class="hazard-name">Distance</span>
                    </div>
                    <div class="hazard-bar-container">
                        <div class="hazard-bar bar-cyan" style="width: 32%"></div>
                    </div>
                    <div class="hazard-badge badge-cyan">Low</div>
                </div>

                <!-- 4. Gravity -->
                <div class="hazard-row">
                    <div class="hazard-label">
                        <span class="hazard-icon color-amber"><i class="fa-solid fa-ring"></i></span>
                        <span class="hazard-name">Gravity</span>
                    </div>
                    <div class="hazard-bar-container">
                        <div class="hazard-bar bar-amber" style="width: 62%"></div>
                    </div>
                    <div class="hazard-badge badge-amber">Medium</div>
                </div>

                <!-- 5. Closed Environment -->
                <div class="hazard-row">
                    <div class="hazard-label">
                        <span class="hazard-icon color-green"><i class="fa-solid fa-house-chimney-window"></i></span>
                        <span class="hazard-name">Closed Environment</span>
                    </div>
                    <div class="hazard-bar-container">
                        <div class="hazard-bar bar-green" style="width: 25%"></div>
                    </div>
                    <div class="hazard-badge badge-green">Low</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CENTER STAGE (STATIC ASTRONAUT & HEALTH TRENDS) -->
    <section class="grid-col col-center">
        <!-- Astronaut Stage -->
        <div class="astronaut-viewport-stage" id="astronaut-stage">
            <div class="astronaut-static-layer">
                <img
                    src="{{ asset('assets/body-transparent.png') }}"
                    alt="Astronaut"
                    class="astronaut-static-img"
                    onerror="this.src = 'images/body.png'"
                />
            </div>

            <!-- Holographic Anatomy Callouts -->
            <!-- Brain Hotspot (Top Left) -->
            <div class="holo-hotspot hotspot-brain" data-target="brain" title="Click to inspect Brain Telemetry">
                <div class="hotspot-card">
                    <div class="hotspot-icon-box cyan">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <div class="hotspot-text">
                        <div class="hotspot-title-row">
                            <span class="hotspot-title">Brain</span>
                            <span class="hotspot-status status-normal"><span class="dot"></span>Normal</span>
                        </div>
                        <div class="hotspot-desc">Cognitive function is stable.</div>
                    </div>
                </div>
                <div class="hotspot-line line-brain"></div>
            </div>

            <!-- Heart Hotspot (Top Right) -->
            <div class="holo-hotspot hotspot-heart" data-target="heart" title="Click to inspect Heart Telemetry">
                <div class="hotspot-card">
                    <div class="hotspot-icon-box red">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <div class="hotspot-text">
                        <div class="hotspot-title-row">
                            <span class="hotspot-title">Heart</span>
                            <span class="hotspot-status status-normal"><span class="dot"></span>Normal</span>
                        </div>
                        <div class="hotspot-desc">HR in range</div>
                    </div>
                </div>
                <div class="hotspot-line line-heart"></div>
            </div>

            <!-- Bones Hotspot (Mid Left) -->
            <div class="holo-hotspot hotspot-bones" data-target="bones" title="Click to inspect Bone Density">
                <div class="hotspot-card">
                    <div class="hotspot-icon-box amber">
                        <i class="fa-solid fa-bone"></i>
                    </div>
                    <div class="hotspot-text">
                        <div class="hotspot-title-row">
                            <span class="hotspot-title">Bones</span>
                            <span class="hotspot-status status-watch"><span class="dot"></span>Watch</span>
                        </div>
                        <div class="hotspot-desc">Bone density slightly low.</div>
                    </div>
                </div>
                <div class="hotspot-line line-bones"></div>
            </div>

            <!-- Eyes Hotspot (Mid Right) -->
            <div class="holo-hotspot hotspot-eyes" data-target="eyes" title="Click to inspect Vision Telemetry">
                <div class="hotspot-card">
                    <div class="hotspot-icon-box cyan">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <div class="hotspot-text">
                        <div class="hotspot-title-row">
                            <span class="hotspot-title">Eyes</span>
                            <span class="hotspot-status status-normal"><span class="dot"></span>Normal</span>
                        </div>
                        <div class="hotspot-desc">Vision stable.</div>
                    </div>
                </div>
                <div class="hotspot-line line-eyes"></div>
            </div>

            <!-- Immune Hotspot (Lower Left) -->
            <div class="holo-hotspot hotspot-immune" data-target="immune" title="Click to inspect Immune Response">
                <div class="hotspot-card">
                    <div class="hotspot-icon-box blue">
                        <i class="fa-solid fa-shield-virus"></i>
                    </div>
                    <div class="hotspot-text">
                        <div class="hotspot-title-row">
                            <span class="hotspot-title">Immune</span>
                            <span class="hotspot-status status-normal"><span class="dot"></span>Normal</span>
                        </div>
                        <div class="hotspot-desc">Immune response is good.</div>
                    </div>
                </div>
                <div class="hotspot-line line-immune"></div>
            </div>
        </div>

        <!-- Card: Health Trends (Bottom Center) -->
        <div class="glass-card health-trends-card">
            <div class="card-head">
                <div class="head-title">
                    <span class="head-icon blue-glow"><i class="fa-solid fa-chart-simple"></i></span>
                    <h2>Health Trends</h2>
                </div>

                <!-- Timeframe Filter Tabs -->
                <div class="trend-tabs">
                    <button class="trend-tab-btn active" data-range="7d">7D</button>
                    <button class="trend-tab-btn" data-range="30d">30D</button>
                    <button class="trend-tab-btn" data-range="mission">Mission</button>
                </div>
            </div>

            <!-- Legend Bar -->
            <div class="trend-legend">
                <div class="legend-item"><span class="legend-dot dot-magenta"></span> Heart Rate</div>
                <div class="legend-item"><span class="legend-dot dot-blue"></span> Blood Pressure</div>
                <div class="legend-item"><span class="legend-dot dot-cyan"></span> Temperature</div>
            </div>

            <!-- Chart Area -->
            <div class="chart-container-box">
                <div class="chart-y-axis">
                    <span>150</span>
                    <span>120</span>
                    <span>90</span>
                    <span>60</span>
                </div>
                <div class="chart-canvas-wrapper">
                    <canvas id="healthTrendsCanvas"></canvas>

                    <!-- Active Tooltip Marker for Day 12 -->
                    <div class="chart-tooltip-marker" id="chart-marker">
                        <div class="tooltip-box">
                            <div class="tooltip-title">Day 12</div>
                            <div class="tooltip-val"><span class="tt-dot"></span> HR: 72 bpm</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- X-Axis Labels -->
            <div class="chart-x-axis">
                <span>Day 6</span>
                <span>Day 8</span>
                <span>Day 10</span>
                <span class="active-day">Day 12</span>
            </div>
        </div>
    </section>

    <!-- RIGHT COLUMN -->
    <section class="grid-col col-right">
        <!-- Card: Daily Check-in -->
        <div class="glass-card daily-checkin-card" id="daily-checkin">
            <div class="card-head">
                <div class="head-title">
                    <span class="head-icon blue-glow"><i class="fa-regular fa-calendar-days"></i></span>
                    <h2>Health Status</h2>
                </div>
                <button class="edit-pill-btn" id="open-checkin-edit"><i class="fa-solid fa-pencil"></i> Edit</button>
            </div>

            <div class="vitals-table">
                <!-- Heart Rate -->
                <div class="vital-row">
                    <div class="vital-name-group">
                        <span class="vital-icon icon-red"><i class="fa-solid fa-heart-pulse"></i></span>
                        <span class="vital-name">Heart Rate</span>
                    </div>
                    <div class="vital-value-group">
                        <span class="vital-val" id="val-heart-rate">72</span>
                        <span class="vital-unit">bpm</span>
                        <!-- Mini ECG sparkline -->
                        <svg class="vital-sparkline" viewBox="0 0 45 18">
                            <path d="M0,9 L12,9 L15,2 L19,16 L23,5 L26,11 L29,9 L45,9" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>

                <!-- Blood Pressure -->
                <div class="vital-row">
                    <div class="vital-name-group">
                        <span class="vital-icon icon-cyan"><i class="fa-solid fa-droplet"></i></span>
                        <span class="vital-name">Blood Pressure</span>
                    </div>
                    <div class="vital-value-group">
                        <span class="vital-val" id="val-bp">118/76</span>
                        <span class="vital-unit">mmHg</span>
                    </div>
                </div>

                <!-- Temperature -->
                <div class="vital-row">
                    <div class="vital-name-group">
                        <span class="vital-icon icon-cyan"><i class="fa-solid fa-temperature-half"></i></span>
                        <span class="vital-name">Temperature</span>
                    </div>
                    <div class="vital-value-group">
                        <span class="vital-val" id="val-temp">36.6</span>
                        <span class="vital-unit">°C</span>
                    </div>
                </div>

                <!-- Blood Glucose -->
                <div class="vital-row">
                    <div class="vital-name-group">
                        <span class="vital-icon icon-blue"><i class="fa-solid fa-tint"></i></span>
                        <span class="vital-name">Blood Glucose</span>
                    </div>
                    <div class="vital-value-group">
                        <span class="vital-val" id="val-glucose">92</span>
                        <span class="vital-unit">mg/dL</span>
                    </div>
                </div>

                <!-- Sleep Hours -->
                <div class="vital-row">
                    <div class="vital-name-group">
                        <span class="vital-icon icon-purple"><i class="fa-solid fa-moon"></i></span>
                        <span class="vital-name">Sleep Hours</span>
                    </div>
                    <div class="vital-value-group">
                        <span class="vital-val" id="val-sleep">7.5</span>
                        <span class="vital-unit">h</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Status Banner -->
            <div class="checkin-status-banner">
                <div class="status-check-circle">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="banner-texts">
                    <div class="banner-main">All Readings Normal</div>
                    <div class="banner-sub">Compared to your baseline</div>
                </div>
            </div>
        </div>

        <!-- Card: Action Guidance -->
        <div class="glass-card action-guidance-card" id="action-guidance">
            <div class="card-head">
                <div class="head-title">
                    <span class="head-icon yellow-glow"><i class="fa-solid fa-lightbulb"></i></span>
                    <h2>Action Guidance</h2>
                </div>
            </div>

            <!-- Warning Notice Box -->
            <div class="guidance-alert-box">
                <div class="alert-icon-col">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="alert-msg">Your bone density is slightly low compared to baseline.</div>
            </div>

            <!-- Recommended Checklist -->
            <ul class="guidance-checklist">
                <li>
                    <span class="check-pill"><i class="fa-solid fa-check"></i></span>
                    <span>Do resistance exercises</span>
                </li>
                <li>
                    <span class="check-pill"><i class="fa-solid fa-check"></i></span>
                    <span>Ensure adequate nutrition (Calcium + Vitamin D)</span>
                </li>
                <li>
                    <span class="check-pill"><i class="fa-solid fa-check"></i></span>
                    <span>Recheck in next check-in</span>
                </li>
            </ul>

            <!-- Primary CTA Button -->
            <button class="btn-primary-cta" id="btn-contact-surgeon">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Contact Flight Surgeon</span>
            </button>
        </div>
    </section>

    <!-- MODAL: Contact Flight Surgeon -->
    <div class="hud-modal" id="modal-surgeon">
        <div class="hud-modal-dialog">
            <div class="hud-modal-header">
                <div class="modal-title-wrap">
                    <i class="fa-solid fa-user-doctor text-cyan"></i>
                    <h3>Flight Surgeon Comms Uplink</h3>
                </div>
                <button class="modal-close-btn" id="close-surgeon-modal">&times;</button>
            </div>
            <div class="hud-modal-body">
                <div class="comm-channel-badge">
                    <span class="dot-online"></span> Channel Active: Station Telemetry Link #04
                </div>
                <div class="form-group mb-3">
                    <label class="hud-label">Telemetry Snapshot</label>
                    <div class="telemetry-mini-preview">
                        <span>HR: 72 bpm</span>
                        <span>BP: 118/76</span>
                        <span>Bone Alert: Active</span>
                        <span>Readiness: 92%</span>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="hud-label" for="surgeon-msg">Message to Flight Surgeon</label>
                    <textarea
                        id="surgeon-msg"
                        class="hud-input"
                        rows="3"
                        placeholder="Describe symptoms, exercise routine, or request advice..."
                    >
Requesting consultation regarding bone density telemetry and resistance protocol adjustments.</textarea>
                </div>
                <div class="modal-actions">
                    <button class="btn-hud-secondary" id="cancel-surgeon-modal">Cancel</button>
                    <button class="btn-hud-primary" id="send-surgeon-modal">
                        <i class="fa-solid fa-satellite-dish"></i> Transmit to Ground Control
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: NASA's 5 Hazards Details -->
    <div class="hud-modal" id="modal-hazards">
        <div class="hud-modal-dialog modal-lg">
            <div class="hud-modal-header">
                <div class="modal-title-wrap">
                    <i class="fa-solid fa-shield-halved text-cyan"></i>
                    <h3>NASA's 5 Hazards of Human Spaceflight</h3>
                </div>
                <button class="modal-close-btn" id="close-hazards-modal">&times;</button>
            </div>
            <div class="hud-modal-body">
                <div class="hazard-detail-grid">
                    <div class="hazard-detail-card">
                        <h4><i class="fa-solid fa-radiation color-amber"></i> 1. Space Radiation</h4>
                        <p>
                            Invisible to the human eye, radiation exposure increases cancer risk, damages CNS, and
                            causes tissue degradation. Current Status: Moderate shielding active.
                        </p>
                    </div>
                    <div class="hazard-detail-card">
                        <h4><i class="fa-solid fa-users color-green"></i> 2. Isolation & Confinement</h4>
                        <p>
                            Behavioral health challenges, sleep disorders, and mood shifts. Monitored through circadian
                            rhythm tracking and mood journals.
                        </p>
                    </div>
                    <div class="hazard-detail-card">
                        <h4><i class="fa-solid fa-globe color-cyan"></i> 3. Distance from Earth</h4>
                        <p>
                            Increasing communications latency up to 20+ minutes during deep space missions, requiring
                            onboard autonomous medical diagnosis.
                        </p>
                    </div>
                    <div class="hazard-detail-card">
                        <h4><i class="fa-solid fa-ring color-amber"></i> 4. Gravity Fields</h4>
                        <p>
                            Transitions between microgravity, hyper-gravity, and Martian gravity impact vestibular
                            balance, fluid redistribution, and bone/muscle mass.
                        </p>
                    </div>
                    <div class="hazard-detail-card">
                        <h4>
                            <i class="fa-solid fa-house-chimney-window color-green"></i> 5. Hostile / Closed Environment
                        </h4>
                        <p>
                            Life support monitoring: air recirculation, microbial ecosystem management, oxygen/CO2
                            balance, and temperature stabilization.
                        </p>
                    </div>
                </div>
                <div class="modal-actions mt-3">
                    <button class="btn-hud-primary" id="ack-hazards-modal">Acknowledge</button>
                </div>
            </div>
        </div>
    </div>
@endsection
