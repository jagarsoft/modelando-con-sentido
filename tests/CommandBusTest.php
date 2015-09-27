<?php

namespace Joselfonseca\Mcs\Tests;

use Joselfonseca\FonckToolbox\ServicesFactory;

/**
 * Class CommandBusTest
 * @package Joselfonseca\Mcs\Tests
 */
class CommandBusTest extends \PHPUnit_Framework_TestCase{

    /**
     * Get the Services Factory
     * @return ServicesFactory
     */
    public function testGetServicesFactory()
    {
        $services = new ServicesFactory();
        $this->assertInstanceOf('Joselfonseca\FonckToolbox\ServicesFactory', $services);
        return $services;
    }

    /**
     * @depends testGetServicesFactory
     */
    public function test_it_gets_the_command_and_gives_it_to_the_bus($services)
    {
        $services->bus->dispatch(\Joselfonseca\Mcs\CalculateShirtPrice\CalculateShirtPriceCommand::class, []);
        $this->assertTrue(true);
    }

    /**
     * @depends testGetServicesFactory
     */
    public function test_it_calculates_fabric_price($services)
    {
        $command = $services->bus->dispatch(\Joselfonseca\Mcs\CalculateShirtPrice\CalculateShirtPriceCommand::class, [
            'mts' => 1.5
        ], [
            \Joselfonseca\Mcs\CalculateShirtPrice\Middleware\CalculateFabricPrice::class
        ]);
        $this->assertEquals(3750, $command->fabricPrice);
    }

}