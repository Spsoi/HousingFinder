<?php

namespace Tests\Units\Controllers;

use App\Http\Controllers\CustomerController;
use App\Services\Addresses\AddressService;
use App\Services\Warehouse\WarehouseService;
use PHPUnit\Framework\TestCase;

class CustomerControllerTest extends TestCase
{
    public function testGetDeliveryCost()
    {
        // Создаем mock объекты AddressService и WarehouseService
        $addressServiceMock = $this->getMockBuilder(AddressService::class)
                                ->getMock();
        $warehouseServiceMock = $this->getMockBuilder(WarehouseService::class)
                                    ->getMock();

        // Создаем контроллер и передаем mock объекты через set метод
        $controller = new CustomerController();
        $controller->set('service', $addressServiceMock);
        $controller->set('verification', $warehouseServiceMock);

        // Устанавливаем ожидание, что метод costDelivery() в AddressService будет вызван один раз с нужным параметром
        $addressServiceMock->expects($this->once())
                        ->method('costDelivery')
                        ->with($this->equalTo(['address_id_1', 'address_id_2']))
                        ->willReturn(123.45);

        // Мокаем getArrayStream() метод, чтобы он возвращал нужные значения
        $controllerMock = $this->getMockBuilder(CustomerController::class)
                            ->setMethods(['getArrayStream'])
                            ->getMock();
        $controllerMock->expects($this->once())
                    ->method('getArrayStream')
                    ->willReturn(['addresses' => ['address_id_1', 'address_id_2']]);

        // Вызываем тестируемый метод и проверяем результат
        $result = $controllerMock->getDeliveryCost();
        $this->assertEquals(['cost' => 123.45, 'seller_id' => null], $result);
    }
    // public function testGetDeliveryCost()
    // {
    //     // Создаем заглушки для AddressService и WarehouseService
    //     $addressServiceMock = $this->createMock(AddressService::class);
    //     $warehouseServiceMock = $this->createMock(WarehouseService::class);

    //     // Устанавливаем ожидания для AddressService и WarehouseService
    //     $addressServiceMock->expects($this->once())
    //         ->method('costDelivery')
    //         ->willReturn(100);

    //     $warehouseServiceMock->expects($this->once())
    //         ->method('getWarehouseByAddressId')
    //         ->willReturnSelf();

    //     $warehouseModelMock = $this->createMock(stdClass::class);
    //     $warehouseModelMock->expects($this->once())
    //         ->method('get')
    //         ->willReturnSelf();

    //     $warehouseModelMock->expects($this->once())
    //         ->method('first')
    //         ->willReturn((object)['seller_id' => 123]);

    //     $warehouseServiceMock->expects($this->once())
    //         ->method('getWarehouseByAddressId')
    //         ->willReturn($warehouseModelMock);

    //     // Создаем экземпляр CustomerController с заглушками
    //     $controller = new CustomerController($addressServiceMock, $warehouseServiceMock);

    //     // Вызываем тестируемый метод
    //     $result = $controller->getDeliveryCost();

    //     // Проверяем результат
    //     $this->assertEquals(['cost' => 100, 'seller_id' => 123], $result);
    // }
}