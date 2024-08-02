<?php

declare(strict_types=1);

use App\Router;
use App\App;
use App\Controllers\{
    HomeController,
    InvoicesController,
};
use Illuminate\Container\Container;

require __DIR__ . '/../vendor/autoload.php';


define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$container = new Container();
$router = new Router($container);

$router->registerRoutesFromControllerAttribuutes(
    [
        HomeController::class,
        InvoicesController::class,
    ]
);

echo (
    (new App(
        $container,
        $router,
        [
            'uri' => $_SERVER['REQUEST_URI'],
            'method' => $_SERVER['REQUEST_METHOD']
        ],
    ))
    ->boot()
    ->run()
);