<?php
declare(strict_types=1);

namespace Zbkm\Evm\Gas;

/**
 * Static gas calculation
 * @note will return the number specified in the constructor, yes
 */
class StaticGasCalculator extends BaseGasCalculator
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