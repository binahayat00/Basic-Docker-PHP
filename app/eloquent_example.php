<?php 

declare(strict_types=1);

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Config;
use Dotenv\Dotenv;

require_once __DIR__ ."/../vendor/autoload.php";
require __DIR__ ."/../eloquent.php";