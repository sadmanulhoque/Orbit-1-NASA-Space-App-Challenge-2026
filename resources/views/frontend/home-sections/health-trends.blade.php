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
