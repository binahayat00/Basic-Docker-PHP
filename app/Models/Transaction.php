<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM transactions');

        $stmt->execute();

        $transactions = $stmt->fetchAll();

        return $transactions ?? [];
    }
}
