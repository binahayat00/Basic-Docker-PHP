<?php

declare(strict_types=1);

namespace App\Attributes;

use Attribute;
use App\Contracts\RouteInterface;

#[Attribute(Attribute::TARGET_METHOD|Attribute::IS_REPEATABLE)]
class Route implements RouteInterface
{
    public function __construct(public string $path,public string $method = 'GET')
    {
         
    }
}
