<?php

namespace Joselfonseca\Mcs\Tests\CalculateShirtPrice;


use Joselfonseca\Mcs\Tests\TestCase;
use Joselfonseca\Mcs\CalculateShirtPrice\CalculateShirtPriceCommand;
use Joselfonseca\Mcs\CalculateShirtPrice\Middleware\AddManuFactureCost;
use Joselfonseca\Mcs\CalculateShirtPrice\Middleware\CalculateFabricPrice;
use Joselfonseca\Mcs\CalculateShirtPrice\Middleware\CalculateButtonsPrice;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\FabricArrayRepository;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\ButtonsArrayRepository;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\ManufactureCostArrayRepository;

class CalculateShirtPriceTest extends TestCase
{

    /**
     * @test
     */
    public function it_calculates_fabric_price()
    {
        $command = $this->services->bus->dispatch(CalculateShirtPriceCommand::class, [
            'mts' => 1.5,
            'fabricSku' => 'RET490'
        ], [
            CalculateFabricPrice::class
        ]);
        $this->assertEquals(3750, $command->fabricPrice);
    }

    /**
     * @test
     * @expectedException     Joselfonseca\Mcs\CalculateShirtPrice\Exceptions\FabricNotFoundException
     */
    public function it_throws_exception_when_fabric_not_found()
    {
        $repository = new FabricArrayRepository();
        $repository->getFabricPrice('TEST234');
    }

    /**
     * @test
     */
    public function it_calculates_shirt_buttons_price()
    {
        $command = $this->services->bus->dispatch(CalculateShirtPriceCommand::class, [
            'mts' => 1.5,
            'fabricSku' => 'RET490',
            'buttons' => 10,
            'buttonSku' => 'BUT78'
        ], [
            CalculateFabricPrice::class,
            CalculateButtonsPrice::class
        ]);
        $this->assertEquals(1000, $command->buttonsPrice);
    }

    /**
     * @test
     * @expectedException     Joselfonseca\Mcs\CalculateShirtPrice\Exceptions\ButtonNotFoundException
     */
    public function it_throws_exception_when_button_sku_not_found()
    {
        $buttonRepository = new ButtonsArrayRepository();
        $buttonRepository->getButtonPriceBySku("HTGTRED4556645");
    }

    /**
     * @test
     */
    public function it_adds_manufacture_costs_to_the_shirt()
    {
        $command = $this->services->bus->dispatch(CalculateShirtPriceCommand::class, [
            'mts' => 1.5,
            'fabricSku' => 'RET490',
            'buttons' => 10,
            'buttonSku' => 'BUT78',
            'shirtSku' => 'COP567'
        ], [
            CalculateFabricPrice::class,
            CalculateButtonsPrice::class,
            AddManuFactureCost::class
        ]);
        $this->assertEquals(2500, $command->manufactureCost);
    }

    /**
     * @test
     */
    public function it_adds_cut_costs_to_the_shirt()
    {
        $command = $this->services->bus->dispatch(CalculateShirtPriceCommand::class, [
            'mts' => 1.5,
            'fabricSku' => 'RET490',
            'buttons' => 10,
            'buttonSku' => 'BUT78',
            'shirtSku' => 'COP567'
        ], [
            CalculateFabricPrice::class,
            CalculateButtonsPrice::class,
            AddManuFactureCost::class
        ]);
        $this->assertEquals(500, $command->cutCost);
    }

    /**
     * @test
     * @expectedException     Joselfonseca\Mcs\CalculateShirtPrice\Exceptions\ManufactureCostNotFoundException
     */
    public function it_throws_exception_if_no_cut_cost_found_in_repository()
    {
        $repository = new ManufactureCostArrayRepository();
        $repository->getCutCost('TYHYYT67');
    }

    /**
     * @test
     * @expectedException     Joselfonseca\Mcs\CalculateShirtPrice\Exceptions\ManufactureCostNotFoundException
     */
    public function it_throws_exception_if_no_manufacture_cost_found_in_repository()
    {
        $repository = new ManufactureCostArrayRepository();
        $repository->getManufactureCost('TYHYYT67');
    }

}