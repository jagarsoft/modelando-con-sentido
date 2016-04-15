<?php

namespace Joselfonseca\Mcs\CalculateShirtPrice;


class CalculateShirtPriceCommandHandler {

    public function handle($command)
    {
        $this->calculateTotalCosts($command);
        $this->calculateAdministrativeCosts($command);
        $this->calculateUtility($command);
        $this->calculateTax($command);
        $this->calculateSalePrice($command);
        return $command;
    }

    protected function calculateTotalCosts($command)
    {
        $command->totalCosts = $command->fabricPrice + $command->buttonsPrice + $command->manufactureCost + $command->cutCost + $command->embroidery['price'];
        return $this;
    }

    protected function calculateAdministrativeCosts($command)
    {
        $command->administrativeCost = ceil(($command->totalCosts * $command->administrativePercent) / 100);
    }

    protected function calculateUtility($command)
    {
        $command->utility = ceil((($command->totalCosts + $command->administrativeCost) * $command->utilityPercent) / 100);
    }
    
    protected function calculateTax($command)
    {
        $command->tax = ceil((($command->totalCosts + $command->administrativeCost + $command->utility) * $command->taxPercent) / 100);
    }

    protected function calculateSalePrice($command)
    {
        $command->salePrice = $command->totalCosts + $command->administrativeCost + $command->utility + $command->tax;
    }

}