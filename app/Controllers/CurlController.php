<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Contracts\Services\EmailValidationInterface;

class CurlController
{
    public function __construct(private EmailValidationInterface $emailValidationService)
    {
    }

    #[Get('/curl')]
    public function index()
    {
        $email = 'test@test.com';
        $result = $this->emailValidationService->verify($email);
        echo '<pre>';
        var_dump($result);
        echo '</pre>';

    }
}
