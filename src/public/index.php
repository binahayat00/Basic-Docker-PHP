<?php

// spl_autoload_register(function($class) {
//     $path =  __DIR__ . '/../' . lcfirst(str_replace('\\','/', $class) . '.php');
//     require $path;

// });

require __DIR__ . '/../vendor/autoload.php';

use App\PaymentGateway\Paddle\Transaction;
use App\Enums\Status;
$transaction = new Transaction();

$transaction->setStatus(Status::PAID);
var_dump($transaction);

