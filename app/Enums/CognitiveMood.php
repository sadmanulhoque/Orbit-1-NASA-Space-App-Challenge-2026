<?php

namespace App\Enums;

enum CognitiveMood: string
{
    case EXCELLENT = 'excellent';
    case GOOD = 'good';
    case LOW = 'low';
    case STRESSED = 'stressed';

    public function label(): string
    {
        return match ($this) {
            self::EXCELLENT => 'Excellent',
            self::GOOD => 'Good',
            self::LOW => 'Low energy / Foggy',
            self::STRESSED => 'Stressed / Anxious',
        };
    }
}
