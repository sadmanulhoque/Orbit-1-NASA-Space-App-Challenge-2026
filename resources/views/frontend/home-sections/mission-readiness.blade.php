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
                <circle
                    class="gauge-fill"
                    id="readiness-gauge-fill"
                    cx="70"
                    cy="70"
                    r="54"
                    stroke-dasharray="339.292"
                    stroke-dashoffset="{{ $assessment ? 339.292 - (339.292 * $assessment->readiness_score) / 100 : 339.292 }}"
                    style="stroke: {{ $assessment && $assessment->readiness_score >= 90 ? 'var(--neon-green-glow)' : ($assessment && $assessment->readiness_score >= 75 ? 'var(--neon-amber-glow)' : '#f97316') }}"
                ></circle>
            </svg>
            <div class="gauge-value-box">
                <span class="gauge-number">{{ $assessment->readiness_score ?? 0 }}</span
                ><span class="gauge-percent">%</span>
            </div>
        </div>

        <div class="gauge-info">
            <div
                class="status-tag {{ $assessment && $assessment->readiness_score >= 90 ? 'status-excellent' : '' }}"
                style="{{ $assessment && $assessment->readiness_score < 90 ? 'color: var(--neon-amber-glow);' : '' }}"
            >
                @if ($assessment && $assessment->readiness_score >= 90)
                    <i class="fa-solid fa-circle-check"></i>
                    <span>Excellent</span>
                @elseif ($assessment && $assessment->readiness_score >= 75)
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
                    @elseif ($assessment->readiness_score >= 75)
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
            <span>Streak: <strong>{{ $streakDays }} Days</strong></span>
        </div>
    </div>
</div>
