<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Get deposited value by the instruction/transaction responsible for this execution
 */
class CallValue extends BaseOpcode
{
    protected const OPCODE = "34";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->value));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(2)];
    }
}