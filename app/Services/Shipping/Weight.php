<?php

declare(strict_types=1);

namespace App\Services\Shipping;
use App\Enums\Shipping\Attributes;

class Weight
{
    public function __construct(public readonly int $value, public readonly ?string $unit = null)
    {
        if($this->value <= Attributes::MIN_WEIGHT->text() || $this->value > Attributes::MAX_WEIGHT->text()) {
            throw new \InvalidArgumentException('Invalid package weight');
        }
    }

    public function equalTo(Weight $other): bool
    {
        return $this->value === $other->value;
    }
}
