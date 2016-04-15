<?php

namespace Joselfonseca\Mcs\CalculateShirtPrice;

/**
 * Class CalculateShirtPriceCommand
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
    public $buttonSku;

    /**
     * SKU de la camisa
     * @var null
     */
    public $shirtSku;

    /**
     * @var
     */
    public $embroidery;

    /**
     * @var
     */
    public $administrativePercent;

    /**
     * @var
     */
    public $utilityPercent;

    /**
     * @var
     */
    public $taxPercent;


    /**
     * CalculateShirtPriceCommand constructor.
     * @param int $mts
     * @param null $fabricSku
     * @param int $buttons
     * @param null $buttonSku
     * @param null $shirtSku
     * @param null $embroidery
     * @param int $administrativePercent
     * @param int $utilityPercent
     * @param int $taxPercent
     */
    public function __construct($mts = 0, $fabricSku = null, $buttons = 8, $buttonSku = null, $shirtSku = null, $embroidery = null, $administrativePercent = 10, $utilityPercent = 50, $taxPercent = 16)
    {
        $this->mts = $mts;
        $this->fabricSku = $fabricSku;
        $this->buttons = $buttons;
        $this->buttonSku = $buttonSku;
        $this->shirtSku = $shirtSku;
        $this->embroidery = $embroidery;
        $this->administrativePercent = $administrativePercent;
        $this->utilityPercent = $utilityPercent;
        $this->taxPercent = $taxPercent;
    }

}