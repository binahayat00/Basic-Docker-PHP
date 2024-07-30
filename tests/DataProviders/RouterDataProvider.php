<?php

declare(strict_types=1);

namespace Tests\DataProviders;

final class RouterDataProvider
{
    public static function routeNotFoundCases(): array
    {
        return [
            ['/users' , 'PUT'],
            ['/invoices','POST'], 
            ['/users','GET'], 
            ['/users','POST'], 
        ];
    }
}
