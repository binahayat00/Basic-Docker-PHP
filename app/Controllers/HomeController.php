<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Attributes\Get;
use App\Attributes\Post;
use App\Services\InvoiceService;

class HomeController
{
    public function __construct(private InvoiceService $invoiceService)
    {
    }

    #[Get(path:"/")]
    public function index(): View
    {
        return View::make("index", ['title' => 'Home Page']);
    }

    #[Post(path:'/upload')]
    public function upload()
    {
        $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];

        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);
        header('Location: /');
        exit;
    }
}
