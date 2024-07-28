<?php

declare(strict_types= 1);

namespace App\Controllers;

use App\View;
use App\Attributes\Get;
use App\Attributes\Post;

class InvoicesController
{
    #[Get(path:"/invoices")]
    public function index(): View
    {
        return View::make("invoices/index");
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
