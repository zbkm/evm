<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\Hex;

/**
 * Get the block’s gas limit
 */
class GasLimit extends BaseOpcode
{
    protected const STATIC_GAS = 2;
    protected const OPCODE = "45";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->gasLimit));
    }
}