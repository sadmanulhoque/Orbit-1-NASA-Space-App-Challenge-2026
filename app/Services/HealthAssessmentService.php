<?php

namespace App\Services;

use App\Enums\CognitiveMood;
use App\Enums\EnergyLevel;
use App\Enums\Exercises;
use App\Enums\Feelings;
use App\Enums\MuscleDiscomfort;
use App\Enums\SleepHours;
use App\Interfaces\HealthAssessmentInterface;
use App\Models\HealthAssessment;

class HealthAssessmentService
{
    public function __construct(
        private HealthAssessmentInterface $repository
    ) {}

    public function getLatestAssessment(): ?HealthAssessment
    {
        return $this->repository->latest();
    }
    public function getTrendData(): array
    {
        $assessments = $this->repository->trend();

        return [
            'labels' => $assessments
                ->map(fn (HealthAssessment $assessment): string => $assessment->created_at->format('M j'))
                ->values()
                ->all(),
            'series' => [
                [
                    'name' => 'Heart Rate',
                    'data' => $assessments->map(fn (HealthAssessment $assessment): int => (int) $assessment->heart_rate)->values()->all(),
                ],
                [
                    'name' => 'Blood Pressure',
                    'data' => $assessments->map(fn (HealthAssessment $assessment): int => (int) explode('/', $assessment->blood_pressure)[0])->values()->all(),
                ],
                [
                    'name' => 'Temperature',
                    'data' => $assessments->map(fn (HealthAssessment $assessment): float => (float) $assessment->temperature)->values()->all(),
                ],
            ],
        ];
    }

    public function getAssessmentStreakDays(?HealthAssessment $assessment): int
    {
        return $assessment
        ? $assessment->created_at->startOfDay()->diffInDays(now()->startOfDay()) + 1
        : 0;
    }

    public function processAssessment(array $answers): HealthAssessment
    {
        $result = $this->calculate($answers);

        return $this->repository->create($result);
    }

    private function calculate(array $answers): array
    {
        $data = $this->initializeBaseData($answers);

        $this->applySleepImpact($answers['sleep'], $data);
        $this->applyExerciseImpact($answers['exercise'], $data);
        $this->applyBoneImpact($answers['bone'], $data);
        $this->applyMoodImpact($answers['mood'], $data);
        $this->applyIsolationImpact($answers['isolation'], $data);
        $this->applyEnergyImpact($answers['energy'], $data);

        $this->finalizeScoreAndStatus($data);
        $this->setDefaultGuidanceIfEmpty($data);
        $this->addSimulatedVitals($answers['sleep'], $data);
        $this->addHazardLevels($answers, $data);

        return $data;
    }

    private function initializeBaseData(array $answers): array
    {
        return [
            'sleep_hours' => (int) $answers['sleep'],
            'exercise' => $answers['exercise'],
            'bone_discomfort' => $answers['bone'],
            'mood' => $answers['mood'],
            'isolation' => $answers['isolation'],
            'energy' => $answers['energy'],

            'readiness_score' => 100,
            'overall_status' => null,
            'overall_sub' => null,

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
            'guidance_items' => [],
        ];
    }

    private function applySleepImpact(int $sleep, array &$data): void
    {
        if ($sleep <= 5) {
            $data['readiness_score'] -= 18;
            $data['brain_status'] = 'Watch';
            $data['brain_desc'] = 'Possible cognitive fatigue from short sleep.';
            $data['guidance_items'][] = 'Prioritize sleep recovery tonight';
        } elseif ($sleep === 6) {
            $data['readiness_score'] -= 8;
        }
    }

    private function applyExerciseImpact(string $exercise, array &$data): void
    {
        if ($exercise === 'no') {
            $data['readiness_score'] -= 15;
            $data['bones_status'] = 'Watch';
            $data['bones_desc'] = 'Bone density risk elevated – no resistance training.';
            $data['guidance_items'][] = 'Do resistance exercises';
            $data['guidance_items'][] = 'Ensure adequate nutrition (Calcium + Vitamin D)';
            $data['main_alert'] = 'Your bone density risk is elevated due to lack of resistance exercise.';
        } elseif ($exercise === 'partial') {
            $data['readiness_score'] -= 7;
            $data['bones_status'] = 'Watch';
            $data['bones_desc'] = 'Bone loading incomplete today.';
            $data['guidance_items'][] = 'Complete full resistance protocol';
            $data['main_alert'] = 'Bone loading was only partial today.';
        }
    }

    private function applyBoneImpact(string $bone, array &$data): void
    {
        if ($bone === 'moderate') {
            $data['readiness_score'] -= 20;
            $data['bones_status'] = 'Watch';
            $data['bones_desc'] = 'Moderate bone/joint discomfort reported.';
            $data['main_alert'] = 'Moderate bone/joint discomfort detected. Recommend Flight Surgeon review.';
            $data['guidance_items'][] = 'Reduce high-impact activity temporarily';
            $data['guidance_items'][] = 'Recheck in next check-in';
        } elseif ($bone === 'mild') {
            $data['readiness_score'] -= 10;
            $data['bones_status'] = 'Watch';
            $data['bones_desc'] = 'Mild bone/joint discomfort.';

            if (! $data['main_alert']) {
                $data['main_alert'] = 'Mild bone discomfort reported.';
            }

            $data['guidance_items'][] = 'Monitor symptoms closely';
        }
    }

