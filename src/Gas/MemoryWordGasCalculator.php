<?php
declare(strict_types=1);

namespace Zbkm\Evm\Gas;

use Zbkm\Evm\Interfaces\IGasCalculator;

class MemoryWordGasCalculator implements IGasCalculator
{
    public function __construct(
        protected int $byteSizeToCopy,
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
        return 3 * ~~$minimumWordSize;
    }

    public function calculateRefundGas(): int
    {
        return 0;
    }
}