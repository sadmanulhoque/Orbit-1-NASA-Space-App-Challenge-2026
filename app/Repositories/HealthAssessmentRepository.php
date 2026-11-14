<?php

namespace App\Repositories;

use App\Interfaces\HealthAssessmentInterface;
use App\Models\HealthAssessment;

class HealthAssessmentRepository implements HealthAssessmentInterface
{
    public function latest(): ?HealthAssessment
    {
        return HealthAssessment::latest()->first();
    }

    public function create(array $data): HealthAssessment
    {
        return HealthAssessment::create($data);
    }
}
