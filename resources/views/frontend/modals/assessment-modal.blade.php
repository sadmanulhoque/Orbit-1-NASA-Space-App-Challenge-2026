<div class="modal-header assessment-modal-header">
    <div>
        <h5 class="modal-title">Astronaut Daily Health Assessment</h5>
        <p class="assessment-modal-subtitle mb-0">
            Temporary check-in for mission readiness and body system status.
        </p>
    </div>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body assessment-modal-body">
    <form action="{{ route('assessment.store') }}" method="POST" id="questionnaire-form" class="ajax-form">
        @csrf

        <div class="assessment-form-panel">
            <div class="assessment-form-heading">Daily Health Check-in</div>
            <p class="assessment-form-note">
                No embedded biometric sensors are currently connected. Please enter your current readings manually.
            </p>

            <div class="form-group assessment-field">
                <label class="hud-label">1. How many hours did you sleep last night?</label>
                <select class="hud-input" name="sleep" required>
                    <option value="">Select</option>
                    @forelse ($sleepHours as $sleepHour)
                        <option value="{{ $sleepHour->value }}">{{ $sleepHour->label() }}</option>
                    @empty
                        <option value="">No sleep hour options available</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group assessment-field">
                <label class="hud-label">2. Did you complete resistance / bone-loading exercises today?</label>
                <select class="hud-input" name="exercise" required>
                    <option value="">Select</option>
                    @forelse ($exercises as $exercise)
                        <option value="{{ $exercise->value }}">{{ $exercise->label() }}</option>
                    @empty
                        <option value="">No exercise options available</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group assessment-field">
                <label class="hud-label">3. Any bone, joint or muscle discomfort?</label>
                <select class="hud-input" name="bone" required>
                    <option value="">Select</option>
                    @forelse ($muscleDiscomfort as $discomfort)
                        <option value="{{ $discomfort->value }}">{{ $discomfort->label() }}</option>
                    @empty
                        <option value="">No discomfort options available</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group assessment-field">
                <label class="hud-label">4. How is your current cognitive clarity & mood?</label>
                <select class="hud-input" name="mood" required>
                    <option value="">Select</option>
                    @forelse ($cognitiveMood as $mood)
                        <option value="{{ $mood->value }}">{{ $mood->label() }}</option>
                    @empty
                        <option value="">No mood options available</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group assessment-field">
                <label class="hud-label">5. How isolated / confined do you feel today?</label>
                <select class="hud-input" name="isolation" required>
                    <option value="">Select</option>
                    @forelse ($feelings as $feeling)
                        <option value="{{ $feeling->value }}">{{ $feeling->label() }}</option>
                    @empty
                        <option value="">No feeling options available</option>
                    @endforelse
                </select>
            </div>

            <div class="form-group assessment-field">
                <label class="hud-label">6. Overall physical energy level right now?</label>
                <select class="hud-input" name="energy" required>
                    <option value="">Select</option>
                    @forelse ($energyLevel as $energy)
                        <option value="{{ $energy->value }}">{{ $energy->label() }}</option>
                    @empty
                        <option value="">No energy level options available</option>
                    @endforelse
                </select>
            </div>

            <div class="assessment-modal-actions">
                <button type="button" class="btn-hud-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn-hud-primary">
                    <i class="fa-solid fa-rocket"></i> Generate Health Status
                </button>
            </div>
        </div>
    </form>
</div>
