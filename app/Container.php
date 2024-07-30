<?php

declare(strict_types=1);

namespace App;

use Psr\Container\ContainerInterface;
use App\Exception\Container\ContainerException;

class Container implements ContainerInterface
{
    private array $entries = [];
    function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];

            if (is_callable($entry)) {
                return $entry($this);
            }

            $id = $entry;
        }
        return $this->resolve($id);
    }
    function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable|string $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

    public function resolve(string $id)
    {
        $reflectionClass = new \ReflectionClass($id);

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Class '$id' is not instantiable");
        }

        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $id;
        }

        $parameters = $constructor->getParameters();

        if (count($parameters) === 0) {
            return new $id;
        }

        $dependencies = array_map(function (\ReflectionParameter $parameter) use ($id) {
            $name = $parameter->getName();
            $type = $parameter->getType();

            if (!$type) {
                throw new ContainerException(
                    "Failed to resolve class '$id' because param '$name' has missed a type hint!"
                );
            }

            if ($type instanceof \ReflectionUnionType) {
                throw new ContainerException(
                    "Failed to resolve class '$id' because of union type for param '$name' !"
                );
            }

            if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                return $this->get($type->getName());
            }

            throw new ContainerException(
                "Failed to resolve class '$id' because the invalid param '$name' !"
            );
        }, $parameters);

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}
