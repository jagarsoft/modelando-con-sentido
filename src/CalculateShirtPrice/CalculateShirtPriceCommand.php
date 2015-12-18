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
     * Cantidad de botones
     * @var int
     */
    public $buttons;

    /**
     * SKU de los botones a usar
     * @var null
     */
    public $buttonsSku;

    /**
     * @param int $mts
     */
    public function __construct(
        $mts = 0,
        $fabricSku = null,
        $buttons = 8,
        $buttonSku = null
    )
    {
        $this->mts = $mts;
        $this->fabricSku = $fabricSku;
        $this->buttons = $buttons;
        $this->buttonSku = $buttonSku;
    }

}