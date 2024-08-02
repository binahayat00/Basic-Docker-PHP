<?php

declare(strict_types=1);

namespace App\Attributes;

use Attribute;
use App\Enums\HttpMethod;

#[Attribute(Attribute::TARGET_METHOD|Attribute::IS_REPEATABLE)]
class Options extends Route
{
    public function __construct(public string $path)
    {
        parent::__construct($path,HttpMethod::OPTIONS);
    }
}
