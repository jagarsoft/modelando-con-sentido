<?php

namespace Joselfonseca\Mcs\CalculateShirtPrice;


/**
 * Class CalculatePriceShirtCommand
 * @package Joselfonseca\Mcs\CalculateShirtPrice
 */
class CalculateShirtPriceCommand {

    /**
     * Metros de tela
     * @var int
     */
    public $mts;


    /**
     * Referencia de la tela
     * @var
     */
    public $fabricSku;

    /**
     * @param int $mts
     */
    public function __construct($mts = 0, $fabricSku = null)
    {
        $this->mts = $mts;
        $this->fabricSku = $fabricSku;
    }

}