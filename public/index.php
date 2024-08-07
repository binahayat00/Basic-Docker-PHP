<?php

declare(strict_types=1);

use App\Router;
use App\App;
use App\Controllers\{
    HomeController,
    InvoicesController,
    CurlController,
};
use Illuminate\Container\Container;

require __DIR__ . '/../vendor/autoload.php';


define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEW_PATH', __DIR__ . '/../views');

// $container = new Container();
// $router = new Router($container);

// $router->registerRoutesFromControllerAttribuutes(
//     [
//         HomeController::class,
//         InvoicesController::class,
//         CurlController::class,
//     ]
// );

// echo (
//     (new App(
//         $container,
//         $router,
//         [
//             'uri' => $_SERVER['REQUEST_URI'],
//             'method' => $_SERVER['REQUEST_METHOD']
//         ],
//     ))
//     ->boot()
//     ->run()
// );
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Extra\Intl\IntlExtension;

$app = AppFactory::create();

$twig = Twig::create(VIEW_PATH, [
    'cache' => STORAGE_PATH . '/cache',
    'auto_reload' => true
]);

$twig->addExtension(new IntlExtension());

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

$app->get('/', [HomeController::class,'index']);
$app->get('/invoices', [InvoicesController::class,'index']);

$app->run();