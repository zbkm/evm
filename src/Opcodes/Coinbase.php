<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Gas\StaticGasCalculator;
use Zbkm\Evm\Utils\Hex;

/**
 * Get the block’s beneficiary address
 */
class Coinbase extends BaseOpcode
{
    protected const OPCODE = "41";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->coinbase));
    }

    protected function getGasCalculators(): array
    {
        return [new StaticGasCalculator(2)];
    }
}