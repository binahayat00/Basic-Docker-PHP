<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Invoice extends Model
{
    public function create(float $amount, int $userId): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO invoices (amount, user_id)
            VALUES (?, ?)'
        );

        $stmt->execute([$amount, $userId]);
        return (int) $this->db->lastInsertId();

    }

    public function find(int $id): array
    {
        $stmt = $this->db->prepare(
            'SELECT invoices.id, amount, user_id, full_name 
            FROM invoices 
            LEFT JOIN users ON user_id = users.id 
            WHERE invoices.id = :id'
        );

        $stmt->execute(['id' => $id]);

        $invoice = $stmt->fetch();

        return $invoice ?? [];
    }
}
