<?php

declare(strict_types=1);

namespace App\Services\Shipping;

use App\Enums\Shipping\Attributes;

class PackageDimension
{
    public function __construct(
        public readonly int $width,
        public readonly int $height,
        public readonly int $length,
        public readonly ?string $unit = null
    ) {
        match (true) {
            $this->width <= Attributes::MIN_WEIGHT->text() || $this->width > Attributes::MAX_WIDTH->text() => throw new \InvalidArgumentException("Invalid package width"),
            $this->height <= Attributes::MIN_HEIGHT->text() || $this->height > Attributes::MAX_HEIGHT->text() => throw new \InvalidArgumentException("Invalid package height"),
            $this->length <= Attributes::MIN_LENGTH->text() || $this->length > Attributes::MAX_LENGTH->text() => throw new \InvalidArgumentException("Invalid package length"),
            default => true,
        };
    }

    public function increaseWidth(int $width): self
    {
        return new self($this->width + $width, $this->height, $this->length);
    }

    public function equalTo(PackageDimension $other): bool
    {
        return
            $this->width === $other->width &&
            $this->height === $other->height &&
            $this->length === $other->length &&
            $this->unit === $other->unit;
    }
}
