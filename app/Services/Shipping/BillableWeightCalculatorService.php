<?php

namespace App\Services\Shipping;
use App\Enums\Shipping\DimDivisor;

class BillableWeightCalculatorService
{
    public function calculate(
        PackageDimension $packageDimension,
        Weight $weight,
        DimDivisor $dimDivisor,
    ): int {
        $dimWeight = (int) round(
            $packageDimension->width * $packageDimension->height * $packageDimension->length / $dimDivisor->value
        );

        return max($dimWeight, $weight->value);
    }
}
