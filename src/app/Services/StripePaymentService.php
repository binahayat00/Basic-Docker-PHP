<?php

namespace App\Services;

use App\Services\Interfaces\PaymentGatewayInterface;

class StripePaymentService implements PaymentGatewayInterface
{
    public function charge(array $customer, float $amount, $tax): bool
    {
        return true;
    }
}
