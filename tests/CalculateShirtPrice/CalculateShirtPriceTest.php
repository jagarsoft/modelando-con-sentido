<?php

namespace Joselfonseca\Mcs\Tests\CalculateShirtPrice;


use Joselfonseca\Mcs\Tests\TestCase;
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
        $command = $this->runCommand();
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
        $command = $this->runCommand();
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
        $command = $this->runCommand();
        $this->assertEquals(2500, $command->manufactureCost);
    }

    /**
     * @test
     */
    public function it_adds_cut_costs_to_the_shirt()
    {
        $command = $this->runCommand();
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

    /**
     * @test
     */
    public function it_calculates_embroidery_price()
    {
        $command = $this->runCommand();
        $this->assertEquals(3000, $command->embroidery['price']);
    }

    /**
     * @test
     */
    public function it_sets_total_costs_for_shirt()
    {
        $command = $this->runCommand();
        $this->assertEquals(10750, $command->totalCosts);
    }

    /**
     * @test
     */
    public function it_calculates_administrative_costs_for_shirt()
    {
        $command = $this->runCommand();
        $this->assertEquals(1075, $command->administrativeCost);
    }

    /**
     * @test
     */
    public function it_calculates_utility_for_shirt()
    {
        $command = $this->runCommand();
        $this->assertEquals(8278, $command->utility);
    }

    /**
     * @test
     */
    public function it_calculates_tax_for_shirt()
    {
        $command = $this->runCommand();
        $this->assertEquals(3217, $command->tax);
    }

    /**
     * @test
     */
    public function it_calculates_sale_price()
    {
        $command = $this->runCommand();
        $this->assertEquals(23320, $command->salePrice);
    }

}