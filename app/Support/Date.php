<?php

namespace App\Support;

use Carbon\CarbonInterface;

class Date
{
    public static function toIsoString(
        ?CarbonInterface $date
    ): ?string {
        return $date?->toISOString();
    }
}
