<?php

namespace Joselfonseca\Mcs\CalculateShirtPrice\Repositories;


use Joselfonseca\Mcs\CalculateShirtPrice\Exceptions\ButtonNotFoundException;

/**
 * Class ButtonsArrayRepository
 * @package Joselfonseca\Mcs\CalculateShirtPrice\Repositories
 */
class ButtonsArrayRepository implements ButtonsRepositoryInterface
{

    /**
     * @var array
     */
    protected $buttons = [
        'BUT78' => 100
    ];

    /**
     *
     * @param $sku
     * @return float
     */
    public function getButtonPriceBySku($sku)
    {
        if(isset($this->buttons[$sku])){
            return (float) $this->buttons[$sku];
        }
        throw new ButtonNotFoundException;
    }
}