    <div class="hud-modal {{ !$assessment ? 'active' : '' }}" id="modal-questionnaire">
        <div class="hud-modal-dialog modal-lg">
            <div class="hud-modal-header">
                <div class="modal-title-wrap">
                    <i class="fa-solid fa-clipboard-list text-cyan"></i>
                    <h3>Astronaut Daily Health Assessment</h3>
                </div>
            </div>

            <div class="hud-modal-body">
                <div class="mb-4 p-3 rounded" style="background: rgba(56, 189, 248, 0.08); border: 1px solid rgba(56, 189, 248, 0.25);">
                    <p class="mb-1" style="font-size: 0.88rem; color: #7dd3fc;">
                        <i class="fa-solid fa-circle-info me-1"></i>
                        <strong>Note:</strong> No embedded biometric sensors are currently connected.
                    </p>
                    <p class="mb-0" style="font-size: 0.84rem; color: var(--text-dim);">
                        This questionnaire is used as a temporary data collection method to generate your mission readiness, body system status, and action guidance.
                    </p>
                </div>

                <form action="{{ route('assessment.store') }}" method="POST" id="questionnaire-form">
                    @csrf

                    <div class="form-group mb-3">
                        <label class="hud-label">1. How many hours did you sleep last night?</label>
                        <select class="hud-input" name="sleep" required>
                            <option value="">Select...</option>
                            <option value="5">Less than 5 hours</option>
                            <option value="6">5–6 hours</option>
                            <option value="7">7–8 hours</option>
                            <option value="9">More than 8 hours</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="hud-label">2. Did you complete resistance / bone-loading exercises today?</label>
                        <select class="hud-input" name="exercise" required>
                            <option value="">Select...</option>
                            <option value="yes">Yes, full session</option>
                            <option value="partial">Partial / light session</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="hud-label">3. Any bone, joint or muscle discomfort?</label>
                        <select class="hud-input" name="bone" required>
                            <option value="">Select...</option>
                            <option value="none">None</option>
                            <option value="mild">Mild discomfort</option>
                            <option value="moderate">Moderate / noticeable</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="hud-label">4. How is your current cognitive clarity & mood?</label>
                        <select class="hud-input" name="mood" required>
                            <option value="">Select...</option>
                            <option value="excellent">Excellent / Sharp</option>
                            <option value="good">Good</option>
                            <option value="low">Low energy / Foggy</option>
                            <option value="stressed">Stressed / Anxious</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="hud-label">5. How isolated / confined do you feel today?</label>
                        <select class="hud-input" name="isolation" required>
                            <option value="">Select...</option>
                            <option value="low">Not at all / Low</option>
                            <option value="medium">Somewhat</option>
                            <option value="high">Quite isolated</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="hud-label">6. Overall physical energy level right now?</label>
                        <select class="hud-input" name="energy" required>
                            <option value="">Select...</option>
                            <option value="high">High</option>
                            <option value="normal">Normal</option>
                            <option value="low">Low / Fatigued</option>
                        </select>
                    </div>

                    <div class="modal-actions">
                        <button type="submit" class="btn-hud-primary" style="width:100%;">
                            <i class="fa-solid fa-rocket"></i> Generate Health Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
