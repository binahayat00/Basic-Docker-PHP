<?php

declare(strict_types=1);

namespace App;

use App\Config;
use Dotenv\Dotenv;
use Twig\Environment;
use Illuminate\Events\Dispatcher;
use Twig\Loader\FilesystemLoader;
use Twig\Extra\Intl\IntlExtension;
use Illuminate\Container\Container;
use App\Exception\RouteNotFoundException;
use Symfony\Component\Mailer\MailerInterface;
use App\Services\SymfonyMail\CustomMailerService;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Contracts\Services\EmailValidationInterface;
use App\Services\AbstractApi\EmailValidationService;

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

        $loader = new FilesystemLoader(VIEW_PATH);
        $twig = new Environment($loader, [
            'cache' => STORAGE_PATH . '/cache',
            'auto_reload' => true
        ]);

        $twig->addExtension(new IntlExtension());

        $this->container->singleton(Environment::class, fn() => $twig);

        $this->container->bind(
            MailerInterface::class,
            fn() => new CustomMailerService($this->config->mailer['dsn'])
        );

        $this->container->bind(
            Config::class,
            fn() => new Config($_ENV)
        );

        $this->container->bind(
            EmailValidationInterface::class,
            fn() => new EmailValidationService($this->config->apiKeys['abstract_api_email_validation'])
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
