<?php

namespace App\Http\Route;

use App\Interfaces\RouteInterface;

class Route implements RouteInterface
{
    protected static array $routes = [];
   
    public static function get(string $uri, array $handler): void
    {
        self::$routes[] = [
            'method' => 'GET',
            'uri' => $uri,
            'handler' => $handler,
        ];
    }

    public static function post(string $uri, array $handler): void
    {
        self::$routes[] = [
            'method' => 'POST',
            'uri' => $uri,
            'handler' => $handler,
        ];
    }

    public static function routes(): array
    {
        return self::$routes;
    }
}