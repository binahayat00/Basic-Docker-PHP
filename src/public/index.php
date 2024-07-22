<?php

use App\Router;
use App\App;
use App\Config;
use App\Controllers\{
    HomeController,
    InvoicesController,
};

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

$router = new Router();
$router->get('/', [HomeController::class, 'index']);
$router->post('/upload', [HomeController::class, 'upload']);
$router->get('/invoices', [InvoicesController::class, 'index']);
$router->get('/invoices/create', [InvoicesController::class, 'create']);
$router->post('/invoices/create', [InvoicesController::class, 'store']);


echo (
    new App(
        $router,
        [
            'uri' => $_SERVER['REQUEST_URI'],
            'method' => $_SERVER['REQUEST_METHOD']
        ],
        new Config($_ENV)
    )
)->run();