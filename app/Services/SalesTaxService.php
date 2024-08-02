<?php

namespace App\Services;

class SalesTaxService
{
    public function process(float $amount, array $customer): float
    {
        return $amount * 65/100;
    }
}
