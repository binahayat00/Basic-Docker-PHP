<?php

declare(strict_types=1);

namespace App\Controllers;

use PDO;
use App\App;
use App\View;
use App\Models\User;
use App\Models\SignUp;
use App\Models\Invoice;

class HomeController
{
    public function index(): View
    {

        $email = 'john4@doe.com';
        $name = 'John1 Doe';
        $amount = 25;

        $userModel = new User();
        $invoiceModel = new Invoice();

        $invoiceId = (new SignUp($userModel, $invoiceModel))->register(
            [
                'email'=> $email,
                'name'=> $name,
            ],
            [
                'amount'=> $amount,
            ]
        );

        return View::make("index", ['title' => 'Home Page', 'invoice' => $invoiceModel->find($invoiceId)]);
    }

    public function upload()
    {
        $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];

        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);
        header('Location: /');
        exit;
    }
}
