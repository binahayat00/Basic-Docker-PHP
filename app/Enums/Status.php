<?php

declare(strict_types=1);

namespace App\Enums;

enum Status
{
    case PAID;
    case PENDING;
    case DECLINED;

    public function text() : string
    {
        return match ($this) {
            self::PAID => 'paid',
            self::PENDING => 'pending',
            self::DECLINED => 'declined',
        };
    }
    
    public static function all() : array
    {
        $statuses = [];
        foreach (self::cases() as $status) {
            $statuses[] = $status->text();
        }
        return $statuses;
    }

}