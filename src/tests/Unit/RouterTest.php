<?php

declare(strict_types=1);

namespace Test\Unit;

use App\Container;
use App\Exception\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private Router $router;
    private Container $container;
    public function setUp(): void
    {
        parent::setUp();
        $this->container = new Container();
        $this->router = new Router($this->container);
    }
    public function test_add_router(): void
    {
        $this->router->addRoute("GET", '/users', ['Users', 'index']);

        $expected = [
            'GET' => [
                '/users' => ['Users', 'index'],
            ],
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    public function test_get(): void
    {
        $this->router->get('/users', ['Users', 'index']);

        $expected = [
            'GET' => [
                '/users' => ['Users', 'index'],
            ],
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    public function test_post(): void
    {
        $this->router->post('/users', ['Users', 'store']);

        $expected = [
            'POST' => [
                '/users' => ['Users', 'store'],
            ],
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    public function test_put(): void
    {
        $this->router->put('/users', ['Users', 'put']);

        $expected = [
            'PUT' => [
                '/users' => ['Users', 'put'],
            ],
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    public function test_delete(): void
    {
        $this->router->delete('/users', ['Users', 'delete']);

        $expected = [
            'DELETE' => [
                '/users' => ['Users', 'delete'],
            ],
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    public function test_options(): void
    {
        $this->router->options('/users', ['Users', 'options']);

        $expected = [
            'OPTIONS' => [
                '/users' => ['Users', 'options'],
            ],
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    public function test_there_are_no_routes_when_router_is_created(): void
    {
        $this->assertEmpty((new Router($this->container))->routes());
    }

    #[DataProviderExternal(\Tests\DataProviders\RouterDataProvider::class, 'routeNotFoundCases')]
    public function test_throws_route_not_found_exception(
        string $requestUri,
        string $requestMethod
    ): void {
        $users = new class () {
            public function delete(): bool
            {
                return true;
            }
        };

        $this->router->get('/users', [$users::class, 'index']);
        $this->router->post('/users', ['Users', 'store']);

        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestUri, $requestMethod);
    }

    public function test_resolves_route_from_a_closure(): void
    {
        $this->router->get('/users', fn() => [1, 2, 3]);

        $this->assertEquals(
            [1, 2, 3],
            $this->router->resolve('/users', 'GET')
        );
    }

    public function test_resolves_route(): void
    {
        $users = new class () {
            public function index(): array
            {
                return [1, 2, 3];
            }
        };

        $this->router->get('/users', [$users::class,'index']);
        $this->assertSame([1,2, 3], $this->router->resolve('/users','GET'));
    }
}
