<?php

namespace App;

class Collection implements \IteratorAggregate
{
    public function __construct(private array $items)
    {
    }
    function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }
}