    private function applyMoodImpact(string $mood, array &$data): void
    {
        if (in_array($mood, ['low', 'stressed'])) {
            $data['readiness_score'] -= 12;
            $data['brain_status'] = 'Watch';
            $data['brain_desc'] = $mood === 'stressed'
                ? 'Elevated stress detected.'
                : 'Cognitive fog reported.';
            $data['guidance_items'][] = 'Use relaxation / circadian protocols';
        }
    }

    private function applyIsolationImpact(string $isolation, array &$data): void
    {
        if ($isolation === 'high') {
            $data['readiness_score'] -= 10;
            $data['guidance_items'][] = 'Schedule crew interaction / private conference';
        } elseif ($isolation === 'medium') {
            $data['readiness_score'] -= 5;
        }
    }

    private function applyEnergyImpact(string $energy, array &$data): void
    {
        if ($energy === 'low') {
            $data['readiness_score'] -= 8;
            $data['immune_status'] = 'Watch';
            $data['immune_desc'] = 'Possible early fatigue signal.';
        }
    }

    private function finalizeScoreAndStatus(array &$data): void
    {
        $score = max(42, min(98, (int) round($data['readiness_score'])));
        $data['readiness_score'] = $score;

        if ($score >= 90) {
            $data['overall_status'] = 'All Readings Normal';
            $data['overall_sub'] = 'Excellent mission readiness';
        } elseif ($score >= 75) {
            $data['overall_status'] = 'Minor Attention Needed';
            $data['overall_sub'] = 'Some parameters require monitoring';
        } else {
            $data['overall_status'] = 'Action Recommended';
            $data['overall_sub'] = 'Review Action Guidance below';
        }
    }

    private function setDefaultGuidanceIfEmpty(array &$data): void
    {
        if (empty($data['guidance_items'])) {
            $data['guidance_items'] = [
                'Maintain current exercise & sleep routine',
                'Continue daily resistance protocol',
                'Recheck in next scheduled check-in',
            ];
        }
    }

    private function addSimulatedVitals(int $sleep, array &$data): void
    {
        $data['heart_rate'] = 68 + rand(0, 11);
        $sys = 112 + rand(0, 13);
        $dia = 72 + rand(0, 9);
        $data['blood_pressure'] = "{$sys}/{$dia}";
        $data['temperature'] = round(36.4 + (mt_rand(0, 50) / 100), 1);
        $data['blood_glucose'] = 88 + rand(0, 17);

        $data['sleep_hours_display'] = $sleep >= 7
            ? round(7 + (mt_rand(0, 10) / 10), 1)
            : round($sleep + (mt_rand(0, 8) / 10), 1);
    }

    private function addHazardLevels(array $answers, array &$data): void
    {
        // Isolation
        if ($answers['isolation'] === 'high') {
            $isolationPct = 72;
        } elseif ($answers['isolation'] === 'medium') {
            $isolationPct = 48;
        } else {
            $isolationPct = 28;
        }

        $data['hazard_isolation_pct'] = $isolationPct;
        $data['hazard_isolation'] = $isolationPct >= 60 ? 'High' : ($isolationPct >= 40 ? 'Medium' : 'Low');

        // Gravity
        $gravityPct = ($answers['exercise'] === 'no' || $answers['bone'] !== 'none') ? 75 : 55;
        $data['hazard_gravity_pct'] = $gravityPct;
        $data['hazard_gravity'] = $gravityPct >= 65 ? 'Medium' : 'Low';

        // Closed environment
        $closedPct = ($answers['mood'] === 'stressed' || $answers['energy'] === 'low') ? 45 : 25;
        $data['hazard_closed_pct'] = $closedPct;
        $data['hazard_closed'] = $closedPct >= 40 ? 'Medium' : 'Low';

        // Static ones
        $data['hazard_radiation'] = 'Medium';
        $data['hazard_radiation_pct'] = 58;
        $data['hazard_distance'] = 'Low';
        $data['hazard_distance_pct'] = 32;
    }

    public function getSleepHours(): array
    {
        return SleepHours::cases();
    }

    public function getExercises(): array
    {
        return Exercises::cases();
    }

    public function getMusclediscomfort(): array
    {
        return MuscleDiscomfort::cases();
    }

    public function getCognitiveMood(): array
    {
        return CognitiveMood::cases();
    }

    public function getFeelings(): array
    {
        return Feelings::cases();
    }

    public function getEnergyLevel(): array
    {
        return EnergyLevel::cases();
    }
}
