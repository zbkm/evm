<?php
declare(strict_types=1);

namespace Zbkm\Evm\Opcodes;

use Zbkm\Evm\Utils\Hex;

/**
 * Get the block’s timestamp
 */
class Timestamp extends BaseOpcode
{
    protected const STATIC_GAS = 2;
    protected const OPCODE = "42";

    public function execute(): void
    {
        $this->context->stack->pushHex(Hex::from($this->context->state->timestamp));
    }
}