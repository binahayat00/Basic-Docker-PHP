<?php

require_once "../PaymentGateway/Stripe/Transaction.php";
require_once "../PaymentGateway/Paddle/Transaction.php";
require_once "../PaymentGateway/Paddle/CustomerProfile.php";
require_once "../Notification/Email.php";

use PaymentGateway\Paddle\{Transaction, CustomerProfile};
use PaymentGateway\Stripe\Transaction as StripeTransaction;

var_dump(new Transaction(5,'Test'));
var_dump(new StripeTransaction(5,'Test'));
var_dump(new CustomerProfile());

