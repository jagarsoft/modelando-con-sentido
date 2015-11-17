<?php

namespace Joselfonseca\Mcs\Tests;

use Joselfonseca\FonckToolbox\ServicesFactory;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\FabricArrayRepository;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\FabricRepositoryInterface;

/**
 * Class TestCase
 * @package Joselfonseca\Mcs\Tests
 */
class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @var
     */
    public $services;

    /**
     * Configurar ambiente.
     */
    public function setUp()
    {
        $this->services = new ServicesFactory();
        $this->services->container->add(FabricRepositoryInterface::class, FabricArrayRepository::class);
        parent::setUp();
    }

    /**
     * Get the Services Factory
     */
    public function testGetServicesFactory()
    {
        $this->assertInstanceOf('Joselfonseca\FonckToolbox\ServicesFactory', $this->services);
    }

}