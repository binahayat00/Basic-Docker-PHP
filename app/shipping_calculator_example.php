<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

use App\Services\Shipping\BillableWeightCalculatorService;

$package = [
    'weight' => 5,
    'dimensions' => [
        'width' => 9,
        'length' => 15,
        'heught' => 7
    ]
];

$fixedDimDivisor = 139;

$billableWeight = (new BillableWeightCalculatorService())->calculate(
    $package['dimensions']['width'],
    $package['dimensions']['heught'],
    $package['dimensions']['length'],
    $package['weight'],
    $fixedDimDivisor
);

var_dump($billableWeight);