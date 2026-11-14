<?php

if (! function_exists('greeting')) {
    function greeting(): string
    {
        $hour = now()->hour;

        return match (true) {
            $hour >= 5 && $hour < 12 => 'Good Morning',
            $hour >= 12 && $hour < 17 => 'Good Afternoon',
            $hour >= 17 && $hour < 21 => 'Good Evening',
            default => 'Good Night',
        };
    }
}
