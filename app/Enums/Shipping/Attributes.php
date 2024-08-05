<?php

namespace App\Enums\Shipping;

enum Attributes
{
    case MIN_WIDTH;
    case MAX_WIDTH;
    case MIN_LENGTH;
    case MAX_LENGTH;
    case MIN_HEIGHT;
    case MAX_HEIGHT;
    case MIN_WEIGHT;
    case MAX_WEIGHT;

    public function text()
    {
        return match ($this) {
            self::MIN_WIDTH => 0,
            self::MAX_WIDTH => 80,
            self::MIN_LENGTH => 0,
            self::MAX_LENGTH => 120,
            self::MIN_HEIGHT => 0,
            self::MAX_HEIGHT => 70,
            self::MIN_WEIGHT => 0,
            self::MAX_WEIGHT => 150,
        };
    }
}
