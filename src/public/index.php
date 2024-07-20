<?php

use App\Router;

require __DIR__ . '/../vendor/autoload.php';
session_start();

define('STORAGE_PATH',__DIR__. '/../storage');
define('VIEW_PATH',__DIR__. '/../views');

$router = new Router();

$router->get('/',[App\Controllers\HomeController::class, 'index']);
$router->get('/invoices',[App\Controllers\InvoicesController::class, 'index']);
$router->get('/invoices/create',[App\Controllers\InvoicesController::class, 'create']);
$router->post('/invoices/create',[App\Controllers\InvoicesController::class, 'store']);

echo $router->resolve($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);