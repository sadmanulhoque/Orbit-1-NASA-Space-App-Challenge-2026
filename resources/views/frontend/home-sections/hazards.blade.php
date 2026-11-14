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
