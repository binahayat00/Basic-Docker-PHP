<?php

declare(strict_types=1);

namespace App;

use App\DB;
use App\Services\StripePaymentService;
use App\Exception\RouteNotFoundException;
use Symfony\Component\Mailer\MailerInterface;
use App\Services\SymfonyMail\CustomMailerService;
use App\Services\Interfaces\PaymentGatewayInterface;

class App
{
    private static DB $db;
    public function __construct(protected Container $container, protected Router $router, protected array $request, protected Config $config)
    {
        static::$db = new DB($config->db ?? []);

        $this->container->set(
            PaymentGatewayInterface::class,
            StripePaymentService::class
        );
        $this->container->set(
            MailerInterface::class,
            fn() => new CustomMailerService($config->mailer['dsn'])
        );
    }

    public static function db(): DB
    {
        return static::$db;
    }

    public function run()
    {
        try {
            return $this->router->resolve($this->request['uri'], $this->request['method']);
        } catch (RouteNotFoundException) {
            http_response_code(404);

            return View::make('errors/404');
        }
    }
}
