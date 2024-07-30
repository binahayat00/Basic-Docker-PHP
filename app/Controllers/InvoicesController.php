<?php

declare(strict_types= 1);

namespace App\Controllers;

use App\View;
use App\Enums\Color;
use App\Attributes\Get;
use App\Models\Invoice;
use App\Attributes\Post;
use App\Enums\InvoiceStatus;

class InvoicesController
{
    #[Get(path:"/invoices")]
    public function index(): View
    {
        $invoices = (new Invoice)->filterByStatus(InvoiceStatus::PAID);
        return View::make("invoices/index",["invoices"=> $invoices]);
    }

    #[Get(path:"/invoices/create")]
    public function create(): View
    {
        return View::make("invoices/create");
    }

    #[Post(path:"/invoices/create")]
    public function store(): string
    {
        $amount = $_POST['amount'];
        return $amount;
    }
}
