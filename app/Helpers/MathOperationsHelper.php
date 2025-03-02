<?php

declare(strict_types=1);

namespace App\Helpers;

class MathOperationsHelper
{
    public static function sum(float|int $a, float|int $b): float|int
    {
        return $a + $b;
    }
}
