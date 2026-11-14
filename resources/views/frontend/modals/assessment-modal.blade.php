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
                    <option value="">Select...</option>
                    <option value="5">Less than 5 hours</option>
                    <option value="6">5–6 hours</option>
                    <option value="7">7–8 hours</option>
                    <option value="9">More than 8 hours</option>
                </select>
            </div>

            <div class="form-group assessment-field">
                <label class="hud-label">2. Did you complete resistance / bone-loading exercises today?</label>
                <select class="hud-input" name="exercise" required>
                    <option value="">Select...</option>
                    <option value="yes">Yes, full session</option>
                    <option value="partial">Partial / light session</option>
                    <option value="no">No</option>
                </select>
            </div>

            <div class="form-group assessment-field">
                <label class="hud-label">3. Any bone, joint or muscle discomfort?</label>
                <select class="hud-input" name="bone" required>
                    <option value="">Select...</option>
                    <option value="none">None</option>
                    <option value="mild">Mild discomfort</option>
                    <option value="moderate">Moderate / noticeable</option>
                </select>
            </div>

            <div class="form-group assessment-field">
                <label class="hud-label">4. How is your current cognitive clarity & mood?</label>
                <select class="hud-input" name="mood" required>
                    <option value="">Select...</option>
                    <option value="excellent">Excellent / Sharp</option>
                    <option value="good">Good</option>
                    <option value="low">Low energy / Foggy</option>
                    <option value="stressed">Stressed / Anxious</option>
                </select>
            </div>

            <div class="form-group assessment-field">
                <label class="hud-label">5. How isolated / confined do you feel today?</label>
                <select class="hud-input" name="isolation" required>
                    <option value="">Select...</option>
                    <option value="low">Not at all / Low</option>
                    <option value="medium">Somewhat</option>
                    <option value="high">Quite isolated</option>
                </select>
            </div>

            <div class="form-group assessment-field">
                <label class="hud-label">6. Overall physical energy level right now?</label>
                <select class="hud-input" name="energy" required>
                    <option value="">Select...</option>
                    <option value="high">High</option>
                    <option value="normal">Normal</option>
                    <option value="low">Low / Fatigued</option>
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
