<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'sleep_hours',
    'exercise',
    'bone_discomfort',
    'mood',
    'isolation',
    'energy',
    'readiness_score',
    'overall_status',
    'overall_sub',
    'brain_status',
    'brain_desc',
    'heart_status',
    'heart_desc',
    'bones_status',
    'bones_desc',
    'eyes_status',
    'eyes_desc',
    'immune_status',
    'immune_desc',
    'heart_rate',
    'blood_pressure',
    'temperature',
    'blood_glucose',
    'sleep_hours_display',
    'main_alert',
    'guidance_items',
    'hazard_radiation',
    'hazard_radiation_pct',
    'hazard_isolation',
    'hazard_isolation_pct',
    'hazard_distance',
    'hazard_distance_pct',
    'hazard_gravity',
    'hazard_gravity_pct',
    'hazard_closed',
    'hazard_closed_pct',
])]
class HealthAssessment extends Model
{
    protected function casts(): array
    {
        return [
            'guidance_items' => 'array',
            'temperature' => 'float',
            'sleep_hours_display' => 'float',
        ];
    }
}
