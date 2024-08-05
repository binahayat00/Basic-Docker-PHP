<?php

declare(strict_types= 1);

namespace App\Controllers;

use App\View;
use App\Attributes\Get;
use App\Models\Invoice;
use App\Attributes\Post;
use App\Enums\InvoiceStatus;
use Twig\Environment;

class InvoicesController
{
    public function __construct(private Environment $twig)
    {

    }

    #[Get(path:"/invoices")]
    public function index(): string
    {
        $invoices = Invoice::query()
        ->where('status',InvoiceStatus::PAID)
        ->get()
        ->map(
            fn(Invoice $invoice) => [
                'invoiceNumber' => $invoice->invoice_number,
                'amount' => $invoice->amount,
                'status' => $invoice->status->name,
                'createdAt' => $invoice->created_at->toDateTimeString(),
            ]
        )
        ->toArray();

        return $this->twig->render("invoices/index.twig",["invoices"=> $invoices]);
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
