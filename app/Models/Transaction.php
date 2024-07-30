<?php

namespace App\Models;
use App\Model;

class Transaction extends Model
{
    public function create(array $attributes): int
    {
        $stmt = $this->db->prepare("INSERT INTO transactions (checks, descriptions, amount, created_at)
                        VALUES (:checks, :descriptions, :amount, NOW())"
                );
        $stmt->execute([
            'checks' => $attributes['checks'],
            'descriptions' => $attributes['descriptions'],
            'amount' => $attributes['amount']
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function getAll(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM transactions');

        $stmt->execute();

        $transactions = $stmt->fetchAll();

        return $transactions ?? [];
    }
}
