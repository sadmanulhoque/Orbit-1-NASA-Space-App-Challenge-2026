<?php

namespace App\Enums;

enum EnergyLevel: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Low / Fatigued',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
        };
    }
}
