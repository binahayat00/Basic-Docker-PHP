<?php

namespace App\Contracts\Services;

use App\DTO\EmailValidationResult;

interface EmailValidationInterface
{
    public function verify(string $email): EmailValidationResult;
}
