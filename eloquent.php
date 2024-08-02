<?php 

declare(strict_types=1);

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Config;
use Dotenv\Dotenv;

require_once __DIR__ ."/vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$configDB = (new Config($_ENV))->db;
$capsule = new Capsule;

$params = [
    'driver' => $configDB['driver'],
    'host' => $configDB['host'],
    'database' => $configDB['dbname'],
    'username' => $configDB['user'],
    'password' => $configDB['password'],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
];

$capsule->addConnection($params);
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();