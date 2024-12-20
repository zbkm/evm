<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Get the block’s difficulty
 */
class PrevRandao extends BaseOpcode
{
    protected const OPCODE = "44";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->prevRandao));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(2)];
    }
}