<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\HealthAssesmentRequest;
use App\Services\HealthAssessmentService;
use Illuminate\Support\Facades\Log;
use Throwable;

class HomeController extends Controller
{
    public function __construct(
        protected HealthAssessmentService $service
    ) {}

    public function index()
    {
        try {
            $assessment = $this->service->getLatestAssessment();

            return view('frontend.home', compact('assessment'));
        } catch (Throwable $e) {
            Log::error('Error fetching latest health assessment: ', [
                'error' => $e,
            ]);
        }
    }

    public function store(HealthAssesmentRequest $request)
    {
        try {
            $this->service->processAssessment($request->validated());

            return redirect()->route('home')->with('success', 'Health assessment completed successfully.');
        } catch (Throwable $e) {
            Log::error('Error storing health assessment: ', [
                'error' => $e,
            ]);
        }
    }
}
