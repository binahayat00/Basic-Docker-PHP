<?php

declare(strict_types=1);

namespace Tests\Unit\Containers;

use App\Container;
use ReflectionException;
use PHPUnit\Framework\TestCase;
use App\Exception\Container\ContainerException;

class ContainerTest extends TestCase
{
    protected Container $container;
    public function setUp(): void
    {
        parent::setUp();
        $this->container = new Container();
    }
    function test_has_entry_works_fine()
    {
        $this->assertFalse($this->container->has('test'));

        $this->container->set('test' , fn() => 'test');

        $this->assertTrue($this->container->has('test'));
    }

    function test_resolve_entry_reflecation_exception()
    {
        $this->expectException(ReflectionException::class);
        
        $this->container->resolve('test');
    }

    function test_resolve_entry_container_exception()
    {
        $this->expectException(ContainerException::class);
        $test = new class($id = 1)
        {
            public function __construct(public int $id){
                $this->id = $id;
            }
        };
        $this->container->resolve($test::class);

    }

    function test_resolve_entry_works_fine()
    {
        $test = new class($this->container)
        {
            public function __construct(public Container $container){
                $this->container = $container;
            }

            public function expected(): string
            {
                return 'expected';
            }
        };
        
        $resolved = $this->container->resolve($test::class);

        $this->assertSame('expected',$resolved->expected());
    }

    function test_get_entry_works_fine()
    {
        $test = new class($this->container)
        {
            public function __construct(public Container $container){
                $this->container = $container;
            }

            public function expected(): string
            {
                return 'expected';
            }
        };
        
        $resolved = $this->container->get($test::class);

        $this->assertSame('expected',$resolved->expected());
    }

    public function test_get_without_resolve_works_fine()
    {
        $test = new class()
        {
            public function expected(): string
            {
                return 'expected';
            }
        };
        $this->container->set($test::class , $test::class);

        $get = $this->container->get($test::class);

        $this->assertSame('expected',$get->expected());

    }

    public function test_set_works_fine()
    {
        $test = new class()
        {
            public function expected(): string
            {
                return 'expected';
            }
        };

        $this->assertFalse($this->container->has($test::class));

        $this->container->set($test::class , $test::class);

        $this->assertTrue($this->container->has($test::class));

        $get = $this->container->get($test::class);

        $this->assertSame('expected',$get->expected());

    }
}
