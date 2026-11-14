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
                    <svg class="radial-gauge" viewBox="0 0 140 140">
                        <circle class="gauge-track" cx="70" cy="70" r="54"></circle>
                        <circle class="gauge-fill" id="readiness-gauge-fill" cx="70" cy="70" r="54"
                            stroke-dasharray="339.292"
                            stroke-dashoffset="{{ $assessment ? 339.292 - (339.292 * $assessment->readiness_score) / 100 : 339.292 }}"
                            style="stroke: {{ $assessment && $assessment->readiness_score >= 90 ? 'var(--neon-green-glow)' : ($assessment && $assessment->readiness_score >= 75 ? 'var(--neon-amber-glow)' : '#f97316') }}">
                        </circle>
                    </svg>
                    <div class="gauge-value-box">
                        <span class="gauge-number">{{ $assessment->readiness_score ?? 0 }}</span><span
                            class="gauge-percent">%</span>
                    </div>
                </div>

                <div class="gauge-info">
                    <div class="status-tag {{ $assessment && $assessment->readiness_score >= 90 ? 'status-excellent' : '' }}"
                        style="{{ $assessment && $assessment->readiness_score < 90 ? 'color: var(--neon-amber-glow);' : '' }}">
                        @if ($assessment && $assessment->readiness_score >= 90)
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Excellent</span>
                        @elseif($assessment && $assessment->readiness_score >= 75)
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>Good</span>
                        @else
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>Attention</span>
                        @endif
                    </div>
                    <p class="gauge-desc">
                        @if ($assessment)
                            @if ($assessment->readiness_score >= 90)
                                You're on track for a successful mission.
                            @elseif($assessment->readiness_score >= 75)
                                Minor adjustments recommended.
                            @else
                                Review Action Guidance carefully.
                            @endif
                        @else
                            Complete the health assessment to see your status.
                        @endif
                    </p>
                </div>
            </div>

            <div class="card-footer-pill">
                <div class="streak-pill">
                    <i class="fa-solid fa-star streak-star"></i>
                    <span>Streak: <strong>12 Days</strong></span>
                </div>
            </div>
        </div>

        <!-- Card: NASA's 5 Hazards (Dynamic) -->
        <div class="glass-card hazards-card" id="nasa-hazards">
            <div class="card-head">
                <div class="head-title">
                    <span class="head-icon blue-glow"><i class="fa-solid fa-shield-halved"></i></span>
                    <h2>NASA's 5 Hazards</h2>
                </div>
                <button type="button" class="link-btn" data-bs-toggle="modal" data-bs-target="#modal-global"
                    data-content="{{ route('hazards.index') }}" data-modal-size="lg">
                    View Details <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <div class="hazards-list">
                @php
                    $hazards = [
                        [
                            'name' => 'Radiation',
                            'icon' => 'fa-radiation',
                            'color' => 'amber',
                            'level' => $assessment->hazard_radiation ?? 'Medium',
                            'pct' => $assessment->hazard_radiation_pct ?? 58,
                        ],
                        [
                            'name' => 'Isolation',
                            'icon' => 'fa-users',
                            'color' => 'green',
                            'level' => $assessment->hazard_isolation ?? 'Low',
                            'pct' => $assessment->hazard_isolation_pct ?? 28,
                        ],
                        [
                            'name' => 'Distance',
                            'icon' => 'fa-globe',
                            'color' => 'cyan',
                            'level' => $assessment->hazard_distance ?? 'Low',
                            'pct' => $assessment->hazard_distance_pct ?? 32,
                        ],
                        [
                            'name' => 'Gravity',
                            'icon' => 'fa-ring',
                            'color' => 'amber',
                            'level' => $assessment->hazard_gravity ?? 'Medium',
                            'pct' => $assessment->hazard_gravity_pct ?? 62,
                        ],
                        [
                            'name' => 'Closed Environment',
                            'icon' => 'fa-house-chimney-window',
                            'color' => 'green',
                            'level' => $assessment->hazard_closed ?? 'Low',
                            'pct' => $assessment->hazard_closed_pct ?? 25,
                        ],
                    ];
                @endphp

                @foreach ($hazards as $h)
                    <div class="hazard-row">
                        <div class="hazard-label">
                            <span class="hazard-icon color-{{ $h['color'] }}"><i
                                    class="fa-solid {{ $h['icon'] }}"></i></span>
                            <span class="hazard-name">{{ $h['name'] }}</span>
                        </div>
                        <div class="hazard-bar-container">
                            <div class="hazard-bar bar-{{ $h['color'] }}" style="width: {{ $h['pct'] }}%"></div>
                        </div>
                        <div class="hazard-badge badge-{{ $h['color'] }}">{{ $h['level'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CENTER STAGE -->
    <section class="grid-col col-center">
        <div class="astronaut-viewport-stage" id="astronaut-stage">
            <div class="astronaut-static-layer">
                <img src="{{ asset('assets/body-transparent.png') }}" alt="Astronaut" class="astronaut-static-img"
                    onerror="this.src = 'images/body.png'" />
            </div>

            <!-- Brain -->
            <div class="holo-hotspot hotspot-brain" data-target="brain">
                <div class="hotspot-card">
                    <div class="hotspot-icon-box cyan"><i class="fa-solid fa-brain"></i></div>
                    <div class="hotspot-text">
                        <div class="hotspot-title-row">
                            <span class="hotspot-title">Brain</span>
                            <span class="hotspot-status status-{{ strtolower($assessment->brain_status ?? 'normal') }}">
                                <span class="dot"></span>{{ $assessment->brain_status ?? 'Normal' }}
                            </span>
                        </div>
                        <div class="hotspot-desc">{{ $assessment->brain_desc ?? 'Cognitive function is stable.' }}</div>
                    </div>
                </div>
                <div class="hotspot-line line-brain"></div>
            </div>

            <!-- Heart -->
            <div class="holo-hotspot hotspot-heart" data-target="heart">
                <div class="hotspot-card">
                    <div class="hotspot-icon-box red"><i class="fa-solid fa-heart"></i></div>
                    <div class="hotspot-text">
                        <div class="hotspot-title-row">
                            <span class="hotspot-title">Heart</span>
                            <span class="hotspot-status status-{{ strtolower($assessment->heart_status ?? 'normal') }}">
                                <span class="dot"></span>{{ $assessment->heart_status ?? 'Normal' }}
                            </span>
                        </div>
                        <div class="hotspot-desc">{{ $assessment->heart_desc ?? 'HR in range' }}</div>
                    </div>
                </div>
                <div class="hotspot-line line-heart"></div>
            </div>

            <!-- Bones -->
            <div class="holo-hotspot hotspot-bones" data-target="bones">
                <div class="hotspot-card">
                    <div class="hotspot-icon-box amber"><i class="fa-solid fa-bone"></i></div>
                    <div class="hotspot-text">
                        <div class="hotspot-title-row">
                            <span class="hotspot-title">Bones</span>
                            <span class="hotspot-status status-{{ strtolower($assessment->bones_status ?? 'normal') }}">
                                <span class="dot"></span>{{ $assessment->bones_status ?? 'Normal' }}
                            </span>
                        </div>
                        <div class="hotspot-desc">{{ $assessment->bones_desc ?? 'Bone density within expected range.' }}
                        </div>
                    </div>
                </div>
                <div class="hotspot-line line-bones"></div>
            </div>

            <!-- Eyes -->
            <div class="holo-hotspot hotspot-eyes" data-target="eyes">
                <div class="hotspot-card">
                    <div class="hotspot-icon-box cyan"><i class="fa-solid fa-eye"></i></div>
                    <div class="hotspot-text">
                        <div class="hotspot-title-row">
                            <span class="hotspot-title">Eyes</span>
                            <span class="hotspot-status status-{{ strtolower($assessment->eyes_status ?? 'normal') }}">
                                <span class="dot"></span>{{ $assessment->eyes_status ?? 'Normal' }}
                            </span>
                        </div>
                        <div class="hotspot-desc">{{ $assessment->eyes_desc ?? 'Vision stable.' }}</div>
                    </div>
                </div>
                <div class="hotspot-line line-eyes"></div>
            </div>

            <!-- Immune -->
            <div class="holo-hotspot hotspot-immune" data-target="immune">
                <div class="hotspot-card">
                    <div class="hotspot-icon-box blue"><i class="fa-solid fa-shield-virus"></i></div>
                    <div class="hotspot-text">
                        <div class="hotspot-title-row">
                            <span class="hotspot-title">Immune</span>
                            <span class="hotspot-status status-{{ strtolower($assessment->immune_status ?? 'normal') }}">
                                <span class="dot"></span>{{ $assessment->immune_status ?? 'Normal' }}
                            </span>
                        </div>
                        <div class="hotspot-desc">{{ $assessment->immune_desc ?? 'Immune response is good.' }}</div>
                    </div>
                </div>
                <div class="hotspot-line line-immune"></div>
            </div>
        </div>

        <!-- Health Trends (kept mostly static for visual) -->
        <div class="glass-card health-trends-card">
            <div class="card-head">
                <div class="head-title">
                    <span class="head-icon blue-glow"><i class="fa-solid fa-chart-simple"></i></span>
                    <h2>Health Trends</h2>
                </div>
                <div class="trend-tabs">
                    <button class="trend-tab-btn active" data-range="7d">7D</button>
                    <button class="trend-tab-btn" data-range="30d">30D</button>
                    <button class="trend-tab-btn" data-range="mission">Mission</button>
                </div>
            </div>
            <div class="trend-legend">
                <div class="legend-item"><span class="legend-dot dot-magenta"></span> Heart Rate</div>
                <div class="legend-item"><span class="legend-dot dot-blue"></span> Blood Pressure</div>
                <div class="legend-item"><span class="legend-dot dot-cyan"></span> Temperature</div>
            </div>
            <div class="chart-container-box">
                <div class="chart-y-axis">
                    <span>150</span><span>120</span><span>90</span><span>60</span>
                </div>
                <div class="chart-canvas-wrapper">
                    <canvas id="healthTrendsCanvas"></canvas>
                    <div class="chart-tooltip-marker" id="chart-marker">
                        <div class="tooltip-box">
                            <div class="tooltip-title">Day 12</div>
                            <div class="tooltip-val"><span class="tt-dot"></span> HR: {{ $assessment->heart_rate ?? 72 }}
                                bpm</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart-x-axis">
                <span>Day 6</span><span>Day 8</span><span>Day 10</span><span class="active-day">Day 12</span>
            </div>
        </div>
    </section>

    <!-- RIGHT COLUMN -->
    <section class="grid-col col-right">
        <!-- Health Status -->
        <div class="glass-card daily-checkin-card" id="daily-checkin">
            <div class="card-head">
                <div class="head-title">
                    <span class="head-icon blue-glow"><i class="fa-regular fa-calendar-days"></i></span>
                    <h2>Health Status</h2>
                </div>
                <button type="button" class="edit-pill-btn" data-bs-toggle="modal" data-bs-target="#modal-global"
                    data-content="{{ route('assessment.create') }}" data-modal-size="lg"
                    data-auto-open-modal="assessment">
                    <i class="fa-solid fa-pencil"></i> Edit
                </button>
            </div>

            <div class="vitals-table">
                <div class="vital-row">
                    <div class="vital-name-group">
                        <span class="vital-icon icon-red"><i class="fa-solid fa-heart-pulse"></i></span>
                        <span class="vital-name">Heart Rate</span>
                    </div>
                    <div class="vital-value-group">
                        <span class="vital-val" id="val-heart-rate">{{ $assessment->heart_rate ?? '--' }}</span>
                        <span class="vital-unit">bpm</span>
                        <svg class="vital-sparkline" viewBox="0 0 45 18">
                            <path d="M0,9 L12,9 L15,2 L19,16 L23,5 L26,11 L29,9 L45,9" fill="none" stroke="#10b981"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>

                <div class="vital-row">
                    <div class="vital-name-group">
                        <span class="vital-icon icon-cyan"><i class="fa-solid fa-droplet"></i></span>
                        <span class="vital-name">Blood Pressure</span>
                    </div>
                    <div class="vital-value-group">
                        <span class="vital-val">{{ $assessment->blood_pressure ?? '--/--' }}</span>
                        <span class="vital-unit">mmHg</span>
                    </div>
                </div>

                <div class="vital-row">
                    <div class="vital-name-group">
                        <span class="vital-icon icon-cyan"><i class="fa-solid fa-temperature-half"></i></span>
                        <span class="vital-name">Temperature</span>
                    </div>
                    <div class="vital-value-group">
                        <span class="vital-val">{{ $assessment->temperature ?? '--' }}</span>
                        <span class="vital-unit">°C</span>
                    </div>
                </div>

                <div class="vital-row">
                    <div class="vital-name-group">
                        <span class="vital-icon icon-blue"><i class="fa-solid fa-tint"></i></span>
                        <span class="vital-name">Blood Glucose</span>
                    </div>
                    <div class="vital-value-group">
                        <span class="vital-val">{{ $assessment->blood_glucose ?? '--' }}</span>
                        <span class="vital-unit">mg/dL</span>
                    </div>
                </div>

                <div class="vital-row">
                    <div class="vital-name-group">
                        <span class="vital-icon icon-purple"><i class="fa-solid fa-moon"></i></span>
                        <span class="vital-name">Sleep Hours</span>
                    </div>
                    <div class="vital-value-group">
                        <span class="vital-val">{{ $assessment->sleep_hours_display ?? '--' }}</span>
                        <span class="vital-unit">h</span>
                    </div>
                </div>
            </div>

            <div class="checkin-status-banner"
                style="{{ $assessment && $assessment->readiness_score < 75 ? 'background: linear-gradient(135deg, rgba(180, 83, 9, 0.25) 0%, rgba(146, 64, 14, 0.35) 100%); border-color: rgba(245, 158, 11, 0.5);' : '' }}">
                <div class="status-check-circle">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="banner-texts">
                    <div class="banner-main">{{ $assessment->overall_status ?? 'No Assessment Yet' }}</div>
                    <div class="banner-sub">{{ $assessment->overall_sub ?? 'Complete the questionnaire to begin' }}</div>
                </div>
            </div>
        </div>

        <!-- Action Guidance -->
        <div class="glass-card action-guidance-card" id="action-guidance">
            <div class="card-head">
                <div class="head-title">
                    <span class="head-icon yellow-glow"><i class="fa-solid fa-lightbulb"></i></span>
                    <h2>Action Guidance</h2>
                </div>
            </div>

            <div class="guidance-alert-box">
                <div class="alert-icon-col">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="alert-msg">
                    {{ $assessment->main_alert ?? 'Complete a health assessment to receive personalized guidance.' }}
                </div>
            </div>

            <ul class="guidance-checklist">
                @if ($assessment && is_array($assessment->guidance_items))
                    @foreach ($assessment->guidance_items as $item)
                        <li>
                            <span class="check-pill"><i class="fa-solid fa-check"></i></span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                @else
                    <li>
                        <span class="check-pill"><i class="fa-solid fa-check"></i></span>
                        <span>Complete the daily health assessment</span>
                    </li>
                @endif
            </ul>

            <button type="button" class="btn-primary-cta" data-bs-toggle="modal" data-bs-target="#modal-global"
                data-content="{{ route('surgeon.index') }}" data-modal-size="md">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Contact Flight Surgeon</span>
            </button>
        </div>
    </section>
@endsection
