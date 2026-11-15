<div class="glass-card health-trends-card">
    <div class="card-head">
        <div class="head-title">
            <span class="head-icon blue-glow"><i class="fa-solid fa-chart-simple"></i></span>
            <h2>Health Trends</h2>
        </div>
    </div>
    <div class="trend-legend">
        <div class="legend-item"><span class="legend-dot dot-readiness"></span> Readiness Score</div>
        <div class="legend-item"><span class="legend-dot dot-sleep"></span> Sleep Hours</div>
        <div class="legend-item"><span class="legend-dot dot-heart"></span> Heart Rate</div>
        <div class="legend-item"><span class="legend-dot dot-temperature"></span> Temperature</div>
    </div>
    <div class="chart-container-box">
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
