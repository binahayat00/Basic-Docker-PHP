<?php

declare(strict_types= 1);

namespace App\Controllers;

use App\View;

class InvoicesController
{
    public function index(): View
    {
        return View::make("invoices/index");
    }

    public function create(): View
    {
        return View::make("invoices/create");
    }

    public function store(): string
    {
        $amount = $_POST['amount'];
        return $amount;
    }
}
