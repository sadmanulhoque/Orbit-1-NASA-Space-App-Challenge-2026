<?php

namespace App\Interfaces;

use App\Models\HealthAssessment;
use Illuminate\Database\Eloquent\Collection;

interface HealthAssessmentInterface
{
    public function latest(): ?HealthAssessment;

    public function trend(): Collection;

    public function create(array $data): HealthAssessment;
}
