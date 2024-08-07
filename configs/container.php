<?php

declare(strict_types= 1);


use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(dirname(__DIR__) .'/configs/container_bindings.php');

return $containerBuilder->build();