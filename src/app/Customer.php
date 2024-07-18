<?php

namespace App;

class Customer
{
    public function __construct(private array $billingInfo = [])
    {
    }

    /**
     * Get the value of billingInfo
     */ 
    public function getBillingInfo(): array
    {
        return $this->billingInfo;
    }
}
