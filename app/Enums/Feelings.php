<?php

namespace App\Enums;

enum Feelings: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Not at all / Low',
            self::MEDIUM => 'Somewhat',
            self::HIGH => 'Quite isolated',
        };
    }

}
