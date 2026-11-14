<?php

namespace App\Services;

use App\Interfaces\HealthAssessmentInterface;

class HealthAssessmentService
{
    public function __construct(
        protected HealthAssessmentInterface $repository
    ) {}

    public function getLatestAssessment()
    {
        return $this->repository->latest();
    }

    public function processAssessment(array $answers)
    {
        $result = $this->calculateHealthStatus($answers);

        return $this->repository->create($result);
    }

    private function calculateHealthStatus(array $answers): array
    {
        $score = 100;
        $brainStatus = 'Normal';
        $brainDesc = 'Cognitive function is stable.';
        $heartStatus = 'Normal';
        $heartDesc = 'HR in range';
        $bonesStatus = 'Normal';
        $bonesDesc = 'Bone density within expected range.';
        $eyesStatus = 'Normal';
        $eyesDesc = 'Vision stable.';
        $immuneStatus = 'Normal';
        $immuneDesc = 'Immune response is good.';

        $guidance = [];
        $mainAlert = null;

        // Sleep impact
        $sleep = (int) $answers['sleep'];
        if ($sleep <= 5) {
            $score -= 18;
            $brainStatus = 'Watch';
            $brainDesc = 'Possible cognitive fatigue from short sleep.';
            $guidance[] = 'Prioritize sleep recovery tonight';
        } elseif ($sleep === 6) {
            $score -= 8;
        }

        // Exercise / Bone loading
        if ($answers['exercise'] === 'no') {
            $score -= 15;
            $bonesStatus = 'Watch';
            $bonesDesc = 'Bone density risk elevated – no resistance training.';
            $guidance[] = 'Do resistance exercises';
            $guidance[] = 'Ensure adequate nutrition (Calcium + Vitamin D)';
            $mainAlert = 'Your bone density risk is elevated due to lack of resistance exercise.';
        } elseif ($answers['exercise'] === 'partial') {
            $score -= 7;
            $bonesStatus = 'Watch';
            $bonesDesc = 'Bone loading incomplete today.';
            $guidance[] = 'Complete full resistance protocol';
            $mainAlert = 'Bone loading was only partial today.';
        }

        // Bone discomfort
        if ($answers['bone'] === 'moderate') {
            $score -= 20;
            $bonesStatus = 'Watch';
            $bonesDesc = 'Moderate bone/joint discomfort reported.';
            $mainAlert = 'Moderate bone/joint discomfort detected. Recommend Flight Surgeon review.';
            $guidance[] = 'Reduce high-impact activity temporarily';
            $guidance[] = 'Recheck in next check-in';
        } elseif ($answers['bone'] === 'mild') {
            $score -= 10;
            $bonesStatus = 'Watch';
            $bonesDesc = 'Mild bone/joint discomfort.';
            if (! $mainAlert) {
                $mainAlert = 'Mild bone discomfort reported.';
            }
            $guidance[] = 'Monitor symptoms closely';
        }

        // Mood / Cognitive
        if (in_array($answers['mood'], ['low', 'stressed'])) {
            $score -= 12;
            $brainStatus = 'Watch';
            $brainDesc = $answers['mood'] === 'stressed'
                ? 'Elevated stress detected.'
                : 'Cognitive fog reported.';
            $guidance[] = 'Use relaxation / circadian protocols';
        }

        // Isolation
        if ($answers['isolation'] === 'high') {
            $score -= 10;
            $guidance[] = 'Schedule crew interaction / private conference';
        } elseif ($answers['isolation'] === 'medium') {
            $score -= 5;
        }

        // Energy
        if ($answers['energy'] === 'low') {
            $score -= 8;
            $immuneStatus = 'Watch';
            $immuneDesc = 'Possible early fatigue signal.';
        }

        $score = max(42, min(98, (int) round($score)));

        // Overall status
        if ($score >= 90) {
            $overallStatus = 'All Readings Normal';
            $overallSub = 'Excellent mission readiness';
        } elseif ($score >= 75) {
            $overallStatus = 'Minor Attention Needed';
            $overallSub = 'Some parameters require monitoring';
        } else {
            $overallStatus = 'Action Recommended';
            $overallSub = 'Review Action Guidance below';
        }

        if (empty($guidance)) {
            $guidance = [
                'Maintain current exercise & sleep routine',
                'Continue daily resistance protocol',
                'Recheck in next scheduled check-in',
            ];
        }

        // Simulated vitals
        $hr = 68 + rand(0, 11);
        $sys = 112 + rand(0, 13);
        $dia = 72 + rand(0, 9);
        $temp = round(36.4 + (mt_rand(0, 50) / 100), 1);
        $glucose = 88 + rand(0, 17);
        $sleepDisplay = $sleep >= 7
            ? round(7 + (mt_rand(0, 10) / 10), 1)
            : round($sleep + (mt_rand(0, 8) / 10), 1);

        // Dynamic Hazards based on answers
        $isolationPct = match ($answers['isolation']) {
            'high' => 72,
            'medium' => 48,
            default => 28,
        };
        $isolationLevel = $isolationPct >= 60 ? 'High' : ($isolationPct >= 40 ? 'Medium' : 'Low');

        $gravityPct = ($answers['exercise'] === 'no' || $answers['bone'] !== 'none') ? 75 : 55;
        $gravityLevel = $gravityPct >= 65 ? 'Medium' : 'Low';

        $closedPct = ($answers['mood'] === 'stressed' || $answers['energy'] === 'low') ? 45 : 25;
        $closedLevel = $closedPct >= 40 ? 'Medium' : 'Low';

        return [
            'sleep_hours' => $sleep,
            'exercise' => $answers['exercise'],
            'bone_discomfort' => $answers['bone'],
            'mood' => $answers['mood'],
            'isolation' => $answers['isolation'],
            'energy' => $answers['energy'],

            'readiness_score' => $score,
            'overall_status' => $overallStatus,
            'overall_sub' => $overallSub,

            'brain_status' => $brainStatus,
            'brain_desc' => $brainDesc,
            'heart_status' => $heartStatus,
            'heart_desc' => $heartDesc,
            'bones_status' => $bonesStatus,
            'bones_desc' => $bonesDesc,
            'eyes_status' => $eyesStatus,
            'eyes_desc' => $eyesDesc,
            'immune_status' => $immuneStatus,
            'immune_desc' => $immuneDesc,

            'heart_rate' => $hr,
            'blood_pressure' => "{$sys}/{$dia}",
            'temperature' => $temp,
            'blood_glucose' => $glucose,
            'sleep_hours_display' => $sleepDisplay,

            'main_alert' => $mainAlert,
            'guidance_items' => $guidance,

            'hazard_radiation' => 'Medium',
            'hazard_radiation_pct' => 58,
            'hazard_isolation' => $isolationLevel,
            'hazard_isolation_pct' => $isolationPct,
            'hazard_distance' => 'Low',
            'hazard_distance_pct' => 32,
            'hazard_gravity' => $gravityLevel,
            'hazard_gravity_pct' => $gravityPct,
            'hazard_closed' => $closedLevel,
            'hazard_closed_pct' => $closedPct,
        ];
    }
}
