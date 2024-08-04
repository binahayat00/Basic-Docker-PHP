<?php

namespace App\Services\Shipping;

class BillableWeightCalculatorService
{
    public function calculate(
        int $width,
        int $height,
        int $length,
        int $weight,
        int $dimDivisor,
    ): int {
        $dimWeight = (int) round($width * $height * $length / $dimDivisor);

        return max($dimWeight, $weight);
    }
}
