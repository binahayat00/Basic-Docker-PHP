<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Exception\InvoiceException;
use App\Invoice;
use App\Customer;

$invoice = new Invoice(new Customer(['name' => 'Alex']));
try {
$invoice->process(-25);
} catch (InvoiceException $exception) {
    echo $exception->getMessage() . ' File:' . $exception->getFile() .' Line:'. $exception->getLine() . PHP_EOL;
}