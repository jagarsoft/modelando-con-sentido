<?php

namespace Joselfonseca\Mcs\Tests;


/**
 * Class CommandBusTest
 * @package Joselfonseca\Mcs\Tests
 */
class CommandBusTest extends TestCase
{

    /**
     * @test
     * Test the command bus
     */
    public function it_gets_the_command_and_gives_it_to_the_bus()
    {
        $this->services->bus->dispatch(\Joselfonseca\Mcs\CalculateShirtPrice\CalculateShirtPriceCommand::class, []);
        $this->assertTrue(true);
    }

}