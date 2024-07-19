<?php

use App\Router;

require __DIR__ . '/../vendor/autoload.php';


$router = new Router();

$router->get('/',[App\Classes\Home::class, 'index']);
$router->get('/invoices',[App\Classes\Invoices::class, 'index']);
$router->get('/invoices/create',[App\Classes\Invoices::class, 'create']);
$router->post('/invoices/create',[App\Classes\Invoices::class, 'store']);

echo $router->resolve($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);