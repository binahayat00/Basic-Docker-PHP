<?php

declare(strict_types=1);

namespace PaymentGateway\Stripe;

class Transaction 
{
    private ?Customer $customer = null;
    public function __construct(
            private float $amount,
            private string $description
        ){
        echo $amount;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function addTax(float $rate): Transaction
    {
        $this->amount += $this->amount * $rate / 100;
        return $this;
    }

    public function applyDiscount(float $rate): Transaction
    {
        $this->amount -= $this->amount * $rate / 100;
        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}