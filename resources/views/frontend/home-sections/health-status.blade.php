<div class="glass-card daily-checkin-card" id="daily-checkin">
    <div class="card-head">
        <div class="head-title">
            <span class="head-icon blue-glow"><i class="fa-regular fa-calendar-days"></i></span>
            <h2>Health Status</h2>
        </div>
        <button
            type="button"
            class="edit-pill-btn"
            data-bs-toggle="modal"
            data-bs-target="#modal-global"
            data-content="{{ route('assessment.create') }}"
            data-modal-size="lg"
            data-auto-open-modal="assessment"
            data-auto-open="{{ $assessmentDueToday ? 'true' : 'false' }}"
        >
            <i class="fa-solid fa-pencil"></i> New Assessment
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
                    <path
                        d="M0,9 L12,9 L15,2 L19,16 L23,5 L26,11 L29,9 L45,9"
                        fill="none"
                        stroke="#10b981"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
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

    <div
        class="checkin-status-banner"
        style="{{ $assessment && $assessment->readiness_score < 75 ? 'background: linear-gradient(135deg, rgba(180, 83, 9, 0.25) 0%, rgba(146, 64, 14, 0.35) 100%); border-color: rgba(245, 158, 11, 0.5);' : '' }}"
    >
        <div class="status-check-circle">
            <i class="fa-solid fa-check"></i>
        </div>
        <div class="banner-texts">
            <div class="banner-main">{{ $assessment->overall_status ?? 'No Assessment Yet' }}</div>
            <div class="banner-sub">{{ $assessment->overall_sub ?? 'Complete the questionnaire to begin' }}</div>
        </div>
    </div>
</div>
