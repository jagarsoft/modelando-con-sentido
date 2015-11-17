<?php

namespace Joselfonseca\Mcs\CalculateShirtPrice\Repositories;


/**
 * Interface FabricRepositoryInterface
 * @package Joselfonseca\Mcs\CalculateShirtPrice\Repositories
 */
interface FabricRepositoryInterface
{

    /**
     * Obtiene el precio de la tela usando el SKU
     * @param $fabricSku
     * @return float Precio de la tela del fabricante
     */
    public function getFabricPrice($fabricSku);

}