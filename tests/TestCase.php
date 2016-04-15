<?php

namespace Joselfonseca\Mcs\Tests;

use Joselfonseca\FonckToolbox\ServicesFactory;
use Joselfonseca\Mcs\CalculateShirtPrice\CalculateShirtPriceCommand;
use Joselfonseca\Mcs\CalculateShirtPrice\Middleware\AddManFractureCost;
use Joselfonseca\Mcs\CalculateShirtPrice\Middleware\CalculateEmbroidery;
use Joselfonseca\Mcs\CalculateShirtPrice\Middleware\CalculateFabricPrice;
use Joselfonseca\Mcs\CalculateShirtPrice\Middleware\CalculateButtonsPrice;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\FabricArrayRepository;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\ButtonsArrayRepository;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\FabricRepositoryInterface;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\ButtonsRepositoryInterface;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\ManufactureRepositoryInterface;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\ManufactureCostArrayRepository;

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
        $this->services->container->add(ButtonsRepositoryInterface::class, ButtonsArrayRepository::class);
        $this->services->container->add(ManufactureRepositoryInterface::class, ManufactureCostArrayRepository::class);
        parent::setUp();
    }

    /**
     * Get the Services Factory
     */
    public function testGetServicesFactory()
    {
        $this->assertInstanceOf('Joselfonseca\FonckToolbox\ServicesFactory', $this->services);
    }

    /**
     * @return mixed
     */
    protected function runCommand()
    {
        $command = $this->services->bus->dispatch(CalculateShirtPriceCommand::class, [
            'mts' => 1.5,
            'fabricSku' => 'RET490',
            'buttons' => 10,
            'buttonSku' => 'BUT78',
            'shirtSku' => 'COP567',
            'embroidery' => [
                'quantity' => 2,
                'unitPrice' => 1500
            ],
            'administrativePercent' => 10,
            'utilityPercent' => 70,
            'taxPercent' => 16
        ], [
            CalculateFabricPrice::class,
            CalculateButtonsPrice::class,
            AddManFractureCost::class,
            CalculateEmbroidery::class
        ]);
        return $command;
    }

}