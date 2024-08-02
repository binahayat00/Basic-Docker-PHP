<?php

declare(strict_types=1);

namespace App\Models;

use PDO;
use App\Enums\EmailStatus;
use Symfony\Component\Mime\Address;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public function queue(
        Address $to,
        Address $from,
        string $subject,
        string $html,
        ?string $text = null
    ): void {
        $stmt = $this->db->prepare(
            'INSERT INTO emails (subject, status, html_body, text_body, meta, created_at)
            VALUES (?, ?, ?, ?, ?, NOW())'
        );

        $meta['to'] = $to->tostring();
        $meta['from'] = $from->tostring();

        $stmt->execute([
            $subject, EmailStatus::Queue->value, $html, $text, json_encode($meta)
        ]);
    }

    public function getEmailsByStatus(EmailStatus $status): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM emails WHERE status = :status'
        );

        $stmt->execute(['status' => $status->value]);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function markEmailSent(int $id): void
    {
        $stmt = $this->db->prepare(
            'UPDATE emails
            SET status = ?, sent_at = NOW()
            WHERE id = ?'
        );

        $stmt->execute([EmailStatus::Sent->value, $id]);
    }
}
