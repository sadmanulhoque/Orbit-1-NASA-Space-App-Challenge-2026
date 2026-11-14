<?php

namespace App\Interfaces;

use App\Models\HealthAssessment;

interface HealthAssessmentInterface
{
    public function latest(): ?HealthAssessment;

    public function create(array $data): HealthAssessment;
}
