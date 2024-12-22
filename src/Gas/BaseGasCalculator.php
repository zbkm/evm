<?php
declare(strict_types=1);

namespace Zbkm\Evm\Gas;

use Zbkm\Evm\Interfaces\IGasCalculator;

abstract class BaseGasCalculator implements IGasCalculator
{

    /**
     * @inheritDoc
     */
    abstract public function calculateGas(): int;

    /**
     * @inheritDoc
     */
    public function calculateRefundGas(): int
    {
        return 0;
    }
}