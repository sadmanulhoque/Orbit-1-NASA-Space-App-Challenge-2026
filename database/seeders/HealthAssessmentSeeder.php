<?php

namespace Database\Seeders;

use App\Models\HealthAssessment;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

class HealthAssessmentSeeder extends Seeder
{
    public function run(): void
    {
        $today = CarbonImmutable::today();
        $dailyValues = [
            9 => [
                'sleep_hours' => 6,
                'readiness_score' => 78,
                'sleep_hours_display' => 6.0,
                'heart_rate' => 74,
                'blood_pressure' => '120/80',
                'temperature' => 36.5,
                'blood_glucose' => 108,
            ],
            8 => [
                'sleep_hours' => 5,
                'readiness_score' => 72,
                'sleep_hours_display' => 5.0,
                'heart_rate' => 76,
                'blood_pressure' => '122/82',
                'temperature' => 36.7,
                'blood_glucose' => 112,
            ],
            7 => [
                'sleep_hours' => 6,
                'readiness_score' => 81,
                'sleep_hours_display' => 6.0,
                'heart_rate' => 72,
                'blood_pressure' => '118/78',
                'temperature' => 36.5,
                'blood_glucose' => 105,
            ],
            6 => [
                'sleep_hours' => 7,
                'readiness_score' => 89,
                'sleep_hours_display' => 7.0,
                'heart_rate' => 69,
                'blood_pressure' => '116/76',
                'temperature' => 36.4,
                'blood_glucose' => 99,
            ],
            5 => [
                'sleep_hours' => 6,
                'readiness_score' => 84,
                'sleep_hours_display' => 6.0,
                'heart_rate' => 70,
                'blood_pressure' => '117/77',
                'temperature' => 36.6,
                'blood_glucose' => 102,
            ],
            4 => [
                'sleep_hours' => 8,
                'readiness_score' => 95,
                'sleep_hours_display' => 8.0,
                'heart_rate' => 65,
                'blood_pressure' => '112/74',
                'temperature' => 36.4,
                'blood_glucose' => 94,
            ],
            3 => [
                'sleep_hours' => 7,
                'readiness_score' => 92,
                'sleep_hours_display' => 7.0,
                'heart_rate' => 67,
                'blood_pressure' => '114/75',
                'temperature' => 36.5,
                'blood_glucose' => 97,
            ],
            2 => [
                'sleep_hours' => 6,
                'readiness_score' => 86,
                'sleep_hours_display' => 6.0,
                'heart_rate' => 70,
                'blood_pressure' => '118/76',
                'temperature' => 36.6,
                'blood_glucose' => 101,
            ],
            1 => [
                'sleep_hours' => 6,
                'readiness_score' => 82,
                'sleep_hours_display' => 6.0,
                'heart_rate' => 71,
                'blood_pressure' => '116/77',
                'temperature' => 36.5,
                'blood_glucose' => 104,
            ],
            0 => [
                'sleep_hours' => 7,
                'readiness_score' => 91,
                'sleep_hours_display' => 7.0,
                'heart_rate' => 68,
                'blood_pressure' => '114/75',
                'temperature' => 36.6,
                'blood_glucose' => 98,
            ],
        ];

        foreach ($dailyValues as $dayOffset => $values) {
            $date = $today->subDays($dayOffset + 1)->setTime(8, 0);

            if (HealthAssessment::query()->whereDate('created_at', $date)->exists()) {
                continue;
            }

            $assessment = new HealthAssessment(array_merge([
                'exercise' => 'yes',
                'bone_discomfort' => 'none',
                'mood' => 'good',
                'isolation' => 'low',
                'energy' => 'normal',
                'overall_status' => $values['readiness_score'] >= 90
                    ? 'All Readings Normal'
                    : 'Minor Attention Needed',
                'overall_sub' => 'Some parameters require monitoring',
                'brain_status' => 'Normal',
                'brain_desc' => 'Cognitive function is stable.',
                'heart_status' => 'Normal',
                'heart_desc' => 'HR in range',
                'bones_status' => 'Normal',
                'bones_desc' => 'Bone density within expected range.',
                'eyes_status' => 'Normal',
                'eyes_desc' => 'Vision stable.',
                'immune_status' => 'Normal',
                'immune_desc' => 'Immune response is good.',
                'main_alert' => null,
                'guidance_items' => [
                    'Maintain current exercise & sleep routine',
                    'Continue daily resistance protocol',
                    'Recheck in next scheduled check-in',
                ],
                'hazard_radiation' => 'Medium',
                'hazard_radiation_pct' => 58,
                'hazard_isolation' => 'Low',
                'hazard_isolation_pct' => 28,
                'hazard_distance' => 'Low',
                'hazard_distance_pct' => 32,
                'hazard_gravity' => 'Low',
                'hazard_gravity_pct' => 55,
                'hazard_closed' => 'Low',
                'hazard_closed_pct' => 25,
            ], $values));

            $assessment->created_at = $date;
            $assessment->updated_at = $date;
            $assessment->save();
        }
    }
}
