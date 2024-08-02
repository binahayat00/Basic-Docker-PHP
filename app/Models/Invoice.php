<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvoiceStatus;
use App\Model;

class Invoice extends Model
{
    public function create(float $amount, int $userId): int
    {
        $stmt = $this->db->insert('invoices')->values(
            [
                'amount' => '?',
                'user_id' => '?'
            ]
        )->setParameter(0, $amount)
            ->setParameter(1, $userId);

        return $stmt->id;
    }

    public function find(int $id): array
    {
        return $this->db->createQueryBuilder()->select(
            'i.id',
            'invoice_number',
            'amount',
            'status',
            'user_id',
            'full_name',
        )->from('invoices', 'i')
            ->innerJoin('i', 'users', 'u', 'i.user_id = u.id')
            ->where('i.id = ?')
            ->setParameter(0, $id);
    }

    public function all(): array
    {
        return $this->db->createQueryBuilder()->select(
            'id',
            'invoice_number',
            'amount',
            'status'
        )->from('invoices')
            ->fetchAllAssociative();
    }

    public function filterByStatus(InvoiceStatus $status): array
    {
        return $this->db->createQueryBuilder()->select(
            'id',
            'invoice_number',
            'amount',
            'status'
        )->from('invoices')
            ->where('status = ?')
            ->setParameter(1, $status->value)
            ->fetchAllAssociative();
    }
}
