<?php

namespace App\Providers;

use App\Interfaces\HealthAssessmentInterface;
use App\Repositories\HealthAssessmentRepository;
use Illuminate\Support\ServiceProvider;

class HealthAssesmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            HealthAssessmentInterface::class,
            HealthAssessmentRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
