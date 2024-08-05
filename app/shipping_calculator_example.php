<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

use App\Enums\Shipping\DimDivisor;
use App\Services\Shipping\Weight;
use App\Services\Shipping\PackageDimension;
use App\Services\Shipping\BillableWeightCalculatorService;

$package = [
    'weight' => 6,
    'dimensions' => [
        'width' => 9,
        'length' => 15,
        'height' => 7
    ]
];

$billableWeightCalculatorService = new BillableWeightCalculatorService();

$packageDimensions = new PackageDimension(
    $package['dimensions']['width'],
    $package['dimensions']['height'],
    $package['dimensions']['length']
);

$weight = new Weight($package['weight']);

$billableWeight = $billableWeightCalculatorService->calculate(
    $packageDimensions,
    $weight,
    DimDivisor::FEDEX
);

var_dump($billableWeight);

$widerPackageDimensions = $packageDimensions->increaseWidth(10);

$widerbillableWeight = $billableWeightCalculatorService->calculate(
    $widerPackageDimensions,
    $weight,
    DimDivisor::FEDEX
);

var_dump($widerbillableWeight);