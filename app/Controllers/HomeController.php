<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use Slim\Views\Twig;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController
{
    public function index(Request $request, Response $response, $args): Response
    {
        return Twig::fromRequest($request)->render($response,'index.twig');
    }
}
