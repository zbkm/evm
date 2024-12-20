<?php
declare(strict_types=1);

namespace Zbkm\Evm\Gas;

use Zbkm\Evm\Interfaces\IGasCalculator;

/**
 * Static gas calculation
 * @note will return the number specified in the constructor, yes
 */
class StaticGasCalculator implements IGasCalculator
{
    /**
     * @param int $value static gas value
     */
    public function __construct(protected int $value)
    {
    }

    /**
     * @inheritDoc
     */
    public function calculateGas(): int
    {
        return $this->value;
    }
}