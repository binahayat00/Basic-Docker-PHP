<?php

require __DIR__ . '/../vendor/autoload.php';

use App\ToasterPro;
use App\FancyOven;

$toaster = new ToasterPro();

$toaster->addSlice('bread');
$toaster->addSlice('bread');
$toaster->addSlice('bread');
$toaster->addSlice('bread');
$toaster->addSlice('bread');
$toaster->toastBagel();

$fancyOven = new FancyOven($toaster);
$fancyOven->toast();
