<?php

declare(strict_types=1);

use App\Config;
use Slim\Views\Twig;
use function \DI\create;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Twig\Extra\Intl\IntlExtension;



return [
    Config::class => create(Config::class)->constructor($_ENV),
    EntityManager::class =>  function(Config $config) {
        $configure = ORMSetup::createAttributeMetadataConfiguration(paths: [__DIR__ .'/../app/Entity']);
        
        return new EntityManager(
        DriverManager::getConnection($config->db['doctrine'], $configure),
        $configure,
        );
    },
    Twig::class => function(Config $config) {
        $twig = Twig::create(VIEW_PATH, [
            'cache' => STORAGE_PATH . '/cache',
            'auto_reload' => $config->environment === 'development',
        ]);
        
        $twig->addExtension(new IntlExtension());

        return $twig;
    }
];