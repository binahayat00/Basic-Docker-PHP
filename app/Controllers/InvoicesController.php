<?php

declare(strict_types= 1);

namespace App\Controllers;

use App\Services\InvoiceService;
use App\View;
use Slim\Views\Twig;
use App\Attributes\Get;
use App\Models\Invoice;
use App\Attributes\Post;
use App\Enums\InvoiceStatus;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class InvoicesController
{
    public function __construct(private readonly Twig $twig, private readonly InvoiceService $invoiceService)
    {

    }

    public function index(Request $request, Response $response, $args): Response
    {
        $invoices = $this->invoiceService->getPaidInvoices();

        return $this->twig->render(
            $response,
            "invoices/index.twig",
            ["invoices"=> $invoices]
        );
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
