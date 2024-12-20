<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Get the chain ID
 */
class ChainId extends BaseOpcode
{
    protected const OPCODE = "46";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->chainId));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(2)];
    }
}