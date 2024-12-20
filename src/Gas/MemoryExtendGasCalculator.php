<?php
declare(strict_types=1);

namespace Zbkm\Evm\Gas;

use Zbkm\Evm\Interfaces\IGasCalculator;
use Zbkm\Evm\Opcodes\CallDataCopy;
use Zbkm\Evm\Utils\Hex;

/**
 * Gas Calculator for memory extend operation
 * @see CallDataCopy
 */
class MemoryExtendGasCalculator implements IGasCalculator
{
    /**
     * @param Hex $initialMemorySize initial memory size
     * @param int $byteSizeToCopy byte size to copy
     * @param Hex $memorySize memory size
     */
    public function __construct(
        protected Hex $initialMemorySize,
        protected int $byteSizeToCopy,
        protected Hex $memorySize,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function calculateGas(): int
    {
        // minimum_word_size = (size + 31) / 32
        // dynamic_gas = 3 * minimum_word_size + memory_expansion_cost
        $minimumWordSize = ($this->byteSizeToCopy + 31) / 32;
        $memoryExpansionCost = MemoryGasHelper::getExpansionPrice($this->memorySize, $this->initialMemorySize);
        return 3 * ~~$minimumWordSize + $memoryExpansionCost;
    }
}