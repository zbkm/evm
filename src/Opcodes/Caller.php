<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Get caller address
 */
class Caller extends BaseOpcode
{
    protected const OPCODE = "33";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->caller));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(2)];
    }
}