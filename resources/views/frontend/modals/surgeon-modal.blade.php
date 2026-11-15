<div class="modal-header assessment-modal-header">
    <div>
        <h5 class="modal-title">Flight Surgeon Comms Uplink</h5>
    </div>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body assessment-modal-body">
    <div class="comm-channel-badge"><span class="dot-online"></span> Channel Active: Station Telemetry Link #04</div>
    <div class="form-group mb-3">
        <label class="hud-label">Telemetry Snapshot</label>
        <div class="telemetry-mini-preview">
            <span>HR: {{ $assessment->heart_rate ?? '--' }} bpm</span>
            <span>BP: {{ $assessment->blood_pressure ?? '--/--' }}</span>
            <span>Bone Alert: {{ $assessment && $assessment->bones_status === 'Watch' ? 'Active' : 'None' }}</span>
            <span>Readiness: {{ $assessment->readiness_score ?? '--' }}%</span>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="hud-label" for="surgeon-msg">Message to Flight Surgeon</label>
        <textarea id="surgeon-msg" class="hud-input" rows="3" placeholder="Describe symptoms or request advice...">
Requesting consultation regarding current health telemetry and recommended protocols.</textarea>
    </div>
    <div class="modal-actions">
        <button class="btn-hud-secondary" data-bs-dismiss="modal" id="cancel-surgeon-modal">Cancel</button>
        <button type="button" class="btn-hud-primary" id="send-surgeon-modal">
            <i class="fa-solid fa-satellite-dish"></i> Transmit to Ground Control
        </button>
    </div>
</div>
