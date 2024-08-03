<?php

namespace App\Contracts\Services;

interface EmailValidationInterface
{
    public function verify(string $email): array;
}
