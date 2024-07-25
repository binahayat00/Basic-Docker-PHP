<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Models\User;
use App\Models\SignUp;
use App\Models\Invoice;
use App\Services\InvoiceService;

class HomeController
{

    public function __construct(private InvoiceService $invoiceService)
    {
    }
    public function index(): View
    {
        return View::make("index", ['title' => 'Home Page']);
    }

    public function signUp(SignUp $signUp): View
    {
        $email = 'john4@doe.com';
        $name = 'John1 Doe';
        $amount = 25;

        $userModel = new User();
        $invoiceModel = new Invoice();

        $invoiceId = (new SignUp($userModel, $invoiceModel))->register(
            [
                'email' => $email,
                'name' => $name,
            ],
            [
                'amount' => $amount,
            ]
        );

        return View::make("index", ['title' => 'Sign Up Page', 'invoice' => $invoiceModel->find($invoiceId)]);
    }

    public function upload()
    {
        $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];

        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);
        header('Location: /');
        exit;
    }
}
