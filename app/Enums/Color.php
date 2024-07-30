<?php

namespace App\Enums;

enum Color: string
{
    case Green = 'green';
    case Red = 'red';
    case Gray = 'gray';
    case Blue = 'blue';
    case Black = 'black';

    public function getClass(): string
    {
        return "color-$this->value";
    }
}
