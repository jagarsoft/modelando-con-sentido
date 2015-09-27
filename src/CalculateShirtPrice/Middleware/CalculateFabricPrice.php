<?php

namespace Joselfonseca\Mcs\CalculateShirtPrice\Middleware;

use League\Tactician\Middleware;

class CalculateFabricPrice implements Middleware{


    protected $fabricVendorPrice = 2500;


    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $command->fabricPrice = $this->fabricVendorPrice * $command->mts;
        return $next($command);
    }
}