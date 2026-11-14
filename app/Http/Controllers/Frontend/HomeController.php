<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\HealthAssesmentRequest;
use App\Services\HealthAssessmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected HealthAssessmentService $service
    ) {}

    public function index(): View
    {

        $assessment = $this->service->getLatestAssessment();

        return view('frontend.home', compact('assessment'));

    }

    public function create(): View
    {
        return view('frontend.modals.assessment-modal');
    }

    public function storeAssessment(HealthAssesmentRequest $request): JsonResponse
    {
        $this->service->processAssessment($request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'Health assessment submitted successfully.',
        ]);
    }

    public function hazards(): View
    {
        return view('frontend.modals.hazards-modal');
    }

    public function surgeon(): View
    {
        $assessment = $this->service->getLatestAssessment();

        return view('frontend.modals.surgeon-modal', compact('assessment'));
    }
}
