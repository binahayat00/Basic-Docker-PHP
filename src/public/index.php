<?php

use App\Invoice;
use App\InvoiceCollection;

require __DIR__ . '/../vendor/autoload.php';

$invoiceCollection = new InvoiceCollection([new Invoice('15'), new Invoice('25'), new Invoice('50')]);

foreach ($invoiceCollection as $invoice) {
    echo $invoice->id .' - '. $invoice->amount . '<br />' ;
}