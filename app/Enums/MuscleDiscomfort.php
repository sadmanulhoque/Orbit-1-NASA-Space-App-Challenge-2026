<?php

namespace App\Enums;

enum MuscleDiscomfort: string
{
    case NONE = 'none';
    case MILD = 'mild';
    case MODERATE = 'moderate';

    public function label(): string
    {
        return match ($this) {
            self::NONE => 'None',
            self::MILD => 'Mild discomfort',
            self::MODERATE => 'Moderate / noticeable discomfort',
        };
    }
}
