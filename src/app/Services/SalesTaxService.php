<?php

namespace App\Services;

class SalesTaxService
{
    public function process(float $amount, array $customer)
    {
        return $amount * 65/100;
    }
}
