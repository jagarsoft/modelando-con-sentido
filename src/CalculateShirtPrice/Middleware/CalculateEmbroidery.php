<?php

namespace Joselfonseca\Mcs\CalculateShirtPrice\Middleware;

use League\Tactician\Middleware;
use Joselfonseca\Mcs\CalculateShirtPrice\Exceptions\EmbroideryFormatException;

/**
 * Class CalculateEmbroidery
 * @package Joselfonseca\Mcs\CalculateShirtPrice\Middleware
 */
class CalculateEmbroidery implements Middleware
{

    /**
     * @param object $command
     * @param callable $next
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        if (empty($command->embroidery)) {
            return $next($command);
        }
        $this->calculateEmbroideryPrice($command);
        return $next($command);
    }

    /**
     * @param $command
     * @throws EmbroideryFormatException
     */
    public function calculateEmbroideryPrice($command)
    {
        $this->validateInput($command);
        $command->embroidery['price'] = $command->embroidery['quantity'] * $command->embroidery['unitPrice'];
    }

    /**
     * @param $command
     * @throws EmbroideryFormatException
     */
    protected function validateInput($command)
    {
        if (!is_array($command->embroidery)) {
            throw new EmbroideryFormatException("Embroidery is not an Array");
        }
        if (!isset($command->embroidery['quantity'])) {
            $command->embroidery['quantity'] = 1;
        }
        if (!isset($command->embroidery['unitPrice'])) {
            throw new EmbroideryFormatException("Embroidery does not have unitPrice index");
        }
    }
}