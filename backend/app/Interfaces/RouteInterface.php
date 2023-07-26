<?php

namespace App\Interfaces;

interface RouteInterface
{
    public static function get(string $uri, array $handler): void;
    public static function post(string $uri, array $handler): void;
    public static function routes(): array;
}