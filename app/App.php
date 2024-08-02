<?php

declare(strict_types=1);

namespace App;

use Dotenv\Dotenv;
use App\Config;
use App\Services\SymfonyMail\CustomMailerService;
use App\Exception\RouteNotFoundException;
use Symfony\Component\Mailer\MailerInterface;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Container\Container;

class App
{
    private Config $config;
    public function __construct(
        protected Container $container, 
        protected ?Router $router = null, 
        protected array $request = [], 
        )
    {
    }

    public function boot(): static
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $this->config = new Config($_ENV);

        $this->initDb($this->config->db);

        $this->container->bind(
            MailerInterface::class,
            fn() => new CustomMailerService($this->config->mailer['dsn'])
        );

        $this->container->bind(
            Config::class,
            fn() => new Config($_ENV)
        );

        return $this;
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

    public function initDb(array $config): void
    {
        
        $configDB = (new Config($_ENV))->db;
        $capsule = new Capsule;
        
        $capsule->addConnection($config);
        $capsule->setEventDispatcher(new Dispatcher($this->container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
