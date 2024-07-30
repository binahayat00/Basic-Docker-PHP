<?php

namespace App\Exception;

class InvoiceException extends \Exception
{
    public static function invalidAmount(): static
    {
        return new static('Invalid amount!');
    }

    public static function missingBillingInfo(): static
    {
        return new static('Missing billing info!');
    }

}
