<?php

namespace App\Enums;

enum SleepHours: string
{
    case LESS_THAN_5 = '5';
    case FIVE_TO_SIX = '6';
    case SEVEN_TO_EIGHT = '7';
    case MORE_THAN_8 = '9';

    public function label(): string
    {
        return match ($this) {
            self::LESS_THAN_5 => 'Less than 5 hours',
            self::FIVE_TO_SIX => '5–6 hours',
            self::SEVEN_TO_EIGHT => '7–8 hours',
            self::MORE_THAN_8 => 'More than 8 hours',
        };
    }
}
