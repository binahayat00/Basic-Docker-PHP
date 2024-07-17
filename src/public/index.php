<?php

require __DIR__ . '/../vendor/autoload.php';

$obj = new class(1, 2, 3) {
    public function __construct(public int $a,public int $b,public int $c)
    {

    }
};

var_dump($obj);