<?php

use App\View;
use App\Router;
use App\Exception\RouteNotFoundException;

require __DIR__ . '/../vendor/autoload.php';
session_start();

define('STORAGE_PATH',__DIR__. '/../storage');
define('VIEW_PATH',__DIR__. '/../views');
try {
$router = new Router();

$router->get('/',[App\Controllers\HomeController::class, 'index']);
$router->post('/upload',[App\Controllers\HomeController::class, 'upload']);
$router->get('/invoices',[App\Controllers\InvoicesController::class, 'index']);
$router->get('/invoices/create',[App\Controllers\InvoicesController::class, 'create']);
$router->post('/invoices/create',[App\Controllers\InvoicesController::class, 'store']);

echo $router->resolve($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);
} catch (RouteNotFoundException $e) {
    // header('HTTP/1.1 404 Not Found');
    http_response_code(404);
    echo View::make('errors/404');
}