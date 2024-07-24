<?php

namespace App\Services;

class GatewayService
{
    public function charge(array $customer, float $amount, $tax)
    {
        return true;
    }
}
