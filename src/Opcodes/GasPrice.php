<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\Hex;

/**
 * Get price of gas in current environment
 */
class GasPrice extends BaseOpcode
{
    protected const STATIC_GAS = 2;
    protected const OPCODE = "3A";

    public function execute(): void
    {
        $this->context->stack->pushHex(
            Hex::from($this->context->state->gasPrice)
        );
    }
}