<?php

// spl_autoload_register(function($class) {
//     $path =  __DIR__ . '/../' . lcfirst(str_replace('\\','/', $class) . '.php');
//     require $path;

// });

require __DIR__ . '/../vendor/autoload.php';

use App\PaymentGateway\Paddle\Transaction;

$transaction = new Transaction(15);

$reflectionProperty = new ReflectionProperty(Transaction::class, 'amount');

$reflectionProperty->setAccessible(true);

$reflectionProperty->setValue($transaction, 125);

var_dump($reflectionProperty->getValue($transaction));

var_dump($transaction->process());
