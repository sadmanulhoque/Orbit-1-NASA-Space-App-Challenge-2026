<?php

namespace App\Enums;

enum Exercises: string
{
    case YES = 'yes';
    case PARTIAL = 'partial';
    case NO = 'no';

    public function label(): string
    {
        return match ($this) {
            self::YES => 'Yes, full session',
            self::PARTIAL => 'Partial / light session',
            self::NO => 'No',
        };
    }
}
