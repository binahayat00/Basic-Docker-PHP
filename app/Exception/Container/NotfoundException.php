<?php

declare(strict_types= 1);

namespace App\Exception\Container;
use Psr\Container\NotFoundExceptionInterface;

class NotfoundException extends \Exception implements NotFoundExceptionInterface
{
}
