<?php
declare(strict_types=1);

namespace Zbkm\Evm\Interfaces;

interface IGasCalculator
{
    /**
     * Perform gas calculation
     *
     * @return int spent gas
     */
    public function calculateGas(): int;
    public function calculateRefundGas(): int;
}