<?php
declare(strict_types=1);

namespace Zbkm\Evm\Gas;

use Zbkm\Evm\Utils\Hex;

/**
 * Gas Calculator for memory extend operation
 */
class MemoryExtendGasCalculator extends BaseGasCalculator
{
    /**
     * @param Hex $initialMemorySize initial memory size
     * @param Hex $memorySize memory size
     */
    public function __construct(
        protected Hex $initialMemorySize,
        protected Hex $memorySize,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function calculateGas(): int
    {
        return MemoryGasHelper::getExpansionPrice($this->memorySize, $this->initialMemorySize);
    }
}