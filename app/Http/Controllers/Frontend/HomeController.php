<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\HealthAssesmentRequest;
use App\Services\HealthAssessmentService;
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

    public function store(HealthAssesmentRequest $request): RedirectResponse
    {
        $this->service->processAssessment($request->validated());

        return redirect()->route('home')->with('success', 'Health assessment completed successfully.');
    }
}
