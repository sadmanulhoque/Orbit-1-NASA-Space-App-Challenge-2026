<?php

namespace App\Repositories;

use App\Interfaces\HealthAssessmentInterface;
use App\Models\HealthAssessment;
use Illuminate\Database\Eloquent\Collection;

class HealthAssessmentRepository implements HealthAssessmentInterface
{
    public function latest(): ?HealthAssessment
    {
        return HealthAssessment::latest()->first();
    }

    public function trend(): Collection
    {
        return HealthAssessment::query()
            ->oldest()
            ->get();
    }

    public function create(array $data): HealthAssessment
    {
        return HealthAssessment::create($data);
    }
}
