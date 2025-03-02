<?php

declare(strict_types=1);

namespace Tests\Unit\Helpers;

use App\Helpers\MathOperationsHelper;

covers(MathOperationsHelper::class);

test('it can sum two numbers', function (mixed $a, mixed $b, mixed $expected) {
    expect(MathOperationsHelper::sum($a, $b))->toBe($expected);
})->with([
    '2 + 2 = 4' => [2, 2, 4],
    '1.1 + 1.1 = 2.2' => [1.1, 1.1, 2.2],
    '0 + 0 = 0' => [0, 0, 0],
    '-16.5 + 6.5 = -10' => [-16.5, 6.5, -10.0],
]);
