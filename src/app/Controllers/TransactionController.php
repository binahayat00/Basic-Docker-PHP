<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Models\Transaction;

class TransactionController
{
    public function index(): View
    {
        $transaction = new Transaction();

        $transactions = $transaction->getAll();

        return View::make("transactions/index", ["transactions" => $transactions]);
    }
}
