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
     * @param int $mts
     */
    public function __construct($mts = 0)
    {
        $this->mts = $mts;
    }

}