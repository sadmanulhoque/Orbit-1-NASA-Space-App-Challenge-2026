<header class="hud-header">
    <div class="header-left">
        <div class="header-brand-group" aria-label="NASA and Orbit-1">
            <div class="brand-nasa" title="NASA Crew Health">
                <img class="nasa-logo-svg" src="{{ asset('assets/nasa.svg') }}" alt="NASA" />
            </div>

            <div class="brand-orbit" title="Orbit-1">
                <img class="orbit-logo" src="{{ asset('assets/orbit-logo.png') }}" alt="Orbit-1" />
            </div>
        </div>

        <div class="header-divider"></div>

        <div class="header-greeting">
            <img class="header-helmet" src="{{ asset('assets/helmet-transparent.png') }}" alt="Astronaut helmet" />
            <div class="header-greeting-copy">
                <div class="header-greeting-title">{{ greeting() }}, Astronaut!</div>
                <div class="header-greeting-message">Your health is stable. Keep up the good work!</div>
            </div>
        </div>
    </div>

    <div class="header-right">
        <!-- Mission Time -->
        <div class="hud-time-block">
            <div class="time-icon">
                <i class="fa-regular fa-clock"></i>
            </div>
            <div class="time-meta">
                <div class="time-utc">{{ now()->format('H:i') }} UTC</div>
                <div class="time-date">{{ now()->format('d M, Y') }}</div>
            </div>
        </div>

        <!-- Connection Status -->
        <div class="hud-status-pill">
            <span class="status-dot-pulse"></span>
            <span class="status-label">Connected</span>
        </div>
    </div>
</header>
