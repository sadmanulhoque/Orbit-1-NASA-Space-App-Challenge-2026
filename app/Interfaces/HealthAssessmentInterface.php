<?php

namespace App\Interfaces;

interface HealthAssessmentInterface
{
    public function latest();

    public function create(array $data);
}
