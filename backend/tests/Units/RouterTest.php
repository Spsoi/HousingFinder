<?php

namespace Tests\Unit\Tests;

use App\Http\Route\Route;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    public $router;
    public function setUp() : void
    {
        parent::setUp();
        $this->router = new Route;
    }

    /**@test*/
    //vendor\bin\phpunit --filter test_it_registers_a_route
    public function test_it_registers_a_route() : void
    {
        $this->router->get('/test/test', [TestController::class, 'test']);
        $expected = [
            [
                'method' => 'GET',
                'uri' => '/test/test',
                'handler' => [TestController::class, 'test']
            ]
        ];  
        $this->assertEquals($expected,  $this->router->routes());
    }

    /**@test*/
    //vendor\bin\phpunit --filter test_it_run_migration
    public function test_it_run_migration() : void
    {
        $this->router->get('/run/migration', [RunMigration::class, 'runMigration']);
        $expected = [
            [
                'method' => 'GET',         
                'uri' => '/run/migration',     
                'handler' => [RunMigration::class, 'runMigration']  
            ]
        ];
        $this->assertEquals($expected, $this->router->routes());
    }

    /**@test*/
    //vendor\bin\phpunit --filter test_empty_route
    public function test_empty_route() : void
    {
        $this->router = new Route;
        $this->assertEquals([], $this->router->routes());
    }   
}