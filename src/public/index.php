<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Invoice;

$invoice = new Invoice(25,'Invoice 1', '123456789123456');

$invoice2 = clone $invoice;

$str = serialize($invoice);

var_dump(unserialize($str)) . "<br />";
var_dump($invoice, $invoice2, $invoice === $invoice2);