<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Get the base fee
 */
class BaseFee extends BaseOpcode
{
    protected const OPCODE = "48";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->baseFee));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(2)];
    }
}