<?php

require __DIR__ . '/../vendor/autoload.php';

$coffeeMaker = new \App\CoffeeMaker();
$coffeeMaker->makeCoffee();

$latteMaker = new \App\LatteMaker();
$latteMaker->makeCoffee();
$latteMaker->makeLatte();

$cappuccinoMaker = new \App\CappuccinoMaker();
$cappuccinoMaker->makeCoffee();
$cappuccinoMaker->makeCappuccino();

$allInOneCoffeeMaker = new \App\AllInOneCoffeeMaker();
$allInOneCoffeeMaker->makeCoffee();
$allInOneCoffeeMaker->makeLatte();
$allInOneCoffeeMaker->makeCappuccino();