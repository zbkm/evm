<?php
declare(strict_types=1);

namespace Zbkm\Evm\Gas;

use Zbkm\Evm\Opcodes\Exp;
use Zbkm\Evm\Utils\Hex;

/**
 * Gas Calculator for Exp opcode
 * @see Exp
 */
class ExpGasCalculator extends BaseGasCalculator
{
    /**
     * @param Hex $exponent exponent
     */
    public function __construct(
        protected Hex $exponent
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function calculateGas(): int
    {
        // dynamic_gas = 50 * exponent_byte_size
        return 50 * $this->getExponentByteSize();
    }

    protected function getExponentByteSize(): int
    {
        if ($this->exponent->get() == "0") {
            return 0;
        }

        return count(str_split($this->exponent->get(), 2));
    }
}