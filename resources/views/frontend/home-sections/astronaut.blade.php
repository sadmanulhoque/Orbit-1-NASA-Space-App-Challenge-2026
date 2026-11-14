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
