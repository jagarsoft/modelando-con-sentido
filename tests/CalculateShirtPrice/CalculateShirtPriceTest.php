<?php

namespace Joselfonseca\Mcs\Tests\CalculateShirtPrice;


use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\ButtonsArrayRepository;
use Joselfonseca\Mcs\Tests\TestCase;
use Joselfonseca\Mcs\CalculateShirtPrice\Repositories\FabricArrayRepository;

class CalculateShirtPriceTest extends TestCase
{

    /**
     * @test
     */
    public function it_calculates_fabric_price()
    {
        $command = $this->services->bus->dispatch(\Joselfonseca\Mcs\CalculateShirtPrice\CalculateShirtPriceCommand::class, [
            'mts' => 1.5,
            'fabricSku' => 'RET490'
        ], [
            \Joselfonseca\Mcs\CalculateShirtPrice\Middleware\CalculateFabricPrice::class
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
        $command = $this->services->bus->dispatch(\Joselfonseca\Mcs\CalculateShirtPrice\CalculateShirtPriceCommand::class, [
            'mts' => 1.5,
            'fabricSku' => 'RET490',
            'buttons' => 10,
            'buttonSku' => 'BUT78'
        ], [
            \Joselfonseca\Mcs\CalculateShirtPrice\Middleware\CalculateFabricPrice::class,
            \Joselfonseca\Mcs\CalculateShirtPrice\Middleware\CalculateButtonsPrice::class
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

}