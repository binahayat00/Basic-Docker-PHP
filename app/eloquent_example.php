<?php 

declare(strict_types=1);

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\InvoiceItem;

require_once __DIR__ ."/../vendor/autoload.php";
require __DIR__ ."/../eloquent.php";

$invoice = new Invoice();

$invoice->amount = 45;
$invoice->invoice_number = "1";
$invoice->status = InvoiceStatus::PENDING;
$invoice->save();

$items = [['Item 1', 1, 15], ['Item 2', 2, 7.5], ['Item 3', 3, 3.75]];

foreach($items as [$description, $quantity, $unitPrice])
{
    $item = new InvoiceItem();

    $item->description = $description;
    $item->quantity = $quantity;
    $item->unit_price = $unitPrice;

    $item->invoice()->associate($invoice);

    $item->save();
}