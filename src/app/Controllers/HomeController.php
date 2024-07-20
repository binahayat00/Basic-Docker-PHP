<?php

declare(strict_types= 1);

namespace App\Controllers;

use App\View;

class HomeController
{
    public function index(): View
    {
        return View::make("index",['title' => 'Home Page']);
    }

    public function upload()
    {
        $filePath = STORAGE_PATH .'/' . $_FILES['receipt']['name'];

        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);
        header('Location: /');
        exit;
    }
}
