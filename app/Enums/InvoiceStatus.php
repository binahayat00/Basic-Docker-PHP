<?php

namespace App\Enums;

use App\Enums\Color;

enum InvoiceStatus: int
{
    case PENDING = 0;
    case PAID = 1;
    case VOID = 2;
    case FAILD = 3;

    public function color(): Color
    {
        return match ($this) {
            self::PAID => Color::Green,
            self::FAILD => Color::Red,
            self::VOID => Color::Gray,
            self::PENDING => Color::Blue,
            default => Color::Black,
        };
    }

    public static function fromColor(Color $color): ?self
    {
        return match ($color) {
            Color::Green => self::PAID,
            Color::Red => self::FAILD,
            Color::Gray => self::VOID,
            Color::Blue => self::PENDING,
            Color::Black => null,
        };
    }
}
