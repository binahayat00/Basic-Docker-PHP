<?php 

namespace App;

use App\Customer;
use App\Exception\InvoiceException;

class Invoice
{
    public string $id;

    public function __construct(public Customer $customer)
    {
    }

    public function process(float $amount)
    {
        if($amount <= 0){
            throw InvoiceException::invalidAmount();
        }

        if(empty($this->customer->getBillingInfo()))
        {
            throw InvoiceException::missingBillingInfo();
        }
        echo "Processing $ $amount invoice - ";
        
        sleep(1);

        echo 'OK' . PHP_EOL;
    }
}