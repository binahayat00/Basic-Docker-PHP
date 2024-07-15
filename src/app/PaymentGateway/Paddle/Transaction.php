<?php

declare(strict_types=1);

namespace App\PaymentGateway\Paddle;

class Transaction 
{
    public static int $count = 0;

    public function __construct(
        public float $amount,
        public string $description,
    )
    {
    }

    public function process()
    {
        echo 'Processing paddle transaction...';
    }


    /**
     * Get the value of count
     */ 
    public static function getCount()
    {
        return self::$count;
    }
}