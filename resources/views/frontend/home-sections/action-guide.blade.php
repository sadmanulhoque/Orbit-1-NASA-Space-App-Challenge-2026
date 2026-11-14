        <div class="glass-card action-guidance-card" id="action-guidance">
            <div class="card-head">
                <div class="head-title">
                    <span class="head-icon yellow-glow"><i class="fa-solid fa-lightbulb"></i></span>
                    <h2>Action Guidance</h2>
                </div>
            </div>

            <div class="guidance-alert-box">
                <div class="alert-icon-col">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="alert-msg">
                    {{ $assessment->main_alert ?? 'Complete a health assessment to receive personalized guidance.' }}
                </div>
            </div>

            <ul class="guidance-checklist">
                @if ($assessment && is_array($assessment->guidance_items))
                    @foreach ($assessment->guidance_items as $item)
                        <li>
                            <span class="check-pill"><i class="fa-solid fa-check"></i></span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                @else
                    <li>
                        <span class="check-pill"><i class="fa-solid fa-check"></i></span>
                        <span>Complete the daily health assessment</span>
                    </li>
                @endif
            </ul>

            <button type="button" class="btn-primary-cta" data-bs-toggle="modal" data-bs-target="#modal-global"
                data-content="{{ route('surgeon.index') }}" data-modal-size="md">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Contact Flight Surgeon</span>
            </button>
        </div>
