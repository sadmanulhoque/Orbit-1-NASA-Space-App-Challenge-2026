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
        <div class="chart-y-axis"><span>150</span><span>120</span><span>90</span><span>60</span></div>
        <div class="chart-canvas-wrapper">
            <div id="healthTrendsChart" data-chart='@json($trendData)'></div>
        </div>
    </div>
    <div class="chart-x-axis">
        @forelse ($trendData['labels'] as $label)
            <span class="{{ $loop->last ? 'active-day' : '' }}">{{ $label }}</span>
        @empty
            <span>No assessment history</span>
        @endforelse
    </div>
</div>
